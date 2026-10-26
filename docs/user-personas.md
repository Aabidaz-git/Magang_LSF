# User Personas
## CMS Klasifikasi Video LSF RI

Dokumen ini mendefinisikan profil representatif pengguna (*personas*) yang berinteraksi dengan CMS Klasifikasi Video Lembaga Sensor Film (LSF) Republik Indonesia. Persona ini menjadi acuan utama perancangan pengalaman pengguna (*User Experience / UX*), antarmuka (*UI*), dan arsitektur fitur.

---

```
                       ┌────────────────────────────────────────┐
                       │           PENGGUNA UTAMA CMS           │
                       └───────────────────┬────────────────────┘
                                           │
                ┌──────────────────────────┴──────────────────────────┐
                ▼                                                     ▼
┌───────────────────────────────┐                     ┌───────────────────────────────┐
│        PERSONA 1: PENILAI     │                     │        PERSONA 2: ADMIN       │
│  Anggota Subkomisi Penilaian  │                     │     Administrator / Tim IT    │
│            LSF RI             │                     │             LSF RI            │
├───────────────────────────────┤                     ├───────────────────────────────┤
│ • Validasi hasil AI           │                     │ • Monitoring GPU Node antrean │
│ • Tinjau bukti frame & waktu  │                     │ • Reliabilitas upload chunking│
│ • Penetapan rating final      │                     │ • Manajemen arsip Master JSON │
└───────────────────────────────┘                     └───────────────────────────────┘
```

---

## 1. Persona 1: Anggota Subkomisi Penilaian LSF (Verifikator Sensor)

> *"Tugas kami menjaga masyarakat dan generasi muda sesuai regulasi perfilman, tanpa menghambat kreativitas sineas. Kami butuh alat bantu yang presisi mendeteksi adegan sensitif, bukan menggantikan pertimbangan nurani kami."*

### 1.1 Profil Demografis & Karakteristik
* **Nama Fiktif / Representatif:** Dra. Ratna Kusuma, M.Si.
* **Jabatan:** Anggota Subkomisi Penilaian Film & Iklan LSF RI
* **Rentang Usia:** 42 – 58 tahun
* **Pendidikan:** S1/S2 Ilmu Komunikasi / Sastra / Hukum / Kebudayaan
* **Tingkat Kemahiran Digital:** Menengah (*comfortable* dengan aplikasi web kantor, browser desktop, spreadsheet, dan media player).
* **Perangkat Kerja Utama:** PC Desktop / Laptop Kantor (Windows 11, Layar 24-27 inci Full HD / 2K, koneksi intranet/internet LSF).

### 1.2 Peran & Tanggung Jawab
1. Menonton dan menelaah materi film (layar lebar, sinetron TV, video OTT/JTI) sebelum diedarkan ke publik.
2. Mengidentifikasi potensi pelanggaran pedoman sensor (Pasal 6 UU No. 33/2009: kekerasan, pornografi/sensualitas, penodaan agama, judi, narkotika).
3. Memeriksa *timestamp* dan *frame* bukti yang ditandai oleh sistem kecerdasan buatan (*AI Vision assistant*).
4. Menuliskan catatan pertimbangan peninjauan untuk setiap adegan yang bermasalah atau memerlukan revisi/pemotongan adegan (*cuts*).
5. Menetapkan keputusan klasifikasi usia resmi:
   - **SU (Semua Umur):** Penonton segala usia, materi ramah anak & keluarga.
   - **13+ (Remaja 13 Tahun):** Konten masa puber, konflik ringan, edukasi terarah.
   - **17+ (Dewasa 17 Tahun):** Konflik psikologis matang, adegan aksi non-eksplisit.
   - **21+ (Dewasa 21 Tahun):** Tema dewasa berat dengan batasan ketat sesuai hukum.

### 1.3 Titik Masalah Saat Ini (Pain Points)
* **Kelelahan Fisik & Sensorik (*Screen Fatigue*):** Harus menonton berjam-jam secara manual tanpa petunjuk awal di mana letak adegan kritis.
* **Ketidakakuratan Pencatatan Manual:** Mencatat *timecode* secara manual di kertas atau Excel sering meleset beberapa detik dari frame sebenarnya.
* **Risiko Adegan Terlewat (*Human Error*):** Pada film berdurasi panjang (di atas 120 menit), risiko terlewatnya adegan berdurasi kilat (contoh: *flash scene* senjata tajam atau dialog terselubung) cukup tinggi.
* **Kekhawatiran Over-Automation:** Takut jika sistem kecerdasan buatan langsung mengambil keputusan tanpa memahami konteks kultural lokal Indonesia.

### 1.4 Kebutuhan & Harapan terhadap CMS
* **Deteksi Cepat Berbasis Frame:** Ingin melihat langsung daftar adegan yang ditandai risiko tinggi (*High Risk*) berserta bukti visual (*frame evidence*) dalam satu klik.
* **Kemudahan Memverifikasi:** Butuh tombol cepat untuk menyetujui, menyunting catatan peninjauan, atau mengubah tingkat risiko hasil rekomendasi AI.
* **Kejelasan Kode Warna:** Tag adegan dan indikator risiko harus kontras dan mudah dibaca sekilas mata.
* **Kenyamanan Antarmuka:** Desain yang bersih, minim distraksi, dan fokus pada data adegan serta player pratinjau.

