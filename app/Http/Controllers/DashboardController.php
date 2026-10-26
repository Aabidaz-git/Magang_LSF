<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Distribusi Sensor Film LSF
        $stats = [
            'total_materi' => 47840,
            'su' => [
                'count' => 18420,
                'percentage' => 38.5,
                'target' => 'Penonton Semua Umur',
                'badge' => 'SU',
                'color' => '#1899A3',
            ],
            'r13' => [
                'count' => 15310,
                'percentage' => 32.0,
                'target' => 'Remaja Usia 13 Tahun ke Atas',
                'badge' => '13+',
                'color' => '#DC7634',
            ],
            'd17' => [
                'count' => 11530,
                'percentage' => 24.1,
                'target' => 'Dewasa Usia 17 Tahun ke Atas',
                'badge' => '17+',
                'color' => '#C8282E',
            ],
            'd21' => [
                'count' => 2580,
                'percentage' => 5.4,
                'target' => 'Dewasa Usia 21 Tahun ke Atas',
                'badge' => '21+',
                'color' => '#4B2979',
            ],
        ];

        // Indikator Efisiensi Operasional (Mockup Dashboard)
        $operationalMetrics = [
            'readiness_percent' => 62,
            'overall_efficiency' => 91.7,
            'in_operation' => 11,
            'at_unloading' => 3,
            'standing' => 1,
            'on_repair' => 0,
            'on_relay' => 7,
            'recent_videos' => Video::orderBy('created_at', 'desc')->take(5)->get(),
        ];

        return view('dashboard.home', compact('stats', 'operationalMetrics'));
    }
}
