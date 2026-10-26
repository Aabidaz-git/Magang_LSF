<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — CMS Klasifikasi Video LSF RI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .float-animation {
            animation: gentleFloat 4s ease-in-out infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.04); }
        }
        .pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }
        /* Loading Screen Overlay animation */
        @keyframes cheerBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-12px) scale(1.03); }
        }
        .cheer-animation {
            animation: cheerBounce 1.8s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-[#F0F4F8] to-blue-100/60 min-h-screen flex items-center justify-center p-4 lg:p-8 font-sans antialiased text-[#2C2C33]">

    <!-- Main Container Card Split-Screen dengan S-Curve Divider -->
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-[#C1CDD4]/60 grid grid-cols-1 md:grid-cols-12 min-h-[640px] relative">
        
        <!-- ======================================================== -->
        <!-- PANEL KIRI: Gambar Bioskop/Studio Tembus Warna & Branding -->
        <!-- ======================================================== -->
        <div class="md:col-span-5 relative overflow-hidden flex flex-col justify-between p-8 lg:p-10 text-white min-h-[260px] md:min-h-auto">
            
            <!-- Foto Studio/Bioskop Asli sebagai Background -->
            <img src="/images/cinema_studio_bg.jpg" 
                 alt="Studio Sensor & Bioskop LSF" 
                 class="absolute inset-0 w-full h-full object-cover object-center transform scale-105 transition-transform duration-1000 hover:scale-100">

            <!-- Lapisan Warna Tembus Pandang (Tint Overlay) Sesuai Palet Resmi LSF -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#003F85]/90 via-[#00336D]/85 to-[#002754]/95 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-[#009CDD]/20 mix-blend-color-dodge pointer-events-none"></div>

            <!-- Konten Atas Panel Kiri -->
            <div class="relative z-10 space-y-4">
                <!-- Badge Logo LSF RI -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-md p-2 flex items-center justify-center border border-white/20 shadow-md">
                        <img src="/images/logo-lsf.png" alt="Logo LSF" class="max-h-full max-w-full object-contain filter brightness-110">
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-[#26B1EB] block">
                            LEMBAGA SENSOR FILM
                        </span>
                        <span class="text-xs font-semibold text-white/90">
                            Republik Indonesia
                        </span>
                    </div>
                </div>

                <!-- 4 Rating Pills Resmi LSF -->
                <div class="inline-flex items-center gap-1.5 p-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-[#1899A3] text-white shadow-xs">SU</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-[#DC7634] text-white shadow-xs">13+</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-[#C8282E] text-white shadow-xs">17+</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-[#4B2979] text-white shadow-xs">21+</span>
                </div>
            </div>

            <!-- Konten Tengah & Bawah Panel Kiri -->
            <div class="relative z-10 my-auto py-8 pr-8 md:pr-14">
                <span class="text-xs font-bold text-[#26B1EB] uppercase tracking-wider block mb-1.5">
                    PORTAL SENSOR MANDIRI
                </span>
                <h2 class="text-xl lg:text-2xl font-black tracking-tight text-white leading-snug max-w-[220px]">
                    Budaya Sensor<br>Mandiri.
                </h2>
                <p class="text-xs text-slate-200 mt-2.5 leading-relaxed max-w-[210px] font-medium">
                    Memilah Memilih tontonan sesuai klasifikasi usia
                </p>
            </div>

            <!-- Footer Panel Kiri -->
            <div class="relative z-10 pt-4 border-t border-white/15 flex items-center justify-between text-[10px] text-slate-300">
                <span>UU No. 33 Tahun 2009</span>
                <span class="font-mono text-[#26B1EB]">PP No. 18/2014</span>
            </div>

            <!-- ======================================================== -->
            <!-- S-CURVE FLUID DIVIDER (Lekukan Gelombang Mulus & Elegan) -->
            <!-- ======================================================== -->
            <div class="hidden md:block absolute top-0 -right-1 bottom-0 w-20 lg:w-28 pointer-events-none z-20">
                <svg class="h-full w-full text-white fill-current" viewBox="0 0 100 600" preserveAspectRatio="none">
                    <!-- Kurva S-Curve mulus dengan kontinuitas tangen C2 tanpa sudut tajam -->
                    <path d="M 100,0 
                             L 65,0 
                             C 20,120 5,230 25,320 
                             C 48,410 92,480 72,600 
                             L 100,600 
                             Z" />
                </svg>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- PANEL KANAN: Formulir Login dengan Maskot Mama Cula LSF   -->
        <!-- ======================================================== -->
        <div class="md:col-span-7 bg-white p-8 lg:p-12 flex flex-col justify-between relative z-10">
            
            <!-- Header Kanan: Status & Dots Akses -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#1899A3]"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#DC7634]"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C8282E]"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#4B2979]"></span>
                </div>
                <!-- Node Gateway: Online removed as requested -->
            </div>

            <!-- Bagian Maskot Mama Cula & Judul CMS -->
            <div class="text-center my-4">
                
                <!-- Gambar Maskot Mama Cula LSF RI (Jempol / Thumbs Up) -->
                <div class="relative inline-block mb-3">
                    <div class="absolute inset-0 bg-[#26B1EB]/20 rounded-full blur-xl pulse-glow"></div>
                    <img src="/images/mama-cula-thumbs-up.png" 
                         alt="Maskot LSF RI - Mama Cula" 
                         class="h-32 sm:h-36 object-contain mx-auto relative z-10 float-animation filter drop-shadow-lg">
                </div>

                <!-- Judul Utama & Subjudul -->
                <h1 class="text-2xl font-black text-[#003F85] tracking-tight">
                    CMS KLASIFIKASI VIDEO
                </h1>
                <p class="text-xs text-slate-500 mt-0.5 max-w-sm mx-auto">
                    Masuk untuk meninjau hasil klasifikasi adegan dan menetapkan tanda lulus sensor resmi.
                </p>
            </div>

            <!-- Form Autentikasi -->
            <form id="loginForm" action="{{ route('login.post') }}" method="POST" class="space-y-3.5 max-w-md mx-auto w-full">
                @csrf

                @if(isset($errors) && $errors->any())
                <div class="p-3 rounded-xl bg-red-50 border border-red-200 text-[#C8282E] text-xs flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <!-- Input Email / NIP -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">
                        Email / NIP Anggota Penilai
                    </label>
                    <div class="relative flex items-center">
                        <i data-lucide="user" class="w-4 h-4 text-slate-400 absolute left-3.5 pointer-events-none"></i>
                        <input type="email" id="emailInput" name="email" value="{{ old('email', 'verifikator@lsf.go.id') }}" required
                               placeholder="nama@lsf.go.id atau NIP"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] placeholder-slate-400 focus:outline-none focus:border-[#003F85] focus:ring-2 focus:ring-[#26B1EB]/30 transition-all">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold text-slate-700">Kata Sandi</label>
                        <a href="#" class="text-[11px] text-[#003F85] hover:text-[#26B1EB] font-medium">Lupa sandi?</a>
                    </div>
                    <div class="relative flex items-center">
                        <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5 pointer-events-none"></i>
                        <input type="password" id="passwordInput" name="password" value="password123" required
                               placeholder="••••••••"
                               class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-[#C1CDD4] rounded-xl text-xs text-[#2C2C33] placeholder-slate-400 focus:outline-none focus:border-[#003F85] focus:ring-2 focus:ring-[#26B1EB]/30 transition-all">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 text-slate-400 hover:text-slate-600">
                            <i data-lucide="eye" id="eyeIcon" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-500 pt-0.5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-[#C1CDD4] text-[#003F85] focus:ring-0">
                        <span>Ingat sesi masuk</span>
                    </label>
                    <span class="text-[11px] text-slate-400">Versi 1.0.0</span>
                </div>

                <!-- Tombol Masuk Utama -->
                <button type="submit" 
                        id="submitBtn"
                        class="w-full py-3 px-4 rounded-xl bg-[#003F85] hover:bg-[#00336D] text-white font-bold text-xs shadow-md shadow-blue-900/20 transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                    <span>Masuk ke Sistem</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>

            <!-- Box Akses Cepat Uji Coba -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-2 max-w-md mx-auto w-full">
                <div class="text-left text-[11px] text-slate-500">
                    <span>Akun Pengujian: </span>
                    <b class="text-[#003F85]">verifikator@lsf.go.id</b>
                </div>
                <button type="button" 
                        onclick="triggerQuickLogin()"
                        class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#003F85] text-xs font-semibold rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer">
                    <i data-lucide="zap" class="w-3.5 h-3.5 text-amber-500"></i>
                    <span>Akses Cepat</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- LOADING SCREEN OVERLAY DENGAN MASKOT MAMA CULA (FIST PUMP) -->
    <!-- ======================================================== -->
    <div id="loadingOverlay" class="fixed inset-0 bg-[#002754]/85 backdrop-blur-md z-50 hidden flex flex-col items-center justify-center text-white p-6">
        <div class="text-center max-w-md w-full space-y-4">
            <!-- Maskot Mama Cula Pose Semangat (Fist Pump) -->
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-[#26B1EB]/30 rounded-full blur-2xl"></div>
                <img src="/images/mama-cula-fist-pump.png" 
                     alt="Mama Cula Semangat" 
                     class="h-44 sm:h-52 object-contain mx-auto relative z-10 cheer-animation filter drop-shadow-2xl">
            </div>

            <!-- Teks Animasi Loading -->
            <div>
                <h3 class="text-xl font-extrabold text-white tracking-tight flex items-center justify-center gap-2">
                    <span>Mempersiapkan CMS LSF RI</span>
                    <i data-lucide="sparkles" class="w-5 h-5 text-amber-400 animate-spin"></i>
                </h3>
                <p class="text-xs text-[#26B1EB] font-medium mt-1">
                    Memverifikasi kredensial &amp; menghubungkan ke Engine AI Vision Qwen-VL...
                </p>
            </div>

            <!-- Progress Bar Animasi -->
            <div class="w-64 mx-auto bg-white/20 h-2 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-[#26B1EB] via-white to-[#1899A3] h-full rounded-full animate-pulse" style="width: 100%"></div>
            </div>

            <p class="text-[11px] text-slate-300">
                Lembaga Sensor Film · Menjaga Kualitas Tontonan Indonesia
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Toggle visibilitas kata sandi
        function togglePasswordVisibility() {
            const pwd = document.getElementById('passwordInput');
            const eye = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                eye.setAttribute('data-lucide', 'eye-off');
            } else {
                pwd.type = 'password';
                eye.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        // Tampilkan loading screen dengan maskot Mama Cula saat form dikirim
        const loginForm = document.getElementById('loginForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        loginForm.addEventListener('submit', function(e) {
            loadingOverlay.classList.remove('hidden');
        });

        // Trigger akses cepat demo
        function triggerQuickLogin() {
            document.getElementById('emailInput').value = 'verifikator@lsf.go.id';
            document.getElementById('passwordInput').value = 'password123';
            loadingOverlay.classList.remove('hidden');
            setTimeout(() => {
                loginForm.submit();
            }, 600);
        }
    </script>
</body>
</html>
