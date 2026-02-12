<x-admin.app-layout title="admin - create category">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <!-- Page Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <a href="{{ route('categories.index') }}"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 bg-white text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Category</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new category to your store</p>
                    </div>
                </div>
            </div>
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <x-form action="{{ route('categories.update', $category->id) }}" :media="true" method="PUT">
                    <div class="space-y-6 p-6 sm:p-8">

                        <!-- Category Name -->
                        <div class="flex flex-row gap-5">

                            <div class="w-full">
                                <label for="name"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Category Name <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" placeholder="e.g., Electronics, Clothing, Food"
                                    value="{{ old('name', $category->name) }}"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                @error('name')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category Slug -->
                            <div class="w-full">
                                <label for="slug"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Slug <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                                </label>
                                <input type="text" id="slug" name="slug" placeholder="e.g., electronics, clothing, food"
                                    value="{{ old('slug', $category->slug) }}"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">URL-friendly version
                                    (auto-generated if left
                                    empty)</p>
                                @error('slug')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <!-- Category Image -->
                        <div>
                            <label for="image" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Category Image <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                            </label>
                            <div class="flex items-start gap-4">
                                <!-- Image Preview -->
                                <div id="imagePreview"
                                    class="relative @if(!isset($category->image))
                                        hidden
                                    @endif h-24 w-24 flex-shrink-0  rounded-lg border-2 border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
                                    <img id="previewImg" src="@if(isset($category->image))
                                        {{ asset('storage/' . $category->image) }}
                                    @endif" alt="Preview" class="h-full w-full object-cover" />
                                    <span class="remove-image absolute -top-2 -right-2 w-6 h-6 flex items-center justify-center 
                  bg-red-500 text-white text-sm font-bold 
                  rounded-full cursor-pointer 
                  hover:bg-red-600 transition duration-200 z-50">
                                        ×
                                    </span>
                                </div>

                                <!-- Upload Area -->
                                <div class="flex-1">
                                    <label for="image"
                                        class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-black bg-gray-50 px-6 py-12 transition-colors hover:border-gray-400 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800/50 dark:hover:border-gray-500 dark:hover:bg-gray-800">
                                        <svg class="mb-3 h-10 w-10 text-gray-400 dark:text-gray-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <span class="text-blue-600 dark:text-blue-400">Click to upload</span> or
                                            drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP up to 5MB</p>
                                        <input type="file" id="image" name="image" accept="image/*" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- category icon --}}
                        <div>
                            <label for="icon" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Category Icon <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                            </label>
                            <div class="flex items-start gap-4">
                                <!-- Icon Preview -->
                                <div id="iconPreview"
                                    class="relative @if(!isset($category->category_icon))
                                        hidden    
                                    @endif h-24 w-24 flex-shrink-0  rounded-lg border-2 border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
                                    <img id="previewIcon" src="@if(isset($category->category_icon))
                                        {{ asset('storage/' . $category->category_icon) }}    
                                    @endif" alt="Preview" class="h-full w-full object-cover" />
                                    <span class="remove-icon absolute -top-2 -right-2 w-6 h-6 flex items-center justify-center 
                        bg-red-500 text-white text-sm font-bold 
                        rounded-full cursor-pointer 
                        hover:bg-red-600 transition duration-200 z-50">
                                        ×
                                    </span>
                                </div>

                                <!-- Upload Area -->
                                <div class="flex-1">
                                    <label for="icon"
                                        class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 px-6 py-12 transition-colors hover:border-gray-400 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800/50 dark:hover:border-gray-500 dark:hover:bg-gray-800">
                                        <svg class="mb-3 h-10 w-10 text-gray-400 dark:text-gray-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <span class="text-blue-600 dark:text-blue-400">Click to upload</span> or
                                            drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP up to 5MB</p>
                                        <input type="file" id="icon" name="icon" accept="image/*" class="hidden" />
                                    </label>
                                </div>
                            </div>
                            @error('icon')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Parent Category -->
                        <div>
                            <label for="parent_id"
                                class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Parent Category <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                            </label>
                            <select id="parent_id" name="parent_id"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                                <option selected disabled>None (Top Level Category)</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class=" mt-1.5 text-xs text-gray-500 dark:text-gray-400">Select a parent to create a
                                subcategory</p>
                            @error('parent_id')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{--additional tags --}}
                        <div class="additional-tags">
                            <label for="parent_id"
                                class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Category tags <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                            </label>
                            @foreach($category->tags as $key => $value)
                                @if($key < 1)
                                    <div class="flex flex-row gap-x-5 mb-2">
                                        <input type="text" name="tags[]" value="{{ old('tags', $value) }}"
                                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                            placeholder="e.g trending, top rated, best selling" />
                                        <button
                                            class="
                                                                                                                                                                                                                                                                                                                                                                    add-tag
                                                                                                                                                                                                                                                                                                                                                                      inline-flex items-center gap-2
                                                                                                                                                                                                                                                                                                                                                                      rounded-lg border px-4 py-2.5 text-sm font-medium
                                                                                                                                                                                                                                                                                                                                                                      shadow-sm transition-colors

                                                                                                                                                                                                                                                                                                                                                                      /* Light mode */
                                                                                                                                                                                                                                                                                                                                                                      bg-white text-gray-700 border-gray-300 hover:bg-gray-100

                                                                                                                                                                                                                                                                                                                                                                      /* Dark mode */
                                                                                                                                                                                                                                                                                                                                                                      dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600
                                                                                                                                                                                                                                                                                                                                                                      dark:hover:bg-gray-700
                                                                                                                                                                                                                                                                                                                                                                     ">
                                            +
                                        </button>
                                    </div>
                                @else
                                    <div class="flex flex-row gap-x-5 mb-2 tag-element">
                                        <input type="text" name="tags[]" value="{{ old('tags', $value) }}"
                                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                                            placeholder="e.g trending, top rated, best selling" />
                                        <button
                                            class="remove-tag inline-flex items-center gap-2 rounded-lg border px-4 py-2.5 text-sm font-medium shadow-sm transition-colors bg-white text-gray-700 border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">-</button>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="flex items-center justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50 sm:px-8">
                        <a href="{{ route('categories.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Update Category
                        </button>
                    </div>

                </x-form>
            </div>

        </div>
    </div>
    <script>
        const imageInput = document.getElementById('image');
        const imagePreviewContainer = document.getElementById('imagePreview');
        const imagePreviewImg = document.getElementById('previewImg');
        const removeImageBtn = document.querySelector('.remove-image');

        imageInput.addEventListener('change', function (event) {
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreviewImg.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(imageInput.files[0]);
            }
        });

        const iconInput = document.getElementById('icon');
        const iconPreviewContainer = document.getElementById('iconPreview');
        const iconPreviewImg = document.getElementById('previewIcon');
        const removeIconBtn = document.querySelector('.remove-icon');

        iconInput.addEventListener('change', function (event) {
            if (iconInput.files && iconInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    iconPreviewImg.src = e.target.result;
                    iconPreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(iconInput.files[0]);
            }
        });

        removeImageBtn.addEventListener('click', function () {
            imagePreviewContainer.classList.add('hidden');
            imagePreviewImg.src = '';
            imageInput.value = '';
        });

        removeIconBtn.addEventListener('click', function () {
            iconPreviewContainer.classList.add('hidden');
            iconPreviewImg.src = '';
            iconInput.value = '';
        });

        $(document).ready(function () {
            $('.add-tag').on('click', function (e) {
                e.preventDefault();
                $('.additional-tags').append(`
      <div class="flex flex-row gap-x-5 mb-2 tag-element">
        <input type="text" name="tags[]" class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" placeholder="e.g trending, top rated, best selling" />
        <button class="remove-tag inline-flex items-center gap-2 rounded-lg border px-4 py-2.5 text-sm font-medium shadow-sm transition-colors bg-white text-gray-700 border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">-</button>
      </div>
    `);
            });

            $(document).on('click', '.remove-tag', function (e) {
                e.preventDefault();
                $(this).closest('.tag-element').remove();
            });
        });
    </script>

</x-admin.app-layout>