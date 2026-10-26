<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $rating = $request->query('rating');
        $status = $request->query('status');
        $sort = $request->query('sort', 'latest');

        $query = Video::query()->with('sceneReports');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('filename', 'like', "%{$search}%")
                  ->orWhere('sha256_hash', 'like', "%{$search}%");
            });
        }

        if ($rating) {
            $query->where('recommended_rating', $rating)
                  ->orWhere('final_rating', $rating);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $videos = $query->paginate(10)->withQueryString();

        // 4 Kartu Metrik Operasional Riwayat
        $metrics = [
            'total_videos' => 142,
            'completed' => 134,
            'processing' => 3,
            'flagged' => 5,
            'valid_rate' => 94.4,
            'gpu_nodes' => 2,
        ];

        return view('dashboard.riwayat', compact('videos', 'metrics', 'search', 'rating', 'status', 'sort'));
    }

    public function downloadSingleJson($id)
    {
        $video = Video::with('sceneReports')->findOrFail($id);

        $data = [
            'lsf_metadata' => [
                'ticket_id' => $video->ticket_id,
                'timestamp_export' => now()->toIso8601String(),
                'system_version' => 'LSF-Vision-CMS-v1.0',
                'regulasi' => 'UU No. 33 Tahun 2009 tentang Perfilman',
            ],
            'file_info' => [
                'title' => $video->title,
                'filename' => $video->filename,
                'sha256' => $video->sha256_hash,
                'size_bytes' => $video->file_size_bytes,
                'duration' => $video->duration,
                'resolution' => $video->resolution,
            ],
            'classification_result' => [
                'recommended_rating' => $video->recommended_rating,
                'final_verified_rating' => $video->final_rating,
                'confidence_score' => $video->confidence_rate / 100,
                'total_scenes_analyzed' => $video->sceneReports->count(),
                'high_risk_scenes_count' => $video->sceneReports->where('risk_level', 'Tinggi')->count(),
                'reviewer_notes' => $video->reviewer_notes,
                'reviewer_name' => $video->reviewer_name,
            ],
            'scene_breakdown' => $video->sceneReports->map(function ($s) {
                return [
                    'timecode' => $s->timecode,
                    'scene_summary' => $s->scene_summary,
                    'tag' => $s->tag,
                    'risk_level' => $s->risk_level,
                    'evidence_frames' => $s->evidence_frames,
                    'reviewer_notes' => $s->reviewer_notes,
                ];
            }),
        ];

        return response()->json($data, 200, [
            'Content-Disposition' => "attachment; filename=\"{$video->ticket_id}_LSF_Report.json\"",
        ]);
    }

    public function downloadMasterJson()
    {
        $videos = Video::with('sceneReports')->get();

        $masterData = [
            'archive_header' => [
                'institution' => 'Lembaga Sensor Film Republik Indonesia',
                'export_date' => now()->toIso8601String(),
                'total_records' => $videos->count(),
                'system' => 'CMS Klasifikasi Video LSF Master Archive',
            ],
            'records' => $videos->map(function ($video) {
                return [
                    'ticket_id' => $video->ticket_id,
                    'title' => $video->title,
                    'filename' => $video->filename,
                    'sha256' => $video->sha256_hash,
                    'medium' => $video->medium,
                    'genre' => $video->genre,
                    'rating' => $video->final_rating ?? $video->recommended_rating,
                    'status' => $video->status,
                    'confidence_rate' => $video->confidence_rate,
                    'scene_count' => $video->sceneReports->count(),
                    'created_at' => $video->created_at->toIso8601String(),
                ];
            }),
        ];

        return response()->json($masterData, 200, [
            'Content-Disposition' => 'attachment; filename="lsf_master_archive_' . date('Ymd_His') . '.json"',
        ]);
    }

    public function downloadBatchCsv()
    {
        $videos = Video::all();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="lsf_riwayat_sensor_' . date('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['ID Tiket', 'Judul Film', 'Nama Berkas', 'Format', 'Resolusi', 'Durasi', 'Rating Rekomendasi', 'Rating Final', 'Akurasi AI (%)', 'Status', 'Verifikator', 'Tanggal Unggah'];

        $callback = function () use ($videos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($videos as $video) {
                fputcsv($file, [
                    $video->ticket_id,
                    $video->title,
                    $video->filename,
                    $video->format,
                    $video->resolution,
                    $video->duration,
                    $video->recommended_rating,
                    $video->final_rating ?? '-',
                    $video->confidence_rate . '%',
                    ucfirst($video->status),
                    $video->reviewer_name ?? 'Belum Ditinjau',
                    $video->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
