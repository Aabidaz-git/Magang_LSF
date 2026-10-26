# User Flows
## CMS Klasifikasi Video LSF RI

Dokumen ini memetakan seluruh alur interaksi pengguna (*User Flows*) di dalam sistem CMS Klasifikasi Video LSF RI, mulai dari proses pengunggahan video berukuran besar, peninjauan hasil analisis kecerdasan buatan, pemantauan riwayat arsip, hingga penyusunan laporan statistik eksekutif.

---

## 1. Peta Navigasi Global (Site Map & Navigation Flow)

```mermaid
graph TD
    A["Halaman Utama / Login"] --> B["Sidebar Navigasi Global"]
    B --> C["1. Home (LSF Data Dashboard)"]
    B --> D["2. Klasifikasi Video (Upload & Analisis)"]
    B --> E["3. Riwayat Analisis (Audit Log & Master JSON)"]
    B --> F["4. Laporan (Visualisasi Metrik & Tren)"]
    
    C --> C1["Tabel Rekapitulasi Sensor"]
    C --> C2["Download CSV / Print Rekap"]
    
    D --> D1["Chunked File Uploader"]
    D --> D2["Indikator Progress Real-Time"]
    D --> D3["Laporan Adegan & Bukti Frame"]
    D --> D4["Riwayat Analisis Terkini"]
    
    E --> E1["Kartu Metrik GPU & Antrean"]
    E --> E2["Filter & Pencarian Tiket / Hash"]
    E --> E3["Download Master JSON / CSV"]
    
    F --> F1["Metrik Medium Layar Lebar/TV/JTI"]
    F --> F2["Grafik Batang Usia & Pie Genre"]
    F --> F3["Tautan Ringkasan Detail"]
```

---

## 2. User Flow 1: Unggah & Pemrosesan Video (Chunked Upload & Inference)

Alur ini dijalankan saat pengguna (Verifikator Sensor atau Tim IT) mengunggah materi sensor video baru untuk dianalisis oleh sistem.

### 2.1 Diagram Alur (Mermaid)

```mermaid
sequenceDiagram
    autonumber
    actor Pengguna as Pengguna / Tim LSF
    participant Client as Web Frontend (Next.js)
    participant Storage as Supabase Storage
    participant Backend as Backend API & Queue
    participant AI as AI Inference Engine (Qwen-VL)

    Pengguna->>Client: Buka menu "Klasifikasi Video"
    Pengguna->>Client: Pilih file video (Drag & Drop / Tombol Unggah)
    Client->>Client: Validasi ekstensi (.mp4, .mov, .mkv) & Hitung SHA-256
    Client->>Client: Pecah file menjadi chunk (misal: 5MB per blok)
    
    loop Pengiriman Tiap Chunk
        Client->>Storage: Unggah chunk i dari N
        Storage-->>Client: Konfirmasi chunk diterima (200 OK)
        Client->>Client: Perbarui progress bar upload (0-100%)
    end
    
    Client->>Backend: Kirim sinyal Upload Selesai (/api/upload/complete)
    Backend->>Storage: Gabungkan chunk & Verifikasi hash utuh
    Backend->>Backend: Daftarkan antrean (Status: Validating File)
    
    par Polling Status Progres
        loop Setiap 3 Detik
            Client->>Backend: Cek status job (/api/job-status?ticketId=XXX)
            Backend-->>Client: Return status ("Processing Scene Classification", 65%)
            Client->>Client: Tampilkan status di modal progres
        end
    and Eksekusi Inference
        Backend->>AI: Ekstraksi frame & Kirim prompt analisis sensor
        AI-->>Backend: Kembalikan JSON hasil deteksi adegan & frame evidence
        Backend->>Backend: Simpan hasil ke database (Status: Completed)
    end
    
    Backend-->>Client: Status Selesai (100% Complete)
    Client->>Pengguna: Render tampilan "Laporan Adegan" & Kartu Ringkasan
```

### 2.2 Langkah-Langkah Operasional
1. **Inisiasi:** Pengguna membuka menu navigasi **Klasifikasi Video**.
2. **Pemilihan Berkas:** Pengguna mengklik tombol *"Unggah Video"* atau menyeret berkas video ke dalam *upload zone*.
3. **Validasi Klien:** Klien memvalidasi tipe MIME dan menyiapkan fungsi *chunking* berbasis JavaScript `Blob.slice()`.
4. **Unggah Partisi (*Chunking*):** Sistem mengirimkan potongan berkas secara berurutan atau paralel terkendali ke *bucket* penyimpanan. Jika ada kegagalan koneksi di salah satu *chunk*, sistem secara otomatis melakukan *retry* hanya pada bagian tersebut.
5. **Pemantauan Status (*Real-Time Feedback*):**
   - Layar menampilkan animasi dan label progres:
     - *"Memvalidasi integritas berkas..."*
     - *"Mengekstrak frame video..."*
     - *"Video sedang dianalisis oleh sistem (Klasifikasi Adegan)..."*
