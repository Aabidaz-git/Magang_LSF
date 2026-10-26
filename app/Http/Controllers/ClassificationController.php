<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\SceneReport;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassificationController extends Controller
{
    public function index(Request $request)
    {
        $videoId = $request->query('video_id');
        
        if ($videoId) {
            $video = Video::with('sceneReports')->find($videoId);
        } else {
            $video = Video::with('sceneReports')->where('ticket_id', 'LSF-2026-X8910')->first() 
                ?? Video::with('sceneReports')->latest()->first();
        }

        $recentVideos = Video::orderBy('created_at', 'desc')->take(6)->get();

        return view('dashboard.klasifikasi', compact('video', 'recentVideos'));
    }

    public function show($id)
    {
        $video = Video::with('sceneReports')->findOrFail($id);
        $recentVideos = Video::orderBy('created_at', 'desc')->take(6)->get();

        return view('dashboard.klasifikasi', compact('video', 'recentVideos'));
    }

    public function chunkUpload(Request $request)
    {
        $request->validate([
            'chunk_index' => 'required|integer',
            'total_chunks' => 'required|integer',
            'file_name' => 'required|string',
            'file_id' => 'required|string',
            'chunk_data' => 'required|file',
        ]);

        $fileId = $request->input('file_id');
        $chunkIndex = $request->input('chunk_index');
        $uploadDir = storage_path("app/chunks/{$fileId}");

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $request->file('chunk_data')->move($uploadDir, "part_{$chunkIndex}");

        return response()->json([
            'status' => 'success',
            'chunk_index' => $chunkIndex,
            'message' => "Chunk {$chunkIndex} berhasil diunggah.",
        ]);
    }

    public function completeUpload(Request $request)
    {
        $request->validate([
            'file_id' => 'required|string',
            'file_name' => 'required|string',
            'total_size' => 'required|integer',
            'total_chunks' => 'required|integer',
        ]);

        $fileName = $request->input('file_name');
        $fileSize = $request->input('total_size');
        $ticketId = 'LSF-2026-X' . rand(8911, 9999);
        $fileExt = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION) ?: 'MP4');
        $sizeMB = round($fileSize / (1024 * 1024), 1) . ' MB';

        // Buat record Video baru di database
        $video = Video::create([
            'ticket_id' => $ticketId,
            'title' => pathinfo($fileName, PATHINFO_FILENAME),
            'filename' => $fileName,
            'file_size_bytes' => $fileSize,
            'file_size_formatted' => $sizeMB,
            'format' => $fileExt,
            'duration' => '00:32:15',
            'resolution' => '1920x1080 FHD',
            'sha256_hash' => hash('sha256', $fileName . time()),
            'storage_path' => "videos/{$fileName}",
            'recommended_rating' => '13+',
            'confidence_rate' => 95.2,
            'status' => 'completed',
            'medium' => 'Layar Lebar',
            'genre' => 'Drama',
            'elements' => ['Dialog', 'Interaksi Sosial'],
            'reviewer_name' => 'Dra. Ratna Kusuma, M.Si.',
            'reviewer_notes' => 'Analisis otomatis selesai. Siap diverifikasi oleh verifikator.',
            'verified_at' => null,
        ]);

        // Tambahkan contoh scene analysis
        SceneReport::create([
            'video_id' => $video->id,
            'timecode' => '00:15',
            'scene_summary' => 'Perbincangan interaktif antartokoh dalam ruang pertemuan publik.',
            'tag' => 'Dialog',
            'risk_level' => 'Rendah',
            'evidence_frames' => ['Frame 1 pada 0:10', 'Frame 2 pada 0:15'],
            'reviewer_notes' => 'Tidak terdeteksi unsur negatif atau kekerasan.',
            'is_flagged' => false,
        ]);

        SceneReport::create([
            'video_id' => $video->id,
            'timecode' => '08:40',
            'scene_summary' => 'Adegan perdebatan keluarga dengan nada emosional terkontrol.',
            'tag' => 'Dialog',
            'risk_level' => 'Rendah',
            'evidence_frames' => ['Frame 3 pada 08:35', 'Frame 4 pada 08:40'],
            'reviewer_notes' => 'Sesuai dengan pedoman sensor bimbingan orang tua 13+.',
            'is_flagged' => false,
        ]);

        AuditLog::create([
            'video_id' => $video->id,
            'action' => 'Video Uploaded & Analyzed',
            'user_name' => 'Dra. Ratna Kusuma, M.Si.',
            'details' => "Mengunggah berkas {$fileName} melalui mekanisme chunking.",
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'status' => 'success',
            'video_id' => $video->id,
            'ticket_id' => $video->ticket_id,
            'redirect_url' => route('klasifikasi.show', $video->id),
        ]);
    }

    public function jobStatus(Request $request)
    {
        $ticketId = $request->query('ticket_id');
        $video = Video::where('ticket_id', $ticketId)->first();

        if (!$video) {
            return response()->json(['status' => 'not_found'], 404);
        }

        return response()->json([
            'status' => $video->status,
            'progress' => 100,
            'stage' => 'Klasifikasi Adegan Selesai',
            'confidence_rate' => $video->confidence_rate,
            'recommended_rating' => $video->recommended_rating,
        ]);
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'final_rating' => 'required|in:SU,13+,17+,21+',
            'reviewer_notes' => 'nullable|string',
        ]);

        $video = Video::findOrFail($id);
        $video->update([
            'final_rating' => $request->input('final_rating'),
            'reviewer_notes' => $request->input('reviewer_notes'),
            'status' => 'completed',
            'verified_at' => now(),
        ]);

        AuditLog::create([
            'video_id' => $video->id,
            'action' => 'Verifikasi Sensor Resmi',
            'user_name' => 'Dra. Ratna Kusuma, M.Si.',
            'details' => "Menetapkan klasifikasi usia resmi: {$request->input('final_rating')}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('klasifikasi.show', $video->id)
            ->with('success', "Keputusan sensor berhasil diverifikasi dengan rating {$video->final_rating}!");
    }
}
