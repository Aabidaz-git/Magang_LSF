@extends('layouts.app')

@section('title', 'Detail Ringkasan Laporan — LSF RI')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('laporan.index') }}" class="p-2 rounded-xl bg-white border border-[#C1CDD4] text-slate-600 hover:bg-slate-50 shadow-xs">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-[#2C2C33] tracking-tight">
                    Rincian Rekapitulasi Laporan Sensor
                </h1>
                <p class="text-xs text-slate-500">
                    Tabel breakdown data sensor film berdasarkan media distribusi dan genre.
                </p>
            </div>
        </div>
        <button onclick="window.print()" class="px-3.5 py-2 rounded-xl bg-white border border-[#C1CDD4] text-[#2C2C33] hover:bg-slate-50 text-xs font-semibold flex items-center gap-1.5 shadow-xs">
            <i data-lucide="printer" class="w-4 h-4 text-slate-500"></i>
            <span>Cetak Rekap</span>
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-[#C1CDD4]/60 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-[#C1CDD4]/60">
                    <tr>
                        <th class="px-5 py-3.5">ID Tiket</th>
                        <th class="px-5 py-3.5">Judul Materi</th>
                        <th class="px-5 py-3.5">Media Edar</th>
                        <th class="px-5 py-3.5">Genre</th>
                        <th class="px-5 py-3.5">Rating Final</th>
                        <th class="px-5 py-3.5">Akurasi</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 text-xs">
                    @forelse($videos as $item)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-3.5 font-mono font-bold text-[#003F85]">{{ $item->ticket_id }}</td>
                        <td class="px-5 py-3.5 font-semibold text-[#2C2C33]">{{ $item->title }}</td>
                        <td class="px-5 py-3.5">
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700">
                                {{ $item->medium }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">{{ $item->genre }}</td>
                        <td class="px-5 py-3.5">
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold text-white {{ ($item->final_rating ?? $item->recommended_rating) === 'SU' ? 'bg-[#1899A3]' : (($item->final_rating ?? $item->recommended_rating) === '13+' ? 'bg-[#DC7634]' : 'bg-[#C8282E]') }}">
                                {{ $item->final_rating ?? $item->recommended_rating }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 font-mono font-semibold text-slate-600">{{ $item->confidence_rate }}%</td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('klasifikasi.show', $item->id) }}" class="text-xs font-semibold text-[#003F85] hover:underline">
                                Buka Detail &rarr;
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-400">Belum ada data rekapan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
