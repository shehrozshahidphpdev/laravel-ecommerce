<x-admin.app-layout title="admin - create category">
  <div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
      {{-- FORM HEADER --}}
      <x-admin.form-header title="Create Specifications" text="Add a new Specifications for products"
        backpath="specifications.index" />
      <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
        <x-form action="{{ route('specifications.update', $label->id) }}" method="PUT">
          <div class="space-y-6 p-6 sm:p-8">
            <!-- Color Name -->
            <div class="w-full">
              <label for="name" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                Specification Label <span class="text-rose-500">*</span>
              </label>
              <div class="flex flex-row gap-5 mb-5 label-element">
                <div class="input-elment w-full">
                  <input type="text" id="label" name="label[]" value="{{ old('label', $label->label) }}"
                    placeholder="e.g., Processor, Cpu, Gpu, Ram"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                  @error('label')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <!-- Form Actions -->
    <div
      class="flex items-center justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50 sm:px-8">
      <a href="{{ route('specifications.index') }}"
        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        Cancel
      </a>
      <button type="submit"
        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-600">
        Create
      </button>
    </div>

    </x-form>
  </div>

  </div>
  </div>
</x-admin.app-layout>