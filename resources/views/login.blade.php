{{-- login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SI-Poliklinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-neutral-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 rounded-2xl overflow-hidden shadow-xl bg-white">

        {{-- Sisi Kiri: Form Login --}}
        <div class="p-8 sm:p-10 md:p-14 flex flex-col justify-center">
            <div class="mb-8">
                {{-- Logo Placeholder Dinamis (Bisa diganti image asli jika file sudah ada) --}}
                <div class="w-14 h-14 rounded-xl bg-primary-700 flex items-center justify-center text-white mb-6 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-primary-900">Selamat Datang</h1>
                <p class="text-neutral-600 text-sm mt-1">Masuk untuk melanjutkan aktivitasmu</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-secondary-50 border border-secondary-300 text-secondary-800 text-sm px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Form Diubah Mengarah Langsung ke Route Dashboard untuk Testing --}}
            <form method="GET" action="/dashboard" class="space-y-5">

                <div>
                    <label for="username" class="block text-sm font-medium text-neutral-900 mb-1">Nama Pengguna</label>
                    <input type="text" id="username" name="username" required autofocus
                        class="w-full rounded-lg border border-neutral-200 px-4 py-2.5 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-700 transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-900 mb-1">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        class="w-full rounded-lg border border-neutral-200 px-4 py-2.5 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-700 transition">
                </div>

                <div class="text-right">
                    <a href="/lupa-password" class="text-sm text-primary-700 hover:text-primary-900 hover:underline">
                        Lupa password?
                    </a>
                </div>

                <button type="submit"
                    class="w-full bg-primary-700 hover:bg-primary-900 text-white font-semibold py-2.5 rounded-lg transition shadow-md">
                    Login
                </button>
            </form>
        </div>

        {{-- Sisi Kanan: Aksen Visual --}}
        <div class="hidden md:flex relative bg-primary-900 items-center justify-center overflow-hidden">
            <div class="absolute top-6 right-6 flex gap-2">
                <div class="w-10 h-3 rounded-full bg-tertiary-500"></div>
                <div class="w-10 h-3 rounded-full bg-secondary-500"></div>
            </div>

            <div class="w-64 bg-primary-400/30 rounded-3xl p-6 backdrop-blur-sm">
                <div class="bg-primary-50 rounded-xl p-4 mb-4 grid grid-cols-3 gap-2 text-center">
                    @for ($i = 0; $i < 9; $i++)
                        <span class="text-primary-700 text-xl font-bold leading-none">+</span>
                    @endfor
                </div>
                <div class="bg-primary-400/40 rounded-xl p-6 flex items-center justify-center">
                    <svg viewBox="0 0 100 30" class="w-full h-10">
                        <polyline points="0,15 20,15 27,3 34,27 41,15 100,15"
                            fill="none" stroke="#FEFDFC" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</body>
</html>