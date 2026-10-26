# Component Library Specification
## CMS Klasifikasi Video LSF RI

Dokumen ini mendokumentasikan katalog komponen antarmuka (*UI Component Inventory*) yang digunakan dalam pengembangan CMS Klasifikasi Video LSF RI berbasis **Next.js (App Router)** dan **Tailwind CSS**. Setiap komponen dirancang agar modular, mudah digunakan kembali (*reusable*), memiliki aksesibilitas tinggi, serta terikat langsung dengan token desain resmi.

---

## 1. Komponen Tombol (Buttons)

Komponen tombol mendukung berbagai varian hierarki aksi, status interaktif (*default*, *hover*, *active*, *disabled*, *loading*), serta integrasi ikon SVG.

### 1.1 Varian Tombol

| Varian | Peruntukan Utama | Latar Belakang & Teks | Status Hover / Focus |
| :--- | :--- | :--- | :--- |
| **Primary** | Aksi utama halaman (*Unggah Video*, *Verifikasi*, *Simpan*) | `bg-[#003F85] text-white` | `hover:bg-[#00336D] focus:ring-2 focus:ring-[#26B1EB]` |
| **Secondary / Light** | Aksi pendukung (*Refresh Log*, *Batal*, *Lihat Detail*) | `bg-[#F0F4F8] text-[#003F85] border border-[#C1CDD4]` | `hover:bg-[#E2E8F0] hover:border-[#003F85]` |
| **Accent / Sky** | Tombol interaktif dinamis (*Download Master JSON*, *Buka Hasil*) | `bg-[#26B1EB] text-white font-semibold` | `hover:bg-[#009CDD] hover:shadow-md` |
| **Danger / Alert** | Aksi berisiko tinggi (*Tolak Sensor*, *Hapus Antrean*) | `bg-[#C8282E] text-white` | `hover:bg-[#A61F24] focus:ring-2 focus:ring-red-400` |
| **Ghost / Outline** | Aksi tanpa dominasi visual (*Export Batch CSV*, *Tutup*) | `bg-transparent text-[#2C2C33] border border-[#C1CDD4]` | `hover:bg-slate-100 hover:text-[#003F85]` |
| **Icon Button** | Aksi baris tabel (*Unduh JSON*, *Preview Frame*, *Menu Opsi*) | `p-2 rounded-lg text-slate-600 hover:bg-slate-100` | `hover:text-[#003F85]` |

### 1.2 Contoh Kode Implementasi (React + Tailwind)
```tsx
import React from 'react';
import { Loader2 } from 'lucide-react';

interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: 'primary' | 'secondary' | 'accent' | 'danger' | 'ghost';
  size?: 'sm' | 'md' | 'lg';
  isLoading?: boolean;
  leftIcon?: React.ReactNode;
  rightIcon?: React.ReactNode;
}

export const Button: React.FC<ButtonProps> = ({
  children,
  variant = 'primary',
  size = 'md',
  isLoading = false,
  leftIcon,
  rightIcon,
  disabled,
  className = '',
  ...props
}) => {
  const baseStyles = 'inline-flex items-center justify-center font-medium transition-all duration-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
  
  const sizeStyles = {
    sm: 'px-3 py-1.5 text-xs gap-1.5',
    md: 'px-4 py-2 text-sm gap-2',
    lg: 'px-6 py-3 text-base gap-2.5',
  };

  const variantStyles = {
    primary: 'bg-[#003F85] text-white hover:bg-[#00336D] focus:ring-[#26B1EB] active:bg-[#002754] shadow-sm',
    secondary: 'bg-[#F0F4F8] text-[#003F85] border border-[#C1CDD4] hover:bg-[#E2E8F0] focus:ring-[#26B1EB]',
    accent: 'bg-[#26B1EB] text-white hover:bg-[#009CDD] focus:ring-[#003F85] shadow-sm',
    danger: 'bg-[#C8282E] text-white hover:bg-[#A61F24] focus:ring-[#E86461] shadow-sm',
    ghost: 'bg-transparent text-[#2C2C33] border border-[#C1CDD4] hover:bg-slate-100 hover:text-[#003F85]',
  };

  return (
    <button
      className={`${baseStyles} ${sizeStyles[size]} ${variantStyles[variant]} ${className}`}
      disabled={disabled || isLoading}
      {...props}
    >
      {isLoading ? <Loader2 className="w-4 h-4 animate-spin" /> : leftIcon}
      <span>{children}</span>
      {!isLoading && rightIcon}
    </button>
  );
};
```

