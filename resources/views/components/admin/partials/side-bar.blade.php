{{-- @push('style') --}}
<style>
  .main-header::-webkit-scrollbar {
    width: 6px;
  }

  .main-header::-webkit-scrollbar-track {
    background: transparent;
  }

  .main-header::-webkit-scrollbar-thumb {
    background: rgba(156, 163, 175, 0.6);
    border-radius: 10px;
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
  }

  .main-header::-webkit-scrollbar-thumb:hover {
    background: rgba(107, 114, 128, 0.9);
  }
</style>
{{-- @endpush --}}

<!-- Sidebar -->
<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[260px] flex-col overflow-y-hidden border-r border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 px-5 lg:static lg:translate-x-0 transition-all duration-300 ease-in-out">

  <!-- SIDEBAR HEADER -->
  <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="flex items-center border-b border-gray-200 dark:border-gray-800 py-5">
    <a href="#" :class="sidebarToggle ? 'lg:hidden' : ''" class="block">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome</h1>
    </a>

    <!-- Logo Icon for collapsed sidebar -->
    <a href="#" :class="sidebarToggle ? 'lg:block' : 'lg:hidden'" class="hidden">
      <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-500 text-white font-bold text-xl">
        LE
      </div>
    </a>
  </div>
  <!-- SIDEBAR HEADER MAIN AREA -->

  <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar main-header">
    <!-- Sidebar Menu -->
    <nav x-data="{selected: $persist('Dashboard')}" class="mt-5 py-4">
      <!-- Menu Group -->
      <div>
        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 dark:text-gray-500">
          <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
            MENU
          </span>

          <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
            class="mx-auto fill-gray-400 dark:fill-gray-500 menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
            fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
              fill="" />
          </svg>
        </h3>

        <ul class="flex flex-col gap-2 mb-6">
          <!-- Menu Item Dashboard -->
          <li>
            <a href="#"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-500' : '' }}">
              <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.74992 18.3333H2.08325C1.16659 18.3333 0.416586 17.5833 0.416586 16.6667V4.16667C0.416586 3.25 1.16659 2.5 2.08325 2.5H8.74992C9.66659 2.5 10.4166 3.25 10.4166 4.16667V16.6667C10.4166 17.5833 9.66659 18.3333 8.74992 18.3333ZM2.08325 4.16667V16.6667H8.74992V4.16667H2.08325Z" />
                <path
                  d="M17.9166 18.3333H11.2499C10.3333 18.3333 9.58325 17.5833 9.58325 16.6667V10.8333C9.58325 9.91667 10.3333 9.16667 11.2499 9.16667H17.9166C18.8333 9.16667 19.5833 9.91667 19.5833 10.8333V16.6667C19.5833 17.5833 18.8333 18.3333 17.9166 18.3333ZM11.2499 10.8333V16.6667H17.9166V10.8333H11.2499Z" />
                <path
                  d="M17.9166 7.5H11.2499C10.3333 7.5 9.58325 6.75 9.58325 5.83333V3.33333C9.58325 2.41667 10.3333 1.66667 11.2499 1.66667H17.9166C18.8333 1.66667 19.5833 2.41667 19.5833 3.33333V5.83333C19.5833 6.75 18.8333 7.5 17.9166 7.5ZM11.2499 3.33333V5.83333H17.9166V3.33333H11.2499Z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Dashboard
              </span>
            </a>
          </li>
          {{-- categories --}}
          <li>
            <a href="{{ route('categories.index') }}"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-500' : '' }}">
              <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.74992 18.3333H2.08325C1.16659 18.3333 0.416586 17.5833 0.416586 16.6667V4.16667C0.416586 3.25 1.16659 2.5 2.08325 2.5H8.74992C9.66659 2.5 10.4166 3.25 10.4166 4.16667V16.6667C10.4166 17.5833 9.66659 18.3333 8.74992 18.3333ZM2.08325 4.16667V16.6667H8.74992V4.16667H2.08325Z" />
                <path
                  d="M17.9166 18.3333H11.2499C10.3333 18.3333 9.58325 17.5833 9.58325 16.6667V10.8333C9.58325 9.91667 10.3333 9.16667 11.2499 9.16667H17.9166C18.8333 9.16667 19.5833 9.91667 19.5833 10.8333V16.6667C19.5833 17.5833 18.8333 18.3333 17.9166 18.3333ZM11.2499 10.8333V16.6667H17.9166V10.8333H11.2499Z" />
                <path
                  d="M17.9166 7.5H11.2499C10.3333 7.5 9.58325 6.75 9.58325 5.83333V3.33333C9.58325 2.41667 10.3333 1.66667 11.2499 1.66667H17.9166C18.8333 1.66667 19.5833 2.41667 19.5833 3.33333V5.83333C19.5833 6.75 18.8333 7.5 17.9166 7.5ZM11.2499 3.33333V5.83333H17.9166V3.33333H11.2499Z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Categories
              </span>
            </a>
          </li>


          {{-- colors --}}
          <li>
            <a href="{{ route('colors.index') }}"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-500' : '' }}">
              <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 2C6.48 2 2 6.03 2 11c0 3.87 3.13 7 7 7h1a1 1 0 0 0 0-2H9c-2.76 0-5-2.24-5-5 0-3.87 3.58-7 8-7s8 3.13 8 7c0 1.66-1.34 3-3 3h-1a1 1 0 0 0 0 2h1c2.76 0 5-2.24 5-5 0-4.97-4.48-9-10-9z" />
                <circle cx="7.5" cy="10.5" r="1.5" />
                <circle cx="12" cy="8" r="1.5" />
                <circle cx="16.5" cy="10.5" r="1.5" />
              </svg>

              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Colors
              </span>
            </a>
          </li>

          {{-- tags --}}
          <li>
            <a href="{{ route('tags.index') }}"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-500' : '' }}">
              <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M20.59 13.41L11 3.83C10.63 3.46 10.12 3.25 9.59 3.25H4C3.45 3.25 3 3.7 3 4.25V9.84C3 10.37 3.21 10.88 3.59 11.25L13.17 20.83C13.95 21.61 15.22 21.61 16 20.83L20.59 16.24C21.37 15.46 21.37 14.19 20.59 13.41ZM7.5 8.75C6.81 8.75 6.25 8.19 6.25 7.5C6.25 6.81 6.81 6.25 7.5 6.25C8.19 6.25 8.75 6.81 8.75 7.5C8.75 8.19 8.19 8.75 7.5 8.75Z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Tags
              </span>
            </a>
          </li>


          {{-- Brand --}}
          <li>
            <a href="{{ route('brands.index') }}"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-500' : '' }}">
              <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 2L4 7V17L12 22L20 17V7L12 2ZM12 4.3L18 8V16L12 19.7L6 16V8L12 4.3ZM9 10H15V12H9V10ZM9 13H13V15H9V13Z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Brands
              </span>
            </a>
          </li>

          {{-- Products --}}
          <li>
            <a href="{{ route('products.index') }}"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-500' : '' }}">
              <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 2L4 7V17L12 22L20 17V7L12 2ZM12 4.3L18 8V16L12 19.7L6 16V8L12 4.3ZM9 10H15V12H9V10ZM9 13H13V15H9V13Z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Products
              </span>
            </a>
          </li>

          <!-- Menu Item Calendar -->
          <li>
            <a href="{{ route('specifications.index') }}"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500">
              <svg class="fill-current" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 11l3 3L22 4l-1.5-1.5L12 11 10.5 9.5 9 11zM2 5h6v2H2V5zm0 6h6v2H2v-2zm0 6h6v2H2v-2z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Specifications
              </span>
            </a>
          </li>

          <!-- Menu Item Settings -->
          <li>
            <a href="#"
              class="group relative flex items-center gap-3 rounded-lg px-4 py-3 font-medium text-gray-700 dark:text-gray-300 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-500">
              <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M17.4316 10.8346C17.4568 10.5596 17.4736 10.283 17.4736 10.0013C17.4736 9.71966 17.4568 9.44299 17.4232 9.16799L19.2316 7.74633C19.3899 7.62216 19.4316 7.40133 19.3399 7.22216L17.6316 4.28466C17.5399 4.10549 17.3316 4.03883 17.1482 4.10549L14.9982 4.98883C14.5482 4.64716 14.0732 4.35549 13.5482 4.13049L13.1982 1.82966C13.1649 1.63883 12.9982 1.50049 12.7982 1.50049H9.39817C9.19817 1.50049 9.03151 1.63883 8.99817 1.82966L8.64817 4.13049C8.12317 4.35549 7.64817 4.65549 7.19817 4.98883L5.04817 4.10549C4.86484 4.03049 4.65651 4.10549 4.56484 4.28466L2.85651 7.22216C2.75651 7.40133 2.79817 7.62216 2.96484 7.74633L4.77317 9.16799C4.73984 9.44299 4.69817 9.72799 4.69817 10.0013C4.69817 10.2746 4.71484 10.5596 4.74817 10.8346L2.93984 12.2563C2.78151 12.3805 2.73984 12.6013 2.83151 12.7805L4.53984 15.718C4.63151 15.8971 4.83984 15.9638 5.02317 15.8971L7.17317 15.0138C7.62317 15.3555 8.09817 15.6471 8.62317 15.8721L8.97317 18.173C9.03151 18.3638 9.19817 18.5021 9.39817 18.5021H12.7982C12.9982 18.5021 13.1649 18.3638 13.1982 18.173L13.5482 15.8721C14.0732 15.6471 14.5482 15.3555 14.9982 15.0138L17.1482 15.8971C17.3316 15.9721 17.5399 15.8971 17.6316 15.718L19.3399 12.7805C19.4316 12.6013 19.3899 12.3805 19.2316 12.2563L17.4316 10.8346ZM11.0982 13.5013C9.14817 13.5013 7.59817 11.9513 7.59817 10.0013C7.59817 8.05132 9.14817 6.50132 11.0982 6.50132C13.0482 6.50132 14.5982 8.05132 14.5982 10.0013C14.5982 11.9513 13.0482 13.5013 11.0982 13.5013Z" />
              </svg>
              <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                Settings
              </span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</aside>