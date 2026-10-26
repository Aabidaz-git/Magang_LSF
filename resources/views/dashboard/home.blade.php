@extends('layouts.app')

@section('title', 'Home — LSF Data Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Header Dashboard -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-[#003F85]">
                    Agregat Data Nasional
                </span>
                <span class="text-xs text-slate-400">Pembaruan: Hari ini, 09:55 WIB</span>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#2C2C33] tracking-tight mt-1">
                LSF Data Dashboard
            </h1>
            <p class="text-sm text-slate-500">
                Data Jumlah Klasifikasi Usia Materi Sensor Film (Periode 2020 - 2025)
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-3.5 py-2 rounded-xl bg-white border border-[#C1CDD4] text-[#2C2C33] hover:bg-slate-50 text-xs font-semibold flex items-center gap-2 shadow-xs transition-colors">
                <i data-lucide="printer" class="w-4 h-4 text-slate-500"></i>
                <span>Cetak Rekapitulasi</span>
            </button>
            <a href="{{ route('riwayat.batch-csv') }}" class="px-4 py-2 rounded-xl bg-[#003F85] hover:bg-[#00336D] text-white text-xs font-semibold flex items-center gap-2 shadow-sm transition-colors">
                <i data-lucide="download" class="w-4 h-4 text-[#26B1EB]"></i>
                <span>Export CSV</span>
            </a>
        </div>
    </div>

    <!-- 4 Primary Metric Cards Row (Diadopsi dari Mockup Dashboard Referensi) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <!-- Card 1: Red -->
        <div class="rounded-2xl p-5 text-white bg-gradient-to-br from-[#C8282E] to-[#A61F24] shadow-md shadow-red-900/10 flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-center justify-between opacity-90 text-xs font-medium mb-3">
                <span>Total Materi Sensor</span>
                <i data-lucide="film" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="text-3xl font-black tracking-tight">47.840</div>
                <div class="text-[11px] opacity-80 mt-1 flex items-center gap-1">
                    <span>↑ 18% dari periode lalu</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Cerulean Blue -->
        <div class="rounded-2xl p-5 text-white bg-gradient-to-br from-[#009CDD] to-[#007CB0] shadow-md shadow-sky-900/10 flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-center justify-between opacity-90 text-xs font-medium mb-3">
                <span>Tingkat Validitas AI</span>
                <i data-lucide="check-circle-2" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="text-3xl font-black tracking-tight">94.4 %</div>
                <div class="text-[11px] opacity-80 mt-1">Tingkat akurasi pre-screening</div>
            </div>
        </div>

        <!-- Card 3: Sky Blue -->
        <div class="rounded-2xl p-5 text-white bg-gradient-to-br from-[#26B1EB] to-[#009CDD] shadow-md shadow-sky-900/10 flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-center justify-between opacity-90 text-xs font-medium mb-3">
                <span>Efisiensi Sidang Sensor</span>
                <i data-lucide="trending-up" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="text-3xl font-black tracking-tight">91.7 %</div>
                <div class="text-[11px] opacity-80 mt-1">Rata-rata kecepatan telaah adegan</div>
            </div>
        </div>

        <!-- Card 4: Slate Dark -->
        <div class="rounded-2xl p-5 text-white bg-gradient-to-br from-[#1b2735] to-[#2C2C33] shadow-md shadow-slate-900/10 flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-center justify-between opacity-90 text-xs font-medium mb-3">
                <span>Total Judul Terverifikasi</span>
                <i data-lucide="archive" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="text-3xl font-black tracking-tight">45.260</div>
                <div class="text-[11px] opacity-80 mt-1">Arsip dokumen master JSON</div>
            </div>
        </div>
    </div>

    <!-- Section Distribusi Klasifikasi Usia & 4 Kartu Kategori -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
        <!-- Donut Distribusi Card (4 Kolom) -->
        <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-[#2C2C33] flex items-center justify-between">
                    <span>Distribusi Klasifikasi Usia</span>
                    <span class="text-xs font-normal text-slate-400">100% Total Data</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Proporsi rating film LSF RI</p>
            </div>

            <!-- Visual Donut Chart Interaktif Menggunakan Conic Gradient -->
            <div class="my-6 flex flex-col items-center justify-center">
                <div class="relative w-44 h-44 rounded-full conic-distribution flex items-center justify-center p-3 shadow-inner">
                    <div class="w-28 h-28 rounded-full bg-white flex flex-col items-center justify-center shadow-xs">
                        <span class="text-2xl font-black text-[#003F85]">100%</span>
                        <span class="text-[10px] uppercase font-bold text-slate-400">Total Data</span>
                    </div>
                </div>
            </div>

            <!-- Legend Donut Chart -->
            <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100">
                <div class="flex items-center gap-2 text-xs font-medium text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-[#1899A3]"></span>
                    <span>SU: <b>38.5%</b></span>
                </div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-[#DC7634]"></span>
                    <span>13+: <b>32.0%</b></span>
                </div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-[#C8282E]"></span>
                    <span>17+: <b>24.1%</b></span>
                </div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-[#4B2979]"></span>
                    <span>21+: <b>5.4%</b></span>
                </div>
            </div>
        </div>

        <!-- 4 Kotak Kartu Usia Individual (8 Kolom) -->
        <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Card SU -->
            <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between hover:border-[#1899A3] transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-[#1899A3] text-white flex items-center justify-center font-bold text-xs">SU</span>
                        <span class="font-bold text-sm text-[#2C2C33]">Semua Umur (SU)</span>
                    </div>
                    <span class="text-[11px] font-semibold text-[#1899A3] bg-teal-50 px-2 py-0.5 rounded-full">Ramah Anak</span>
                </div>
                <div class="my-2">
                    <div class="text-3xl font-extrabold text-[#1899A3]">38.5 %</div>
                    <p class="text-xs text-slate-500 mt-1">18.420 Judul Film &amp; Tayangan</p>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-2">
                    <div class="bg-[#1899A3] h-full rounded-full" style="width: 38.5%"></div>
                </div>
                <div class="text-[10px] text-slate-400 mt-3 pt-2 border-t border-slate-100 flex justify-between">
                    <span>Target: Penonton Semua Usia</span>
                    <span>2020 - 2025</span>
                </div>
            </div>

            <!-- Card 13+ -->
            <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between hover:border-[#DC7634] transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-[#DC7634] text-white flex items-center justify-center font-bold text-xs">13+</span>
                        <span class="font-bold text-sm text-[#2C2C33]">Remaja 13 Tahun (R13)</span>
                    </div>
                    <span class="text-[11px] font-semibold text-[#DC7634] bg-amber-50 px-2 py-0.5 rounded-full">Bimbingan</span>
                </div>
                <div class="my-2">
                    <div class="text-3xl font-extrabold text-[#DC7634]">32.0 %</div>
                    <p class="text-xs text-slate-500 mt-1">15.310 Judul Film &amp; Tayangan</p>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-2">
                    <div class="bg-[#DC7634] h-full rounded-full" style="width: 32%"></div>
                </div>
                <div class="text-[10px] text-slate-400 mt-3 pt-2 border-t border-slate-100 flex justify-between">
                    <span>Target: Remaja Usia 13 Tahun+</span>
                    <span>2020 - 2025</span>
                </div>
            </div>

            <!-- Card 17+ -->
            <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between hover:border-[#C8282E] transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-[#C8282E] text-white flex items-center justify-center font-bold text-xs">17+</span>
                        <span class="font-bold text-sm text-[#2C2C33]">Dewasa 17 Tahun (D17)</span>
                    </div>
                    <span class="text-[11px] font-semibold text-[#C8282E] bg-red-50 px-2 py-0.5 rounded-full">Ketegangan</span>
                </div>
                <div class="my-2">
                    <div class="text-3xl font-extrabold text-[#C8282E]">24.1 %</div>
                    <p class="text-xs text-slate-500 mt-1">11.530 Judul Film &amp; Tayangan</p>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-2">
                    <div class="bg-[#C8282E] h-full rounded-full" style="width: 24.1%"></div>
                </div>
                <div class="text-[10px] text-slate-400 mt-3 pt-2 border-t border-slate-100 flex justify-between">
                    <span>Target: Penonton Dewasa 17+</span>
                    <span>2020 - 2025</span>
                </div>
            </div>

            <!-- Card 21+ -->
            <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs flex flex-col justify-between hover:border-[#4B2979] transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-[#4B2979] text-white flex items-center justify-center font-bold text-xs">21+</span>
                        <span class="font-bold text-sm text-[#2C2C33]">Dewasa 21 Tahun (D21)</span>
                    </div>
                    <span class="text-[11px] font-semibold text-[#4B2979] bg-purple-50 px-2 py-0.5 rounded-full">Khusus</span>
                </div>
                <div class="my-2">
                    <div class="text-3xl font-extrabold text-[#4B2979]">5.4 %</div>
                    <p class="text-xs text-slate-500 mt-1">2.580 Judul Film &amp; Tayangan</p>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-2">
                    <div class="bg-[#4B2979] h-full rounded-full" style="width: 5.4%"></div>
                </div>
                <div class="text-[10px] text-slate-400 mt-3 pt-2 border-t border-slate-100 flex justify-between">
                    <span>Target: Dewasa Khusus 21 Tahun+</span>
                    <span>2020 - 2025</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Effectivity Indicators Slider Bar (Sesuai Mockup Referensi) -->
    <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 flex items-center gap-2">
                <i data-lucide="activity" class="w-4 h-4 text-[#003F85]"></i>
                <span>Status Kesiapan Operasional Sistem (Effectivity Indicators)</span>
            </h4>
            <span class="text-xs font-semibold text-[#003F85]">Readiness: 62%</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-center">
                <div class="text-xl font-bold text-[#003F85]">11</div>
                <div class="text-[10px] text-slate-500 font-medium">In Operation</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-center">
                <div class="text-xl font-bold text-[#26B1EB]">3</div>
                <div class="text-[10px] text-slate-500 font-medium">At Unloading</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-center">
                <div class="text-xl font-bold text-[#DC7634]">1</div>
                <div class="text-[10px] text-slate-500 font-medium">Standing Queue</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-center">
                <div class="text-xl font-bold text-emerald-600">0</div>
                <div class="text-[10px] text-slate-500 font-medium">On Repair</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-center">
                <div class="text-xl font-bold text-[#5744C1]">7</div>
                <div class="text-[10px] text-slate-500 font-medium">On Relay Node</div>
            </div>
        </div>
    </div>

    <!-- Tabel Rekapitulasi Sensor Film -->
    <div class="bg-white rounded-2xl border border-[#C1CDD4]/60 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-[#2C2C33]">Tabel Rekapitulasi Sensor Film</h3>
                <p class="text-xs text-slate-500">Rekapitulasi resmi penggolongan usia penonton sesuai kriteria sensor</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 bg-blue-50 text-[#003F85] rounded-full">
                UU No. 33/2009
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-[#C1CDD4]/60">
                    <tr>
                        <th class="px-6 py-3.5">Kategori Usia</th>
                        <th class="px-6 py-3.5">Target Penonton</th>
                        <th class="px-6 py-3.5">Jumlah Judul Film</th>
                        <th class="px-6 py-3.5">Persentase (%)</th>
                        <th class="px-6 py-3.5 text-right">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#1899A3] flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-[#1899A3] text-white flex items-center justify-center text-xs font-bold">SU</span>
                            <span>Semua Umur (SU)</span>
                        </td>
                        <td class="px-6 py-4 text-xs">Penonton Semua Umur (Ramah Keluarga)</td>
                        <td class="px-6 py-4 font-mono font-bold text-[#2C2C33]">18.420 Judul</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-[#1899A3]">38.5%</span>
                                <div class="w-24 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#1899A3] h-full rounded-full" style="width: 38.5%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('riwayat.index', ['rating' => 'SU']) }}" class="text-xs text-[#003F85] hover:underline font-semibold">Lihat Judul &rarr;</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#DC7634] flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-[#DC7634] text-white flex items-center justify-center text-xs font-bold">13+</span>
                            <span>Remaja 13 Tahun (R13)</span>
                        </td>
                        <td class="px-6 py-4 text-xs">Remaja Usia 13 Tahun ke Atas</td>
                        <td class="px-6 py-4 font-mono font-bold text-[#2C2C33]">15.310 Judul</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-[#DC7634]">32.0%</span>
                                <div class="w-24 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#DC7634] h-full rounded-full" style="width: 32.0%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('riwayat.index', ['rating' => '13+']) }}" class="text-xs text-[#003F85] hover:underline font-semibold">Lihat Judul &rarr;</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#C8282E] flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-[#C8282E] text-white flex items-center justify-center text-xs font-bold">17+</span>
                            <span>Dewasa 17 Tahun (D17)</span>
                        </td>
                        <td class="px-6 py-4 text-xs">Dewasa Usia 17 Tahun ke Atas</td>
                        <td class="px-6 py-4 font-mono font-bold text-[#2C2C33]">11.530 Judul</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-[#C8282E]">24.1%</span>
                                <div class="w-24 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#C8282E] h-full rounded-full" style="width: 24.1%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('riwayat.index', ['rating' => '17+']) }}" class="text-xs text-[#003F85] hover:underline font-semibold">Lihat Judul &rarr;</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#4B2979] flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-[#4B2979] text-white flex items-center justify-center text-xs font-bold">21+</span>
                            <span>Dewasa 21 Tahun (D21)</span>
                        </td>
                        <td class="px-6 py-4 text-xs">Dewasa Khusus Usia 21 Tahun ke Atas</td>
                        <td class="px-6 py-4 font-mono font-bold text-[#2C2C33]">2.580 Judul</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-[#4B2979]">5.4%</span>
                                <div class="w-24 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#4B2979] h-full rounded-full" style="width: 5.4%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('riwayat.index', ['rating' => '21+']) }}" class="text-xs text-[#003F85] hover:underline font-semibold">Lihat Judul &rarr;</a>
                        </td>
                    </tr>
                    <tr class="bg-slate-50 font-bold border-t-2 border-slate-200">
                        <td class="px-6 py-4 text-[#003F85]">TOTAL KESELURUHAN</td>
                        <td class="px-6 py-4 text-xs text-slate-500">Materi Sensor 5 Tahun</td>
                        <td class="px-6 py-4 font-mono text-base text-[#2C2C33]">47.840 Judul</td>
                        <td class="px-6 py-4 font-mono text-[#003F85]">100.0 %</td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-xs text-emerald-600 font-semibold">Lengkap</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
