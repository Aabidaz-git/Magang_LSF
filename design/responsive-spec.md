# Responsive & Layout Specification
## CMS Klasifikasi Video LSF RI

Dokumen ini mendefinisikan aturan tata letak adaptif (*responsive design behavior*), titik henti layar (*breakpoints*), dan adaptasi komponen antarmuka pengguna pada berbagai jenis perangkat (ponsel cerdas, tablet, monitor kerja, hingga layar ultrawide).

---

## 1. Titik Henti Layar (Responsive Breakpoints)

Menggunakan standar *Tailwind CSS breakpoint scale* yang telah diselaraskan dengan kebutuhan perangkat kerja LSF RI:

| Token | Lebar Layar (Viewport) | Target Perangkat Utama | Karakteristik Tata Letak |
| :--- | :--- | :--- | :--- |
| **Mobile (`sm`)** | `375px` – `639px` | Smartphone (iPhone, Galaxy) | Tata letak kolom tunggal (*single column*), menu laci (*drawer*), tabel dengan *horizontal scroll*. |
| **Tablet (`md`)** | `640px` – `1023px` | iPad, Galaxy Tab, Laptop Mini | Grid 2 kolom pada kartu statistik, sidebar dapat dilipat (*collapsible*), font fluid. |
| **Desktop (`lg` & `xl`)** | `1024px` – `1439px` | Laptop 14–16 inci, Monitor Standar (1080p)| Sidebar permanen (*persistent*), tata letak multi-kolom (*dashboard 2-3 column*), tabel penuh. |
| **Wide Display (`2xl`)** | `1440px` ke atas | Monitor Kerja Eksekutif LSF (2K / 4K) | Konten terpusat (*max-width: 1440px*), margin otomatis, visual grafik berdampingan. |

---

## 2. Perilaku Komponen Kunci Lintas Breakpoint

```
DESKTOP (1280px+)                          TABLET (768px)                MOBILE (375px)
┌────────┬─────────────────────────────┐   ┌────┬────────────────────┐   ┌───────────────────────────┐
│ SIDEBAR│ TOPBAR (Logo + 4 Pills)     │   │ICON│ TOPBAR (Compact)   │   │ [=] Logo LSF        (Avatar)
│ (260px)├─────────────────────────────┤   │BAR ├────────────────────┤   ├───────────────────────────┤
│        │ [Card 1] [Card 2] [Card 3]  │   │80px│ [Card 1]  [Card 2] │   │ [Card 1 (Full Width)]     │
│ • Home │                             │   │    │ [Card 3]  [Card 4] │   │ [Card 2 (Full Width)]     │
│ • Klas │ ┌────────────────┐ ┌──────┐ │   │    ├────────────────────┤   ├───────────────────────────┤
│ • Riway│ │  Tabel Adegan  │ │Metrik│ │   │    │ [Tabel Adegan]     │   │ [Tabel Adegan - H-Scroll] │
│ • Lapor│ │  (Full Width)  │ │Video │ │   │    │ (Scroll Horisontal)│   │ (Tampilan Kartu Terlipat) │
│        │ └────────────────┘ └──────┘ │   │    │                    │   │                           │
└────────┴─────────────────────────────┘   └────┴────────────────────┘   └───────────────────────────┘
```

### 2.1 Sidebar Navigasi Utama
* **Desktop (1024px+):**
  - Tampil penuh di sisi kiri dengan lebar tetap `260px`.
  - Memuat logo teks lembaga, menu utama dengan ikon dan label teks, lencana notifikasi, serta status pengguna.
* **Tablet (768px – 1023px):**
  - Mengkerut otomatis ke mode *Mini Sidebar* (`80px`) hanya menampilkan ikon dengan *tooltip* saat disentuh/diarahkan kursor.
* **Mobile (< 768px):**
  - Tersembunyi secara bawaan (*hidden*).
  - Terbuka sebagai *Off-Canvas Drawer* saat tombol hamburger di sudut kiri atas diklik, disertai lapisan *backdrop* redup (*dim overlay* 50% opacity).

### 2.2 Topbar Navigasi & Branding LSF
* **Desktop:**
  - Menampilkan lencana logo fisik LSF, teks hierarki resmi (*LEMBAGA SENSOR FILM · REPUBLIK INDONESIA*), judul halaman aktif, dan 4 lencana pill klasifikasi usia (`SU`, `13+`, `17+`, `21+`) berurutan di sisi kanan.
* **Mobile:**
  - Menampilkan ikon hamburger, logo LSF mini, dan avatar verifikator.
  - Lencana pill klasifikasi usia diposisikan dalam bilah geser horizontal (*horizontal scrollable chip list*) di bawah topbar agar tidak menumpuk.

### 2.3 Tabel Analisis Adegan & Data Grid
* **Desktop:**
  - Seluruh kolom (Waktu, Adegan, Tag, Tingkat, Bukti Frame, Catatan Peninjauan) terlihat utuh tanpa perlu menggeser horizontal pada resolusi 1280px+.
* **Mobile / Tablet:**
  - Mengaktifkan pembungkus `overflow-x-auto` dengan bayangan indikator geser di sisi kanan.
  - Alternatif tampilan *Mobile Card View*: setiap baris adegan diubah menjadi kartu vertikal yang dapat diperluas (*accordion collapse/expand*), menampilkan bukti thumbnail di atas dan catatan di bawah.

### 2.4 Kartu Statistik Metrik (Metric Cards)
* **Desktop (1280px+):** 4 kolom sejajar (`grid grid-cols-4 gap-6`).
* **Tablet (768px):** 2 baris 2 kolom (`grid grid-cols-2 gap-4`).
* **Mobile (375px):** 1 kolom vertikal bertumpuk (`grid grid-cols-1 gap-3`), atau format korsel horizontal (*snap scroll*).

---

## 3. Aturan Ukuran Target Interaksi Sentuh (Touch Ergonomics)

Pada perangkat sentuh (tablet verifikator di ruang sidang sensor atau ponsel staf):
* Seluruh tombol interaktif, ikon aksi, dan baris dropdown memiliki area sentuh minimum **44 x 44 piksel**.
* Jarak antar tombol aksi minimal **8 piksel** untuk mencegah salah tekan (*accidental click*) pada aksi krusial seperti penolakan sensor (*reject button*).
* Input teks pada form unggah memiliki tinggi minimal `48px` untuk kenyamanan pengetikan virtual keyboard.

---

## 4. Tipografi Skala Adaptif (Fluid Typography)

Teks judul dan angka metrik menyesuaikan ukuran secara proporsional sesuai lebar viewport tanpa menyebabkan teks terpotong (*text overflow*):

```css
/* Judul H1 Dashboard */
.dash-title {
  font-size: clamp(1.5rem, 2.5vw + 0.5rem, 2.25rem); /* 24px pada mobile s/d 36px pada desktop */
  line-height: 1.2;
}

/* Angka Metrik Utama */
.stat-num {
  font-size: clamp(1.75rem, 2vw + 1rem, 2.5rem); /* 28px s/d 40px */
}
```
