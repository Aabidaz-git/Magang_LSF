# Lo-Fi Wireframe: Halaman Home (LSF Data Dashboard)
## CMS Klasifikasi Video LSF RI

Halaman ini berfungsi sebagai beranda utama CMS yang menyajikan ikhtisar agregat statistik sensor film nasional, sebaran klasifikasi usia, dan tabel rekapitulasi lima tahunan.

---

## 1. Diagram Tata Letak Wireframe (Desktop View)

```text
+------------------------------------------------------------------------------------------------------------------+
| [LOGO LSF]  LEMBAGA SENSOR FILM · REPUBLIK INDONESIA              [SU] [13+] [17+] [21+]  [Avatar Penilai (v)]  |
|             Klasifikasi Adegan Video · Sistem Otomasi Sensor                                                     |
+--------------+---------------------------------------------------------------------------------------------------+
| SIDEBAR      | DASHBOARD HEADER                                                                                  |
|              | LSF Data Dashboard                                                                               |
| [*] Home     | Data Jumlah Klasifikasi Usia (Periode 2020 - 2025)                                                |
| [ ] Klasifik |---------------------------------------------------------------------------------------------------|
| [ ] Riwayat  | STATISTIC CARDS ROW                                                                               |
| [ ] Laporan  | +-----------------+ +-----------------+ +-----------------+ +-----------------+ +------------------+ |
|              | | DISTRIBUSI USIA | | SU              | | 13+             | | 17+             | | 21+              | |
|              | |   [ DONUT RING ]| | Semua Umur      | | Remaja 13 Tahun | | Dewasa 17 Tahun | | Dewasa 21 Tahun  | |
|              | |   (100% Total)  | | 38.5 %          | | 32.0 %          | | 24.1 %          | | 5.4 %            | |
|              | | [SU][13][17][21]| | 2020 - 2025     | | 2020 - 2025     | | 2020 - 2025     | | 2020 - 2025      | |
|              | +-----------------+ +-----------------+ +-----------------+ +-----------------+ +------------------+ |
|              |---------------------------------------------------------------------------------------------------|
|              | TABEL REKAPITULASI SENSOR FILM                                    [ Export CSV ]  [ Cetak Tabel ] |
|              | +-----------------------------------------------------------------------------------------------+ |
|              | | Kategori Usia | Target Penonton             | Jumlah Judul Film    | Persentase (%)           | |
|              | +---------------+-----------------------------+----------------------+--------------------------+ |
|              | | SU (Semua)    | Penonton Semua Umur         | 18.420 Judul         | 38.5%  [====       ]     | |
|              | | 13+ (Remaja)  | Penonton Usia 13 Tahun+     | 15.310 Judul         | 32.0%  [===        ]     | |
|              | | 17+ (Dewasa)  | Penonton Usia 17 Tahun+     | 11.530 Judul         | 24.1%  [==         ]     | |
|              | | 21+ (Dewasa)  | Penonton Usia 21 Tahun+     |  2.580 Judul         |  5.4%  [=          ]     | |
|              | +---------------+-----------------------------+----------------------+--------------------------+ |
|              | | TOTAL         | Akumulasi Sensor 5 Tahun    | 47.840 Judul         | 100.0%                   | |
|              | +-----------------------------------------------------------------------------------------------+ |
+--------------+---------------------------------------------------------------------------------------------------+
```

---

## 2. Rincian Elemen & Zona Interaksi

1. **Bilah Atas Resmi (Official Topbar):**
   - Logo fisik LSF RI di sudut kiri.
   - Teks hierarki instansi: `LEMBAGA SENSOR FILM · REPUBLIK INDONESIA`.
   - Chip pill klasifikasi usia interaktif (`SU` Hijau-Teal `#1899A3`, `13+` Oranye `#DC7634`, `17+` Merah `#C8282E`, `21+` Deep Violet `#4B2979`).
2. **Kartu Donut Distribusi Klasifikasi Usia:**
   - Visual ring diagram lingkaran dengan persentase terpusat `100% Total Data`.
   - Legenda warna interaktif di bagian bawah ring.
3. **Kartu Statistik Periode 2020–2025:**
   - 4 kartu individual dengan penanda lencana usia di sudut kiri atas.
   - Nilai persentase besar dan teks keterangan rentang tahun.
4. **Tabel Rekapitulasi Sensor Film:**
   - Header tabel tegas dengan warna latar `#F0F4F8`.
   - Kolom progress visual mini pada nilai persentase.
   - Tombol aksi ekspor di sudut kanan atas tabel:
     - `Export CSV`: Menghasilkan berkas spreadsheet tabulasi.
     - `Cetak Tabel`: Membuka dialog cetak browser (*print stylesheet*).