6. **Penyajian Hasil:** Setelah komputasi tuntas, sistem memuat tampilan **Laporan Adegan** lengkap dengan kartu rating, statistik risiko, dan baris detail temuan adegan.

### 2.3 Penanganan Kasus Khusus (Edge Cases)
* **Koneksi Terputus Saat Upload:** Klien menyimpan status indeks *chunk* terakhir di `localStorage`. Saat koneksi pulih, tombol *"Lanjutkan Unggah"* diaktifkan tanpa memulai dari nol.
* **Format File Tidak Didukung:** Menampilkan pesan galat *"Format berkas tidak didukung. Mohon gunakan MP4, MOV, atau MKV."*
* **Kelebihan Beban Antrean (Queue Full):** Jika *node* GPU sedang penuh, sistem menampilkan status *"Dalam antrean nomor urut X"* dengan estimasi waktu tunggu.

---

## 3. User Flow 2: Peninjauan Analisis & Penetapan Klasifikasi (Review & Verification)

Alur ini merupakan inti dari mekanisme kerja Anggota Subkomisi Penilaian LSF dalam menelaah draf rekomendasi AI dan menetapkan keputusan sensor resmi.

### 3.1 Diagram Alur (Mermaid)

```mermaid
flowchart TD
    Start(["Mulai Peninjauan Laporan"]) --> LoadData["Sistem memuat Laporan Adegan & Rekomendasi Rating"]
    LoadData --> ReviewSummary["Penilai membaca Ringkasan: Rating AI, Total Adegan, High Risk"]
    ReviewSummary --> BrowseScenes["Penilai memeriksa tabel daftar adegan per timestamp"]
    
    BrowseScenes --> CheckFlag{"Ada adegan sensitif / berisiko?"}
    
    CheckFlag -- Ya --> InspectFrame["Klik thumbnail bukti frame untuk memperbesar (Modal Preview)"]
    InspectFrame --> PlayTimestamp["Periksa cuplikan adegan pada timecode spesifik"]
    PlayTimestamp --> EditNotes["Tulis catatan peninjauan & pertimbangan sensor"]
    EditNotes --> AdjustRating["Koreksi rekomendasi rating jika diperlukan (misal: 13+ menjadi 17+)"]
    AdjustRating --> SaveScene["Simpan catatan adegan"]
    SaveScene --> BrowseScenes
    
    CheckFlag -- Tidak / Selesai --> FinalDecision["Tetapkan Klasifikasi Akhir: SU / 13+ / 17+ / 21+"]
    FinalDecision --> SubmitVerif["Klik tombol 'Verifikasi & Simpan Keputusan'"]
    SubmitVerif --> RecordAudit["Sistem mencatat log audit (Verifikator, Timestamp, Catatan)"]
    RecordAudit --> StatusVerified["Status video berubah menjadi: 'Terverifikasi'"]
    StatusVerified --> Selesai(["Selesai / Menuju Riwayat"])
```

### 3.2 Langkah-Langkah Operasional
1. **Pemeriksaan Ringkasan Awal:** Verifikator meninjau kartu statistik di bagian atas tabel:
   - Draf Rating Awal (misal: `13+` atau `17+`)
   - Jumlah Total Adegan yang diekstrak
   - Jumlah Adegan *High Risk* (adegan kritis dengan tingkat kekerasan/sensualitas tinggi)
2. **Inspeksi Baris Adegan:** Verifikator membaca baris demi baris tabel adegan:
   - Memeriksa stempel waktu (*timecode*, contoh: `00:10`).
   - Membaca deskripsi temuan adegan dan tag kategori (*Dialog*, *Kekerasan*, *Horor*).
   - Mengamati *chip* tingkat risiko (*Rendah*, *Sedang*, *Tinggi*).
3. **Pemeriksaan Bukti Frame:** Mengklik bukti frame (contoh: *Frame 1 pada 0:00, Frame 2 pada 0:05*) untuk membuka jendela pratinjau resolusi tinggi guna memastikan tidak ada bias dari AI.
4. **Pemberian Catatan Khusus:** Verifikator mengisi kolom *Catatan Peninjauan* jika adegan tersebut memerlukan pemotongan (*cut*) atau revisi audio (*dialog bleep*).
5. **Finalisasi & Penetapan Rating:** Verifikator memilih rating akhir resmi dan menekan tombol verifikasi. Sistem menyimpan status sebagai `Terverifikasi` dan memperbarui data rekapitulasi.

---

## 4. User Flow 3: Monitoring, Audit Log, & Ekspor Arsip (Riwayat Analisis)

Alur ini digunakan oleh Administrator IT dan Tim Penilai untuk memantau beban sistem, mencari tiket sensor terdahulu, serta mengunduh master berkas JSON/CSV.

