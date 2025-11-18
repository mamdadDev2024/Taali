<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl"
      x-data="themeManager()"
      x-init="init()"
      :class="{ 'dark': isDark }"
      class="scroll-smooth antialiased transition-colors duration-300 min-h-screen flex flex-col">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Font -->
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('{{ asset('vasir.woff') }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Vazir', sans-serif;
        }

        .background-gradient {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #f0f0f0, #d9d9d9);
            transition: background 0.5s ease;
            z-index: -1;
        }

        .dark .background-gradient {
            background: linear-gradient(135deg, #111111, #222222);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen transition-colors duration-300 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100">

    <!-- Gradient Background -->
    <div class="background-gradient"></div>

    <div class="relative z-10 flex-1 flex flex-col">

        <!-- Header -->
        @if(isset($header))
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4 bg-white dark:bg-gray-800 shadow-md transition-colors duration-300">
                {{ $header }}
            </div>
        @else
            @include('components.partials.header')
        @endif

        <!-- Main Content -->
        <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="w-full px-4 sm:px-6 lg:px-8 py-4 bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-300">
            @include('components.partials.footer')
        </footer>
    </div>

    @livewireScripts
    <x-toaster-hub />
    <livewire:confirm-modal />

    <script>
        function themeManager() {
            return {
                isDark: false,
                init() {
                    this.isDark = localStorage.theme === 'dark'
                                || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    document.documentElement.classList.toggle('dark', this.isDark);
                },
                toggleDark() {
                    this.isDark = !this.isDark;
                    document.documentElement.classList.toggle('dark', this.isDark);
                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                }
            }
        }
    </script>

</body>
</html>
