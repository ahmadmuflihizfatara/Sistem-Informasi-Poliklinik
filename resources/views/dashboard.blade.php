{{-- dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SI-Poliklinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 900: '#0B3B36', 700: '#146B5F', 400: '#6FA89D', 50: '#E3F1EE' },
                        secondary: { 800: '#8A3620', 300: '#F0B79B', 500: '#D8693F', 50: '#FBEAE0' },
                        tertiary: { 800: '#7A5308', 500: '#C88A1E', 50: '#FBEACD' },
                        neutral: { 900: '#232620', 600: '#55584F', 400: '#9A9C92', 200: '#DEDFD7', 50: '#FEFDFC' },
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-neutral-50 text-neutral-900">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-16 bg-primary-900 flex flex-col items-center py-6 gap-6 fixed h-full z-10">
            <button class="text-primary-50 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav class="flex flex-col gap-2 mt-4">
                <a href="{{ route('dashboard') }}" class="w-9 h-9 rounded-lg bg-primary-700 flex items-center justify-center text-white" title="Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                    </svg>
                </a>
                <a href="{{ route('laporan-kesehatan.index') }}" class="w-9 h-9 rounded-lg flex items-center justify-center text-primary-50 hover:bg-primary-700 hover:text-white transition" title="Laporan Kesehatan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </a>
            </nav>

            <a href="{{ route('logout') }}" class="mt-auto text-primary-50 hover:text-white transition" title="Keluar">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </a>
        </aside>

        {{-- Konten Utama --}}
        <main class="ml-16 flex-1 p-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-primary-900">Selamat Datang</h1>
                    <p class="text-neutral-600 text-sm mt-1">Informasi keadaan kesehatan taruna hari ini.</p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="relative">
                        <select class="appearance-none bg-white border border-neutral-200 rounded-lg pl-4 pr-9 py-2 text-sm text-neutral-900 focus:outline-none focus:ring-2 focus:ring-primary-400">
                            <option>Rentang tanggal: 1 – 26 September 2026</option>
                            <option>Bulan ini</option>
                            <option>7 hari terakhir</option>
                            <option>Kustom</option>
                        </select>
                    </div>
                    <div class="relative">
                        <select class="appearance-none bg-white border border-neutral-200 rounded-lg pl-4 pr-9 py-2 text-sm text-neutral-900 focus:outline-none focus:ring-2 focus:ring-primary-400">
                            <option>Semua tingkat</option>
                            <option>Tingkat I</option>
                            <option>Tingkat II</option>
                            <option>Tingkat III</option>
                            <option>Tingkat IV</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Kartu Indikator --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-primary-50 rounded-xl p-5 border border-primary-400/30">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-primary-700">💚</span>
                        <span class="text-sm font-medium text-neutral-600">Sakit Ringan</span>
                    </div>
                    <p class="text-3xl font-bold text-primary-900">{{ $ringan ?? 18 }} <span class="text-base font-normal text-neutral-600">taruna</span></p>
                </div>

                <div class="bg-tertiary-50 rounded-xl p-5 border border-tertiary-500/30">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-tertiary-800">🌡️</span>
                        <span class="text-sm font-medium text-neutral-600">Sakit Sedang</span>
                    </div>
                    <p class="text-3xl font-bold text-tertiary-800">{{ $sedang ?? 7 }} <span class="text-base font-normal text-neutral-600">taruna</span></p>
                </div>

                <div class="bg-secondary-50 rounded-xl p-5 border border-secondary-500/30">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-secondary-800">➕</span>
                        <span class="text-sm font-medium text-neutral-600">Sakit Berat</span>
                    </div>
                    <p class="text-3xl font-bold text-secondary-800">{{ $berat ?? 2 }} <span class="text-base font-normal text-neutral-600">taruna</span></p>
                </div>
            </div>

            {{-- Grid Chart --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                {{-- Bar Chart --}}
                <div class="bg-white rounded-xl p-5 border border-neutral-200">
                    <h2 class="font-semibold text-primary-900 mb-4">Sakit per Tingkat</h2>
                    <canvas id="chartTingkat" height="180"></canvas>
                </div>

                {{-- Donut Sebaran Keluhan --}}
                <div class="bg-white rounded-xl p-5 border border-neutral-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-primary-900">Sebaran Jenis Keluhan</h2>
                        <span class="text-xs text-neutral-400">Keluhan aktif, 1 – 26 September 2026</span>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="relative w-40 h-40 flex-shrink-0">
                            <canvas id="chartKeluhan"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-2xl font-bold text-neutral-900">27</span>
                                <span class="text-xs text-neutral-600">keluhan aktif</span>
                            </div>
                        </div>
                        <ul class="text-sm space-y-2 flex-1">
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-primary-900"></span>Demam</span>
                                <span class="text-neutral-600">9 &middot; 33%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-primary-700"></span>ISPA</span>
                                <span class="text-neutral-600">7 &middot; 26%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-primary-400"></span>Cedera latihan</span>
                                <span class="text-neutral-600">5 &middot; 19%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-tertiary-500"></span>Gangguan pencernaan</span>
                                <span class="text-neutral-600">4 &middot; 15%</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-secondary-500"></span>Lainnya</span>
                                <span class="text-neutral-600">2 &middot; 7%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Kartu Rekap & Donut Jenis Kelamin --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl p-5 border border-neutral-200">
                    <h2 class="font-semibold text-primary-900 mb-1">Sembuh</h2>
                    <p class="text-xs text-neutral-600 mb-3">Dinyatakan pulih bulan ini</p>
                    <div class="flex items-end justify-between">
                        <span class="text-3xl font-bold text-primary-900">41</span>
                        <span class="text-xs font-medium bg-primary-50 text-primary-700 px-2 py-1 rounded-full">+6 dari minggu lalu</span>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-neutral-200">
                    <h2 class="font-semibold text-primary-900 mb-1">Isoman</h2>
                    <p class="text-xs text-neutral-600 mb-3">Sedang isolasi mandiri</p>
                    <div class="flex items-end justify-between">
                        <span class="text-3xl font-bold text-primary-900">5</span>
                        <span class="text-xs font-medium bg-tertiary-50 text-tertiary-800 px-2 py-1 rounded-full">2 selesai besok</span>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-neutral-200">
                    <h2 class="font-semibold text-primary-900 mb-3">Sakit Berdasarkan Jenis Kelamin</h2>
                    <div class="flex items-center gap-4">
                        <div class="relative w-24 h-24 flex-shrink-0">
                            <canvas id="chartGender"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-xl font-bold text-neutral-900">27</span>
                                <span class="text-[10px] text-neutral-600">taruna sakit</span>
                            </div>
                        </div>
                        <ul class="text-sm space-y-2">
                            <li class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-primary-700"></span>Laki-laki
                                <span class="text-neutral-600 ml-auto">19 &middot; 70%</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-secondary-500"></span>Perempuan
                                <span class="text-neutral-600 ml-auto">8 &middot; 30%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        // Bar Chart: Sakit per Tingkat
        new Chart(document.getElementById('chartTingkat'), {
            type: 'bar',
            data: {
                labels: ['Tingkat I', 'Tingkat II', 'Tingkat III', 'Tingkat IV'],
                datasets: [
                    { label: 'Ringan', data: [8, 4, 3, 3], backgroundColor: '#6FA89D', stack: 's' },
                    { label: 'Sedang', data: [2, 2, 2, 1], backgroundColor: '#C88A1E', stack: 's' },
                    { label: 'Berat',  data: [1, 1, 1, 0], backgroundColor: '#8A3620', stack: 's' },
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

        // Donut Chart: Sebaran Keluhan
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
            options: {
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });

        // Donut Chart: Jenis Kelamin
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
            options: {
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });
    </script>
</body>
</html>