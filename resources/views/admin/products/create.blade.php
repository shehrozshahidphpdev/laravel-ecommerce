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
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Products</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new product to your store</p>
                    </div>
                </div>
            </div>
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <x-form action="{{ route('products.store') }}">
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
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
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="Iphone 17 Pro Max"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                            @error('name')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- short description --}}
                        <div class="">
                            <label for="name" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Short Description <span class="text-rose-500">*</span><span class="text-xs dark:text-gray-400">(dont exceed 100 words)</span>  
                            </label>
                            <input type="text" id="short_description" name="short_description"
                                value="{{ old('short_description') }}" placeholder="lorem impsum doler sit amet..."
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20" />
                            @error('short_description')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- deyailed description --}}
                        <div class="w-full">
                            <label for="description"
                                class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Description <span class="text-rose-500">*</span> <span class="text-xs dark:text-gray-400">(dont exceed 300 words)</span>  
                            </label>
                            <textarea name="description" id="myeditorinstance" rows="8"
                                placeholder="Enter product description..." class="dark:bg-gray-800 w-full rounded-lg border border-gray-300 dark:border-gray-700 
                                bg-white
                                px-4 py-3 text-sm text-gray-900 dark:text-white 
                                placeholder-gray-400 dark:placeholder-gray-500
                                shadow-sm 
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 
                                outline-none transition-all duration-200 resize-none">
                                {{ old('description') }}
                             </textarea>

                            @error('description')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">
                                    {{ $message }}
                                </p>
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
                                <input type="number" id="original_price" name="original_price" value="{{ old('original_price') }}"
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

                                <input type="number" id="discounted_price" name="discounted_price"    value="{{ old('discounted_price') }}"
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
                                        <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>
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
                                value="{{ old('sku') }}"
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
                                    value="{{ old('quantity') }}"
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
                                            <option value="{{ $brand->id }}">
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
                                            value="{{ old('status') == 1 ? 'selected' : '' }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="active"
                                            class="select-none ms-2 text-sm font-medium text-heading">Active</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="non-active" type="radio" value="0" name="status"
                                            value="{{ old('status') == 0 ? 'selected' : '' }}"
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
                                            value="{{ old('featured') == 1 ? 'selected' : '' }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="featured"
                                            class="select-none ms-2 text-sm font-medium text-heading">Yes</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="not-featured" type="radio" value="0" name="featured"
                                            value="{{ old('featured') == 0 ? 'selected' : '' }}"
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
                                            value="{{ old('sale') == 0 ? 'selected' : '' }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="on-sale"
                                            class="select-none ms-2 text-sm font-medium text-heading">Yes</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="no-sale" type="radio" value="0" name="sale"
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
                <a href="{{ route('categories.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Create Category
                </button>
            </div>

            </x-form>
        </div>

    </div>
    </div>
</x-admin.app-layout>