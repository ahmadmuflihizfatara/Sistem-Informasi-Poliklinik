{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SI-Poliklinik Poltek SSN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        primary:   { 900: '#0B3B36', 700: '#146B5F', 400: '#6FA89D', 50: '#E3F1EE' },
                        secondary: { 800: '#8A3620', 500: '#D8693F', 300: '#F0B79B', 50: '#FBEAE0' },
                        tertiary:  { 800: '#7A5308', 500: '#C88A1E', 50: '#FBEACD' },
                        neutral:   { 900: '#232620', 600: '#55584F', 400: '#9A9C92', 200: '#DEDFD7', 50: '#FEFDFC' },
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        // Terapkan tema tersimpan sebelum render, agar tidak ada "flash"
        if (localStorage.theme === 'dark' ||
           (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="font-sans bg-neutral-50 dark:bg-neutral-900 text-neutral-900 dark:text-neutral-50 transition-colors">

    <div class="flex min-h-screen">

        {{-- ===== Sidebar ===== --}}
        <aside class="w-16 bg-primary-900 flex flex-col items-center py-6 gap-6 fixed h-full z-20">
            <button class="text-primary-50 hover:text-white transition" title="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav class="flex flex-col gap-3 mt-4">
                <a href="{{ route('dashboard') }}" title="Dashboard"
                   class="w-10 h-10 rounded-xl bg-primary-700 flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                    </svg>
                </a>
                <a href="{{ route('laporan-kesehatan.index') }}" title="Laporan Kesehatan"
                   class="w-10 h-10 rounded-xl flex items-center justify-center text-primary-50 hover:bg-primary-700 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </a>
            </nav>

            <a href="{{ route('logout') }}" title="Keluar"
               class="mt-auto text-primary-50 hover:text-white transition"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </aside>

        {{-- ===== Konten Utama ===== --}}
        <main class="ml-16 flex-1 p-6 md:p-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-primary-900 dark:text-primary-50">Selamat Datang</h1>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm mt-1">Informasi keadaan kesehatan taruna hari ini.</p>
                </div>

                <div class="flex flex-wrap items-start gap-3">

                    {{-- ===== Dropdown Rentang Tanggal + Kustom ===== --}}
                    <div class="relative" id="dateFilterWrapper">
                        <button type="button" id="dateFilterBtn" onclick="toggleDateDropdown()"
                            class="flex items-center gap-2 bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700
                                   rounded-lg pl-4 pr-3 py-2 text-sm text-neutral-900 dark:text-neutral-100
                                   focus:outline-none focus:ring-2 focus:ring-primary-400 cursor-pointer min-w-[230px] justify-between">
                            <span id="dateFilterLabel">7 hari terakhir</span>
                            <svg class="w-4 h-4 text-neutral-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="dateDropdown"
                             class="hidden absolute right-0 mt-2 w-72 bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700
                                    rounded-xl shadow-lg z-30 overflow-hidden">
                            <ul class="text-sm">
                                <li>
                                    <button type="button" onclick="pickDateOption('rentang', 'Rentang tanggal: 1 &ndash; 26 September 2026')"
                                        class="w-full text-left px-4 py-2.5 hover:bg-primary-50 dark:hover:bg-neutral-700 text-neutral-900 dark:text-neutral-100">
                                        Rentang tanggal: 1 &ndash; 26 September 2026
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="pickDateOption('bulan_ini', 'Bulan ini')"
                                        class="w-full text-left px-4 py-2.5 hover:bg-primary-50 dark:hover:bg-neutral-700 text-neutral-900 dark:text-neutral-100">
                                        Bulan ini
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="pickDateOption('7_hari', '7 hari terakhir')"
                                        class="w-full text-left px-4 py-2.5 hover:bg-primary-50 dark:hover:bg-neutral-700 text-neutral-900 dark:text-neutral-100 bg-primary-50/60 dark:bg-neutral-700/60">
                                        7 hari terakhir
                                    </button>
                                </li>
                                <li class="border-t border-neutral-100 dark:border-neutral-700">
                                    <button type="button" onclick="toggleCustomPanel()"
                                        id="kustomBtn"
                                        class="w-full text-left px-4 py-2.5 hover:bg-primary-700 hover:text-white text-neutral-900 dark:text-neutral-100 font-medium">
                                        Kustom
                                    </button>
                                </li>
                            </ul>

                            {{-- Panel Kustom: dari tanggal - sampai tanggal --}}
                            <div id="customPanel" class="hidden border-t border-neutral-200 dark:border-neutral-700 p-4 space-y-3 bg-neutral-50 dark:bg-neutral-900/40">
                                <div>
                                    <label class="block text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-1">Dari tanggal</label>
                                    <input type="date" id="tanggalDari"
                                        class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800
                                               px-3 py-1.5 text-sm text-neutral-900 dark:text-neutral-100
                                               focus:outline-none focus:ring-2 focus:ring-primary-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-1">Sampai tanggal</label>
                                    <input type="date" id="tanggalSampai"
                                        class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800
                                               px-3 py-1.5 text-sm text-neutral-900 dark:text-neutral-100
                                               focus:outline-none focus:ring-2 focus:ring-primary-400">
                                </div>
                                <p id="customError" class="hidden text-xs text-secondary-800">Tanggal akhir harus setelah tanggal awal.</p>
                                <button type="button" onclick="applyCustomRange()"
                                    class="w-full bg-primary-700 hover:bg-primary-900 text-white text-sm font-medium py-2 rounded-lg transition">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ===== Filter Tingkat ===== --}}
                    <div class="relative">
                        <select id="filterTingkat"
                            onchange="applyFilterTingkat(this.value)"
                            class="appearance-none bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700
                                   rounded-lg pl-4 pr-9 py-2 text-sm text-neutral-900 dark:text-neutral-100
                                   focus:outline-none focus:ring-2 focus:ring-primary-400 cursor-pointer">
                            <option value="semua" selected>Semua tingkat</option>
                            <option value="1">Tingkat I</option>
                            <option value="2">Tingkat II</option>
                            <option value="3">Tingkat III</option>
                            <option value="4">Tingkat IV</option>
                        </select>
                        <svg class="w-4 h-4 text-neutral-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    {{-- ===== Toggle Dark Mode ===== --}}
                    <button type="button" onclick="toggleDarkMode()" title="Ganti tema"
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-neutral-200 dark:border-neutral-700
                               bg-white dark:bg-neutral-800 text-neutral-600 dark:text-tertiary-500 hover:bg-primary-50 dark:hover:bg-neutral-700 transition">
                        {{-- Ikon bulan (tampil saat mode terang) --}}
                        <svg id="iconMoon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                        </svg>
                        {{-- Ikon matahari (tampil saat mode gelap) --}}
                        <svg id="iconSun" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Kartu Indikator --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-primary-50 dark:bg-neutral-800 rounded-2xl p-5 border border-primary-400/30 dark:border-neutral-700">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-9 h-9 rounded-xl bg-white dark:bg-neutral-900 flex items-center justify-center text-primary-700 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Sakit Ringan</span>
                    </div>
                    <p class="text-3xl font-semibold text-primary-900 dark:text-primary-50" data-count="18">18
                        <span class="text-base font-normal text-neutral-600 dark:text-neutral-400">taruna</span>
                    </p>
                </div>

                <div class="bg-tertiary-50 dark:bg-neutral-800 rounded-2xl p-5 border border-tertiary-500/30 dark:border-neutral-700">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-9 h-9 rounded-xl bg-white dark:bg-neutral-900 flex items-center justify-center text-tertiary-800 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21h6M12 3v10m0 0a3 3 0 100 6 3 3 0 000-6z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Sakit Sedang</span>
                    </div>
                    <p class="text-3xl font-semibold text-tertiary-800 dark:text-tertiary-500" data-count="7">7
                        <span class="text-base font-normal text-neutral-600 dark:text-neutral-400">taruna</span>
                    </p>
                </div>

                <div class="bg-secondary-50 dark:bg-neutral-800 rounded-2xl p-5 border border-secondary-500/30 dark:border-neutral-700">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-9 h-9 rounded-xl bg-white dark:bg-neutral-900 flex items-center justify-center text-secondary-800 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Sakit Berat</span>
                    </div>
                    <p class="text-3xl font-semibold text-secondary-800 dark:text-secondary-500" data-count="2">2
                        <span class="text-base font-normal text-neutral-600 dark:text-neutral-400">taruna</span>
                    </p>
                </div>
            </div>

            {{-- Grid Chart --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

                {{-- Bar Chart --}}
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700">
                    <h2 class="font-semibold text-primary-900 dark:text-primary-50 mb-4">Sakit per Tingkat</h2>
                    <canvas id="chartTingkat" height="190"></canvas>
                </div>

                {{-- Donut Sebaran Keluhan --}}
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-primary-900 dark:text-primary-50">Sebaran Jenis Keluhan</h2>
                        <span class="text-xs text-neutral-400">Keluhan aktif, 1 &ndash; 26 September 2026</span>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="relative w-40 h-40 flex-shrink-0">
                            <canvas id="chartKeluhan"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span class="text-2xl font-semibold text-neutral-900 dark:text-neutral-50">27</span>
                                <span class="text-xs text-neutral-600 dark:text-neutral-400">keluhan aktif</span>
                            </div>
                        </div>
                        <ul class="text-sm space-y-2 flex-1">
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100"><span class="w-2.5 h-2.5 rounded-full bg-primary-900"></span>Demam</span>
                                <span class="text-neutral-600 dark:text-neutral-400">9 &middot; 33%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100"><span class="w-2.5 h-2.5 rounded-full bg-primary-700"></span>ISPA</span>
                                <span class="text-neutral-600 dark:text-neutral-400">7 &middot; 26%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100"><span class="w-2.5 h-2.5 rounded-full bg-primary-400"></span>Cedera latihan</span>
                                <span class="text-neutral-600 dark:text-neutral-400">5 &middot; 19%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100"><span class="w-2.5 h-2.5 rounded-full bg-tertiary-500"></span>Gangguan pencernaan</span>
                                <span class="text-neutral-600 dark:text-neutral-400">4 &middot; 15%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100"><span class="w-2.5 h-2.5 rounded-full bg-secondary-500"></span>Lainnya</span>
                                <span class="text-neutral-600 dark:text-neutral-400">2 &middot; 7%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Kartu Rekap & Donut Jenis Kelamin --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700">
                    <h2 class="font-semibold text-primary-900 dark:text-primary-50 mb-1">Sembuh</h2>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400 mb-4">Dinyatakan pulih bulan ini</p>
                    <div class="flex items-end justify-between">
                        <span class="text-3xl font-semibold text-primary-900 dark:text-primary-50">41</span>
                        <span class="text-xs font-medium bg-primary-50 dark:bg-primary-900/40 text-primary-700 dark:text-primary-400 px-2.5 py-1 rounded-full">+6 dari minggu lalu</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700">
                    <h2 class="font-semibold text-primary-900 dark:text-primary-50 mb-1">Isoman</h2>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400 mb-4">Sedang isolasi mandiri</p>
                    <div class="flex items-end justify-between">
                        <span class="text-3xl font-semibold text-primary-900 dark:text-primary-50">5</span>
                        <span class="text-xs font-medium bg-tertiary-50 dark:bg-tertiary-800/40 text-tertiary-800 dark:text-tertiary-500 px-2.5 py-1 rounded-full">2 selesai besok</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700">
                    <h2 class="font-semibold text-primary-900 dark:text-primary-50 mb-3">Sakit Berdasarkan Jenis Kelamin</h2>
                    <div class="flex items-center gap-4">
                        <div class="relative w-24 h-24 flex-shrink-0">
                            <canvas id="chartGender"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span class="text-xl font-semibold text-neutral-900 dark:text-neutral-50">27</span>
                                <span class="text-[10px] text-neutral-600 dark:text-neutral-400">taruna sakit</span>
                            </div>
                        </div>
                        <ul class="text-sm space-y-2 flex-1">
                            <li class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100">
                                <span class="w-2.5 h-2.5 rounded-full bg-primary-700"></span>Laki-laki
                                <span class="text-neutral-600 dark:text-neutral-400 ml-auto">19 &middot; 70%</span>
                            </li>
                            <li class="flex items-center gap-2 text-neutral-900 dark:text-neutral-100">
                                <span class="w-2.5 h-2.5 rounded-full bg-secondary-500"></span>Perempuan
                                <span class="text-neutral-600 dark:text-neutral-400 ml-auto">8 &middot; 30%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        // ================== DARK MODE ==================
        function updateDarkIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            document.getElementById('iconMoon').classList.toggle('hidden', isDark);
            document.getElementById('iconSun').classList.toggle('hidden', !isDark);
        }
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            updateDarkIcons();
        }
        updateDarkIcons();

        // ================== DROPDOWN RENTANG TANGGAL ==================
        function toggleDateDropdown() {
            document.getElementById('dateDropdown').classList.toggle('hidden');
        }
        function toggleCustomPanel() {
            document.getElementById('customPanel').classList.toggle('hidden');
        }
        function pickDateOption(value, label) {
            document.getElementById('dateFilterLabel').innerHTML = label;
            document.getElementById('dateDropdown').classList.add('hidden');
            document.getElementById('customPanel').classList.add('hidden');
            // TODO: panggil endpoint/filter data sesuai value ('rentang' | 'bulan_ini' | '7_hari')
        }
        function applyCustomRange() {
            const dari = document.getElementById('tanggalDari').value;
            const sampai = document.getElementById('tanggalSampai').value;
            const errorEl = document.getElementById('customError');

            if (!dari || !sampai) {
                errorEl.textContent = 'Isi kedua tanggal terlebih dahulu.';
                errorEl.classList.remove('hidden');
                return;
            }
            if (new Date(sampai) < new Date(dari)) {
                errorEl.textContent = 'Tanggal akhir harus setelah tanggal awal.';
                errorEl.classList.remove('hidden');
                return;
            }
            errorEl.classList.add('hidden');

            const format = (d) => new Date(d).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            const label = `${format(dari)} &ndash; ${format(sampai)}`;

            pickDateOption('kustom', label);
            // TODO: kirim `dari` dan `sampai` (format Y-m-d) ke backend, misal:
            // fetch(`/dashboard/data?dari=${dari}&sampai=${sampai}`)...
        }
        // Tutup dropdown saat klik di luar area
        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('dateFilterWrapper');
            if (!wrapper.contains(e.target)) {
                document.getElementById('dateDropdown').classList.add('hidden');
            }
        });

        // ================== DATA GRAFIK ==================
        const dataTingkat = {
            semua: { ringan: [8,4,3,3], sedang: [2,2,2,1], berat: [1,1,1,0] },
            1: { ringan: [8], sedang: [2], berat: [1] },
            2: { ringan: [4], sedang: [2], berat: [1] },
            3: { ringan: [3], sedang: [2], berat: [1] },
            4: { ringan: [3], sedang: [1], berat: [0] },
        };
        const labelTingkat = {
            semua: ['Tingkat I','Tingkat II','Tingkat III','Tingkat IV'],
            1: ['Tingkat I'], 2: ['Tingkat II'], 3: ['Tingkat III'], 4: ['Tingkat IV'],
        };

        let chartTingkat = new Chart(document.getElementById('chartTingkat'), {
            type: 'bar',
            data: {
                labels: labelTingkat.semua,
                datasets: [
                    { label: 'Ringan', data: dataTingkat.semua.ringan, backgroundColor: '#6FA89D', stack: 's', borderRadius: 4 },
                    { label: 'Sedang', data: dataTingkat.semua.sedang, backgroundColor: '#C88A1E', stack: 's', borderRadius: 4 },
                    { label: 'Berat',  data: dataTingkat.semua.berat,  backgroundColor: '#8A3620', stack: 's', borderRadius: 4 },
                ]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 } } } },
                scales: {
                    x: { stacked: true, grid: { color: '#DEDFD7' } },
                    y: { stacked: true, grid: { display: false } }
                }
            }
        });

        function applyFilterTingkat(value) {
            chartTingkat.data.labels = labelTingkat[value];
            chartTingkat.data.datasets[0].data = dataTingkat[value].ringan;
            chartTingkat.data.datasets[1].data = dataTingkat[value].sedang;
            chartTingkat.data.datasets[2].data = dataTingkat[value].berat;
            chartTingkat.update();
        }

        new Chart(document.getElementById('chartKeluhan'), {
            type: 'doughnut',
            data: {
                labels: ['Demam', 'ISPA', 'Cedera latihan', 'Gangguan pencernaan', 'Lainnya'],
                datasets: [{
                    data: [9, 7, 5, 4, 2],
                    backgroundColor: ['#0B3B36', '#146B5F', '#6FA89D', '#C88A1E', '#D8693F'],
                    borderWidth: 2,
                    borderColor: '#FEFDFC'
                }]
            },
            options: { cutout: '72%', plugins: { legend: { display: false } } }
        });

        new Chart(document.getElementById('chartGender'), {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [19, 8],
                    backgroundColor: ['#146B5F', '#D8693F'],
                    borderWidth: 2,
                    borderColor: '#FEFDFC'
                }]
            },
            options: { cutout: '72%', plugins: { legend: { display: false } } }
        });
    </script>
</body>
</html>
