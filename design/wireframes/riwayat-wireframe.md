# Lo-Fi Wireframe: Halaman Riwayat Analisis
## CMS Klasifikasi Video LSF RI

Halaman ini merupakan arsip audit penelaahan film dan log komprehensif seluruh video yang dianalisis oleh sistem, dilengkapi dengan metrik kesehatan komputasi GPU dan opsi ekspor data massal.

---

## 1. Diagram Tata Letak Wireframe (Desktop View)

```text
+------------------------------------------------------------------------------------------------------------------+
| [LOGO LSF]  LEMBAGA SENSOR FILM · REPUBLIK INDONESIA              [SU] [13+] [17+] [21+]  [Avatar Admin (v)]    |
|             Klasifikasi Adegan Video · Riwayat & Audit Trail                                                     |
+--------------+---------------------------------------------------------------------------------------------------+
| SIDEBAR      | ARSIP AUDIT SENSOR LSF                                                                            |
|              | Riwayat Analisis Terkini & Log Klasifikasi Video                                                  |
| [ ] Home     | Arsip telaah sensor mandiri AI vision sesuai UU No. 33/2009 tentang Perfilman                    |
| [ ] Klasifik |---------------------------------------------------------------------------------------------------|
| [*] Riwayat  | AKSI MASSAL:               [ Export Batch (CSV) ]   [ Download Master JSON ]   [ Refresh Log ]    |
| [ ] Laporan  |---------------------------------------------------------------------------------------------------|
|              | 4 KARTU METRIK OPERASIONAL GPU & ANTREAN                                                          |
|              | +--------------------+ +--------------------+ +--------------------+ +--------------------+       |
|              | | TOTAL VIDEO        | | STATUS SELESAI     | | SEDANG DIPROSES    | | BUTUH TINJAUAN   |       |
|              | | 142 Video          | | 134 Video          | | 3 Antrean          | | 5 Video          |       |
|              | | [+18% bulan ini]   | | [94.4% Rate Valid] | | [2 GPU Nodes Aktif]| | [Flagged Anomali]|       |
|              | | [=============   ] | | [================] | | [======          ] | | [===             |       |
|              | +--------------------+ +--------------------+ +--------------------+ +--------------------+       |
|              |---------------------------------------------------------------------------------------------------|
|              | BILAH PENCARIAN & FILTER MULTI-PARAMETER                                                          |
|              | [ Cari ID Tiket, Judul Film, atau SHA-256... ] [ Filter Bulan (v) ] [ Urutan: Terbaru (v) ]       |
|              |---------------------------------------------------------------------------------------------------|
|              | DAFTAR ANTREAN & HASIL TIKET SENSOR                                                               |
|              | +-----------------------------------------------------------------------------------------------+ |
|              | | [✓] LSF-2026-X8910 | "Merah Putih Memanggil.mp4"                       Status: [ SELESAI ]    | |
|              | |     Format: MP4 | Ukuran: 1.4 GB | Res: 1080p | Tgl: 26 Okt 2026, 09:15 | Conf: 96.2%         | |
|              | |     Elemen: [ Dialog Kebangsaan ] [ Aksi Militer ] [ Ledakan ]                                | |
|              | |     Aksi: [ Buka Hasil ]   [ + JSON ]   [ Log Audit ]                                         | |
|              | +-----------------------------------------------------------------------------------------------+ |
|              | | [!] LSF-2026-X8909 | "Misteri Rumah Tua.mkv"                           Status: [ BUTUH REVIEW]| |
|              | |     Format: MKV | Ukuran: 2.1 GB | Res: 4K UHD | Tgl: 26 Okt 2026, 08:30 | Conf: 88.5%         | |
|              | |     Elemen: [ Horor Supranatural ] [ Jumpscare Tinggi ] [ Flagged 21+ ]                       | |
|              | |     Aksi: [ Buka Hasil ]   [ + JSON ]   [ Log Audit ]                                         | |
|              | +-----------------------------------------------------------------------------------------------+ |
|              | | [~] LSF-2026-X8908 | "Cinta di Kota Tua.mov"                           Status: [ INFERENCE ]  | |
|              | |     Format: MOV | Ukuran: 850 MB | Res: 1080p | Tgl: 26 Okt 2026, 08:10 | Node: GPU-Worker-02 | |
|              | |     Progres: 65% Ekstraksi frame... [==============        ]                                  | |
|              | +-----------------------------------------------------------------------------------------------+ |
|              | PAGINASI:  [< Sebelumnya]  Halaman 1 dari 15  [Berikutnya >]              Menampilkan 1-10 data   |
+--------------+---------------------------------------------------------------------------------------------------+
```

---

## 2. Rincian Fitur Utama

1. **Aksi Massal:** Tombol ekspor JSON master dan batch CSV langsung mengirim permintaan unduhan ke server.
2. **Kartu GPU & Antrean:** Memberikan visibilitas instan terhadap kapasitas server *inference*.
3. **Pencarian Cepat:** Pencarian asinkronus yang memfilter daftar tiket tanpa me-refresh seluruh halaman.
4. **Item Metadata Lengkap:** Menyajikan hash kriptografis SHA-256 untuk memvalidasi integritas materi sensor.
