# Lo-Fi Wireframe: Halaman Laporan (Visualisasi Metrik & Tren)
## CMS Klasifikasi Video LSF RI

Halaman ini ditujukan untuk analisis eksekutif komisi penilai guna memantau tren distribusi materi film antar-platform serta demografi klasifikasi usia dan genre konten.

---

## 1. Diagram Tata Letak Wireframe (Desktop View)

```text
+------------------------------------------------------------------------------------------------------------------+
| [LOGO LSF]  LEMBAGA SENSOR FILM · REPUBLIK INDONESIA              [SU] [13+] [17+] [21+]  [Avatar Penilai (v)]  |
|             Laporan Klasifikasi Video · Visualisasi Grafik Agregat                                               |
+--------------+---------------------------------------------------------------------------------------------------+
| SIDEBAR      | RINGKASAN LAPORAN SENSOR                                               [ Lihat Detail Rekap -> ]  |
|              |---------------------------------------------------------------------------------------------------|
| [ ] Home     | 4 KARTU MEDIUM TAYANG SENSOR                                                                      |
| [ ] Klasifik | +--------------------+ +--------------------+ +--------------------+ +--------------------+       |
| [ ] Riwayat  | | TOTAL DATA         | | LAYAR LEBAR        | | TELEVISI           | | JTI (STREAMING)    |       |
| [*] Laporan  | | 1.248 Judul        | | 312 Judul          | | 520 Judul          | | 416 Judul          |       |
|              | | [↑12% bln lalu]    | | [↑8% bln lalu]     | | [↓3% bln lalu]     | | [↑24% bln lalu]    |       |
|              | +--------------------+ +--------------------+ +--------------------+ +--------------------+       |
|              |---------------------------------------------------------------------------------------------------|
|              | BAGIAN VISUALISASI GRAFIK EKSEKUTIF                                                               |
|              |                                                                                                   |
|              | +-----------------------------------------------+ +---------------------------------------------+ |
|              | | GRAFIK BATANG: SEBARAN KLASIFIKASI USIA       | | GRAFIK PIE: DISTRIBUSI GENRE KONTEN         | |
|              | |                                               | |                                             | |
|              | |  500 |   [===]                                | |                 . - ~ ~ ~ - .               | |
|              | |      |   [   ]    [===]                       | |             . '    Horror   ' .             | |
|              | |  300 |   [   ]    [   ]    [===]              | |           /       (34.2%)       \           | |
|              | |      |   [   ]    [   ]    [   ]              | |          :  Action         Comedy:          | |
|              | |  100 |   [   ]    [   ]    [   ]    [===]     | |          :  (22.1%)        (18.5%):          | |
|              | |    0 +-----------------------------------     | |           \   Romance   Lainnya /           | |
|              | |           SU       13+      17+      21+      | |             . ' (15.2%) (10.0%) '           | |
|              | |         (Teal)   (Amber)   (Red)   (Violet)   | |                 ' - , _ _ _ , '             | |
|              | +-----------------------------------------------+ +---------------------------------------------+ |
|              |                                                                                                   |
|              | FILTER PERIODE LAPORAN:  [ Kuartal IV 2026 (v) ]   [ Format: Semua Media (v) ]   [ Unduh PDF ]    |
+--------------+---------------------------------------------------------------------------------------------------+
```

---

## 2. Rincian Elemen Kunci

1. **Empat Kartu Medium Tayang:**
   - Menyajikan klasifikasi film berdasarkan media edar: Layar Lebar (Bioskop), Televisi (Free-to-air & Kabel), dan JTI (Jaringan Teknologi Informasi seperti Netflix, Vidio, Disney+).
   - Indikator tren persentase kenaikan/penurunan bulanan.
2. **Grafik Batang (Klasifikasi Usia):** Menampilkan perbandingan jumlah judul per rating usia dengan warna semantik masing-masing (`SU` Teal, `13+` Oranye, `17+` Merah, `21+` Violet).
3. **Grafik Lingkaran/Pie (Genre):** Menunjukkan porsi proporsi genre terbanyak yang masuk ke meja sensor LSF.
