<x-admin.app-layout title="admin - categories">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">

            <!-- Header Section -->
            <div class="border-b border-gray-200 bg-white px-6 py-4 dark:border-gray-700 dark:bg-gray-900">
                <div class="flex flex-row gap-4 justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Brands
                        </h3>
                    </div>
                    <x-admin.admin-search-input />
                    <a href="{{ route('brands.create') }}" class="
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
        <div class="overflow-x-auto">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50/50 dark:border-gray-700 dark:bg-gray-800/50">
                        <th
                            class="w-1/6 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-400">
                            #
                        </th>
                        <th
                            class="w-1/6 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-400">
                            Brand Name
                        </th>
                        <th
                            class="w-1/6 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-400">
                            status
                        </th>
                        <th
                            class="w-1/6 px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-400">
                            Actions
                        </th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-100 dark:bg-gray-900">
                    @foreach($brands as $brand)
                        <tr class="transition-colors  dark:hover:bg-gray-800/40">
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $brand->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block text-white">{{ $brand->slug }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-block text-white">{{ $brand->is_active === 1 ? 'Active' : 'Not Active' }}</span>
                            </td>
                            {{-- delete btn --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-row gap-2">
                                    <x-form action="{{ route('brands.destroy', $brand->id) }}" method="DELETE">
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-red-800 dark:bg-red-500/20 dark:text-emerald-400">
                                            <button type="submit">
                                                <svg class="cursor-pointer hover:fill-error-500 dark:hover:fill-error-500 fill-gray-700 dark:fill-gray-400"
                                                    width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z"
                                                        fill=""></path>
                                                </svg>
                                            </button>
                                        </span>
                                    </x-form>
                                    {{-- edit btn --}}
                                    <a href="{{ route('brands.edit', $brand->id) }}">
                                        <span
                                            class=" inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold                                                                                                                             
                                                                                          text-sky-800 dark:bg-sky-500/20 dark:text-sky-400">
                                            <svg class="cursor-pointer hover:fill-primary-500 dark:hover:fill-primary-500 fill-gray-700 dark:fill-gray-400"
                                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14.8463 2.14645C15.0416 1.95118 15.3582 1.95118 15.5534 2.14645L17.8536 4.44661C18.0488 4.64187 18.0488 4.95845 17.8536 5.15371L7.56066 15.4466C7.46788 15.5394 7.35195 15.6033 7.2242 15.6318L3.7242 16.3818C3.55327 16.419 3.3749 16.3666 3.25264 16.2444C3.13037 16.1221 3.07799 15.9437 3.11518 15.7728L3.86518 12.2728C3.89372 12.145 3.95761 12.0291 4.05039 11.9363L14.8463 2.14645ZM14.1392 3.56066L5.06066 12.6392L4.56066 14.9392L6.86066 14.4392L15.9392 5.36066L14.1392 3.56066Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </span>
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
        {{ $brands->links() }}
    </div>
    </div>
</x-admin.app-layout>