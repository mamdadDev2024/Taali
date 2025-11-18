<header class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-[#111] text-gray-900 dark:text-gray-100 transition-colors duration-300 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">

        <h1 class="text-lg font-semibold tracking-tight">{{ $title ?? 'صفحه' }}</h1>

        <div class="flex items-center gap-3">

            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 transition-shadow shadow-sm">
                        @if(Auth::user()->image?->first()?->path)
                            <img src="{{ asset(Auth::user()->image->first()->path) }}"
                                 class="w-8 h-8 rounded-full object-cover ring-1 ring-gray-300 dark:ring-gray-700">
                        @else
                            <x-heroicon-o-user class="w-6 h-6 opacity-80 dark:opacity-100" />
                        @endif
                        <span class="font-semibold">{{ auth()->user()->name }}</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 opacity-70 dark:opacity-100" />
                    </button>

                    <div x-show="open" @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white dark:bg-[#111] border border-gray-200 dark:border-gray-800/70 rounded-2xl shadow-xl divide-y divide-gray-100 dark:divide-gray-800/70 z-50 overflow-hidden">

                        <ul class="py-2 text-gray-700 dark:text-gray-200 text-sm">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-md mx-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <x-heroicon-o-home class="w-5 h-5" />
                                    داشبورد
                                </a>
                            </li>
                            @hasrole('super-admin')
                            <li>
                                <a href="{{ route('content.create') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-md mx-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <x-heroicon-o-plus-circle class="w-5 h-5" />
                                    {{__('Content Create')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('content.index') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-md mx-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <x-heroicon-o-numbered-list class="w-5 h-5" />
                                    {{__('Content Index')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('comment.index') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-md mx-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <x-heroicon-o-chat-bubble-left-right class="w-5 h-5" />
                                    {{__('Manage Comments')}}
                                </a>
                            </li>
                            @endhasrole
                            <li>
                                <a href="{{ route('settings') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-md mx-1 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                                    تنظیمات
                                </a>
                            </li>
                        </ul>

                        <div class="py-2 bg-gray-50 dark:bg-[#0D0D0D]">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md mx-1 transition">
                                    <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                                    خروج
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-lg bg-primary text-surface font-medium hover:bg-accent-1 transition-colors duration-200">
                    ورود
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 rounded-lg border border-primary text-primary font-medium hover:bg-primary hover:text-surface transition-colors duration-200">
                    ثبت‌نام
                </a>
            @endauth

            <button @click="toggleDark()"
                    class="p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors text-accent hover:bg-accent-1/20">
                <x-heroicon-o-moon x-show="!isDark" class="w-5 h-5" />
                <x-heroicon-o-sun x-show="isDark" class="w-5 h-5" />
            </button>


        </div>
    </div>
</header>
