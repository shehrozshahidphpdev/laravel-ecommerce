<x-admin.app-layout title="admin - categories">
  <div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">

      <!-- Header Section -->
      <div class="border-b border-gray-200 bg-white px-6 py-4 dark:border-gray-700 dark:bg-gray-900">
        <div class="flex flex-row gap-4 justify-between items-center">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Products
            </h3>
          </div>
          <x-admin.admin-search-input />
          <a href="{{ route('products.create') }}" class="
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
          </a>
        </div>

      </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <table class="w-full text-sm">
        <thead>
          <tr class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-10">
              #</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Category</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Tag</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Brand</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Product Name</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Short Desc</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Description</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Orig. Price</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Disc. Price</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              SKU</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Qty</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Sale</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Status</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Featured</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Views</th>
            <th
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
              Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-100 dark:divide-gray-700 table-body">
          @foreach($products as $product)
            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-800/50">

              <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium">{{ $product->id }}</td>

              <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->category->name }}</td>

              <td class="px-4 py-3">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">
                  {{ $product->tag->name }}
                </span>
              </td>

              <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->brand->name }}</td>

              <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">{{ $product->name }}</td>

              <td class="px-4 py-3 text-gray-500 dark:text-gray-400 max-w-[160px] truncate">
                {{ Str::limit($product->short_description, 30, '...') ?? 'N/A' }}
              </td>

              <td class="px-4 py-3 text-gray-500 dark:text-gray-400 max-w-[160px] truncate">
                {{ Str::limit(strip_tags($product->description), 30, '...') ?? 'N/A' }}
              </td>

              <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">{{ $product->original_price }}</td>

              <td class="px-4 py-3 font-medium text-emerald-600 dark:text-emerald-400">
                {{ $product->discounted_price ?? '—' }}
              </td>

              <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $product->sku ?? 'N/A' }}</td>

              <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->quantity ?? 'N/A' }}</td>

              <td class="px-4 py-3">
                @if($product->on_sale)
                  <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400">
                    Sale
                  </span>
                @else
                  <span class="text-gray-400 dark:text-gray-600">—</span>
                @endif
              </td>

              <td class="px-4 py-3">
                @if($product->is_active == '1')
                  <span
                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                  </span>
                @else
                  <span
                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Inactive
                  </span>
                @endif
              </td>

              <td class="px-4 py-3">
                @if($product->is_featured)
                  <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-400">
                    Featured
                  </span>
                @else
                  <span class="text-gray-400 dark:text-gray-600">—</span>
                @endif
              </td>

              <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ number_format($product->views_count) }}</td>

              {{-- Actions --}}
              <td class="px-4 py-3">
                <div class="flex items-center gap-1.5">

                  {{-- Delete --}}
                  <x-form action="{{ route('products.destroy', $product->id) }}" method="DELETE">
                    <button type="submit" title="delete"
                      onclick="return confirm('Are you sure you want to delete the record')"
                      class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-red-50 hover:border-red-300 hover:text-red-600 dark:hover:bg-red-500/10 dark:hover:border-red-500/40 dark:hover:text-red-400 transition-colors duration-150">
                      <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z" />
                      </svg>
                    </button>
                  </x-form>

                  {{-- Edit --}}
                  <a href="{{ route('products.edit', $product->id) }}" title="edit"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-blue-50 hover:border-blue-300 hover:text-blue-600 dark:hover:bg-blue-500/10 dark:hover:border-blue-500/40 dark:hover:text-blue-400 transition-colors duration-150">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.8463 2.14645C15.0416 1.95118 15.3582 1.95118 15.5534 2.14645L17.8536 4.44661C18.0488 4.64187 18.0488 4.95845 17.8536 5.15371L7.56066 15.4466C7.46788 15.5394 7.35195 15.6033 7.2242 15.6318L3.7242 16.3818C3.55327 16.419 3.3749 16.3666 3.25264 16.2444C3.13037 16.1221 3.07799 15.9437 3.11518 15.7728L3.86518 12.2728C3.89372 12.145 3.95761 12.0291 4.05039 11.9363L14.8463 2.14645ZM14.1392 3.56066L5.06066 12.6392L4.56066 14.9392L6.86066 14.4392L15.9392 5.36066L14.1392 3.56066Z" />
                    </svg>
                  </a>

                  {{-- Show --}}
                  <a href="{{ route('products.show', $product->id) }}" title="show"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-600 dark:hover:bg-emerald-500/10 dark:hover:border-emerald-500/40 dark:hover:text-emerald-400 transition-colors duration-150">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm0-2.5A1.5 1.5 0 1 0 10 8a1.5 1.5 0 0 0 0 3Z" />
                    </svg>
                  </a>

                </div>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="pagination mt-3">
    {{ $products->links() }}
  </div>
  </div>
  @push('script')
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        const searchInput = document.querySelector('.search-input');
        const tableBody = document.querySelector('.table-body');
        const paginationContainer = document.querySelector('.pagination');

        const originalTableHTML = tableBody.innerHTML;
        const originalPaginationHTML = paginationContainer.innerHTML;


        searchInput.addEventListener('keyup', function () {
          const searchText = searchInput.value;
          console.log(searchText);

          if (searchText.length < 2) {
            // Restore original table and pagination
            tableBody.innerHTML = originalTableHTML;
            paginationContainer.innerHTML = originalPaginationHTML;
            return;
          }

          let row = "";

          fetch("{{ route('categories.search') }}", {
            method: 'post',
            headers: {
              'X-CSRF-TOKEN': token,
              'Content-Type': 'application/json',
              'Accept': 'application/json',
            },
            body: JSON.stringify({
              search: searchText
            })
          })
            .then(response => {
              if (!response.ok) {
                throw new Error("Network response was not ok");
              }
              return response.json();
            })
            .then(data => {
              console.log(data);
              if (data.categories && data.categories.length > 0) {
                data.categories.forEach(category => {
                  let parentCategory = category.parent_id ? category.parent_id : 'N/A';
                  let categoryImage = category.image
                    ? `/storage/${category.image}`
                    : '/assets/photos/No_Image_Available.jpg';
                  let categoryIcon = category.category_icon
                    ? `/storage/${category.category_icon}`
                    : '/assets/photos/No_Image_Available.jpg';

                  // Fixed: Proper tags handling
                  let tags = category.tags
                    ? (Array.isArray(category.tags) ? category.tags.join(',') : category.tags)
                    : 'N/A';
                  let tagsDisplay = tags.length > 20 ? tags.substring(0, 20) + '...' : tags;

                  row += `
                                                                                                                                              <tr class="transition-colors dark:hover:bg-gray-800/40">
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <span class="text-sm text-gray-700 dark:text-gray-300">${category.id}</span>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <span class="text-sm text-gray-700 dark:text-gray-300">${category.name}</span>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <span class="text-sm text-gray-700 dark:text-gray-300">${category.slug}</span>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <span class="text-sm text-gray-700 dark:text-gray-300">${parentCategory}</span>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
                                                                                                                                                    <img src="${categoryImage}" alt="category image" class="h-full w-full object-cover" />
                                                                                                                                                  </div>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
                                                                                                                                                    <img src="${categoryIcon}" alt="category icon" class="h-full w-full object-cover" />
                                                                                                                                                  </div>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4 overflow-hidden">
                                                                                                                                                  <span class="text-sm text-gray-700 dark:text-gray-300">${tagsDisplay}</span>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                  <div class="flex flex-row gap-2">
                                                                                                                                                    <form action="categories/${category.id}" method="POST">
                                                                                                                                                      <input type="hidden" name="_token" value="${token}">
                                                                                                                                                      <input type="hidden" name="_method" value="DELETE">
                                                                                                                                                      <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-red-800 dark:bg-red-500/20 dark:text-emerald-400">
                                                                                                                                                        <button type="submit">
                                                                                                                                                          <svg class="cursor-pointer hover:fill-error-500 dark:hover:fill-error-500 fill-gray-700 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z" fill=""></path>
                                                                                                                                                          </svg>
                                                                                                                                                        </button>
                                                                                                                                                      </span>
                                                                                                                                                    </form>
                                                                                                                                                    <a href="categories/${category.id}/edit">
                                                                                                                                                      <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-sky-800 dark:bg-sky-500/20 dark:text-sky-400">
                                                                                                                                                        <svg class="cursor-pointer hover:fill-primary-500 dark:hover:fill-primary-500 fill-gray-700 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8463 2.14645C15.0416 1.95118 15.3582 1.95118 15.5534 2.14645L17.8536 4.44661C18.0488 4.64187 18.0488 4.95845 17.8536 5.15371L7.56066 15.4466C7.46788 15.5394 7.35195 15.6033 7.2242 15.6318L3.7242 16.3818C3.55327 16.419 3.3749 16.3666 3.25264 16.2444C3.13037 16.1221 3.07799 15.9437 3.11518 15.7728L3.86518 12.2728C3.89372 12.145 3.95761 12.0291 4.05039 11.9363L14.8463 2.14645ZM14.1392 3.56066L5.06066 12.6392L4.56066 14.9392L6.86066 14.4392L15.9392 5.36066L14.1392 3.56066Z" fill="currentColor" />
                                                                                                                                                        </svg>
                                                                                                                                                      </span>
                                                                                                                                                    </a>
                                                                                                                                                  </div>
                                                                                                                                                </td>
                                                                                                                                              </tr>
                                                                                                                                            `;
                });
              } else {
                row = `<tr><td colspan="8" class="px-6 py-4 text-center text-gray-500">No categories found</td></tr>`;
              }

              tableBody.innerHTML = row;
            })
            .catch(error => {
              console.log(error);
            });
        });
      });
    </script>
  @endpush

</x-admin.app-layout>