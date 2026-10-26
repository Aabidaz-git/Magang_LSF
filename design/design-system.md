# Design System Specification
## CMS Klasifikasi Video LSF RI

Dokumen ini merupakan panduan desain resmi (*Single Source of Truth*) untuk antarmuka CMS Klasifikasi Video Lembaga Sensor Film (LSF) Republik Indonesia. Panduan ini mencakup palet warna yang telah disetujui, tipografi, sistem spasi (*spacing*), spesifikasi komponen, tema *Light & Dark Mode*, serta standar aksesibilitas WCAG 2.1 AA.

---

## 1. Palet Pewarnaan Resmi (Official Color Palette)

Palet warna ini diekstraksi langsung dari pedoman *brand color reference* proyek, dirancang untuk mencerminkan identitas institusional LSF yang berwibawa, modern, terpercaya, dan memiliki hierarki visual yang jelas untuk peninjauan sensor video.

```
┌──────────────────────────────────────────────────────────────────────────────────────────────────┐
│                                       PRIMARY PALETTE                                            │
├───────────────┬───────────────┬─────────────────┬────────────────┬───────────────────────────────┤
│  Text Dark    │ Navy Primary  │ Sky Blue Accent │ Cerulean Blue  │ Light Border Stroke           │
│   #2C2C33     │   #003F85     │    #26B1EB      │    #009CDD     │    #C1CDD4                    │
│ RGB 44,44,51  │ RGB 0,63,133  │ RGB 38,177,235  │ RGB 0,156,221  │ RGB 193,205,212               │
└───────────────┴───────────────┴─────────────────┴────────────────┴───────────────────────────────┘

┌──────────────────────────────────────────────────────────────────────────────────────────────────┐
│                                 SECONDARY & CATEGORY PALETTE                                     │
├───────────────────────────────┬──────────────────────────────────┬───────────────────────────────┤
│         Royal Purple          │          Magenta Violet          │          Deep Indigo          │
│            #5744C1            │              #701C85             │            #4B2979            │
│         RGB 87,68,193         │          RGB 112,28,133          │         RGB 75,41,121         │
└───────────────────────────────┴──────────────────────────────────┴───────────────────────────────┘

┌──────────────────────────────────────────────────────────────────────────────────────────────────┐
│                               SEMANTIC & LSF RATING CLASSIFICATION                               │
├───────────────┬───────────────┬─────────────────┬────────────────┬───────────────────────────────┤
│  Alert/Danger │    Success    │   Ocean Blue    │   Soft Coral   │        Warning/Caution        │
│   (Rating 17+)│  (Rating SU)  │   (Information) │  (Medium Risk) │          (Rating 13+)         │
│   #C8282E     │   #1899A3     │    #1F6BB3      │    #E86461     │            #DC7634            │
│ RGB 200,40,46 │ RGB 24,153,163│  RGB 31,107,179 │ RGB 232,100,97 │         RGB 220,118,52        │
└───────────────┴───────────────┴─────────────────┴────────────────┴───────────────────────────────┘
```

### 1.1 Tabel Spesifikasi Warna Primer (Primary Colors)

| Token Warna | HEX | RGB | CMYK | Peruntukan & Panduan Penggunaan |
| :--- | :--- | :--- | :--- | :--- |
| `primary-navy` | `#003F85` | `0, 63, 133` | `100, 84, 19, 5` | **Background Navigasi Utama:** Sidebar aktif, header bar LSF, tombol aksi utama (*active states*), link penting. |
| `primary-sky` | `#26B1EB` | `38, 177, 235` | `67, 12, 0, 0` | **Interaksi & Hover:** Efek *hover button*, indikator fokus (*focus ring*), progress bar pengunggahan *chunk*, aksen visual aktif. |
| `primary-cerulean` | `#009CDD` | `0, 156, 221` | `74, 24, 0, 0` | **Grafis & Kartu Statistik:** Warna latar kartu metrik kedua, aksen chart agregat, border tab aktif. |
| `neutral-charcoal` | `#2C2C33` | `44, 44, 51` | `74, 68, 57, 60` | **Tipografi Utama:** Warna teks judul (h1–h6), teks paragraf, ikon netral gelap, status rating 21+. |
| `neutral-border` | `#C1CDD4` | `193, 205, 212` | `23, 12, 11, 0` | **Garis Pemisah & Pembatas:** Garis horizontal (*HR lines*), pembatas sel tabel, border kartu, input border default. |