### 4.1 Diagram Alur (Mermaid)

```mermaid
flowchart TD
    A(["Buka Menu 'Riwayat Analisis'"]) --> B["Muat Kartu Metrik Operasional"]
    B --> B1["Total Video: 142 | Selesai: 134 | Inference: 3 | Flagged: 5"]
    B1 --> C{"Pilih Tindakan Pengguna"}
    
    C -->|Pencarian / Filter| D["Input Kata Kunci: ID Tiket / Judul Film / Hash SHA-256"]
    D --> D1["Terapkan Filter: Rentang Bulan / Status / Urutan"]
    D1 --> D2["Tabel Riwayat menyaring daftar item secara real-time"]
    D2 --> F
    
    C -->|Unduh Master JSON| E1["Klik tombol 'Download Master JSON'"]
    E1 --> E2["Sistem mengompilasi seluruh arsip terfilter ke file JSON resmi"]
    E2 --> E3["Browser mengunduh file: lsf_master_archive_2026.json"]
    
    C -->|Ekspor Batch CSV| G1["Klik tombol 'Export Batch (CSV)'"]
    G1 --> G2["Sistem menghasilkan lembar kerja CSV standar"]
    G2 --> G3["Browser mengunduh file: lsf_riwayat_sensor.csv"]
    
    C -->|Buka Detail Item| F["Pilih salah satu item pada daftar antrean"]
    F --> F1["Periksa metadata: Format, Ukuran, Resolusi, Confidence Rate"]
    F1 --> F2{"Pilih Aksi Item"}
    F2 -->|Lihat Hasil| F3["Klik 'Buka Hasil' -> Pindah ke detail Laporan Adegan"]
    F2 -->|Unduh JSON Tunggal| F4["Klik '+ JSON' -> Unduh file JSON spesifik video"]
```

### 4.2 Langkah-Langkah Operasional
1. **Akses Arsip:** Pengguna menavigasi ke menu **Riwayat Analisis**.
2. **Pemantauan Kesehatan Beban:** Memeriksa 4 kartu metrik utama di bagian atas untuk memastikan tidak ada antrean inference yang mandek (*stuck*).
3. **Pencarian Cepat:** Memasukkan parameter pelacakan (misal ID Tiket `LSF-2026-X8910` atau judul film).
4. **Pengunduhan Dokumen:**
   - Untuk integrasi sistem database eksternal: Klik *"Download Master JSON"*.
   - Untuk laporan spreadsheet berkala pimpinan: Klik *"Export Batch (CSV)"*.
   - Untuk data per judul film: Klik tombol *"+ JSON"* pada kartu judul terkait.

---

## 5. User Flow 4: Pelaporan Eksekutif & Statistik LSF (Dashboard & Laporan)

Alur ini memfasilitasi kebutuhan pimpinan, sekretariat komisi, dan staf analitik LSF dalam memantau tren sensor film nasional.

### 5.1 Diagram Alur (Mermaid)

```mermaid
flowchart TD
    A(["Buka Menu 'Home' atau 'Laporan'"]) --> B{"Pilih Halaman"}
    
    B -->|Menu Home| C["Tampilan LSF Data Dashboard"]
    C --> C1["Lihat Donut Distribusi Usia: SU (38.5%), 13+ (32%), 17+ (24.1%), 21+ (5.4%)"]
    C --> C2["Periksa Tabel Rekapitulasi Sensor Film"]
    C2 --> C3["Aksi: Klik 'Download CSV' atau 'Cetak Tabel'"]
    
    B -->|Menu Laporan| D["Tampilan Ringkasan Laporan Komprehensif"]
    D --> D1["Periksa 4 Kartu Kategori: Total, Layar Lebar, Televisi, JTI"]
    D1 --> D2["Analisis Grafik Batang: Volume judul per Klasifikasi Usia"]
    D2 --> D3["Analisis Grafik Pie: Sebaran Genre (Horror, Comedy, Romance, Action)"]
    D3 --> D4["Klik 'Lihat Detail' untuk membuka laporan sub-kategori spesifik"]
```

### 5.2 Langkah-Langkah Operasional
1. **Akses Dashboard:** Pengguna membuka menu **Home** untuk melihat ringkasan cepat distribusi klasifikasi usia lima tahunan (2020–2025).
2. **Analisis Komparatif:** Pengguna membuka menu **Laporan** untuk melihat dinamika pergeseran platform tayang:
   - Pertumbuhan materi bioskop (*Layar Lebar*) vs. siaran kabel/terestrial (*Televisi*) vs. media digital (*JTI*).
   - Memantau tren persentase peningkatan bulanan (indikator `↑12% dari bulan sebelumnya`).
3. **Pencetakan / Distribusi:** Mengklik tombol cetak untuk mencetak laporan ke format PDF siap edar untuk rapat pleno anggota LSF.
