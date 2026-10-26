# Lo-Fi Wireframe: Halaman Klasifikasi Video
## CMS Klasifikasi Video LSF RI

Halaman ini merupakan ruang kerja utama bagi verifikator sensor untuk mengunggah berkas video, memantau proses inferensi kecerdasan buatan, meninjau tabel adegan, serta memverifikasi rating resmi.

---

## 1. Diagram Tata Letak Wireframe (Desktop View)

```text
+------------------------------------------------------------------------------------------------------------------+
| [LOGO LSF]  LEMBAGA SENSOR FILM · REPUBLIK INDONESIA              [SU] [13+] [17+] [21+]  [Avatar Penilai (v)]  |
|             Klasifikasi Adegan Video · Unggah & Peninjauan Hasil                                                 |
+--------------+-------------------------------------------------------------------+-------------------------------+
| SIDEBAR      | KOLOM KIRI (Upload & Laporan Adegan)                              | KOLOM KANAN (Metadata & Log)  |
|              |                                                                   |                               |
| [ ] Home     | +---------------------------------------------------------------+ | +---------------------------+ |
| [*] Klasifik | | ZONA UNGGAH CHUNKING VIDEO                                    | | | METADATA VIDEO TIKET      | |
| [ ] Riwayat  | |       ( ( [ICONS CLOUD] ) )                                   | | | File: sample_film_01.mp4   | |
| [ ] Laporan  | |          [ Unggah Video ]  (atau seret berkas ke sini)        | | | Tiket: LSF-2026-X8910     | |
|              | |  Hint: File besar dipecah otomatis per chunk 5MB              | | | Resolusi: 1080p FHD       | |
|              | +---------------------------------------------------------------+ | | Durasi: 00:45:12          | |
|              |                                                                   | | Hash: e3b0c442...991b     | |
|              | +---------------------------------------------------------------+ | +---------------------------+ |
|              | | PROGRES INFERENCE REAL-TIME                                   | |                               |
|              | | [✓] Validasi File SHA-256    [✓] Ekstraksi Frame Audio        | | +---------------------------+ |
|              | | [>>] Klasifikasi Adegan AI... (78%) [============        ]    | | | RINGKASAN KLASIFIKASI     | |
|              | +---------------------------------------------------------------+ | | Rekomendasi: [ 13+ ]      | |
|              |                                                                   | | Akurasi AI: 94.4%         | |
|              | +---------------------------------------------------------------+ | | Status: Menunggu Validasi | |
|              | | LAPORAN ADEGAN                                                | | +---------------------------+ |
|              | | Rating: [ 13+ ]   |   Total Adegan: 14   |   High Risk: 0     | |                               |
|              | | Notice: Draf bantuan AI. Keputusan final tetap pada Penilai.  | | +---------------------------+ |
|              | |---------------------------------------------------------------| | | RIWAYAT TERKINI           | |
|              | | Waktu | Adegan           | Tag    | Tingkat | Bukti | Catatan | | | • trailer_01.mp4 [Buka] | |
|              | |-------+------------------+--------+---------+-------+---------| | |   Status: [ Complete ]    | |
|              | | 00:10 | Dialog remaja    | Dialog | Rendah  | [F1-3]| Aman... | | | • teaser_horor   [Buka] | |
|              | | 12:45 | Adegan kejar mobil|Aksi   | Sedang  | [F4-6]| Periksa | | |   Status: [ Complete ]    | |
|              | | 31:20 | Peringatan senjata|Bahaya | Tinggi  | [F7-9]| Cek cut | | | • episode_04.mkv [Buka] | |
|              | +---------------------------------------------------------------+ | |   Status: [ Processing ]  | |
|              | | AKSI PENILAI:                                                 | | +---------------------------+ |
|              | | Tetapkan Rating: ( ) SU  (*) 13+  ( ) 17+  ( ) 21+            | |                               |
|              | | Catatan Pleno: [ Tulis pertimbangan sensor di sini...       ] | |                               |
|              | | [ Simpan Catatan ]                  [ VERIFIKASI & SELESAI ]  | |                               |
|              | +---------------------------------------------------------------+ |                               |
+--------------+-------------------------------------------------------------------+-------------------------------+
```

---

## 2. Rincian Elemen Kunci

1. **Upload Zone:** Dilengkapi mekanisme *chunking* otomatis di browser dengan penanganan kegagalan per bagian berkas.
2. **Progres Real-Time Bar:** Menampilkan persentase dinamis dari endpoint polling `/api/job-status`.
3. **Tabel Laporan Adegan:** 
   - Bukti frame berupa thumbnail interaktif yang dapat diklik untuk membuka modal pembesar.
   - Kolom catatan peninjauan langsung dapat diketik (*inline editing*).
4. **Panel Aksi Penilai:** Pilihan radio button rating resmi LSF dan tombol konfirmasi keputusan sensor.
