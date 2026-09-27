{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SI-Poliklinik Poltek SSN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        primary:   { 900: '#0B3B36', 700: '#146B5F', 400: '#6FA89D', 50: '#E3F1EE' },
                        secondary: { 800: '#8A3620', 500: '#D8693F', 300: '#F0B79B', 50: '#FBEAE0' },
                        tertiary:  { 800: '#7A5308', 500: '#C88A1E', 50: '#FBEACD' },
                        neutral:   { 900: '#232620', 600: '#55584F', 400: '#9A9C92', 200: '#DEDFD7', 50: '#FEFDFC' },
                    },
                    boxShadow: { card: '0 20px 45px -15px rgba(11,59,54,0.25)' }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-neutral-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 rounded-[28px] overflow-hidden shadow-card bg-white">

        {{-- === Sisi Kiri : Form Login === --}}
        <div class="p-10 md:p-16 flex flex-col justify-center">

            <img src="{{ asset('images/logo-ssn.png') }}" alt="Logo Politeknik Siber dan Sandi Negara"
                 class="w-16 h-16 object-contain mb-8">

            <h1 class="text-3xl font-semibold text-primary-900">Selamat Datang</h1>
            <p class="text-neutral-600 text-sm mt-2 mb-8">Masuk untuk melanjutkan aktivitasmu</p>

            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-secondary-50 border border-secondary-300 text-secondary-800 text-sm px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="username" class="block text-xs font-medium tracking-wide text-neutral-600 mb-1">
                        NAMA PENGGUNA
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                        class="w-full rounded-lg border border-neutral-200 px-4 py-2.5 text-neutral-900 placeholder-neutral-400
                               focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-700 transition">
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium tracking-wide text-neutral-600 mb-1">
                        KATA SANDI
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full rounded-lg border border-neutral-200 px-4 py-2.5 pr-11 text-neutral-900
                                   focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-700 transition">
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400 hover:text-primary-700">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="text-right mt-2">
                        <a href="{{ route('password.request') }}" class="text-xs text-primary-700 hover:text-primary-900 hover:underline">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-primary-700 hover:bg-primary-900 text-white font-semibold py-3 rounded-lg
                           transition shadow-sm hover:shadow-md">
                    Login
                </button>
            </form>

            <p class="text-[11px] text-neutral-400 mt-10">
                &copy; {{ date('Y') }} Politeknik Siber dan Sandi Negara &mdash; SI-Poliklinik
            </p>
        </div>

        {{-- === Sisi Kanan : Aksen Visual Hijau === --}}
        <div class="hidden md:flex relative bg-primary-900 items-center justify-center overflow-hidden">
            <div class="absolute top-8 right-8 flex gap-2">
                <span class="w-8 h-2.5 rounded-full bg-tertiary-500"></span>
                <span class="w-8 h-2.5 rounded-full bg-secondary-500"></span>
            </div>
            <div class="absolute -bottom-16 -left-16 w-56 h-56 rounded-full bg-primary-700/40"></div>
            <div class="absolute top-10 -right-10 w-40 h-40 rounded-full bg-primary-400/20"></div>

            <div class="relative w-60 bg-primary-400/30 rounded-[32px] p-5 backdrop-blur-sm shadow-xl">
                <div class="bg-primary-50 rounded-2xl p-4 mb-4 grid grid-cols-3 gap-2">
                    @for ($i = 0; $i < 9; $i++)
                        <span class="text-primary-700 text-lg leading-none text-center">+</span>
                    @endfor
                </div>
                <div class="bg-primary-400/40 rounded-2xl p-6 flex items-center justify-center">
                    <svg viewBox="0 0 100 30" class="w-full h-10">
                        <polyline points="0,15 20,15 27,3 34,27 41,15 100,15"
                            fill="none" stroke="#FEFDFC" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
