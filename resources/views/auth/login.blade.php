<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — CMS Klasifikasi Video LSF RI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F7FA] min-h-screen flex items-center justify-center p-4 font-sans antialiased">

    <!-- Card Wrapper Kontainer Login Split-Screen -->
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden border border-[#C1CDD4]/60 grid grid-cols-1 md:grid-cols-12 min-h-[580px]">
        
        <!-- Panel Kiri: Form Login dengan Latar Gradien Wave Biru LSF -->
        <div class="md:col-span-5 bg-gradient-to-br from-[#003F85] via-[#00336D] to-[#002754] p-8 lg:p-10 flex flex-col justify-between text-white relative overflow-hidden">
            <!-- Fluid Wave SVG Background Decor -->
            <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full bg-[#26B1EB]/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-56 h-56 rounded-full bg-[#009CDD]/20 blur-3xl pointer-events-none"></div>

            <!-- Top Header Login -->
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md p-2 flex items-center justify-center border border-white/20 mb-6">
                    <img src="/images/logo-lsf.png" alt="Logo LSF" class="max-h-full max-w-full object-contain filter brightness-110">
                </div>
                <h2 class="text-2xl font-bold tracking-tight mb-1">
                    Selamat Datang!
                </h2>
                <p class="text-xs text-slate-300">
                    Sistem Otomasi Klasifikasi &amp; Sensor Video LSF RI
                </p>
            </div>

            <!-- Formulir Input -->
            <form action="{{ route('login.post') }}" method="POST" class="relative z-10 my-6 space-y-4">
                @csrf

                @if(isset($errors) && $errors->any())
                <div class="p-3 rounded-xl bg-red-500/20 border border-red-500/40 text-red-200 text-xs">
                    {{ $errors->first() }}
                </div>
                @endif

                <div>
                    <label class="block text-xs font-medium text-slate-200 mb-1.5">Email / NIP Verifikator</label>
                    <div class="relative flex items-center">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5"></i>
                        <input type="email" name="email" value="{{ old('email', 'verifikator@lsf.go.id') }}" required
                               placeholder="nama@lsf.go.id"
                               class="w-full pl-10 pr-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#26B1EB] focus:border-transparent transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-200 mb-1.5">Kata Sandi</label>
                    <div class="relative flex items-center">
                        <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5"></i>
                        <input type="password" name="password" value="password123" required
                               placeholder="••••••••"
                               class="w-full pl-10 pr-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#26B1EB] focus:border-transparent transition-all">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-300">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/10 text-[#26B1EB] focus:ring-0">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="text-[#26B1EB] hover:underline">Lupa sandi?</a>
                </div>

                <!-- Tombol Sign In Merah sesuai Mockup (#C8282E) -->
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-[#C8282E] hover:bg-[#A61F24] text-white font-bold text-sm shadow-lg shadow-red-900/30 transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Masuk ke Sistem</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>

            <!-- Bottom Disclaimer -->
            <div class="relative z-10 text-[11px] text-slate-400">
                Akses terbatas hanya untuk Anggota Subkomisi Penilaian &amp; Tim IT LSF RI.
            </div>
        </div>

        <!-- Panel Kanan: Branding Lembaga & Artwork Isometrik -->
        <div class="md:col-span-7 p-8 lg:p-12 flex flex-col justify-between bg-gradient-to-br from-slate-50 via-white to-blue-50/40 relative">
            <!-- Dot Matrix Accent (Pola Titik Kanan Atas) -->
            <div class="absolute top-6 right-6 opacity-30">
                <div class="grid grid-cols-6 gap-2">
                    @for($i = 0; $i < 24; $i++)
                        <span class="w-1.5 h-1.5 rounded-full bg-[#003F85]"></span>
                    @endfor
                </div>
            </div>

            <!-- Top Header Kanan -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#1899A3]"></span>
                    <span class="w-3 h-3 rounded-full bg-[#DC7634]"></span>
                    <span class="w-3 h-3 rounded-full bg-[#C8282E]"></span>
                    <span class="w-3 h-3 rounded-full bg-[#4B2979]"></span>
                </div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                    LSF-AI-VISION-V1.0
                </span>
            </div>

            <!-- Artwork Isometrik Modern Dashboard -->
            <div class="my-8 flex flex-col items-center justify-center text-center">
                <div class="relative w-64 h-52 mb-6">
                    <!-- Ilustrasi Laptop Isometrik Mockup SVG -->
                    <div class="w-full h-full rounded-2xl bg-gradient-to-tr from-[#003F85] to-[#26B1EB] p-2 shadow-2xl shadow-blue-900/20 flex flex-col justify-between">
                        <div class="bg-white rounded-xl p-3 h-full flex flex-col justify-between">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                <div class="flex gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                </div>
                                <span class="text-[9px] font-bold text-[#003F85]">LSF Data Dashboard</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 my-2">
                                <div class="bg-blue-50 p-1.5 rounded text-center">
                                    <span class="text-[8px] text-slate-500 block">Efisiensi</span>
                                    <span class="text-xs font-bold text-[#003F85]">91.7%</span>
                                </div>
                                <div class="bg-amber-50 p-1.5 rounded text-center">
                                    <span class="text-[8px] text-slate-500 block">Verifikasi</span>
                                    <span class="text-xs font-bold text-[#DC7634]">13+</span>
                                </div>
                                <div class="bg-emerald-50 p-1.5 rounded text-center">
                                    <span class="text-[8px] text-slate-500 block">Rate Valid</span>
                                    <span class="text-xs font-bold text-[#1899A3]">94.4%</span>
                                </div>
                            </div>
                            <div class="h-10 bg-slate-100 rounded-lg p-1.5 flex items-center justify-between">
                                <span class="text-[9px] text-slate-600 font-medium">Auto-classify: complete</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="text-xl font-extrabold text-[#003F85] tracking-tight">
                    CMS KLASIFIKASI VIDEO
                </h3>
                <p class="text-xs text-slate-500 max-w-sm mt-1 leading-relaxed">
                    Akselerasi telaah sensor mandiri berbasis multimodal artificial intelligence sesuai Undang-Undang Nomor 33 Tahun 2009 tentang Perfilman.
                </p>
            </div>

            <!-- Footer Credentials Test Info -->
            <div class="bg-slate-50 rounded-2xl p-3 border border-slate-200 text-left flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-bold text-[#2C2C33] block">Akun Uji Coba:</span>
                    <span class="text-[11px] text-slate-500">Email: <b class="text-[#003F85]">verifikator@lsf.go.id</b> | Sandi: <b class="text-[#003F85]">password123</b></span>
                </div>
                <a href="{{ route('dashboard.home') }}" class="px-3 py-1.5 bg-[#003F85] text-white text-xs font-semibold rounded-lg hover:bg-[#00336D]">
                    Langsung Masuk &rarr;
                </a>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
