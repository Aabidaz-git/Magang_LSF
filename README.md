# CMS Klasifikasi Video LSF RI
### Content Management System & Otomasi Telaah Sensor Video
**Lembaga Sensor Film (LSF) · Republik Indonesia**

[![Laravel](https://img.shields.io/badge/Laravel-11%2F12-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4.0-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-v8.0-646CFF?style=flat&logo=vite&logoColor=white)](https://vitejs.dev)
[![Regulasi](https://img.shields.io/badge/Regulasi-UU_No._33%2F2009-003F85?style=flat)](file:///docs/prd.md)

---

## 1. Tentang Aplikasi Ini

**CMS Klasifikasi Video LSF RI** adalah platform sistem manajemen konten operasional internal yang dirancang khusus untuk memfasilitasi dan mempercepat alur penelaahan sensor film di lingkungan Lembaga Sensor Film (LSF) Republik Indonesia. 

Aplikasi ini mengintegrasikan teknologi *Computer Vision Multimodal AI* (Qwen-VL) sebagai asisten pra-sensor (*pre-screening assistant*) dengan prinsip **Human-in-the-Loop (HITL)**. Sistem mendeteksi potensi muatan adegan sensitif (dialog, kekerasan, sensualitas, horor/ketegangan, senjata) secara otomatis, mengekstrak stempel waktu (*timecode*) dan bukti visual frame, lalu menyajikannya ke **Anggota Subkomisi Penilaian LSF** untuk divalidasi dan ditetapkan rating resminya (`SU`, `13+`, `17+`, `21+`).

---

## 2. Tujuan Pengembangan

1. **Efisiensi Waktu Sensor:** Mengurangi beban penayangan manual ratusan jam materi tayang (bioskop, TV, dan streaming/JTI) dengan penandaan dini segmen berisiko (*risk scene detection*).
2. **Presisi Bukti Frame & Timecode:** Mencegah terjadinya *timecode drift* atau pencatatan manual yang meleset antarsesak peninjau melalui penyediaan thumbnail bukti frame beresolusi tinggi.
3. **Keandalan Pengunggahan File Besar (Chunking):** Mendukung pengunggahan berkas video resolusi tinggi (MP4, MKV, MOV, AVI) berukuran puluhan gigabyte secara partisi per *chunk* (5MB) yang kebal terhadap gangguan jaringan.
4. **Standardisasi Output & Audit Trail:** Menyediakan ekspor laporan resmi dalam format terstandarisasi **Master JSON** dan **Batch CSV** untuk integrasi pangkalan data arsip perfilman nasional.
5. **Kepatuhan Hukum Perfilman:** Memastikan seluruh materi sensor selaras dengan kriteria **UU No. 33 Tahun 2009 tentang Perfilman** dan **PP No. 18 Tahun 2014**.

---

## 3. Fitur Utama Aplikasi

### A. Home (LSF Data Dashboard)
* **Distribusi Klasifikasi Usia:** Diagram donat visual persentase rating usia (`SU`: 38.5%, `13+`: 32.0%, `17+`: 24.1%, `21+`: 5.4%).
* **Kartu Statistik Periode 2020–2025:** 4 kartu metrik utama dengan perbandingan tren.
* **Effectivity Indicators Slider Bar:** Panel status kesiapan sistem (*In Operation, At Unloading, Standing, On Relay*).
* **Tabel Rekapitulasi Sensor Film:** Tabel tabulasi target penonton, jumlah judul film, dan persentase, dilengkapi tombol **Export CSV** dan **Cetak Rekapitulasi**.

### B. Klasifikasi Video (Upload & Laporan Adegan)
* **Chunked Video Uploader:** Area seret-dan-lepas (*drag-and-drop*) yang memecah file besar menjadi partisi 5MB di browser sebelum dikirimkan ke backend.
* **Indikator Progres Real-Time:** Menampilkan tahapan *Validasi Hash SHA-256*, *Ekstraksi Frame*, hingga *Klasifikasi Adegan AI*.
* **Tabel Laporan Adegan:** Menyajikan stempel waktu (*timecode*), deskripsi adegan, chip tag kategori (*Dialog, Aksi, Horor*), tingkat risiko (*Rendah, Sedang, Tinggi*), modal pratinjau bukti frame, dan catatan peninjauan.
* **Formulir Penetapan Rating Resmi:** Pilihan rating akhir (`SU`, `13+`, `17+`, `21+`) dan input catatan sidang pleno oleh verifikator.
* **Metadata & Riwayat Terkini:** Menampilkan format, resolusi, durasi, SHA-256 hash integritas, dan skor akurasi AI (*confidence rate*).

### C. Riwayat Analisis (Audit Log & Master Archive)
* **4 Kartu Metrik Operasional:** Total Video Dianalisis (142), Status Selesai/Terverifikasi (134), Sedang Diproses/GPU Nodes (3), dan Butuh Tinjauan/Flagged (5).
* **Bilah Filter Multi-Parameter:** Pencarian instan (ID Tiket LSF, Judul Film, Hash SHA-256), filter rating usia, filter status antrean, dan pengurutan tanggal.
* **Ekspor Dokumen:** Tombol unduh **Download Master JSON**, **+ JSON** individual per judul, dan **Export Batch (CSV)**.

### D. Laporan (Visualisasi Metrik & Tren Media)
* **Ringkasan Medium Sensor:** 4 kartu agregat platform: **Total Data**, **Layar Lebar (Bioskop)**, **Televisi**, dan **JTI (Streaming/OTT)** beserta persentase tren bulanan.
* **Grafik Batang (Klasifikasi Usia):** Visualisasi volume film per rating usia.
* **Grafik Lingkaran/Pie (Distribusi Genre):** Proporsi genre terbanyak (*Horror, Action, Comedy, Romance, Lain-lain*).

### E. Autentikasi Pengguna
* **Login Layar Terpisah (Split-Screen):** Mengadopsi desain gelombang biru fluid wave dengan form input modern dan tombol masuk merah (`#C8282E`), serta artwork isometrik LSF.

---

## 4. Struktur Direktori Proyek

```text
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php            # Login & Logout verifikator
│   │       ├── DashboardController.php       # Dashboard utama (Home)
│   │       ├── ClassificationController.php  # Chunking uploader & analisis adegan
│   │       ├── HistoryController.php         # Riwayat arsip, audit & download JSON/CSV
│   │       └── ReportController.php          # Visualisasi grafik agregat media & genre
│   └── Models/
│       ├── Video.php                         # Model video, metadata & rating
│       ├── SceneReport.php                   # Model adegan, tag & frame evidence
│       └── AuditLog.php                      # Model jejak audit penelaahan sensor
├── bootstrap/                                # Bootstrapping Laravel & providers
├── config/                                   # Konfigurasi sistem
├── database/
│   ├── migrations/                           # Migrasi database (videos, scene_reports, audit_logs)
│   ├── seeders/DatabaseSeeder.php            # Data awal autentik LSF
│   └── database.sqlite                       # Basis data lokal SQLite
├── design/                                   # Dokumentasi Desain (Fase 2)
│   ├── component-library.md                  # Katalog komponen UI
│   ├── design-system.md                      # Palet warna resmi, font, spacing & WCAG
│   ├── responsive-spec.md                    # Breakpoints adaptif mobile/desktop
│   ├── mockups/                              # Hi-Fi Mockup specs (Dashboard, Login, Stats)
│   └── wireframes/                           # Lo-Fi Wireframes per halaman
├── docs/                                     # Dokumentasi Kebutuhan (Fase 1)
│   ├── prd.md                                # Product Requirements Document
│   ├── scope.md                              # In-Scope & Out-of-Scope
│   ├── user-flows.md                         # Alur interaksi pengguna & diagram Mermaid
│   └── user-personas.md                      # Persona Penilai & Admin IT
├── public/                                   # Public assets, images & compiled bundles
│   ├── images/logo-lsf.png                   # Logo resmi LSF RI
│   └── build/                                # Hasil kompilasi Vite Tailwind
├── resources/
│   ├── css/app.css                           # Styling Tailwind CSS v4 & tema warna LSF
│   ├── js/app.js                             # Inisialisasi frontend JS
│   └── views/                                # Template Blade UI
│       ├── auth/login.blade.php              # Halaman Login
│       ├── dashboard/
│       │   ├── home.blade.php                # Halaman Home (LSF Data Dashboard)
│       │   ├── klasifikasi.blade.php         # Halaman Klasifikasi Video
│       │   ├── riwayat.blade.php             # Halaman Riwayat Analisis
│       │   ├── laporan.blade.php             # Halaman Laporan Visualisasi Grafik
│       │   └── ringkasan-laporan.blade.php   # Detail ringkasan rekapan
│       └── layouts/app.blade.php             # Master layout (Sidebar + Topbar LSF)
├── routes/
│   └── web.php                               # Definisi seluruh rute web & API LSF
├── storage/                                  # Penyimpanan chunk video & frame logs
├── package.json                              # Dependensi npm (Tailwind v4, Vite)
├── composer.json                             # Dependensi PHP Composer
└── vite.config.js                            # Konfigurasi bundler Vite
```

---

## 5. Cara Menjalankan Aplikasi di Lokal

### Prasyarat Sistem
- **PHP** versi 8.2 atau lebih tinggi (didukung PHP 8.5 / Laragon / Herd).
- **Composer** versi 2.x.
- **Node.js** versi 18+ & **NPM**.

### Langkah Instalasi

1. **Buka Terminal / PowerShell di Direktori Proyek:**
   ```powershell
   cd "C:\Users\naura\OneDrive\Documents\Magang LSF\Magang_LSF"
   ```

2. **Pastikan Dependensi Terinstal:**
   ```powershell
   composer install
   npm install
   ```

3. **Pastikan Berkas Konfigurasi Lingkungan (`.env`) & Key Aplikasi Siap:**
   ```powershell
   php artisan key:generate
   ```

4. **Jalankan Migrasi & Seeder Database:**
   ```powershell
   php artisan migrate --seed
   ```

5. **Kompilasi Aset Frontend (Tailwind CSS v4 via Vite):**
   ```powershell
   npm run build
   ```

6. **Jalankan Server Pengembangan:**
   * Di terminal 1 (Server Backend Laravel):
     ```powershell
     php artisan serve
     ```
   * Di terminal 2 (Hot Reload Vite - Opsional saat mengembangkan tampilan):
     ```powershell
     npm run dev
     ```

7. **Akses Aplikasi di Browser:**
   Buka URL: [**`http://127.0.0.1:8000`**](http://127.0.0.1:8000)

---

## 6. Akun Uji Coba (Demo Credentials)

| Peran Pengguna | Email Login | Kata Sandi | Deskripsi Akses |
| :--- | :--- | :--- | :--- |
| **Verifikator Sensor** | `verifikator@lsf.go.id` | `password123` | Anggota Subkomisi Penilai (Validasi adegan, input catatan, penetapan rating) |
| **Administrator IT** | `admin@lsf.go.id` | `admin123` | Tim IT LSF (Monitoring GPU nodes, ekspor Master JSON & CSV, log audit) |

---

## 7. Rujukan Dokumen Pengembangan

- [**PRD (Product Requirements Document)**](file:///docs/prd.md)
- [**User Personas LSF**](file:///docs/user-personas.md)
- [**User Flows & Diagram Interaksi**](file:///docs/user-flows.md)
- [**Cakupan Proyek (Scope)**](file:///docs/scope.md)
- [**Design System Specification**](file:///design/design-system.md)
- [**Component Library Inventory**](file:///design/component-library.md)
- [**Responsive & Layout Specification**](file:///design/responsive-spec.md)
