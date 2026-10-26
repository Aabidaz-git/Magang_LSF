# Product Requirements Document (PRD)
## CMS Klasifikasi Video LSF RI

| Metadata | Keterangan |
| :--- | :--- |
| **Nama Proyek** | Content Management System (CMS) Klasifikasi Video LSF RI |
| **Instansi** | Lembaga Sensor Film (LSF) Republik Indonesia |
| **Dasar Hukum** | UU No. 33 Tahun 2009 tentang Perfilman & PP No. 18 Tahun 2014 |
| **Versi Dokumen** | 1.0.0 (Fase 1 - Requirement & Design Baseline) |
| **Target Branch** | `testing_branch` |
| **Tech Stack** | Next.js (App Router), TypeScript, Tailwind CSS, Supabase (PostgreSQL, Storage, Auth) |

---

## 1. Deskripsi & Gambaran Umum Produk

**CMS Klasifikasi Video LSF RI** adalah platform internal berbasis web yang dirancang khusus untuk memodernisasi dan mempercepat alur kerja penelaahan sensor film di lingkungan Lembaga Sensor Film (LSF) Republik Indonesia. 

Sistem ini menjembatani proses verifikasi manual konvensional dengan kapabilitas kecerdasan buatan (*multimodal AI vision* seperti Qwen-VL). Melalui sistem ini, video materi sensor berukuran besar diunggah melalui mekanisme *chunking* yang andal, diproses oleh layanan *inference backend* untuk mendeteksi potensi pelanggaran (kekerasan, pornografi/sensualitas, adegan berbahaya, penodaan, dan dialog sensitif), serta disajikan ke verifikator dalam bentuk draf laporan berbasis *frame* dan *timestamp*.

Prinsip utama sistem ini adalah **Human-in-the-Loop (HITL)**: kecerdasan buatan berfungsi sebagai asisten pembacaan dini (*pre-screening assistant*), sementara keputusan klasifikasi usia (SU, 13+, 17+, 21+) dan catatan penyensoran tetap berada penuh di tangan **Anggota Subkomisi Penilaian LSF**.

---

## 2. Latar Belakang & Masalah

### 2.1 Masalah Saat Ini (Problem Statement)
1. **Beban Penayangan Manual yang Tinggi:** Ratusan jam materi tayang (layar lebar, sinetron televisi, dan media Jaringan Teknologi Informasi / JTI) memerlukan peninjauan detik per detik, menimbulkan kelelahan (*fatigue*) pada verifikator sensor.
2. **Risiko Ketidakkonsistenan Timestamp:** Penandaan adegan sensitif yang dicatat secara manual rentan terhadap selisih detik (*timecode drift*) antarsesak peninjau.
3. **Keterbatasan Pengunggahan File Besar:** File materi sensor video resolusi tinggi sering kali mengalami kegagalan unggah jika koneksi terputus di tengah jalan tanpa sistem *chunking/resumable upload*.
4. **Pelaporan Terfragmentasi:** Data hasil sensor, log audit sistem, dan statistik klasifikasi usia sering kali belum terhubung secara langsung dalam satu dasbor analitik terpadu.

### 2.2 Tujuan Produk (Product Objectives)
- Mempercepat waktu pemindaian awal materi sensor hingga 60% dengan bantuan deteksi otomatis adegan berisiko.
- Menyediakan bukti visual (*frame evidence*) dan log *timestamp* yang presisi untuk setiap segmen yang dicurigai.
- Menjamin keandalan unggah file video besar (hingga ukuran puluhan gigabyte) dengan metode *chunking*.
- Menyediakan ekspor laporan resmi yang terstandarisasi dalam format Master JSON dan CSV untuk integrasi arsip LSF RI.

---

## 3. Fitur Utama & Kriteria Penerimaan (Acceptance Criteria)

### A. Home (LSF Data Dashboard)
Dasbor utama yang menyajikan visualisasi agregat hasil sensor dan rekapitulasi data film secara komprehensif.

