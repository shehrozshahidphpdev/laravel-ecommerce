<x-admin.app-layout title="admin - create category">
  <div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
      <!-- Page Header -->
      <div class="mb-6">
        <div class="flex items-center gap-3">
          <a href="{{ route('colors.index') }}"
            class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 bg-white text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </a>
          <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Colors</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new colors for products</p>
          </div>
        </div>
      </div>
      <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
        <x-form action="{{ route('colors.store') }}" :media="true">
          <div class="space-y-6 p-6 sm:p-8">
            <div class="flex flex-row gap-5">
              <!-- Color Name -->
              <div class="w-full">
                <label for="name" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                  Color Name <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="color" name="color" placeholder="e.g., Yellow, Blue, Orange"
                  class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                @error('color')
                  <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
              </div>

              <!-- Category Slug -->
              <div class="w-full">
                <label for="slug" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                  Choose Color <span class="text-rose-500">*</span>
                </label>
                <div class="" id="color-picker"></div>
                <input type="hidden" id="hex_code" name="hex_code"
                  class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                @error('hex_code')
                  <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
      </div>

      <!-- Form Actions -->
      <div
        class="flex items-center justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50 sm:px-8">
        <a href="{{ route('colors.index') }}"
          class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
          Cancel
        </a>
        <button type="submit"
          class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-600">
          Create Colors
        </button>
      </div>

      </x-form>
    </div>

  </div>
  </div>
  @push('script')
    <script>
      const pickr = Pickr.create({
        el: '#color-picker',
        theme: 'classic',

        default: '#ff0000',

        components: {
          preview: true,
          opacity: false,
          hue: true,

          interaction: {
            hex: true,
            input: true,
            save: true
          }
        }
      });

      // When admin selects color
      pickr.on('save', (color) => {
        const hexColor = color.toHEXA().toString();
        document.getElementById('hex_code').value = hexColor;
        pickr.hide();
      });
    </script>

  @endpush
</x-admin.app-layout>