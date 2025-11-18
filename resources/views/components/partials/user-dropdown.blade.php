<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
            class="flex items-center gap-3 text-sm font-medium
                   text-gray-900 dark:text-gray-100 cursor-pointer
                   bg-white dark:bg-gray-800
                   border border-gray-200 dark:border-gray-700/70
                   rounded-xl px-3 sm:px-4 py-2.5
                   hover:bg-gray-100 dark:hover:bg-gray-700
                   transition-all duration-200 shadow-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-400">
        @if(Auth::user()->image->first()?->path)
            <img src="{{ asset(Auth::user()->image->first()->path) }}"
                 alt="User Avatar"
                 class="w-8 h-8 rounded-full object-cover
                        ring-1 ring-gray-300 dark:ring-gray-600
                        transform transition-transform duration-200 hover:scale-105">
        @else
            <x-heroicon-o-user class="w-6 h-6 opacity-80" />
        @endif

        <span class="font-semibold truncate max-w-[100px] sm:max-w-[150px]">{{ auth()->user()->name }}</span>

        <x-heroicon-o-chevron-down class="w-4 h-4 opacity-70 transition-transform duration-200"
                                   :class="{ 'rotate-180': open }" />
    </button>

    <div x-show="open" @click.outside="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="absolute right-0 mt-2 w-56 rounded-xl overflow-hidden z-50
                bg-white dark:bg-gray-900
                shadow-xl dark:shadow-black/40
                border border-gray-200 dark:border-gray-700/70
                divide-y divide-gray-100 dark:divide-gray-800/70">

        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 sm:px-4 py-2.5
                          hover:bg-gray-100 dark:hover:bg-gray-700
                          rounded-md transition-colors duration-200">
                    <x-heroicon-o-home class="w-5 h-5" />
                    داشبورد
                </a>
            </li>

            @hasrole('super-admin')
            <li>
                <a href="{{ route('content.create') }}"
                   class="flex items-center gap-3 px-3 sm:px-4 py-2.5
                          hover:bg-gray-100 dark:hover:bg-gray-700
                          rounded-md transition-colors duration-200">
                    <x-heroicon-o-plus-circle class="w-5 h-5" />
                    ایجاد محتوا
                </a>
            </li>

            <li>
                <a href="{{ route('content.index') }}"
                   class="flex items-center gap-3 px-3 sm:px-4 py-2.5
                          hover:bg-gray-100 dark:hover:bg-gray-700
                          rounded-md transition-colors duration-200">
                    <x-heroicon-o-numbered-list class="w-5 h-5" />
                    لیست محتوا
                </a>
            </li>

            <li>
                <a href="{{ route('comment.index') }}"
                   class="flex items-center gap-3 px-3 sm:px-4 py-2.5
                          hover:bg-gray-100 dark:hover:bg-gray-700
                          rounded-md transition-colors duration-200">
                    <x-heroicon-o-chat-bubble-left-right class="w-5 h-5" />
                    مدیریت دیدگاه‌ها
                </a>
            </li>
            @endhasrole

            <li>
                <a href="{{ route('settings') }}"
                   class="flex items-center gap-3 px-3 sm:px-4 py-2.5
                          hover:bg-gray-100 dark:hover:bg-gray-700
                          rounded-md transition-colors duration-200">
                    <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                    تنظیمات
                </a>
            </li>
        </ul>

        <div class="py-2 bg-gray-50 dark:bg-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 sm:px-4 py-2.5 text-sm
                               text-red-600 dark:text-red-400
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               rounded-md transition-colors duration-200">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                    خروج
                </button>
            </form>
        </div>
    </div>
</div>