* **Acceptance Criteria (AC):**
  1. **Visual Distribusi Klasifikasi Usia:** Sistem wajib menampilkan visualisasi donat/lingkaran persentase klasifikasi usia secara dinamis untuk kategori:
     - **SU (Semua Umur):** Hijau `#1fa363`
     - **13+ (Remaja 13 Tahun ke atas):** Kuning/Amber `#f59e0b`
     - **17+ (Dewasa 17 Tahun ke atas):** Merah `#ef4444`
     - **21+ (Dewasa 21 Tahun ke atas):** Hitam/Gelap `#1b2735`
  2. **Tabel Rekapitulasi Sensor Film:** Memuat tabel rangkuman dengan kolom:
     - Kategori Usia
     - Target Penonton
     - Jumlah Judul Film
     - Persentase (%)
  3. **Ekspor & Cetak:** Tersedia tombol aksi untuk mengunduh data tabel dalam format Excel/CSV serta mencetak laporan langsung (*print-friendly view*).
  4. **Responsivitas Dasbor:** Dasbor harus menyesuaikan tampilan dengan mulus pada berbagai resolusi monitor staf LSF.

---

### B. Klasifikasi Video (Upload & Hasil Analisis Adegan)
Modul operasional inti untuk mengunggah materi video tunggal dan memeriksa hasil inferensi adegan.

* **Acceptance Criteria (AC):**
  1. **Chunked File Uploader:** 
     - Menerima format kontainer umum film (`.mp4`, `.mov`, `.mkv`, `.avi`).
     - File besar dipecah secara otomatis di sisi klien menjadi blok-blok *chunk* (misal: 5MB–10MB per bagian) sebelum dikirimkan ke storage backend.
     - Menyertakan indikator status pengunggahan (persentase, kecepatan, dan estimasi waktu selesai).
  2. **Status Progres Real-Time:** 
     - Menampilkan indikator status interaktif:
       - *Tahap 1: Validasi File & Penghitungan Hash (SHA-256)*
       - *Tahap 2: Ekstraksi Frame & Audio*
       - *Tahap 3: Klasifikasi Adegan oleh Engine AI*
       - *Tahap 4: Kompilasi Hasil Analisis*
     - Menampilkan pesan status: *"Video sedang dianalisis oleh sistem..."*.
  3. **Laporan Adegan (Scene Analysis Report):**
     - Memuat ringkasan klasifikasi (Rating Rekomendasi AI, Jumlah Total Adegan, Jumlah Adegan *High Risk*).
     - Menampilkan tabel detail adegan dengan kolom:
       - **Waktu (Timecode):** Format `MM:SS` atau `HH:MM:SS`.
       - **Adegan:** Deskripsi naratif kejadian dalam video.
       - **Tag Kategori:** Label klasifikasi seperti *Dialog*, *Kekerasan*, *Sensualitas*, *Horor/Ketakutan*, *Senjata*, dsb.
       - **Tingkat Risiko:** *Rendah (Low)*, *Sedang (Medium)*, *Tinggi (High)* dengan kode warna jelas.
       - **Bukti Frame (Evidence):** Thumbnail visual frame adegan yang bersangkutan yang dapat diperbesar (*modal preview*).
       - **Catatan Peninjauan:** Area catatan yang dapat divalidasi/disunting oleh verifikator manusia.
  4. **Panel Riwayat Analisis Terkini:**
     - Menampilkan riwayat video yang baru selesai dianalisis di sisi kanan/bawah.
     - Memuat status proses (`Complete`, `Processing`, `Failed`) dan tombol langsung *"Buka Hasil"*.

---

### C. Riwayat Analisis (Audit Log & Master Archive)
Arsip lengkap seluruh aktivitas sensor film mandiri dan pelacakan historis hasil telaah.

