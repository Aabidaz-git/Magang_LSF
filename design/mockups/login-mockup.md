# Hi-Fi Mockup Specification: Login Screen
## CMS Klasifikasi Video LSF RI

Dokumen ini merinci spesifikasi *High-Fidelity Mockup* untuk halaman **Login & Autentikasi**, diadaptasi langsung dari layar referensi (*INSIDE PROJECT - LOGIN SCREEN*).

---

## 1. Komposisi Tata Letak Split-Screen

```
┌────────────────────────────────────────────────────────┬────────────────────────────────────────────────────────┐
│ PANEL KIRI (GELOMBANG BIRU & FORM LOGIN)               │ PANEL KANAN (BRANDING & ISOMETRIC ARTWORK)             │
│                                                        │                                                        │
│   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~                 │                     [ LOGO LSF ] LEMBAGA SENSOR FILM   │
│   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~             │                                                        │
│                                                        │                                                        │
│   Selamat Datang di CMS LSF!                           │                         _.-""""-._                     │
│   Sistem Otomasi Klasifikasi & Sensor Video            │                       .'          `.                   │
│                                                        │                      /   [LAPTOP]   \                  │
│   [ Input: NIP / Email Verifikator LSF             ]   │                     |  DASHBOARD CMS |                 │
│                                                        │                     |   ANALYTICS    |                 │
│   [ Lock Ico | Input Password                      ]   │                      \  ISOMETRIC   /                  │
│                                                        │                       `._        _.'                   │
│   [ MASUK (Tombol Merah #C8282E) ]   Lupa kata sandi?  │                          `------'                      │
│                                                        │                                                        │
│                                                        │                  CMS KLASIFIKASI VIDEO                 │
│                                                        │            LEMBAGA SENSOR FILM REPUBLIK INDONESIA      │
│                                                        │                                                        │
│   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~             │                                                        │
│   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~                 │   [· · · Grid Dots Aksen Kanan Atas & Kiri Bawah · · ·]│
└────────────────────────────────────────────────────────┴────────────────────────────────────────────────────────┘
```

---

## 2. Rincian Spesifikasi Desain

### 2.1 Panel Kiri: Form Interaktif Gelombang Biru (Curved Wave)
* **Latar Belakang:** Gradien dinamis *fluid wave* yang memadukan Deep Navy `#003F85`, Vivid Cerulean `#009CDD`, dan Sky Blue `#26B1EB`.
* **Tipografi:** Teks judul warna putih tebal (`font-bold text-white text-2xl`).
* **Input Field:**
  - Latar semi-transparan putih dengan efek *glassmorphism* (`bg-white/10 backdrop-blur-md border border-white/20`).
  - Teks putih dan placeholder abu-abu terang.
  - Ikon kunci gembok (*lock icon*) di dalam kotak password.
* **Tombol Masuk (*Sign In Button*):**
  - Menggunakan warna merah tegas `#C8282E` sesuai referensi tombol pada mockup.
  - Efek hover: `hover:bg-[#A61F24]` dengan bayangan lembut merah `shadow-lg shadow-red-900/30`.

### 2.2 Panel Kanan: Branding & Artwork Isometrik
* **Latar Belakang:** Putih bersih (`#FFFFFF`) dengan pola titik-titik aksen (*dot matrix pattern*) di sudut kanan atas dan kiri bawah.
* **Logo Instansi:** Menampilkan logo resmi LSF RI dan teks instansi di sudut kanan atas.
* **Artwork Isometrik 3D:** Ilustrasi laptop modern yang menampilkan visual antarmuka dasbor klasifikasi video, kartu identitas pegawai sensor, dan perangkat tablet.
* **Tipografi Judul Produk:** Teks tebal berwarna Deep Navy `#003F85` bertuliskan **CMS KLASIFIKASI VIDEO** dengan sub-teks resmi LSF RI.