---

## 2. Persona 2: Administrator & Tim IT LSF

> *"Sistem harus stabil 24/7. File video film layar lebar bisa mencapai ukuran puluhan gigabyte, jadi mekanisme chunking dan antrean pemrosesan GPU harus transparan dan tidak boleh putus di tengah jalan."*

### 2.1 Profil Demografis & Karakteristik
* **Nama Fiktif / Representatif:** Dimas Prasetyo, S.Kom.
* **Jabatan:** Pranata Komputer / System & Infrastructure Administrator LSF RI
* **Rentang Usia:** 27 – 38 tahun
* **Pendidikan:** S1 Teknik Informatika / Sistem Informasi
* **Tingkat Kemahiran Digital:** Mahir (DevOps, Database, Network, API, Cloud Storage).
* **Perangkat Kerja Utama:** Dual-monitor workstation, terminal Linux, Windows Dev environment, browser tools.

### 2.2 Peran & Tanggung Jawab
1. Memastikan infrastruktur pengunggahan berkas video berjalan lancar tanpa *memory leak* atau kegagalan *payload*.
2. Memantau ketersediaan antrean kerja (*queue status*) pada *node inference GPU backend*.
3. Mengelola integritas berkas materi film menggunakan *checksum hash* SHA-256 untuk memastikan file tidak rusak atau dimanipulasi.
4. Menangani pencadangan (*backup*), ekspor arsip Master JSON, dan log audit seluruh aktivitas pengguna demi transparansi hukum.
5. Memelihara kebersihan ruang penyimpanan (*storage lifecycle*) pada Supabase Storage.

### 2.3 Titik Masalah Saat Ini (Pain Points)
* **Upload Timeout pada File Raksasa:** Pengunggahan standar HTTP sering putus jika mengunggah berkas film master berukuran 5GB – 20GB melalui jaringan biasa.
* **Ketiadaan Visibilitas Antrean Inference:** Sering tidak tahu apakah AI sedang bekerja, macet (*hung*), atau kehabisan memori GPU (*OOM*).
* **Kesulitan Penelusuran Audit:** Jika ada keluhan atau sengketa hasil sensor dari pemilik film, sulit melacak riwayat log dan siapa yang melakukan verifikasi jika sistem arsip terpencar.
* **Format Data Tidak Baku:** Permintaan data dari pimpinan sering membutuhkan pengolahan manual yang memakan waktu jika tidak tersedia fitur ekspor JSON/CSV langsung.

### 2.4 Kebutuhan & Harapan terhadap CMS
* **Reliabilitas Resumable Chunking:** Fitur unggah yang memecah file menjadi partisi kecil, dengan status progres per blok dan verifikasi hash otomatis.
* **Dashboard Monitoring Operasional:** Kartu metrik di halaman Riwayat yang menunjukkan jumlah video yang diproses, jumlah *GPU node* aktif, dan berkas yang butuh perhatian.
* **Ekspor Data Standar:** Satu tombol untuk mengunduh Master JSON komprehensif atau mengekspor batch CSV untuk kebutuhan rekapitulasi pelaporan berkala.
* **Filter Audit Trail Presisi:** Pencarian cepat berbasis ID Tiket LSF, Hash SHA-256, atau nama berkas.

---

## 3. Matriks Perbandingan & Interaksi Persona

| Aspek | Anggota Subkomisi Penilaian (Verifikator) | Administrator & Tim IT |
| :--- | :--- | :--- |
| **Fokus Utama** | Akurasi konten, kepatuhan norma, keadilan sensor | Keandalan sistem, throughput antrean, integritas data |
| **Menu Favorit** | `Klasifikasi Video` & `Laporan Adegan` | `Riwayat Analisis` & `Home / Dashboard` |
| **Aksi Terbanyak** | Memeriksa frame bukti, menulis catatan, approve rating | Memantau status proses, unduh Master JSON, audit log |
| **Toleransi Error** | Rendah terhadap kesalahan konteks sensor | Rendah terhadap kegagalan jaringan & integritas file |
| **Format Output** | Tampilan visual tabel adegan & draf rating | Master JSON terstruktur, Hash SHA-256, CSV Tabulasi |

---

## 4. Prinsip Desain untuk Menjawab Kebutuhan Persona

1. **Efisiensi Kognitif (Cognitive Load Reduction):**
   Untuk verifikator, sorot adegan dengan tingkat risiko tinggi (*High Risk*) menggunakan aksen merah tegas agar peninjau tidak perlu membaca baris netral satu per satu jika waktu mendesak.
2. **Umpan Balik Status yang Transparan (System Feedback):**
   Untuk Tim IT dan verifikator, setiap tahap unggah *chunk* dan komputasi inferensi harus memiliki label teks dan persentase yang jelas (*Real-time progress feedback*).
3. **Akuntabilitas & Keamanan Data (Human Oversight & Security):**
   Setiap interaksi persetujuan verifikasi mewajibkan identitas login yang valid dan tersimpan di riwayat audit.