---

## 2. Komponen Input & Formulir (Inputs & Forms)

### 2.1 Search Input
Input pencarian terintegrasi dengan ikon kaca pembesar dan tombol reset cepat.
* **Peruntukan:** Pencarian cepat ID Tiket LSF, nama video, atau hash SHA-256 di menu *Riwayat Analisis*.
* **Spesifikasi:**
  ```tsx
  <div className="relative flex items-center w-full max-w-md">
    <Search className="absolute left-3.5 w-4 h-4 text-slate-400 pointer-events-none" />
    <input
      type="text"
      placeholder="Cari ID Tiket (LSF-2026-X), Judul Film, atau SHA-256..."
      className="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-[#C1CDD4] rounded-lg text-[#2C2C33] placeholder-slate-400 focus:outline-none focus:border-[#003F85] focus:ring-2 focus:ring-[#26B1EB]/30 transition-all"
    />
  </div>
  ```

### 2.2 Chunked File Upload Zone
Zona interaktif untuk pengunggahan materi video berukuran besar.
* **Fitur Visual:** Area *dashed border* yang bereaksi terhadap drag-and-drop, ikon awan (*cloud upload*), tombol pemilihan berkas, dan teks hint *chunking*.
* **Spesifikasi:**
  ```tsx
  <div className="flex flex-col items-center justify-center p-8 border-2 border-dashed border-[#003F85]/40 hover:border-[#003F85] rounded-2xl bg-[#003F85]/5 hover:bg-[#003F85]/10 transition-all cursor-pointer text-center">
    <div className="w-14 h-14 mb-4 rounded-full bg-[#003F85]/10 flex items-center justify-center text-[#003F85]">
      <UploadCloud className="w-7 h-7" />
    </div>
    <Button variant="primary" size="md" className="mb-2">Unggah Video</Button>
    <p className="text-xs text-slate-500 max-w-xs">
      Mendukung MP4, MOV, MKV. File besar otomatis diunggah per chunk untuk menjamin keutuhan data.
    </p>
  </div>
  ```

---

## 3. Komponen Kartu Statistik & Metrik (Cards)

### 3.1 Operasional Metric Stat Card (Riwayat & Dashboard)
Kartu informasi metrik dengan baris progres warna dinamis di bagian bawah.
* **Elemen:** Label metrik, ikon jenis, angka besar (*28px*), chip tren bulanan (*+18% bulan ini*), dan progress bar indikator.
* **Implementasi:**
  ```tsx
  <div className="bg-white p-5 rounded-xl border border-[#C1CDD4] shadow-sm flex flex-col justify-between relative overflow-hidden">
    <div className="flex items-center justify-between text-xs font-medium text-slate-500 mb-2">
      <span>Total Video Dianalisis</span>
      <div className="p-2 rounded-lg bg-[#003F85]/10 text-[#003F85]">
        <Film className="w-4 h-4" />
      </div>
    </div>
    <div className="flex items-baseline justify-between mb-3">
      <span className="text-3xl font-bold text-[#2C2C33]">142</span>
      <span className="text-xs font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-[#003F85]">+18% bulan ini</span>
    </div>
    <div className="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
      <div className="bg-[#003F85] h-full rounded-full" style={{ width: '85%' }} />
    </div>
  </div>
  ```

---

## 4. Komponen Lencana, Tag, & Pill Rating (Badges & Chips)

### 4.1 Pill Rating Sensor LSF (Topbar & Laporan)
Lencana resmi pengelompokan usia penonton film Indonesia:

| Kategori | Kelas CSS Tailwind | Penampilan |
| :--- | :--- | :--- |
| **SU (Semua Umur)** | `bg-[#1899A3] text-white font-bold px-3 py-1 rounded-full text-xs` | **SU** Hijau-Teal Aman |
| **13+ (Remaja)** | `bg-[#DC7634] text-white font-bold px-3 py-1 rounded-full text-xs` | **13+** Oranye Peringatan |
| **17+ (Dewasa 17)** | `bg-[#C8282E] text-white font-bold px-3 py-1 rounded-full text-xs` | **17+** Merah Bahaya |
| **21+ (Dewasa 21)** | `bg-[#4B2979] text-white font-bold px-3 py-1 rounded-full text-xs` | **21+** Violet Terbatas |