* **Acceptance Criteria (AC):**
  1. **Kartu Metrik Operasional:**
     - **Total Video Dianalisis:** Agregat total film yang masuk ke sistem.
     - **Status Selesai (Terverifikasi):** Jumlah video yang telah diverifikasi verifikator beserta tingkat persentase validitas.
     - **Sedang Diproses (Inference):** Jumlah antrean aktif yang sedang dikerjakan *node* komputasi GPU.
     - **Butuh Tinjauan Verifikator:** Jumlah video yang memiliki tanda bahaya (*flagged* 21+ atau anomali) dan menunggu konfirmasi.
  2. **Pencarian & Penyaringan Multi-parameter:**
     - Pencarian teks berdasarkan: Judul Video, ID Tiket LSF (contoh: `LSF-2026-XXXX`), atau SHA-256 Hash.
     - Filter berdasarkan: Rentang Bulan/Tahun, Status Verifikasi, Klasifikasi Usia, dan Urutan Unggah (Terbaru/Terlama).
  3. **Item Metadata Lengkap:** Setiap entri daftar riwayat menyajikan:
     - ID Tiket LSF & Judul Video
     - Format File, Ukuran (MB/GB), Resolusi (1080p, 4K, dsb.)
     - Tanggal & Waktu Unggah
     - *Confidence Rate* AI (%)
     - Elemen terdeteksi (chip indikator: *Kekerasan Ringan*, *Ketegangan*, dsb.)
  4. **Aksi Ekspor & Unduh:**
     - Tombol *"Download Master JSON"* untuk mengunduh seluruh data riwayat terfilter.
     - Tombol *"+ JSON"* pada setiap kartu baris untuk mengunduh arsip spesifik video tersebut.
     - Tombol *"Export Batch (CSV)"* untuk laporan tabulasi spreadsheet.

---

### D. Laporan (Visualisasi Eksekutif & Statistik LSF)
Visualisasi analitik performa operasional LSF lintas medium sensor.

* **Acceptance Criteria (AC):**
  1. **Kartu Ringkasan Medium Sensor:**
     - Menyajikan 4 metrik agregat: **Total**, **Layar Lebar (Bioskop)**, **Televisi**, dan **JTI (Jaringan Teknologi Informasi / OTT / Streaming)**.
     - Menyertakan indikator tren pertumbuhan dibandingkan periode bulan sebelumnya (contoh: `↑12% dari bulan sebelumnya`).
  2. **Grafik Batang (Klasifikasi Usia):**
     - Menggambarkan sebaran kuantitas judul film berdasarkan rating usia: **SU**, **13+**, **17+**, dan **21+**.
  3. **Grafik Lingkaran/Pie (Distribusi Genre):**
     - Menampilkan proporsi persentase genre: **Horror**, **Comedy**, **Romance**, **Action**, **Drama**, dan **Lain-lain**.
  4. **Integrasi Tautan:** Terdapat tautan *"Lihat Detail"* yang mengarahkan ke rincian tabel laporan terperinci.

---

## 4. Arsitektur Teknis & Struktur Proyek

Sistem dibangun menggunakan arsitektur web modern berbasis Next.js App Router dengan integrasi Backend-as-a-Service (BaaS) Supabase.

### 4.1 Tech Stack
- **Frontend & App Framework:** Next.js 14+ (App Router)
- **Bahasa Pemrograman:** TypeScript 5.x
- **Styling & UI Tokens:** Tailwind CSS 3.4+
- **Komponen Ikon:** Lucide React / SVG Ikon Resmi LSF
- **Database:** Supabase PostgreSQL
- **File Storage:** Supabase Storage (S3-compatible bucket untuk video chunks & frame snapshots)
- **Autentikasi & Otorisasi:** Supabase Auth (Email & Role-based Access Control: Admin, Penilai LSF)

### 4.2 Struktur Folder Aplikasi (`src/`)
```text
├── src/
│   ├── app/
│   │   ├── (dashboard)/
│   │   │   ├── layout.tsx              # Shell utama (Sidebar LSF, Header Topbar)
│   │   │   ├── home/page.tsx           # Dashboard Utama & Rekap Sensor
│   │   │   ├── klasifikasi/page.tsx    # Chunked Upload & Review Adegan Video
│   │   │   ├── riwayat/page.tsx        # Arsip, Audit Trail & Download JSON
│   │   │   └── laporan/page.tsx        # Visualisasi Metrik & Grafik Eksekutif
│   │   ├── api/
│   │   │   ├── upload/
│   │   │   │   └── route.ts            # Handler inisiasi & chunk assembly video
│   │   │   ├── job-status/
│   │   │   │   └── route.ts            # Polling status progress klasifikasi adegan
│   │   │   └── reports/
│   │   │       └── export/route.ts     # Generator Master JSON & CSV
│   │   ├── layout.tsx                  # Root layout & font provider
│   │   └── page.tsx                    # Redirect /home atau /login
│   ├── components/
│   │   ├── charts/                     # BarChart, DonutChart, PieChart LSF
│   │   ├── tables/                     # SceneReportTable, RekapitulasiTable
│   │   ├── upload/                     # ChunkUploader, UploadProgressModal
│   │   └── ui/                         # Badge, Button, Modal, Card, Dropdown
│   ├── lib/
│   │   ├── supabase/
│   │   │   ├── client.ts               # Supabase browser client
│   │   │   ├── server.ts               # Supabase server client
│   │   │   └── types.ts                # Database generated TypeScript types
│   │   └── utils.ts                    # Formatter timecode, bytes, hash helper
│   └── types/
│       ├── video.ts                    # Tipe data video, metadata, chunk
│       ├── report.ts                   # Tipe data adegan, rating, frame evidence
│       └── lsf-json.ts                 # Kontrak skema Master JSON LSF
```

