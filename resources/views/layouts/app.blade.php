<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Klasifikasi Adegan Video') — LSF RI</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F7FA] text-[#2C2C33] min-h-screen flex flex-col font-sans antialiased">

    <!-- Topbar Resmi Lembaga Sensor Film -->
    <header class="bg-white border-b border-[#C1CDD4]/60 sticky top-0 z-40 px-6 py-3 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Toggle -->
            <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            <!-- Logo Badge -->
            <a href="{{ route('dashboard.home') }}" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center p-1 border border-slate-200 shadow-xs">
                    <img src="/images/logo-lsf.png" alt="Logo LSF RI" class="max-h-full max-w-full object-contain">
                </div>
                <div>
                    <span class="text-[10px] font-bold tracking-wider text-[#003F85] uppercase block">
                        Lembaga Sensor Film · Republik Indonesia
                    </span>
                    <h1 class="text-base font-bold text-[#2C2C33] leading-tight">
                        CMS Klasifikasi Adegan Video
                    </h1>
                </div>
            </a>
        </div>

        <!-- Rating Badges & User Status -->
        <div class="flex items-center gap-4">
            <!-- Official Rating Pills -->
            <div class="hidden sm:flex items-center gap-1.5 bg-slate-100/80 p-1 rounded-full border border-slate-200">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#1899A3] text-white shadow-xs">SU</span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#DC7634] text-white shadow-xs">13+</span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#C8282E] text-white shadow-xs">17+</span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#4B2979] text-white shadow-xs">21+</span>
            </div>

            <!-- Profile Info & Logout -->
            <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                <div class="w-9 h-9 rounded-full bg-[#003F85] text-white flex items-center justify-center font-bold text-xs shadow-xs">
                    RK
                </div>
                <div class="hidden md:block text-left">
                    <span class="text-xs font-bold text-[#2C2C33] block">Dra. Ratna Kusuma</span>
                    <span class="text-[11px] text-slate-500 block">Subkomisi Penilai</span>
                </div>
                <button type="button" onclick="triggerLogout()" title="Keluar / Logout" class="text-slate-400 hover:text-[#C8282E] p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <!-- Main App Layout: Sidebar + Content -->
    <div class="flex flex-1 relative">
        <!-- Sidebar Navigation -->
        <aside id="sidebar" class="w-64 bg-[#003F85] text-white flex flex-col shrink-0 transition-all duration-300 z-30 lg:static fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 shadow-lg lg:shadow-none">
            <!-- Sidebar Header for Mobile -->
            <div class="lg:hidden p-4 flex items-center justify-between border-b border-white/10">
                <span class="font-bold text-sm">Menu Utama LSF</span>
                <button id="closeSidebarBtn" class="p-1 rounded text-white/70 hover:text-white">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Nav Links -->
            <nav class="p-4 space-y-1.5 flex-1">
                <a href="{{ route('dashboard.home') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('dashboard.home') ? 'bg-[#002754] text-white font-semibold shadow-xs' : 'text-slate-200 hover:bg-[#00336D] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="home" class="w-4 h-4 {{ request()->routeIs('dashboard.home') ? 'text-[#26B1EB]' : 'text-slate-300' }}"></i>
                        <span>Home</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 opacity-60"></i>
                </a>

                <a href="{{ route('klasifikasi.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('klasifikasi.*') ? 'bg-[#002754] text-white font-semibold shadow-xs' : 'text-slate-200 hover:bg-[#00336D] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="film" class="w-4 h-4 {{ request()->routeIs('klasifikasi.*') ? 'text-[#26B1EB]' : 'text-slate-300' }}"></i>
                        <span>Klasifikasi Video</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 opacity-60"></i>
                </a>

                <a href="{{ route('riwayat.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('riwayat.*') ? 'bg-[#002754] text-white font-semibold shadow-xs' : 'text-slate-200 hover:bg-[#00336D] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="history" class="w-4 h-4 {{ request()->routeIs('riwayat.*') ? 'text-[#26B1EB]' : 'text-slate-300' }}"></i>
                        <span>Riwayat Analisis</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 opacity-60"></i>
                </a>

                <a href="{{ route('laporan.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ request()->routeIs('laporan.*') ? 'bg-[#002754] text-white font-semibold shadow-xs' : 'text-slate-200 hover:bg-[#00336D] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="bar-chart-3" class="w-4 h-4 {{ request()->routeIs('laporan.*') ? 'text-[#26B1EB]' : 'text-slate-300' }}"></i>
                        <span>Laporan</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 opacity-60"></i>
                </a>
            </nav>

            <!-- Sidebar Footer Status -->
            <div class="p-4 border-t border-white/10 bg-[#002754]/40">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs text-slate-300 font-medium">Inference Node: 2 Aktif</span>
                </div>
                <p class="text-[11px] text-slate-400">
                    Model: Qwen-VL Multimodal Vision · UU 33/2009
                </p>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 lg:p-8 max-w-[1440px] w-full mx-auto">
            <!-- Toast Notifikasi Sukses -->
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-teal-50 border border-[#1899A3]/30 text-[#1899A3] flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-[#1899A3]"></i>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-teal-700 hover:text-teal-900">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- ======================================================== -->
    <!-- LOADING SCREEN OVERLAY LOGOUT: MAMA CULA POINTING / DADAH -->
    <!-- ======================================================== -->
    <div id="logoutOverlay" class="fixed inset-0 bg-[#002754]/90 backdrop-blur-md z-50 hidden flex flex-col items-center justify-center text-white p-6">
        <div class="text-center max-w-md w-full space-y-4">
            <!-- Maskot Mama Cula Versi Berbeda (Pose Telunjuk 1 / Pointing) -->
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-[#26B1EB]/30 rounded-full blur-2xl"></div>
                <img src="/images/mama-cula-pointing.png" 
                     alt="Mama Cula Sampai Jumpa" 
                     class="h-44 sm:h-52 object-contain mx-auto relative z-10 cheer-animation filter drop-shadow-2xl">
            </div>

            <!-- Teks Animasi Logout -->
            <div>
                <h3 class="text-xl font-extrabold text-white tracking-tight flex items-center justify-center gap-2">
                    <span>Sampai Jumpa Kembali!</span>
                    <i data-lucide="shield-check" class="w-5 h-5 text-emerald-400"></i>
                </h3>
                <p class="text-xs text-[#26B1EB] font-medium mt-1">
                    Mengakhiri sesi penilai &amp; mengamankan data sensor LSF RI...
                </p>
            </div>

            <!-- Progress Bar Animasi -->
            <div class="w-64 mx-auto bg-white/20 h-2 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-[#DC7634] via-[#26B1EB] to-white h-full rounded-full animate-pulse" style="width: 100%"></div>
            </div>

            <p class="text-[11px] text-slate-300">
                Lembaga Sensor Film · Menuju Halaman Masuk
            </p>
        </div>
    </div>

    <style>
        @keyframes cheerBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-12px) scale(1.03); }
        }
        .cheer-animation {
            animation: cheerBounce 1.8s ease-in-out infinite;
        }
    </style>

    <script>
        // Inisialisasi ikon Lucide
        lucide.createIcons();

        // Mobile drawer toggle logic
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
        if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
        if (backdrop) backdrop.addEventListener('click', toggleSidebar);

        // Logika Loading Screen Logout dengan Mama Cula Pointing
        function triggerLogout() {
            const logoutOverlay = document.getElementById('logoutOverlay');
            if (logoutOverlay) {
                logoutOverlay.classList.remove('hidden');
            }
            setTimeout(() => {
                const form = document.getElementById('logoutForm');
                if (form) {
                    form.submit();
                } else {
                    window.location.href = "{{ route('login') }}";
                }
            }, 1000);
        }
    </script>
</body>
</html>
