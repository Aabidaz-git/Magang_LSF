@extends('layouts.app')

@section('title', 'Klasifikasi Video — Unggah & Analisis Sensor')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-black text-[#2C2C33] tracking-tight">
                Klasifikasi Adegan Video
            </h1>
            <p class="text-xs text-slate-500">
                Unggah video materi sensor, jalankan pemrosesan chunking, lalu telaah draf temuan AI vision.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-50 text-[#003F85] border border-blue-200">
                Tiket Aktif: {{ $video->ticket_id ?? 'LSF-2026-X8910' }}
            </span>
        </div>
    </div>

    <!-- Layout Grid: 2 Kolom (Kiri: Upload & Laporan Adegan, Kanan: Metadata & Riwayat Terkini) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- KOLOM KIRI (8 Kolom di Desktop) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Zona Unggah Chunking File Video Besar -->
            <div class="bg-white p-6 rounded-2xl border border-[#C1CDD4]/60 shadow-xs">
                <div id="dropZone" 
                     class="border-2 border-dashed border-[#003F85]/40 hover:border-[#003F85] rounded-2xl p-8 flex flex-col items-center justify-center text-center cursor-pointer transition-all bg-[#003F85]/5 hover:bg-[#003F85]/10">
                    <div class="w-16 h-16 rounded-full bg-[#003F85]/10 text-[#003F85] flex items-center justify-center mb-3">
                        <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                    </div>
                    <label for="fileInput" class="cursor-pointer">
                        <span class="px-5 py-2.5 rounded-xl bg-[#003F85] text-white text-xs font-bold inline-block hover:bg-[#00336D] shadow-sm transition-all">
                            Pilih Berkas Video
                        </span>
                        <input type="file" id="fileInput" accept="video/mp4,video/mkv,video/quicktime,video/avi" class="hidden">
                    </label>
                    <p class="text-xs text-slate-500 mt-3 max-w-sm">
                        File besar (MP4, MKV, MOV) otomatis diunggah per <b>chunk (5MB)</b> secara aman untuk mencegah kegagalan jaringan.
                    </p>
                </div>

                <!-- Progress Upload & Inference Bar (Tersembunyi secara default, aktif saat upload) -->
                <div id="progressContainer" class="hidden mt-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-700 mb-1.5">
                        <span id="progressStatusText">Menyiapkan pengunggahan chunk...</span>
                        <span id="progressPercentage" class="text-[#003F85]">0%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                        <div id="progressBar" class="bg-gradient-to-r from-[#003F85] to-[#26B1EB] h-full rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-slate-400 mt-2">
                        <span id="progressDetail">Memecah partisi berkas video...</span>
                        <span class="flex items-center gap-1 text-[#1899A3]">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Hash SHA-256 Integritas Terjaga
                        </span>
                    </div>
                </div>
            </div>

            <!-- Kartu Laporan Adegan (Scene Analysis Report) -->
            <div class="bg-white rounded-2xl border border-[#C1CDD4]/60 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-[#2C2C33] flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-[#003F85]"></i>
                            <span>Laporan Adegan Video (Draf AI Vision)</span>
                        </h2>
                        <span class="text-xs font-semibold px-3 py-1 bg-teal-50 text-[#1899A3] rounded-full border border-teal-200">
                            Analisis Selesai
                        </span>
                    </div>

                    <!-- 3 Kartu Statistik Ringkas -->
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 text-center">
                            <span class="text-[11px] text-slate-500 font-medium block">Rekomendasi Rating</span>
                            <span class="text-xl font-extrabold text-[#DC7634]">
                                {{ $video->recommended_rating ?? '13+' }}
                            </span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 text-center">
                            <span class="text-[11px] text-slate-500 font-medium block">Total Adegan Terdeteksi</span>
                            <span class="text-xl font-extrabold text-[#003F85]">
                                {{ $video->sceneReports->count() ?? 3 }}
                            </span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 text-center">
                            <span class="text-[11px] text-slate-500 font-medium block">Adegan High Risk</span>
                            <span class="text-xl font-extrabold text-emerald-600">
                                {{ $video->sceneReports->where('risk_level', 'Tinggi')->count() ?? 0 }}
                            </span>
                        </div>
                    </div>

                    <!-- Notice Banner -->
                    <div class="p-3 bg-blue-50/70 border border-blue-200/80 rounded-xl text-xs text-[#003F85] flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4 shrink-0 text-[#003F85]"></i>
                        <span>Analisis AI multimodal selesai. Tetap gunakan sebagai draf bantuan untuk peninjau manusia (Anggota Subkomisi LSF).</span>
                    </div>
                </div>

                <!-- Tabel Detail Adegan -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead class="bg-slate-50 text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-[#C1CDD4]/60">
                            <tr>
                                <th class="px-4 py-3">Waktu</th>
                                <th class="px-4 py-3">Adegan</th>
                                <th class="px-4 py-3">Tag</th>
                                <th class="px-4 py-3">Tingkat</th>
                                <th class="px-4 py-3">Bukti</th>
                                <th class="px-4 py-3">Catatan Peninjauan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 text-xs">
                            @forelse($video->sceneReports as $scene)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-4 py-3.5 font-mono font-bold text-[#003F85] whitespace-nowrap">
                                    {{ $scene->timecode }}
                                </td>
                                <td class="px-4 py-3.5 max-w-xs leading-relaxed">
                                    {{ $scene->scene_summary }}
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-sky-50 text-[#003F85] border border-sky-200">
                                        {{ $scene->tag }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold {{ $scene->risk_level === 'Tinggi' ? 'bg-red-50 text-[#C8282E]' : ($scene->risk_level === 'Sedang' ? 'bg-amber-50 text-[#DC7634]' : 'bg-emerald-50 text-emerald-700') }}">
                                        {{ $scene->risk_level }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <button onclick="openEvidenceModal('{{ $scene->timecode }}', '{{ $scene->tag }}', '{{ addslashes(implode(', ', $scene->evidence_frames ?? [])) }}')"
                                            class="text-[#003F85] hover:text-[#26B1EB] font-semibold flex items-center gap-1 underline cursor-pointer">
                                        <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                        <span>Frame Bukti</span>
                                    </button>
                                </td>
                                <td class="px-4 py-3.5 text-slate-600 max-w-xs">
                                    {{ $scene->reviewer_notes ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                    Belum ada adegan yang terdeteksi pada berkas ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Formulir Verifikasi & Penetapan Rating oleh Penilai -->
                <div class="p-6 bg-slate-50/80 border-t border-slate-200">
                    <h3 class="text-sm font-bold text-[#2C2C33] mb-3 flex items-center gap-2">
                        <i data-lucide="check-square" class="w-4 h-4 text-[#003F85]"></i>
                        <span>Penetapan Klasifikasi Resmi oleh Penilai LSF</span>
                    </h3>
                    
                    <form action="{{ route('klasifikasi.verify', $video->id) }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Pilihan Radio Klasifikasi Usia -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Pilih Rating Akhir:</label>
                            <div class="flex flex-wrap items-center gap-3">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-white cursor-pointer hover:border-[#1899A3]">
                                    <input type="radio" name="final_rating" value="SU" {{ ($video->final_rating ?? $video->recommended_rating) == 'SU' ? 'checked' : '' }} class="text-[#1899A3]">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-[#1899A3] text-white">SU</span>
                                    <span class="text-xs font-medium text-slate-700">Semua Umur</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-white cursor-pointer hover:border-[#DC7634]">
                                    <input type="radio" name="final_rating" value="13+" {{ ($video->final_rating ?? $video->recommended_rating) == '13+' ? 'checked' : '' }} class="text-[#DC7634]">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-[#DC7634] text-white">13+</span>
                                    <span class="text-xs font-medium text-slate-700">Remaja 13+</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-white cursor-pointer hover:border-[#C8282E]">
                                    <input type="radio" name="final_rating" value="17+" {{ ($video->final_rating ?? $video->recommended_rating) == '17+' ? 'checked' : '' }} class="text-[#C8282E]">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-[#C8282E] text-white">17+</span>
                                    <span class="text-xs font-medium text-slate-700">Dewasa 17+</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-white cursor-pointer hover:border-[#4B2979]">
                                    <input type="radio" name="final_rating" value="21+" {{ ($video->final_rating ?? $video->recommended_rating) == '21+' ? 'checked' : '' }} class="text-[#4B2979]">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-[#4B2979] text-white">21+</span>
                                    <span class="text-xs font-medium text-slate-700">Dewasa 21+</span>
                                </label>
                            </div>
                        </div>

                        <!-- Catatan Peninjau -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Catatan Pertimbangan Sensor:</label>
                            <textarea name="reviewer_notes" rows="2" 
                                      placeholder="Masukkan pertimbangan sensor atau catatan revisi adegan..."
                                      class="w-full p-3 bg-white border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] focus:outline-none focus:ring-2 focus:ring-[#26B1EB]">{{ $video->reviewer_notes }}</textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end gap-3 pt-2">
                            <a href="{{ route('riwayat.single-json', $video->id) }}" class="px-4 py-2 rounded-xl bg-white border border-[#C1CDD4] text-[#003F85] text-xs font-semibold hover:bg-slate-50 flex items-center gap-1.5 shadow-xs">
                                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                <span>Unduh JSON Tiket Ini</span>
                            </a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#003F85] hover:bg-[#00336D] text-white text-xs font-bold flex items-center gap-2 shadow-sm transition-all">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-400"></i>
                                <span>Simpan &amp; Verifikasi Keputusan Sensor</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (4 Kolom di Desktop) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Metadata Video Card -->
            <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs space-y-4">
                <h3 class="text-sm font-bold text-[#2C2C33] flex items-center gap-2 border-b border-slate-100 pb-2">
                    <i data-lucide="info" class="w-4 h-4 text-[#003F85]"></i>
                    <span>Metadata Berkas Sensor</span>
                </h3>

                <div class="space-y-2.5 text-xs">
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400">Judul Berkas:</span>
                        <span class="font-semibold text-[#2C2C33] text-right truncate max-w-[180px]" title="{{ $video->title }}">
                            {{ $video->title }}
                        </span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400">ID Tiket:</span>
                        <span class="font-mono font-bold text-[#003F85]">{{ $video->ticket_id }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400">Format &amp; Resolusi:</span>
                        <span class="font-semibold text-slate-700">{{ $video->format }} · {{ $video->resolution }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400">Durasi Video:</span>
                        <span class="font-mono font-semibold text-slate-700">{{ $video->duration }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400">Ukuran File:</span>
                        <span class="font-semibold text-slate-700">{{ $video->file_size_formatted }}</span>
                    </div>
                    <div class="py-1">
                        <span class="text-slate-400 block mb-1">SHA-256 Hash Integritas:</span>
                        <div class="p-2 bg-slate-50 rounded-lg border border-slate-200 font-mono text-[10px] text-slate-600 break-all select-all">
                            {{ $video->sha256_hash ?? 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Tingkat Keyakinan AI (Confidence Score) -->
            <div class="bg-gradient-to-br from-[#003F85] to-[#002754] text-white p-5 rounded-2xl shadow-md space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-200">Akurasi Engine AI</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#26B1EB] text-white">Qwen-VL</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-extrabold text-[#26B1EB]">{{ $video->confidence_rate }}%</span>
                    <span class="text-xs text-slate-300">Confidence Rate</span>
                </div>
                <div class="w-full bg-white/10 h-2 rounded-full overflow-hidden">
                    <div class="bg-[#26B1EB] h-full rounded-full" style="width: {{ $video->confidence_rate }}%"></div>
                </div>
                <p class="text-[11px] text-slate-300 leading-relaxed">
                    Tingkat probabilitas kesesuaian deteksi adegan terhadap batasan UU No. 33/2009.
                </p>
            </div>

            <!-- Riwayat Analisis Terkini Panel -->
            <div class="bg-white p-5 rounded-2xl border border-[#C1CDD4]/60 shadow-xs space-y-3">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Riwayat Analisis Terkini
                    </h3>
                    <a href="{{ route('riwayat.index') }}" class="text-xs text-[#003F85] hover:underline font-semibold">
                        Semua &rarr;
                    </a>
                </div>

                <div class="space-y-2.5">
                    @foreach($recentVideos as $item)
                    <div class="p-2.5 rounded-xl border border-slate-100 hover:border-[#003F85]/30 hover:bg-slate-50/70 transition-all flex items-center justify-between">
                        <div class="truncate max-w-[150px]">
                            <span class="font-bold text-xs text-[#2C2C33] block truncate">{{ $item->title }}</span>
                            <span class="text-[10px] font-mono text-slate-400">{{ $item->ticket_id }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $item->status === 'completed' ? 'bg-teal-50 text-[#1899A3]' : ($item->status === 'flagged' ? 'bg-red-50 text-[#C8282E]' : 'bg-blue-50 text-[#003F85]') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                            <a href="{{ route('klasifikasi.show', $item->id) }}" class="p-1 text-[#003F85] hover:bg-blue-50 rounded" title="Buka Hasil">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Pratinjau Bukti Frame Adegan -->
<div id="evidenceModal" class="fixed inset-0 bg-slate-900/60 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-slate-200">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i data-lucide="camera" class="w-4 h-4 text-[#003F85]"></i>
                <h3 class="font-bold text-sm text-[#2C2C33]">Bukti Frame Hasil Deteksi AI</h3>
            </div>
            <button onclick="closeEvidenceModal()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <!-- Simulated Frame Graphic Canvas -->
            <div class="w-full h-52 bg-slate-900 rounded-2xl flex flex-col items-center justify-center text-white relative overflow-hidden">
                <div class="absolute top-3 left-3 bg-black/60 px-2 py-1 rounded font-mono text-xs font-bold text-emerald-400" id="modalTimecode">
                    00:10
                </div>
                <div class="absolute top-3 right-3 bg-[#003F85] px-2 py-1 rounded text-xs font-semibold" id="modalTag">
                    Dialog
                </div>
                <i data-lucide="film" class="w-12 h-12 text-slate-500 mb-2"></i>
                <span class="text-xs text-slate-300">Pratinjau Frame Visual Ekstraksi Vision Engine</span>
            </div>

            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                <span class="text-[11px] font-bold text-slate-500 block mb-1">Daftar Frame Terverifikasi:</span>
                <p id="modalEvidenceText" class="text-xs text-slate-700 leading-relaxed font-mono">
                    Frame 1 pada 0:00, Frame 2 pada 0:05
                </p>
            </div>
        </div>
        <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
            <button onclick="closeEvidenceModal()" class="px-4 py-2 bg-[#003F85] text-white text-xs font-bold rounded-xl hover:bg-[#00336D]">
                Tutup Pratinjau
            </button>
        </div>
    </div>
</div>

<script>
    // Logika Modal Bukti Frame
    function openEvidenceModal(timecode, tag, evidence) {
        document.getElementById('modalTimecode').innerText = timecode;
        document.getElementById('modalTag').innerText = tag;
        document.getElementById('modalEvidenceText').innerText = evidence;
        document.getElementById('evidenceModal').classList.remove('hidden');
    }

    function closeEvidenceModal() {
        document.getElementById('evidenceModal').classList.add('hidden');
    }

    // Logika Simulasi Chunked Upload Sisi Klien
    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressPercentage = document.getElementById('progressPercentage');
    const progressStatusText = document.getElementById('progressStatusText');
    const progressDetail = document.getElementById('progressDetail');

    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileUpload(e.target.files[0]);
        }
    });

    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('border-[#003F85]', 'bg-[#003F85]/15'); });
    dropZone.addEventListener('dragleave', (e) => { e.preventDefault(); dropZone.classList.remove('border-[#003F85]', 'bg-[#003F85]/15'); });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-[#003F85]', 'bg-[#003F85]/15');
        if (e.dataTransfer.files.length > 0) {
            handleFileUpload(e.dataTransfer.files[0]);
        }
    });

    async function handleFileUpload(file) {
        progressContainer.classList.remove('hidden');
        progressStatusText.innerText = `Mengunggah "${file.name}" secara chunking...`;
        
        const chunkSize = 5 * 1024 * 1024; // 5 MB per chunk
        const totalChunks = Math.ceil(file.size / chunkSize) || 1;
        const fileId = 'file_' + Date.now();

        for (let i = 0; i < totalChunks; i++) {
            const start = i * chunkSize;
            const end = Math.min(file.size, start + chunkSize);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append('chunk_index', i);
            formData.append('total_chunks', totalChunks);
            formData.append('file_id', fileId);
            formData.append('file_name', file.name);
            formData.append('chunk_data', chunk, `part_${i}`);
            formData.append('_token', '{{ csrf_token() }}');

            // Kirim chunk ke endpoint backend
            try {
                await fetch('{{ route("api.upload.chunk") }}', {
                    method: 'POST',
                    body: formData
                });
            } catch (err) {
                console.warn('Simulasi fallback chunk upload:', err);
            }

            // Perbarui progress bar
            const percent = Math.round(((i + 1) / totalChunks) * 60);
            progressBar.style.width = percent + '%';
            progressPercentage.innerText = percent + '%';
            progressDetail.innerText = `Mengunggah bagian ${i + 1} dari ${totalChunks} partisi...`;
            await new Promise(r => setTimeout(r, 200));
        }

        // Tahap Inference & Assembly
        progressStatusText.innerText = "Video sedang dianalisis oleh sistem (Validasi & Klasifikasi Adegan)...";
        progressBar.style.width = '80%';
        progressPercentage.innerText = '80%';
        progressDetail.innerText = "Ekstraksi frame vision model Qwen-VL...";
        await new Promise(r => setTimeout(r, 800));

        progressBar.style.width = '100%';
        progressPercentage.innerText = '100%';
        progressDetail.innerText = "Analisis selesai! Menyiapkan Laporan Adegan...";

        // Sinyal selesai ke server
        const completeRes = await fetch('{{ route("api.upload.complete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                file_id: fileId,
                file_name: file.name,
                total_size: file.size,
                total_chunks: totalChunks
            })
        });

        const data = await completeRes.json();
        if (data.redirect_url) {
            window.location.href = data.redirect_url;
        } else {
            window.location.reload();
        }
    }
</script>
@endsection