### 1.2 Warna Sekunder & Aksen Kategori (Secondary & Categorical)

| Token Warna | HEX | RGB | Peruntukan & Panduan Penggunaan |
| :--- | :--- | :--- | :--- |
| `secondary-purple` | `#5744C1` | `87, 68, 193` | Badge analisis lanjutan, segmen chart genre "Drama/Misteri", elemen metrik pendukung. |
| `secondary-magenta`| `#701C85` | `112, 28, 133`| Sorotan filter khusus, indikator verifikator level Subkomisi, aksen chart genre "Action". |
| `secondary-indigo` | `#4B2979` | `75, 41, 121` | **Rating 21+ (Dewasa 21 Tahun)**, badge konten bertanda khusus (*Flagged anomaly*). |

### 1.3 Warna Semantik & Rating Sensor Resmi LSF

| Kategori Sensor / Status | HEX | Token Nama | Arti & Implementasi dalam CMS |
| :--- | :--- | :--- | :--- |
| **SU (Semua Umur)** / Success | `#1899A3` | `lsf-su` / `semantic-success` | Materi aman untuk semua penonton. Status: *Valid / Selesai (Terverifikasi)*, badge hijau kebiruan/teal. |
| **13+ (Remaja 13 Tahun)** / Warning | `#DC7634` | `lsf-13` / `semantic-warning` | Bimbingan orang tua diperlukan. Adegan risiko sedang, status: *Menunggu Konfirmasi*, badge amber/oranye. |
| **17+ (Dewasa 17 Tahun)** / Danger | `#C8282E` | `lsf-17` / `semantic-danger` | Mengandung unsur ketegangan/konflik matang. Adegan *High Risk*, peringatan kritis, tombol *delete/reject*. |
| **21+ (Dewasa 21 Tahun)** / Flagged | `#4B2979` | `lsf-21` / `semantic-flagged` | Materi dewasa ketat. Menandai anomali adegan yang butuh sidang pleno subkomisi sensor. |
| **Information / In-Progress** | `#1F6BB3` | `semantic-info` | Status *Sedang Diproses (Inference)*, node GPU aktif, tooltip penjelasan sistem. |
| **Medium Risk / Coral Alert** | `#E86461` | `semantic-coral` | Adegan batas ambang risiko sedang (*Medium Risk Scene*) pada tabel telaah. |

---

## 2. Sistem Tipografi (Typography System)

Tipografi CMS Klasifikasi Video LSF menggunakan font **Plus Jakarta Sans** (atau *Inter* sebagai fallback sistem) untuk memastikan keterbacaan tinggi (*legibility*) pada angka stempel waktu (*timecode*), tabel analisis adegan, dan teks deskripsi visual.

### 2.1 Font Family & Fallback
```css
font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11', 'tnum'; /* Tabular numbers untuk timecode */
```

### 2.2 Skala Hirarki Tipografi (Type Scale)

