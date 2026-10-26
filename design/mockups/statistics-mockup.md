# Hi-Fi Mockup Specification: Statistics & Table Screen
## CMS Klasifikasi Video LSF RI

Dokumen ini merinci spesifikasi *High-Fidelity Mockup* untuk layar **Statistik & Tabel Data Arsip**, yang diadaptasi langsung dari desain referensi terlampir (*INSIDE PROJECT - STATISTIC SCREEN*).

---

## 1. Komposisi Tata Letak & Struktur Bilah Filter

```
┌────────────────────────────────────────────────────────────────────────────────────────────────────────┐
│ [LSF LOGO] Header: Tabel Riwayat Sensor Film    [Indikator: 01.01.2026] (v)   09:55 [Bell: 3] [Avatar] │
├─────────┬──────────────────────────────────────────────────────────────────────────────────────────────┤
│ NAV     │ MULTI-PARAMETER FILTER & ACTION BAR                                                          │
│ [Icons] │ [📅 Kalender] [📦 Kategori (v)] [🏷️ Rating (v)] [👤 Penilai (v)] [Periode Tgl] [ Tampilkan ]  │
│         │                                                                             (#C8282E Merah)  │
│ • Home  ├──────────────────────────────────────────────────────────────────────────────────────────────┤
│ • Klas  │ TABEL DATA RIWAYAT DETAIL SENSOR                                                             │
│ • Riway │ ┌───┬────┬──────────────────┬──────────────┬──────────────┬───────┬─────────┬────────┬──────┐│
│ • Lapor │ │[x]│No  │ Judul Materi     │ ID Tiket LSF │ Verifikator  │ Durasi│ Akurasi │ Status │ Aksi ││
│         │ ├───┼────┼──────────────────┼──────────────┼──────────────┼───────┼─────────┼────────┼──────┤│
│         │ │[ ]│ 1  │ Garuda di Dadaku │ LSF-2026-X01 │ Dra. Ratna   │ 01:42 │ 96.2%   │ [SU]   │ [..] ││
│         │ │[ ]│ 2  │ Malam Mencekam   │ LSF-2026-X02 │ Budi S., M.A │ 01:55 │ 88.4%   │ [17+]  │ [..] ││
│         │ │[ ]│ 3  │ Petualangan Rimba│ LSF-2026-X03 │ Siti N., M.H │ 00:45 │ 94.0%   │ [13+]  │ [..] ││
│         │ │[ ]│ 4  │ Kisah Dua Hati   │ LSF-2026-X04 │ Dra. Ratna   │ 02:10 │ 95.1%   │ [13+]  │ [..] ││
│         │ └───┴────┴──────────────────┴──────────────┴──────────────┴───────┴─────────┴────────┴──────┘│
│         │                                                                                              │
│         │ FOOTER BAR:                                                                                  │
│         │ [ <  1/10  > ] Paginasi Halaman                     Tindakan Cepat: [ ✓ Setuju ] [ ✕ Tolak ] │
└─────────┴──────────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 2. Rincian Elemen Desain

### 2.1 Bilah Filter Multi-Parameter (Top Filter Toolbar)
* **Warna Aksen Tombol:** Tombol eksekusi filter utama menggunakan warna merah `#C8282E` sesuai tombol *"Show"* pada desain referensi.
* **Dropdown Seleksi:** Input pilihan dengan border abu-abu `#C1CDD4` yang berubah menjadi Sky Blue `#26B1EB` saat aktif.
* **Date Range Picker:** Integrasi ikon kalender dengan rentang tanggal fleksibel untuk menyaring arsip bulanan/tahunan.

### 2.2 Grid Tabel Riwayat Interaktif
* **Seleksi Kotak Centang (*Bulk Checkbox*):** Memungkinkan verifikator memilih banyak berkas sekaligus untuk melakukan ekspor batch CSV atau unduh Master JSON massal.
* **Chip Status Warna:** 
  - Status `Selesai / Terverifikasi` menggunakan lencana Teal `#1899A3`.
  - Status `Sedang Diproses` menggunakan chip animasi Sky Blue `#26B1EB`.
  - Status `Butuh Tinjauan (High Risk)` menggunakan chip peringatan Merah `#C8282E`.
* **Paginasi & Aksi Bawah:** Paginasi ringkas di sisi kiri bawah dan kelompok tombol aksi cepat di sisi kanan bawah.
