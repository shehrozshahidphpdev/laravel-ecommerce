@props([
    'backpath',
    'title',
    'text'
])
<!-- form Header -->
<div class="mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route($backpath) }}"
            class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 bg-white text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white"> {{ $title }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400"> {{ $text }}</p>
        </div>
    </div>
</div>