| Level | Ukuran (px/rem) | Line Height | Weight | Tracking | Penggunaan Utama |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Display / H1** | `32px` (`2.0rem`) | `40px` (`1.25`) | Bold (`700`) | `-0.02em` | Judul Dashboard LSF, Judul Besar Riwayat Analisis. |
| **Heading 2** | `24px` (`1.5rem`) | `32px` (`1.33`) | SemiBold (`600`) | `-0.015em` | Judul Bagian Card (Laporan Adegan, Ringkasan Laporan). |
| **Heading 3** | `18px` (`1.125rem`)| `26px` (`1.44`) | SemiBold (`600`) | `-0.01em` | Judul sub-panel, judul metrik kartu statistik. |
| **Heading 4** | `16px` (`1.0rem`) | `24px` (`1.50`) | Medium (`500`) | `0em` | Label kolom tabel penting, header modal dialog. |
| **Body Large** | `16px` (`1.0rem`) | `24px` (`1.50`) | Regular (`400`) | `0em` | Paragraf pengantar, deskripsi telaah panjang. |
| **Body Base** | `14px` (`0.875rem`)| `20px` (`1.43`) | Regular (`400`) / Medium (`500`) | `0em` | Isi sel tabel adegan, catatan peninjauan, input teks. |
| **Body Small** | `12px` (`0.75rem`) | `16px` (`1.33`) | Medium (`500`) | `+0.01em` | Badge tag adegan (*Dialog*, *Kekerasan*), teks helper input. |
| **Caption / Stat Num** | `28px` (`1.75rem`) | `36px` (`1.28`) | Bold (`700`) | `+0.02em` | Angka metrik statistik utama (contoh: `142`, `94.4%`). |
| **Mono / Timecode** | `13px` (`0.8125rem`)| `18px` (`1.38`) | SemiBold (`600`) | `+0.05em` | Stempel waktu `00:10:45`, SHA-256 Hash ringkas. |

---

## 3. Sistem Spasi & Grid (Spacing & Layout Grid)

Sistem spasi mengadopsi prinsip **8pt Baseline Grid** (dengan increment micro 4px) untuk menjaga konsistensi vertikal dan horizontal di seluruh antarmuka.

### 3.1 Skala Spasi (Spacing Scale)

```
Token Spasi     Nilai (px)   Nilai (rem)   Contoh Penggunaan
──────────────────────────────────────────────────────────────────
space-1         4px          0.25rem       Micro gap badge, inline icon padding
space-2         8px          0.5rem        Jarak antar-tag chips, padding sel compact
space-3         12px         0.75rem       Padding input field, icon button spacing
space-4         16px         1.0rem        Padding dasar kartu (card internal padding)
space-5         20px         1.25rem       Jarak antar elemen form, header dialog
space-6         24px         1.5rem        Gap antar kartu metrik di dashboard
space-8         32px         2.0rem        Margin antar seksi utama konten
space-10        40px         2.5rem        Padding container halaman utama
space-12        48px         3.0rem        Section divider margin
```

### 3.2 Sistem Grid & Layout Container
- **Lebar Maksimal Kontainer:** `1440px` (terpusat dengan margin otomatis).
- **Sidebar Width:** `260px` (desktop expanded) / `80px` (collapsed icon-only) / `0px` (mobile drawer).
- **Topbar Height:** `72px` (tetap di bagian atas, sticky).
- **Grid Dashboard:** CSS Grid 12 kolom (`grid-cols-12`) dengan `gap-6` (24px).

---

## 4. Variabel CSS Tema (Theming: Light & Dark Mode)

CMS mendukung perpindahan tema tanpa *flickering* menggunakan variabel CSS berbasis semantik:

