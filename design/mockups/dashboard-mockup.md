# Hi-Fi Mockup Specification: Dashboard Screen
## CMS Klasifikasi Video LSF RI

Dokumen ini merinci spesifikasi *High-Fidelity Mockup* untuk halaman **Dashboard**, yang diadaptasi langsung dari desain referensi terlampir (*INSIDE PROJECT - DASHBOARD*) dengan penyesuaian khusus identitas Lembaga Sensor Film (LSF) RI.

---

## 1. Tinjauan Visual & Komposisi Layar

```
┌────────────────────────────────────────────────────────────────────────────────────────────────────────┐
│ [LSF LOGO] Header: Analisis Sensor Film       [Periode: 01.01.2026] (v)   09:55 [Bell: 3] [Avatar Penilai]│
├─────────┬──────────────────────────────────────────────────────────────────────────────────────────────┤
│ NAV     │ 4 PRIMARY METRIC CARDS ROW                                                                   │
│ [Icons] │ ┌───────────────┐ ┌───────────────┐ ┌───────────────┐ ┌───────────────┐                      │
│         │ │ [Card Red]    │ │ [Card Cerulean│ │ [Card Sky]    │ │ [Card Muted]  │                      │
│ • Home  │ │ 9.999 Judul   │ │ 4.999 Terverif│ │ 3.008 Inference│ │ 5.668 Arsip   │                      │
│ • Klas  │ └───────────────┘ └───────────────┘ └───────────────┘ └───────────────┘                      │
│ • Riway │                                                                                              │
│ • Lapor │ PROGRESS BAR GLOBAL: [ Readiness percentage: 62% ============================            ]   │
│         │                                                                                              │
│         │ TWO-COLUMN ANALYTICS SECTION                                                                 │
│         │ ┌──────────────────────────────────────────────┐ ┌─────────────────────────────────────────┐ │
│         │ │ PARAMETER DEPOSIT & REKAP SENSOR             │ │ OVERALL EFFICIENCY & SEBARAN USIA         │ │
│         │ │ Tabel ringkasan verifikasi dokumen           │ │   ( ( [ DONUT RING: 91.7% ] ) )           │ │
│         │ │ Daftar anggota penilai aktif                 │ │                                         │ │
│         │ └──────────────────────────────────────────────┘ └─────────────────────────────────────────┘ │
│         │                                                                                              │
│         │ EFFECTIVITY INDICATORS SLIDER BAR                                                            │
│         │ [ < ]  [ 11 In operation ]  [ 3 At unloading ]  [ 1 Standing ]  [ 0 On repair ]  [ 7 On relay ] [ > ]│
└─────────┴──────────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 2. Spesifikasi Visual Berdasarkan Palet Referensi

### 2.1 Bilah Navigasi Kiri (Dark Navy Sidebar)
* **Warna Latar:** Deep Navy `#003F85` dengan garis pemisah tipis `rgba(255, 255, 255, 0.1)`.
* **Item Menu Aktif:** Indikator rounded pill dengan aksen latar `#002754` dan teks putih tebal.
* **Ikon Navigasi:** Ikon garis bersih (*stroke width: 2px*) berwarna `#C1CDD4` yang berubah menjadi `#26B1EB` saat kursor melayang (*hover*).
* **Lencana Angka (*Badge*):** Lencana merah bulat `#C8282E` dengan angka putih kontras untuk menandai notifikasi video yang butuh perhatian verifikator.

### 2.2 Baris 4 Kartu Metrik Utama (Metric Cards)
Diadopsi langsung dari desain referensi dengan 4 blok warna khas:
1. **Kartu 1 (Merah `#C8282E`):** Total materi sensor masuk (`9.999 judul`), ikon film, teks putih.
2. **Kartu 2 (Cerulean Blue `#009CDD`):** Video selesai terverifikasi (`4.999 judul`), ikon centang.
3. **Kartu 3 (Sky Blue `#26B1EB`):** Video dalam proses komputasi GPU (`3.008 judul`), ikon *spinner/chip*.
4. **Kartu 4 (Light Slate `#C1CDD4`):** Arsip master tersimpan (`5.668 dokumen`), ikon brankas arsip.

### 2.3 Visual Donut Diagram & Indikator Efisiensi
* **Diagram Donut Utama:** Menampilkan efisiensi waktu penelaahan sensor (`91.7%`) dengan ring berwarna ganda (`#003F85` untuk terverifikasi dan `#DC7634` untuk antrean).
* **Slider Bar Indikator Operasional Bawah (*Effectivity Indicators*):**
  - Kotak-kotak modular putih dengan border halus `#C1CDD4` dan bayangan lembut.
  - Setiap kotak memuat ikon tematik dan angka status (misal: *11 node GPU aktif*, *3 file sedang diunggah*, *0 server galat*).
