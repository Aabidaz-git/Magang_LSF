<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // 4 Kartu Medium Tayang Sensor
        $mediaSummary = [
            'total' => [
                'count' => '1.248',
                'trend' => '↑12% dari bulan sebelumnya',
                'trend_type' => 'up',
            ],
            'layar_lebar' => [
                'count' => '312',
                'trend' => '↑8% dari bulan sebelumnya',
                'trend_type' => 'up',
            ],
            'televisi' => [
                'count' => '520',
                'trend' => '↑15% dari bulan sebelumnya',
                'trend_type' => 'up',
            ],
            'jti' => [
                'count' => '416',
                'trend' => '↑24% dari bulan sebelumnya',
                'trend_type' => 'up',
            ],
        ];

        // Data Grafik Batang: Sebaran Klasifikasi Usia
        $ageDistribution = [
            ['label' => 'SU (Semua Umur)', 'count' => 480, 'color' => '#1899A3', 'percentage' => 38.5],
            ['label' => '13+ (Remaja)', 'count' => 399, 'color' => '#DC7634', 'percentage' => 32.0],
            ['label' => '17+ (Dewasa)', 'count' => 301, 'color' => '#C8282E', 'percentage' => 24.1],
            ['label' => '21+ (Dewasa Khusus)', 'count' => 68, 'color' => '#4B2979', 'percentage' => 5.4],
        ];

        // Data Grafik Pie: Distribusi Genre Konten
        $genreDistribution = [
            ['genre' => 'Horror', 'percentage' => 34.2, 'count' => 427, 'color' => '#C8282E'],
            ['genre' => 'Action', 'percentage' => 22.1, 'count' => 276, 'color' => '#1F6BB3'],
            ['genre' => 'Comedy', 'percentage' => 18.5, 'count' => 231, 'color' => '#26B1EB'],
            ['genre' => 'Romance', 'percentage' => 15.2, 'count' => 190, 'color' => '#701C85'],
            ['genre' => 'Lain-lain (Dokumenter/Animasi)', 'percentage' => 10.0, 'count' => 124, 'color' => '#1899A3'],
        ];

        return view('dashboard.laporan', compact('mediaSummary', 'ageDistribution', 'genreDistribution'));
    }

    public function detail()
    {
        $videos = Video::orderBy('created_at', 'desc')->get();
        return view('dashboard.ringkasan-laporan', compact('videos'));
    }
}