---

## 5. Skema Data & Kontrak Master JSON

### 5.1 Entitas Database Utama (PostgreSQL)
1. **`videos`**: Menyimpan metadata file (`id`, `ticket_id`, `filename`, `file_size_bytes`, `duration_seconds`, `resolution`, `sha256_hash`, `storage_path`, `status`, `created_at`).
2. **`classification_jobs`**: Status eksekusi inference (`id`, `video_id`, `status: 'queued' | 'validating' | 'processing' | 'completed' | 'failed'`, `progress_percent`, `started_at`, `finished_at`, `error_message`).
3. **`scene_reports`**: Adegan terdeteksi (`id`, `video_id`, `timecode_start`, `timecode_end`, `scene_description`, `tag`, `risk_level: 'low' | 'medium' | 'high'`, `evidence_frames`, `review_notes`, `is_flagged`).
4. **`audit_verifications`**: Keputusan final sensor (`id`, `video_id`, `verified_by_user_id`, `final_rating: 'SU' | '13+' | '17+' | '21+'`, `decision_notes`, `verified_at`).

### 5.2 Standar Format Ekspor JSON (Master Output)
```json
{
  "lsf_metadata": {
    "ticket_id": "LSF-2026-X8910",
    "timestamp_export": "2026-10-26T10:30:00Z",
    "system_version": "LSF-Vision-CMS-v1.0",
    "regulasi": "UU No. 33 Tahun 2009 tentang Perfilman"
  },
  "file_info": {
    "filename": "film_preview_sample_01.mp4",
    "sha256": "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855",
    "size_bytes": 104857600,
    "duration": "00:45:12",
    "resolution": "1920x1080"
  },
  "classification_result": {
    "recommended_rating": "13+",
    "final_verified_rating": "13+",
    "confidence_score": 0.944,
    "total_scenes_analyzed": 14,
    "high_risk_scenes_count": 0,
    "summary_notes": "Konten visual dialog remaja berimbang. Tidak terdapat unsur kekerasan eksplisit maupun pornografi."
  },
  "scene_breakdown": [
    {
      "timecode": "00:10",
      "scene_summary": "Sebuah layar digital menampilkan foto grup sekelompok remaja berpose di dalam ruangan.",
      "tag": "Dialog",
      "risk_level": "Rendah",
      "evidence_frames": [
        "https://storage.lsf.go.id/frames/LSF-2026-X8910/f1.jpg",
        "https://storage.lsf.go.id/frames/LSF-2026-X8910/f2.jpg"
      ],
      "reviewer_notes": "Aman untuk kelompok usia remaja."
    }
  ]
}
```

---

## 6. Persyaratan Non-Fungsional (NFR)

1. **Keandalan Unggah (Upload Reliability):** Sistem chunking harus mampu melanjutkan proses (*resume*) atau mengulang *chunk* spesifik yang gagal tanpa harus mengulang unggahan dari awal.
2. **Kinerja & Responsivitas:** Halaman dasbor dan riwayat harus memiliki waktu muat di bawah 1,5 detik untuk memuat 50 entri pertama menggunakan paginasi / infinite scroll.
3. **Integritas & Keamanan Data:**
   - Integritas file diverifikasi menggunakan perbandingan hash SHA-256 sebelum dan sesudah penggabungan *chunk*.
   - Akses video dan frame bukti dibatasi (*signed URLs*) untuk mencegah kebocoran materi film sebelum tanggal rilis resmi.
4. **Audit Trail Komprehensif:** Setiap tindakan pengubahan catatan atau penetapan rating oleh verifikator tercatat dalam log audit dengan stempel waktu dan identitas akun peninjau.
