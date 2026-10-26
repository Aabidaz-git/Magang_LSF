@extends('layouts.app')

@section('title', 'Riwayat Analisis — Arsip Audit Sensor LSF')

@section('content')
<div class="space-y-6">

    <!-- Header Section Arsip Audit -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#003F85] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                ARSIP AUDIT SENSOR LSF RI
            </span>
            <h1 class="text-2xl font-black text-[#2C2C33] tracking-tight mt-2">
                Riwayat Analisis Terkini &amp; Log Klasifikasi Video
            </h1>
            <p class="text-xs text-slate-500 max-w-2xl mt-0.5">
                Arsip lengkap hasil telaah sensor mandiri berbasis multimodal AI (Qwen-VL) sesuai UU No. 33/2009 tentang Perfilman &amp; Kriteria Sensor LSF Republik Indonesia.
            </p>
        </div>

        <!-- Aksi Massal -->
        <div class="flex items-center gap-2.5">
            <a href="{{ route('riwayat.batch-csv') }}" class="px-3.5 py-2 rounded-xl bg-white border border-[#C1CDD4] text-[#2C2C33] hover:bg-slate-50 text-xs font-semibold flex items-center gap-1.5 shadow-xs transition-colors">
                <i data-lucide="file-spreadsheet" class="w-4 h-4 text-emerald-600"></i>
                <span>Export Batch (CSV)</span>
            </a>
            <a href="{{ route('riwayat.master-json') }}" class="px-3.5 py-2 rounded-xl bg-[#26B1EB] hover:bg-[#009CDD] text-white text-xs font-semibold flex items-center gap-1.5 shadow-xs transition-colors">
                <i data-lucide="file-code" class="w-4 h-4"></i>
                <span>Download Master JSON</span>
            </a>
            <button onclick="window.location.reload()" class="p-2 rounded-xl bg-white border border-[#C1CDD4] text-slate-600 hover:bg-slate-50 shadow-xs" title="Segarkan Log">
                <i data-lucide="rotate-cw" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    <!-- 4 Kartu Metrik Status Antrean & GPU Nodes (Sesuai Wireframe Riwayat) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Metric 1: Total Video -->
        <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-xs text-slate-500 mb-2 font-medium">
                <span>Total Video Dianalisis</span>
                <i data-lucide="film" class="w-4 h-4 text-[#003F85]"></i>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-[#2C2C33]">{{ $metrics['total_videos'] }}</span>
                <span class="text-[11px] font-semibold text-[#003F85] bg-blue-50 px-2 py-0.5 rounded-full">+18% bulan ini</span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-3">
                <div class="bg-[#003F85] h-full rounded-full" style="width: 85%"></div>
            </div>
        </div>

        <!-- Metric 2: Status Selesai / Terverifikasi -->
        <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-xs text-slate-500 mb-2 font-medium">
                <span>Status Selesai (Terverifikasi)</span>
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-[#2C2C33]">{{ $metrics['completed'] }}</span>
                <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">94.4% Rate Valid</span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-3">
                <div class="bg-emerald-600 h-full rounded-full" style="width: 94%"></div>
            </div>
        </div>

        <!-- Metric 3: Sedang Diproses (Inference) -->
        <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-xs text-slate-500 mb-2 font-medium">
                <span>Sedang Diproses (Inference)</span>
                <i data-lucide="cpu" class="w-4 h-4 text-[#26B1EB]"></i>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-[#009CDD]">{{ $metrics['processing'] }}</span>
                <span class="text-[11px] font-semibold text-[#003F85] bg-sky-50 px-2 py-0.5 rounded-full">{{ $metrics['gpu_nodes'] }} GPU Nodes</span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-3">
                <div class="bg-[#26B1EB] h-full rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <!-- Metric 4: Butuh Tinjauan Verifikator -->
        <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between text-xs text-slate-500 mb-2 font-medium">
                <span>Butuh Tinjauan Verifikator</span>
                <i data-lucide="alert-triangle" class="w-4 h-4 text-[#C8282E]"></i>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-[#C8282E]">{{ $metrics['flagged'] }}</span>
                <span class="text-[11px] font-semibold text-red-700 bg-red-50 px-2 py-0.5 rounded-full">Flagged 21+ / Anomali</span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-3">
                <div class="bg-[#C8282E] h-full rounded-full" style="width: 35%"></div>
            </div>
        </div>
    </div>

    <!-- Bilah Pencarian & Multi-Parameter Filter (Diadopsi dari Mockup Statistics) -->
    <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs">
        <form action="{{ route('riwayat.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            
            <!-- Input Pencarian -->
            <div class="sm:col-span-4 relative flex items-center">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5"></i>
                <input type="text" name="search" value="{{ $search }}"
                       placeholder="Cari Tiket (LSF-2026-X), Judul, atau SHA-256..."
                       class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#26B1EB]">
            </div>

            <!-- Filter Rating -->
            <div class="sm:col-span-2">
                <select name="rating" class="w-full px-3 py-2 bg-slate-50 border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] focus:outline-none focus:ring-2 focus:ring-[#26B1EB]">
                    <option value="">Semua Rating Usia</option>
                    <option value="SU" {{ $rating === 'SU' ? 'selected' : '' }}>Semua Umur (SU)</option>
                    <option value="13+" {{ $rating === '13+' ? 'selected' : '' }}>Remaja 13+</option>
                    <option value="17+" {{ $rating === '17+' ? 'selected' : '' }}>Dewasa 17+</option>
                    <option value="21+" {{ $rating === '21+' ? 'selected' : '' }}>Dewasa 21+</option>
                </select>
            </div>

            <!-- Filter Status -->
            <div class="sm:col-span-2">
                <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] focus:outline-none focus:ring-2 focus:ring-[#26B1EB]">
                    <option value="">Semua Status</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Selesai Terverifikasi</option>
                    <option value="processing" {{ $status === 'processing' ? 'selected' : '' }}>Sedang Diproses (Inference)</option>
                    <option value="flagged" {{ $status === 'flagged' ? 'selected' : '' }}>Butuh Tinjauan (Flagged)</option>
                </select>
            </div>

            <!-- Urutan -->
            <div class="sm:col-span-2">
                <select name="sort" class="w-full px-3 py-2 bg-slate-50 border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] focus:outline-none focus:ring-2 focus:ring-[#26B1EB]">
                    <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Urut: Terbaru</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Urut: Terlama</option>
                </select>
            </div>

            <!-- Tombol Filter Merah (#C8282E sesuai referensi mockup) -->
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="flex-1 py-2 px-3 bg-[#C8282E] hover:bg-[#A61F24] text-white text-xs font-bold rounded-xl shadow-xs transition-colors flex items-center justify-center gap-1.5">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                    <span>Terapkan</span>
                </button>
                @if($search || $rating || $status)
                <a href="{{ route('riwayat.index') }}" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl" title="Reset Filter">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Antrean & Arsip Sensor -->
    <div class="bg-white rounded-2xl border border-[#C1CDD4]/60 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-[#C1CDD4]/60">
                    <tr>
                        <th class="px-5 py-3.5">ID Tiket &amp; Judul</th>
                        <th class="px-5 py-3.5">Spesifikasi Video</th>
                        <th class="px-5 py-3.5">Elemen Terdeteksi</th>
                        <th class="px-5 py-3.5">Akurasi &amp; Rating</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 text-xs">
                    @forelse($videos as $video)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <!-- ID Tiket & Judul -->
                        <td class="px-5 py-4">
                            <span class="font-mono font-bold text-[#003F85] block">{{ $video->ticket_id }}</span>
                            <span class="font-bold text-[#2C2C33] text-sm block mt-0.5 truncate max-w-xs">{{ $video->title }}</span>
                            <span class="text-[10px] text-slate-400 block font-mono">Hash: {{ substr($video->sha256_hash ?? 'e3b0c442...', 0, 16) }}...</span>
                        </td>

                        <!-- Spesifikasi Video -->
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="space-y-0.5">
                                <div><b class="text-slate-800">{{ $video->format }}</b> · {{ $video->resolution }}</div>
                                <div class="text-slate-500 font-mono">{{ $video->duration }} · {{ $video->file_size_formatted }}</div>
                                <div class="text-[10px] text-slate-400">{{ $video->created_at->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </td>

                        <!-- Elemen Terdeteksi -->
                        <td class="px-5 py-4 max-w-xs">
                            <div class="flex flex-wrap gap-1.5">
                                @if(!empty($video->elements))
                                    @foreach($video->elements as $elm)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ $elm }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-slate-400 text-[11px]">-</span>
                                @endif
                            </div>
                        </td>

                        <!-- Akurasi & Rating -->
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                @php
                                    $finalRating = $video->final_rating ?? $video->recommended_rating;
                                    $pillClass = $finalRating === 'SU' ? 'bg-[#1899A3]' : ($finalRating === '13+' ? 'bg-[#DC7634]' : ($finalRating === '17+' ? 'bg-[#C8282E]' : 'bg-[#4B2979]'));
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold text-white {{ $pillClass }}">
                                    {{ $finalRating }}
                                </span>
                                <span class="font-mono text-xs font-bold text-[#003F85]">{{ $video->confidence_rate }}%</span>
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-5 py-4 whitespace-nowrap">
                            @if($video->status === 'completed')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-teal-50 text-[#1899A3] border border-teal-200 flex items-center gap-1 w-max">
                                    <i data-lucide="check" class="w-3 h-3"></i> Terverifikasi
                                </span>
                            @elseif($video->status === 'flagged')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-50 text-[#C8282E] border border-red-200 flex items-center gap-1 w-max">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i> Butuh Tinjauan
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-[#009CDD] border border-sky-200 flex items-center gap-1 w-max">
                                    <i data-lucide="loader-2" class="w-3 h-3 animate-spin"></i> Sedang Diproses
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('klasifikasi.show', $video->id) }}" 
                                   class="px-2.5 py-1.5 rounded-lg bg-[#003F85] hover:bg-[#00336D] text-white text-xs font-semibold flex items-center gap-1 shadow-xs transition-colors">
                                    <span>Buka Hasil</span>
                                </a>
                                <a href="{{ route('riwayat.single-json', $video->id) }}" 
                                   class="px-2 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-[#003F85] text-xs font-bold border border-slate-200 transition-colors"
                                   title="Unduh JSON Berkas">
                                    + JSON
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            Tidak ditemukan riwayat analisis video yang cocok dengan kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi Halaman -->
        @if($videos->hasPages())
        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <div>
                Menampilkan <b>{{ $videos->firstItem() }}</b> - <b>{{ $videos->lastItem() }}</b> dari <b>{{ $videos->total() }}</b> entri
            </div>
            <div>
                {{ $videos->links() }}
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
