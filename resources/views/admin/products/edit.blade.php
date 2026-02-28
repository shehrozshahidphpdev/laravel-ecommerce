<x-admin.app-layout title="admin - create category">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <!-- Page Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 bg-white text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Product</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Edit product to your store</p>
                    </div>
                </div>
            </div>
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <x-form action="{{ route('products.update', $product->id) }}" method="PUT" :media="true">
                    <div class="space-y-6 p-6 sm:p-8">
                        <div class="flex flex-row gap-5">
                            <!-- Category Name -->
                            <div class="w-full">
                                <label for="name"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Product Category <span class="text-rose-500">*</span>
                                </label>
                                <select name="category_id" id="category_id"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                                    <option value="" selected>--- Please Choose a Category ---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- product Slug -->
                            <div class="w-full">
                                <label for="slug"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Slug <span class="text-gray-400 text-xs font-normal">(Optional)</span>
                                </label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) ?? $product->slug }}"
                                    placeholder="e.g., mouse, cap, towel"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">URL-friendly version
                                    (auto-generated if left
                                    empty)</p>
                                @error('slug')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- product name --}}
                        <div class="product-name">
                            <label for="name" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Product Name <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name )}}"
                                placeholder="Iphone 17 Pro Max"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                            @error('name')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- short description --}}
                        <div class="">
                            <label for="name" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Short Description <span class="text-rose-500">*</span><span
                                    class="text-xs dark:text-gray-400">(dont exceed 100 words)</span>
                            </label>
                            <input type="text" id="short_description" name="short_description"
                                value="{{ old('short_description', $product->short_description)  }}"
                                placeholder="lorem impsum doler sit amet..."
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                            @error('short_description')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- deyailed description --}}
                        <div class="w-full">
                            <label for="description"
                                class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Description <span class="text-rose-500">*</span> <span
                                    class="text-xs dark:text-gray-400">(dont exceed 300 words)</span>
                            </label>
                            <textarea name="description" id="myeditorinstance" rows="8"
                                placeholder="Enter product description..." class="dark:bg-gray-800 w-full rounded-lg border border-gray-300 dark:border-gray-700 
                                bg-white
                                px-4 py-3 text-sm text-gray-900 dark:text-white 
                                placeholder-gray-400 dark:placeholder-gray-500
                                shadow-sm 
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 
                                outline-none transition-all duration-200 resize-none">
                                {!! old('description', $product->description) !!}
                             </textarea>

                            @error('description')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                     <!-- Product Images -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Product Image <span class="text-red-600 text-xs font-normal">*</span>
                            </label>

                            <!-- Preview Grid (existing + new images show here) -->
                            <div id="imagePreview" class="{{ $productImages->isNotEmpty() ? 'flex' : 'hidden' }} flex-wrap gap-3 mb-3">

                                {{-- Existing images from DB --}}
                                @foreach ($productImages as $image)
                                    <div class="relative w-24 h-24 rounded-xl overflow-hidden border-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 shadow-sm group flex-shrink-0"
                                        data-existing-id="{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="w-full h-full object-cover" />
                                        {{-- Hidden input so this ID gets submitted with the form --}}
                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}" />
                                        <button type="button"
                                            class="remove-btn absolute top-1 right-1 w-5 h-5 rounded-full bg-red-500 hover:bg-red-600 text-white text-xs font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer z-10">
                                            &times;
                                        </button> 
                                    </div>
                                @endforeach

                            </div>

                            <!-- Upload Area -->
                            <label for="image"
                                class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-black bg-gray-50 px-6 py-12 transition-colors hover:border-gray-400 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800/50 dark:hover:border-gray-500 dark:hover:bg-gray-800">
                                <svg class="mb-3 h-10 w-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <span class="text-blue-600 dark:text-blue-400">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP up to 5MB — max 8 images</p>
                                <input type="file" id="image" name="images[]" accept="image/*" class="hidden" multiple />
                            </label>

                            @error('images')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- prices section --}}
                        {{-- original price --}}
                        <div class="flex flex-row gap-5">
                            <div class="w-full">
                                <label for="name"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Original Price <span class="text-rose-500">*</span>
                                </label>
                                <input type="number" id="original_price" name="original_price"
                                    value="{{ old('original_price', $product->original_price)  }}"
                                    placeholder="e.g., $1000.00"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                @error('original_price')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- discounted price --}}

                            <div class="w-full">
                                <label for="discounted_price"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Discounted Price (optional)
                                </label>

                                <input type="number" id="discounted_price" name="discounted_price"
                                    value="{{ old('discounted_price', $product->discounted_price) }}"
                                    placeholder="e.g., $1000.00"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                @error('discounted_price')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row gap-5">
                            {{-- product tag --}}
                            <div class="w-full">
                                <label for="tag" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Product Tag (optional)
                                </label>
                                <select name="tag_id" id="tag_id"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                                    <option value="" selected>--- Please Select a Tag ---</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" @selected(old('tag_id', $tag->id == $product->tag_id))>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tag_id')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- sku --}}
                        <div class="w-full">
                            <label for="sku" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                SKU
                            </label>
                            <input type="text" id="sku" name="sku" placeholder="e.g. LAPT-MAC-16-GRY"
                                value="{{ old('sku', $product->sku)}}"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                            @error('sku')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-row gap-5">
                            <div class="w-full">
                                {{-- quantity --}}
                                <label for="quantity"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Quantity <span class="text-red-600">*</span>
                                </label>
                                <input type="number" id="quantity" name="quantity" placeholder="e.g. 10"
                                    value="{{ old('quantity', $product->quantity) }}"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                                @error('quantity')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="brand_id"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Brand <span class="text-red-600">*</span>
                                </label>
                                <select name="brand_id" id="brand_id"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                                    <option value="" selected>--- Please Select a Brand ---</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @selected($brand->id == $product->brand_id)>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row justify-around text-white">
                            {{-- status --}}
                            <div class="status">
                                <label for="tatu"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Status
                                </label>
                                <div class="flex flex-row gap-5">
                                    <div class="flex items-center mb-4">
                                        <input id="active" type="radio" value="1" name="status"
                                            @checked(old('status', $product->is_active) == 1)
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="active"
                                            class="select-none ms-2 text-sm font-medium text-heading">Active</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="non-active" type="radio" value="0" name="status"
                                            @checked(old('status', $product->is_active) == 0)
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="non-active"
                                            class="select-none ms-2 text-sm font-medium text-heading">Non Active</label>
                                    </div>
                                </div>
                                @error('status')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="featured">
                                <label for="featured"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Featured
                                </label>
                                <div class="flex flex-row gap-5">
                                    <div class="flex items-center mb-4">
                                        <input id="featured" type="radio" value="1" name="featured"
                                            @checked(old('featured', $product->is_featured) == 1)
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="featured"
                                            class="select-none ms-2 text-sm font-medium text-heading">Yes</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="not-featured" type="radio" value="0" name="featured"
                                            @checked(old('featured', $product->is_featured) == 0)
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="not-featured"
                                            class="select-none ms-2 text-sm font-medium text-heading">No</label>
                                    </div>
                                </div>
                                @error('featured')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sale">
                                <label for="sale"
                                    class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                    Sale
                                </label>
                                <div class="flex flex-row gap-5">
                                    <div class="flex items-center mb-4">
                                        <input id="on-sale" type="radio" value="1" name="sale"
                                            @checked(old('sale', $product->on_sale) == 1)
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="on-sale"
                                            class="select-none ms-2 text-sm font-medium text-heading">Yes</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="no-sale" type="radio" value="0" name="sale"
                                        @checked(old('sale', $product->on_sale) == 0)
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="no-sale"
                                            class="select-none ms-2 text-sm font-medium text-heading">No</label>
                                    </div>
                                </div>
                                @error('sale')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Form Actions -->
            <div
                class="flex items-center justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50 sm:px-8">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Save Changes
                </button>
            </div>

            </x-form>
        </div>

    </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

        const input            = document.getElementById('image');
        const previewContainer = document.getElementById('imagePreview');

        // Track newly added files only
        let selectedFiles = [];

        // ─── Remove button for EXISTING images (from DB) ─────────────────────────
        // We use event delegation so it works on dynamically added tiles too
        previewContainer.addEventListener('click', function (e) {
            const btn = e.target.closest('.remove-btn');
            if (!btn) return;

            const box = btn.closest('[data-existing-id]');
            if (box) {
                // Remove the hidden input so this ID is NOT sent on submit
                // meaning the controller will know this image was removed
                box.remove();
                updatePreviewVisibility();
            }
        });

        // ─── When the user picks NEW files ───────────────────────────────────────
        input.addEventListener('change', function () {

            const pickedFiles = Array.from(this.files);

            // Count existing visible tiles (DB images not yet removed)
            const totalCurrent = previewContainer.querySelectorAll('[data-existing-id], [data-new-file]').length;

            pickedFiles.forEach(function (file) {

                // Total tile count check (existing + new combined)
                const currentTotal = previewContainer.querySelectorAll('[data-existing-id], [data-new-file]').length;
                if (currentTotal >= 8) {
                    alert('You can only have up to 8 images total.');
                    return;
                }

                // Skip duplicates
                const alreadyAdded = selectedFiles.some(function (f) {
                    return f.name === file.name && f.size === file.size;
                });
                if (alreadyAdded) return;

                // Skip files bigger than 5 MB
                if (file.size > 5 * 1024 * 1024) {
                    alert(file.name + ' is larger than 5MB and was skipped.');
                    return;
                }

                selectedFiles.push(file);
                showNewPreview(file);
            });

            syncFilesToInput();
            updatePreviewVisibility();
        });

        // ─── Show/hide preview container ─────────────────────────────────────────
        function updatePreviewVisibility() {
            const hasTiles = previewContainer.querySelectorAll('[data-existing-id], [data-new-file]').length > 0;
            if (hasTiles) {
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            } else {
                previewContainer.classList.remove('flex');
                previewContainer.classList.add('hidden');
            }
        }

        // ─── Sync new files array → file input ───────────────────────────────────
        function syncFilesToInput() {
            try {
                const dt = new DataTransfer();
                selectedFiles.forEach(function (f) { dt.items.add(f); });
                input.files = dt.files;
            } catch (e) {
                console.error('DataTransfer sync failed:', e);
            }
        }

        // ─── Build preview tile for a NEW file ───────────────────────────────────
        function showNewPreview(file) {

            const reader = new FileReader();

            reader.onload = function (event) {

                const box = document.createElement('div');
                box.className = 'relative w-24 h-24 rounded-xl overflow-hidden border-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 shadow-sm group flex-shrink-0';
                box.dataset.newFile = file.name; // marks this as a new (not DB) tile

                const img = document.createElement('img');
                img.src       = event.target.result;
                img.alt       = file.name;
                img.className = 'w-full h-full object-cover';

                const removeBtn = document.createElement('button');
                removeBtn.type      = 'button';
                removeBtn.innerHTML = '&times;';
                removeBtn.className = 'remove-btn absolute top-1 right-1 w-5 h-5 rounded-full bg-red-500 hover:bg-red-600 text-white text-xs font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer z-10';

                removeBtn.addEventListener('click', function () {
                    selectedFiles = selectedFiles.filter(function (f) {
                        return !(f.name === file.name && f.size === file.size);
                    });
                    box.remove();
                    syncFilesToInput();
                    updatePreviewVisibility();
                });

                box.appendChild(img);
                box.appendChild(removeBtn);
                previewContainer.appendChild(box);
            };

            reader.readAsDataURL(file);
        }

        // ─── Sync on submit as safety net ────────────────────────────────────────
        const form = input.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                syncFilesToInput();
            });
        }

    });     
        </script>
    @endpush
</x-admin.app-layout>