### 4.2 Tag Kategori Adegan (Scene Tags)
Digunakan pada baris tabel laporan adegan:
* `Tag Dialog`: `bg-sky-50 text-[#003F85] border border-sky-200 px-2.5 py-0.5 rounded text-xs font-medium`
* `Tag Kekerasan`: `bg-red-50 text-[#C8282E] border border-red-200 px-2.5 py-0.5 rounded text-xs font-medium`
* `Tag Sensualitas`: `bg-purple-50 text-[#701C85] border border-purple-200 px-2.5 py-0.5 rounded text-xs font-medium`
* `Tag Horor`: `bg-amber-50 text-[#DC7634] border border-amber-200 px-2.5 py-0.5 rounded text-xs font-medium`

---

## 5. Komponen Tabel Data (Data Tables)

Tabel dirancang untuk menyajikan data kompleks secara teratur dengan dukungan *sticky header*, sel thumbnail yang dapat diklik, dan *chip* status.

### 5.1 Struktur Tabel Laporan Adegan
```html
<div class="overflow-x-auto rounded-xl border border-[#C1CDD4] bg-white shadow-sm">
  <table class="w-full text-left text-sm border-collapse">
    <thead class="bg-slate-50 border-b border-[#C1CDD4] text-xs font-semibold text-slate-600 uppercase tracking-wider">
      <tr>
        <th class="px-4 py-3">Waktu</th>
        <th class="px-4 py-3">Adegan</th>
        <th class="px-4 py-3">Tag</th>
        <th class="px-4 py-3">Tingkat</th>
        <th class="px-4 py-3">Bukti Frame</th>
        <th class="px-4 py-3">Catatan Peninjauan</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-[#C1CDD4] text-[#2C2C33]">
      <tr class="hover:bg-slate-50/70 transition-colors">
        <td class="px-4 py-3 font-mono font-semibold text-[#003F85]">00:10</td>
        <td class="px-4 py-3 max-w-xs text-xs leading-relaxed">
          Sebuah layar digital menampilkan foto grup sekelompok remaja perempuan berpose di dalam ruangan.
        </td>
        <td class="px-4 py-3"><span class="tag-dialog">Dialog</span></td>
        <td class="px-4 py-3"><span class="badge-low">Rendah</span></td>
        <td class="px-4 py-3">
          <button class="text-xs text-[#003F85] hover:underline flex items-center gap-1 font-medium">
            <Eye class="w-3.5 h-3.5" /> 3 Frame
          </button>
        </td>
        <td class="px-4 py-3 text-xs text-slate-500">
          Konten visual foto grup remaja. Tidak terlihat konten berbahaya.
        </td>
      </tr>
    </tbody>
  </table>
</div>
```

---

## 6. Komponen Modal Dialog & Drawer (Modals & Overlays)

### 6.1 Modal Bukti Frame (Evidence Zoom Modal)
* **Tujuan:** Menampilkan tangkapan layar resolusi tinggi saat verifikator mengklik bukti adegan.
* **Fitur:** Pratinjau gambar tajam, stempel waktu presisi, tag deteksi, tombol putar 5 detik di sekitar *timecode*, dan tombol navigasi antar-frame bukti.

### 6.2 Modal Progres Unggah & Analisis (Job Progress Modal)
* **Tujuan:** Memberikan umpan balik saat proses pengunggahan *chunk* dan komputasi inferensi berlangsung.
* **Fitur:** Progress bar melingkar atau horizontal dengan tahapan:
  1. *Pengunggahan Chunk Video (xx%)*
  2. *Validasi Integritas SHA-256*
  3. *Ekstraksi Frame & Inferensi Adegan (Qwen-VL)*
  4. *Penyusunan Draf Laporan*

---

## 7. Komponen Notifikasi Toast & Alert (Feedback Banners)

Digunakan untuk memberikan konfirmasi aksi secara instan kepada pengguna:
* **Success Toast:** *"Keputusan sensor berhasil diverifikasi dan disimpan ke arsip."* (Ikon Checkmark, Border `#1899A3`)
* **Warning Toast:** *"Adegan pada 01:24:10 terdeteksi kategori 17+. Harap periksa bukti frame sebelum validasi."* (Ikon Peringatan, Border `#DC7634`)
* **Error Toast:** *"Gagal mengunggah partisi video nomor 12. Menghubungkan ulang..."* (Ikon Silang Merah, Border `#C8282E`)
