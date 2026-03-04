<x-admin.app-layout title="admin - categories">
  <div class="px-4 py-6 sm:px-6 lg:px-4 space-y-6">

    {{-- Header Card --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
      <div class="px-6 py-4 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
          Product Details
        </h3>

        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-lg border px-4 py-2 text-sm font-medium
                  bg-white text-gray-700 border-gray-300 hover:bg-gray-100
                  dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 transition">
          Back
        </a>
      </div>
    </div>

    {{-- Product Info --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900 p-6">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Product Info
      </h2>

      <div class="space-y-2 text-sm">
        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Product Name:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->name }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">SLug:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->slug }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">SKU:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->sku ?? 'N/A' }}
          </span>
        </p>


        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Brand:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->brand->name ?? 'N/A' }}
          </span>
        </p>


        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Category:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->category->name ?? '-' }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Views:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->views_count  }}
          </span>
        </p>


        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Quantity:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->quantity  }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Status:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->is_active == 1 ? 'Active' : 'Not Active'  }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Featured:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->is_active == 1 ? 'Featured' : 'Not Featured'  }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Sale:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->is_active == 1 ? 'Yes' : 'No'  }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Deal:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->deal_of_the_day == 1 ? 'Yes' : 'No'  }}
          </span>
        </p>

        <p class="mb-2">
          <span class="text-gray-500 dark:text-gray-400">Deal Expired At:</span>
          <span class="font-medium text-gray-900 dark:text-white">
            {{ $product->deal_expiration_date ? $product->deal_expiration_date->format('d M Y H:i A') : 'N/A' }}
          </span>
        </p>

        <p>
          <span class="text-gray-500 dark:text-gray-400">Tag:</span>
          <span
            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">
            {{ $product->tag->name ?? "No Tag Available"}}
          </span>
        </p>

        <p>
          <span class="text-gray-500 dark:text-gray-400">Created At:</span>
          <span
            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium  text-blue-700 dark:text-blue-400">
            {{ $product->created_at }}
          </span>
        </p>

        <p>
          <span class="text-gray-500 dark:text-gray-400">Updated At:</span>
          <span
            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium  text-blue-700 dark:text-blue-400">
            {{ $product->updated_at }}
          </span>
        </p>


      </div>
    </div>

    {{-- Description --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900 p-6">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Description
      </h2>

      <div class="space-y-3 text-sm">
        <div>
          <span class="text-gray-500 dark:text-gray-400">Short Description:</span>
          <p class="text-gray-800 dark:text-gray-300 mt-1">
            {{ $product->short_description ?? '-' }}
          </p>
        </div>

        <div>
          <span class="text-gray-500 dark:text-gray-400">Full Description:</span>
          <div class="text-gray-800 dark:text-gray-300 mt-1 leading-relaxed">
            {!! $product->description !!}
          </div>
        </div>
      </div>
    </div>


    {{-- Product Images --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900 p-6">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Iamges
      </h2>

      <div class="space-y-3 flex items-center">
        @foreach ($product->images as $image)
          <div class="image rounded-lg border border-gray-500 overflow-hidden h-40 w-40">
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image">
          </div>
        @endforeach
      </div>
    </div>

    {{-- Prices --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900 p-6">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Prices
      </h2>

      <div class="space-y-3 text-sm">
        <div>
          <span class="text-gray-500 dark:text-gray-400">Original Price:</span>
          <p class="text-lg font-semibold text-gray-900 dark:text-white">
            ${{ number_format($product->original_price, 2) }}
          </p>
        </div>

        <div>
          <span class="text-gray-500 dark:text-gray-400">Discounted Price:</span>
          <p class="text-lg font-semibold text-emerald-600">
            ${{ number_format($product->discounted_price, 2) ?? '-' }}
          </p>
        </div>
      </div>
    </div>

  </div>
</x-admin.app-layout>