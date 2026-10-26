@extends('layouts.app')

@section('title', 'Laporan — Statistik & Visualisasi Grafik Agregat')

@section('content')
<div class="space-y-6">

    <!-- Header Laporan -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black text-[#2C2C33] tracking-tight">
                Laporan Klasifikasi Video
            </h1>
            <p class="text-xs text-slate-500">
                Visualisasi metrik operasional dan sebaran demografi sensor film lintas kategori media edar.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-3.5 py-2 rounded-xl bg-white border border-[#C1CDD4] text-[#2C2C33] hover:bg-slate-50 text-xs font-semibold flex items-center gap-1.5 shadow-xs">
                <i data-lucide="printer" class="w-4 h-4 text-slate-500"></i>
                <span>Cetak Laporan</span>
            </button>
            <a href="{{ route('riwayat.master-json') }}" class="px-4 py-2 rounded-xl bg-[#003F85] text-white hover:bg-[#00336D] text-xs font-bold flex items-center gap-1.5 shadow-sm">
                <i data-lucide="download" class="w-4 h-4 text-[#26B1EB]"></i>
                <span>Download Master JSON</span>
            </a>
        </div>
    </div>

    <!-- 4 Kartu Ringkasan Medium Tayang Sensor (Total, Layar Lebar, Televisi, JTI) -->
    <div class="bg-white p-6 rounded-2xl border border-[#C1CDD4]/60 shadow-xs">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-blue-50 text-[#003F85] flex items-center justify-center">
                    <i data-lucide="file-bar-chart" class="w-4 h-4"></i>
                </span>
                <div>
                    <h2 class="text-base font-bold text-[#2C2C33]">Ringkasan Laporan Sensor</h2>
                    <span class="text-xs text-slate-400">Akumulasi seluruh media penayangan resmi</span>
                </div>
            </div>
            <a href="{{ route('laporan.detail') }}" class="text-xs font-bold text-[#003F85] hover:text-[#26B1EB] flex items-center gap-1">
                <span>Lihat Detail Rekap</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Data -->
            <div class="p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center gap-4 hover:border-[#003F85]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-[#003F85]/10 text-[#003F85] flex items-center justify-center shrink-0">
                    <i data-lucide="layers" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Total Materi</span>
                    <span class="text-2xl font-black text-[#2C2C33]">{{ $mediaSummary['total']['count'] }}</span>
                    <span class="text-[11px] font-semibold text-emerald-600 block mt-0.5">
                        {{ $mediaSummary['total']['trend'] }}
                    </span>
                </div>
            </div>

            <!-- Layar Lebar (Bioskop) -->
            <div class="p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center gap-4 hover:border-[#003F85]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center shrink-0">
                    <i data-lucide="projector" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Layar Lebar</span>
                    <span class="text-2xl font-black text-[#2C2C33]">{{ $mediaSummary['layar_lebar']['count'] }}</span>
                    <span class="text-[11px] font-semibold text-emerald-600 block mt-0.5">
                        {{ $mediaSummary['layar_lebar']['trend'] }}
                    </span>
                </div>
            </div>

            <!-- Televisi -->
            <div class="p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center gap-4 hover:border-[#003F85]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-[#003F85] flex items-center justify-center shrink-0">
                    <i data-lucide="tv" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Televisi</span>
                    <span class="text-2xl font-black text-[#2C2C33]">{{ $mediaSummary['televisi']['count'] }}</span>
                    <span class="text-[11px] font-semibold text-emerald-600 block mt-0.5">
                        {{ $mediaSummary['televisi']['trend'] }}
                    </span>
                </div>
            </div>

            <!-- JTI (Streaming / OTT) -->
            <div class="p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center gap-4 hover:border-[#003F85]/40 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-[#5744C1] flex items-center justify-center shrink-0">
                    <i data-lucide="wifi" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">JTI (Streaming)</span>
                    <span class="text-2xl font-black text-[#2C2C33]">{{ $mediaSummary['jti']['count'] }}</span>
                    <span class="text-[11px] font-semibold text-emerald-600 block mt-0.5">
                        {{ $mediaSummary['jti']['trend'] }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 Kolom Visualisasi: Bar Chart Usia + Pie Chart Genre -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Grafik Batang: Sebaran Klasifikasi Usia (6 Kolom) -->
        <div class="lg:col-span-6 bg-white p-6 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <div>
                    <h3 class="text-base font-bold text-[#2C2C33]">Sebaran Klasifikasi Usia</h3>
                    <p class="text-xs text-slate-400">Distribusi kuantitas judul film berdasarkan rating usia</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 rounded-lg text-slate-600">Grafik Batang</span>
            </div>

            <!-- Visual Bar Chart CSS Pure -->
            <div class="space-y-4 my-2">
                @foreach($ageDistribution as $bar)
                <div class="space-y-1">
                    <div class="flex items-center justify-between text-xs font-semibold">
                        <span class="text-slate-700 flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $bar['color'] }}"></span>
                            {{ $bar['label'] }}
                        </span>
                        <span class="font-mono text-[#2C2C33]">{{ $bar['count'] }} Judul ({{ $bar['percentage'] }}%)</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500" 
                             style="width: {{ $bar['percentage'] * 2.5 }}%; background-color: {{ $bar['color'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-[11px] text-slate-500 mt-4 flex items-center justify-between">
                <span>Total sampel film: 1.248</span>
                <span>Standar: PP No. 18/2014</span>
            </div>
        </div>

        <!-- Grafik Pie / Lingkaran: Distribusi Genre Konten (6 Kolom) -->
        <div class="lg:col-span-6 bg-white p-6 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <div>
                    <h3 class="text-base font-bold text-[#2C2C33]">Distribusi Genre Film</h3>
                    <p class="text-xs text-slate-400">Komposisi persentase tema materi sensor</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 rounded-lg text-slate-600">Grafik Pie</span>
            </div>

            <!-- Visual Pie Chart Menggunakan Conic Gradient Dinamis -->
            <div class="my-4 flex flex-col sm:flex-row items-center justify-center gap-6">
                <div class="relative w-40 h-40 rounded-full shrink-0 shadow-sm"
                     style="background: conic-gradient(
                         #C8282E 0% 34.2%,
                         #1F6BB3 34.2% 56.3%,
                         #26B1EB 56.3% 74.8%,
                         #701C85 74.8% 90.0%,
                         #1899A3 90.0% 100%
                     );">
                     <div class="absolute inset-4 rounded-full bg-white flex items-center justify-center">
                         <span class="text-xs font-bold text-slate-700">5 Genre</span>
                     </div>
                </div>

                <div class="space-y-2 text-xs flex-1 w-full">
                    @foreach($genreDistribution as $item)
                    <div class="flex items-center justify-between p-1.5 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full" style="background-color: {{ $item['color'] }}"></span>
                            <span class="font-medium text-slate-700">{{ $item['genre'] }}</span>
                        </div>
                        <span class="font-mono font-bold text-[#2C2C33]">{{ $item['percentage'] }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-[11px] text-slate-500 mt-4 flex items-center justify-between">
                <span>Genre terbanyak: Horror (34.2%)</span>
                <span>Paling sedikit: Edukasi (10.0%)</span>
            </div>
        </div>

    </div>

</div>
@endsection