```css
:root {
  /* Surface & Backgrounds */
  --bg-app: #F5F7FA;
  --bg-surface: #FFFFFF;
  --bg-surface-subtle: #F0F4F8;
  --bg-sidebar: #003F85;
  --bg-sidebar-hover: #00336D;
  --bg-sidebar-active: #002754;

  /* Typography Colors */
  --text-primary: #2C2C33;
  --text-secondary: #5A626A;
  --text-muted: #8E9AA5;
  --text-inverse: #FFFFFF;
  --text-link: #003F85;

  /* Borders & Dividers */
  --border-light: #E2E8F0;
  --border-medium: #C1CDD4;
  --border-focus: #26B1EB;

  /* Action & Accent */
  --accent-primary: #003F85;
  --accent-hover: #26B1EB;
  --accent-vivid: #009CDD;

  /* Status Colors */
  --status-su: #1899A3;
  --status-13: #DC7634;
  --status-17: #C8282E;
  --status-21: #4B2979;
  --status-info: #1F6BB3;
  --status-coral: #E86461;

  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(0, 63, 133, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 63, 133, 0.08), 0 2px 4px -1px rgba(0, 63, 133, 0.04);
  --shadow-lg: 0 10px 15px -3px rgba(0, 63, 133, 0.12), 0 4px 6px -2px rgba(0, 63, 133, 0.05);
}

[data-theme='dark'] {
  /* Surface & Backgrounds */
  --bg-app: #0F172A;
  --bg-surface: #1E293B;
  --bg-surface-subtle: #334155;
  --bg-sidebar: #0A192F;
  --bg-sidebar-hover: #132A4A;
  --bg-sidebar-active: #1D3D68;

  /* Typography Colors */
  --text-primary: #F8FAFC;
  --text-secondary: #94A3B8;
  --text-muted: #64748B;
  --text-inverse: #0F172A;
  --text-link: #38BDF8;

  /* Borders & Dividers */
  --border-light: #334155;
  --border-medium: #475569;
  --border-focus: #38BDF8;

  /* Action & Accent */
  --accent-primary: #26B1EB;
  --accent-hover: #38BDF8;
  --accent-vivid: #009CDD;

  /* Status Colors (Adjusted for dark background luminosity) */
  --status-su: #2DD4BF;
  --status-13: #FB923C;
  --status-17: #F87171;
  --status-21: #C084FC;
  --status-info: #60A5FA;
  --status-coral: #FB7185;

  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
}
```

---

## 5. Standar Aksesibilitas (WCAG 2.1 AA Compliance)

Untuk memastikan CMS dapat digunakan secara optimal oleh seluruh anggota subkomisi sensor tanpa hambatan fisik maupun visual, sistem menerapkan standar kepatuhan berikut:

1. **Rasio Kontras Warna Minimum:**
   - **Teks Reguler (di bawah 18px):** Minimal rasio kontras `4.5:1` terhadap latar belakang.
     - Contoh: Teks Charcoal `#2C2C33` di atas latar putih `#FFFFFF` menghasilkan rasio kontras `12.6:1` (Lulus AAA).
     - Tombol Navy `#003F85` dengan teks putih `#FFFFFF` menghasilkan rasio kontras `8.9:1` (Lulus AAA).
   - **Teks Besar (18px+ atau tebal 14px+):** Minimal rasio kontras `3.0:1`.
   - **Elemen Antarmuka Grafis & Border:** Minimal rasio kontras `3.0:1` terhadap elemen di sekitarnya.
2. **Indikator Status Tidak Boleh Hanya Warna (Non-Color Dependent Indicators):**
   - Setiap lencana status tidak hanya memakai warna, tetapi menyertakan teks dan ikon unik (misal: Ikon centang untuk Terverifikasi, ikon tanda seru untuk *High Risk*, ikon jam pasir untuk *Processing*).
3. **Status Fokus yang Jelas (Visible Focus States):**
   - Seluruh elemen interaktif (tombol, link, input, baris tabel interaktif) wajib memiliki ring fokus yang terlihat jelas saat navigasi menggunakan tombol `Tab`:
     ```css
     :focus-visible {
       outline: 2px solid var(--accent-hover);
       outline-offset: 2px;
       border-radius: 4px;
     }
     ```
4. **Target Sentuh & Klik Minimum (Touch Targets):**
   - Ukuran minimum area klik/sentuh tombol dan kontrol adalah `44 x 44 px` pada tablet/mobile dan `36 x 36 px` pada desktop.
5. **Aksesibilitas Pembaca Layar (Screen Readers & ARIA):**
   - Seluruh gambar (termasuk *thumbnail bukti frame*) wajib memiliki atribut `alt` deskriptif (contoh: `alt="Bukti frame timecode 00:10 adegan dialog remaja"`).
   - Modal dialog dilengkapi dengan `role="dialog"`, `aria-modal="true"`, dan `aria-labelledby`.
