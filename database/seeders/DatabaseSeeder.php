<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\SceneReport;
use App\Models\AuditLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Verifikator Resmi LSF
        $user = User::updateOrCreate(
            ['email' => 'verifikator@lsf.go.id'],
            [
                'name' => 'Dra. Ratna Kusuma, M.Si.',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@lsf.go.id'],
            [
                'name' => 'Dimas Prasetyo, S.Kom. (IT Admin)',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Video Sampel Utama untuk Halaman Klasifikasi
        $mainVideo = Video::updateOrCreate(
            ['ticket_id' => 'LSF-2026-X8910'],
            [
                'title' => 'Generasi Emas: Kisah Sahabat',
                'filename' => 'film_preview_sample_01.mp4',
                'file_size_bytes' => 104857600,
                'file_size_formatted' => '100 MB',
                'format' => 'MP4',
                'duration' => '00:45:12',
                'resolution' => '1920x1080 FHD',
                'sha256_hash' => 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',
                'storage_path' => 'videos/sample_01.mp4',
                'recommended_rating' => '13+',
                'final_rating' => '13+',
                'confidence_rate' => 94.4,
                'status' => 'completed',
                'medium' => 'Layar Lebar',
                'genre' => 'Drama',
                'elements' => ['Dialog Remaja', 'Edukasi Karakter', 'Pemberdayaan'],
                'reviewer_name' => 'Dra. Ratna Kusuma, M.Si.',
                'reviewer_notes' => 'Konten visual dialog remaja berimbang. Aman dan sesuai untuk penonton 13 tahun ke atas.',
                'verified_at' => now()->subHours(2),
            ]
        );

        // Adegan untuk video utama
        SceneReport::updateOrCreate(
            ['video_id' => $mainVideo->id, 'timecode' => '00:10'],
            [
                'scene_summary' => 'Sebuah layar digital menampilkan foto grup dari sekelompok remaja perempuan yang sedang berpose di dalam ruangan, dengan beberapa orang mengenakan hijab.',
                'tag' => 'Dialog',
                'risk_level' => 'Rendah',
                'evidence_frames' => [
                    'Frame 1 pada 0:00 (Pembuka suasana kelas)',
                    'Frame 2 pada 0:05 (Foto grup tersenyum)',
                    'Frame 3 pada 0:07 (Interaksi santai)'
                ],
                'reviewer_notes' => 'Konten visual menampilkan foto & video grup remaja yang sedang berpose. Tidak terlihat konten berbahaya seperti kekerasan.',
                'is_flagged' => false,
            ]
        );

        SceneReport::updateOrCreate(
            ['video_id' => $mainVideo->id, 'timecode' => '14:22'],
            [
                'scene_summary' => 'Perdebatan sengit antartokoh mengenai pilihan studi perguruan tinggi, intonasi suara meninggi tanpa kontak fisik.',
                'tag' => 'Dialog',
                'risk_level' => 'Rendah',
                'evidence_frames' => [
                    'Frame 4 pada 14:15 (Karakter berbicara serius)',
                    'Frame 5 pada 14:22 (Ekspresi emosional normal)'
                ],
                'reviewer_notes' => 'Konflik drama remaja realistis, tidak mengandung ujaran kebencian maupun kata-kata kasar.',
                'is_flagged' => false,
            ]
        );

        SceneReport::updateOrCreate(
            ['video_id' => $mainVideo->id, 'timecode' => '28:50'],
            [
                'scene_summary' => 'Karakter utama berlari menyeberangi jalan raya padat kendaraan untuk mengejar bus terakhir.',
                'tag' => 'Aksi',
                'risk_level' => 'Sedang',
                'evidence_frames' => [
                    'Frame 6 pada 28:45 (Adegan lari)',
                    'Frame 7 pada 28:50 (Kendaraan mengerem)'
                ],
                'reviewer_notes' => 'Perilaku sedikit berisiko namun tidak dimaksudkan untuk ditiru secara destruktif.',
                'is_flagged' => false,
            ]
        );

        // 3. Koleksi Arsip Riwayat Analisis
        $sampleVideos = [
            [
                'ticket_id' => 'LSF-2026-X8909',
                'title' => 'Misteri Rumah Tua Angker',
                'filename' => 'teaser_horor_rumah_tua.mkv',
                'file_size_bytes' => 2254857600,
                'file_size_formatted' => '2.1 GB',
                'format' => 'MKV',
                'duration' => '01:52:10',
                'resolution' => '3840x2160 4K',
                'sha256_hash' => '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',
                'recommended_rating' => '17+',
                'final_rating' => null,
                'confidence_rate' => 88.5,
                'status' => 'flagged',
                'medium' => 'Layar Lebar',
                'genre' => 'Horror',
                'elements' => ['Horor Supranatural', 'Jumpscare Tinggi', 'Ketegangan Gelap'],
                'reviewer_name' => 'Dra. Ratna Kusuma, M.Si.',
                'reviewer_notes' => 'Terdapat adegan kemunculan makhluk astral mendadak dengan efek darah non-eksplisit. Membutuhkan verifikasi ulang batas 17+.',
                'verified_at' => null,
            ],
            [
                'ticket_id' => 'LSF-2026-X8908',
                'title' => 'Cinta di Kota Tua Batavia',
                'filename' => 'cinta_di_kota_tua.mov',
                'file_size_bytes' => 891289600,
                'file_size_formatted' => '850 MB',
                'format' => 'MOV',
                'duration' => '01:34:25',
                'resolution' => '1920x1080 FHD',
                'sha256_hash' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8',
                'recommended_rating' => '13+',
                'final_rating' => '13+',
                'confidence_rate' => 96.1,
                'status' => 'completed',
                'medium' => 'Televisi',
                'genre' => 'Romance',
                'elements' => ['Romansa Santun', 'Latar Budaya', 'Busana Tradisional'],
                'reviewer_name' => 'Budi Santoso, M.Sn.',
                'reviewer_notes' => 'Unsur romantis dikemas santun sesuai etika penyiaran televisi nasional.',
                'verified_at' => now()->subDay(),
            ],
            [
                'ticket_id' => 'LSF-2026-X8907',
                'title' => 'Petualangan Rimba Khatulistiwa',
                'filename' => 'petualangan_rimba.mp4',
                'file_size_bytes' => 1503238553,
                'file_size_formatted' => '1.4 GB',
                'format' => 'MP4',
                'duration' => '01:28:40',
                'resolution' => '1920x1080 FHD',
                'sha256_hash' => '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a',
                'recommended_rating' => 'SU',
                'final_rating' => 'SU',
                'confidence_rate' => 98.7,
                'status' => 'completed',
                'medium' => 'Televisi',
                'genre' => 'Dokumenter',
                'elements' => ['Flora Fauna', 'Konservasi Alam', 'Keluarga'],
                'reviewer_name' => 'Siti Nurhaliza, M.Sos.',
                'reviewer_notes' => 'Sangat mendidik dan aman untuk seluruh kategori umur.',
                'verified_at' => now()->subDays(2),
            ],
            [
                'ticket_id' => 'LSF-2026-X8906',
                'title' => 'Garis Batas Kecepatan',
                'filename' => 'garis_batas_kecepatan.mp4',
                'file_size_bytes' => 3145728000,
                'file_size_formatted' => '2.9 GB',
                'format' => 'MP4',
                'duration' => '02:05:15',
                'resolution' => '1920x1080 FHD',
                'sha256_hash' => 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d',
                'recommended_rating' => '17+',
                'final_rating' => '17+',
                'confidence_rate' => 92.3,
                'status' => 'completed',
                'medium' => 'JTI',
                'genre' => 'Action',
                'elements' => ['Balap Liar', 'Tabrakan Mobil', 'Ketegangan Tinggi'],
                'reviewer_name' => 'Dra. Ratna Kusuma, M.Si.',
                'reviewer_notes' => 'Adegan balapan berbahaya berulang, tepat diklasifikasikan untuk 17+.',
                'verified_at' => now()->subDays(3),
            ],
            [
                'ticket_id' => 'LSF-2026-X8905',
                'title' => 'Malam Penuh Rahasia',
                'filename' => 'episode_spesial_04.mkv',
                'file_size_bytes' => 1200000000,
                'file_size_formatted' => '1.1 GB',
                'format' => 'MKV',
                'duration' => '00:58:30',
                'resolution' => '1920x1080 FHD',
                'sha256_hash' => 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',
                'recommended_rating' => '17+',
                'final_rating' => null,
                'confidence_rate' => 65.0,
                'status' => 'processing',
                'medium' => 'JTI',
                'genre' => 'Thriller',
                'elements' => ['Investigasi', 'Suasana Mencekam'],
                'reviewer_name' => null,
                'reviewer_notes' => null,
                'verified_at' => null,
            ]
        ];

        foreach ($sampleVideos as $vidData) {
            $vid = Video::updateOrCreate(['ticket_id' => $vidData['ticket_id']], $vidData);

            AuditLog::create([
                'video_id' => $vid->id,
                'action' => 'Job Inference Triggered',
                'user_name' => 'System Worker GPU-Node-01',
                'details' => 'Memulai proses ekstraksi frame dan klasifikasi multi-modal model.',
                'ip_address' => '127.0.0.1',
            ]);

            if ($vid->status === 'completed') {
                AuditLog::create([
                    'video_id' => $vid->id,
                    'action' => 'Verifikasi Selesai',
                    'user_name' => $vid->reviewer_name ?? 'Verifikator LSF',
                    'details' => "Menetapkan rating {$vid->final_rating} dengan catatan telaah resmi.",
                    'ip_address' => '127.0.0.1',
                ]);
            }
        }
    }
}
