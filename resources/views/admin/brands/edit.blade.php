<x-admin.app-layout title="admin - create brand">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <!-- Page Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <a href="{{ route('brands.index') }}"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 bg-white text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Brand</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Edit Brand Details</p>
                    </div>
                </div>
            </div>
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <x-form action="{{ route('brands.update', $brand->id) }}" method="PUT">
                    <div class="space-y-6 p-6 sm:p-8">
                        <div class="flex flex-row gap-5">
                            <!-- Brand Name -->
                            <div class="w-full">
                                <label for="name"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Brand Name <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" placeholder="e.g., Samsung, Dell, Apple"
                                    value="{{ old('name', $brand->name) }}"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                @error('name')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                                @error('slug')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>

                                @enderror
                            </div>

                            <!-- choose status -->
                            <div class="w-full">
                                <label for="color_id"
                                    class="mb-4 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Status <span class="text-rose-500">*</span>
                                </label>

                                <div class="flex gap-3 items-center text-white">
                                    <div class="first flex gap-3 items-center">
                                        <input type="radio" id="active" name="status" value="1" {{ $brand->is_active == 1 ? 'checked' : ''}}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="active">Active</label>
                                    </div>

                                    <div class="first flex gap-3 items-center">
                                        <input type="radio" name="status" id="non-active" value="0" {{ $brand->is_active == 0 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="non-active">Not Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Form Actions -->
            <div
                class="flex items-center justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50 sm:px-8">
                <a href="{{ route('brands.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Update
                </button>
            </div>

            </x-form>
        </div>

    </div>
    </div>
</x-admin.app-layout>