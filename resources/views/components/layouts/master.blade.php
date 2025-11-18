<x-layouts.app>
    <x-slot:title>{{ __($title) ?? __('Home') }}</x-slot:title>

    <main class="
        flex-1
        bg-white dark:bg-gray-900
        border border-gray-200 dark:border-gray-700/70
        rounded-2xl
        p-4 sm:p-6 md:p-8
        m-2 sm:m-4 md:m-6
        shadow-md dark:shadow-lg
        transition-all duration-300
        overflow-hidden
    ">
        {{ $slot }}
    </main>
</x-layouts.app>
