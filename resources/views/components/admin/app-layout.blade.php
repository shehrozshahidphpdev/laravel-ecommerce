@props(['title'])
<!doctype html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <title>
      {{ $title ?? 'EcommerceApplication' }}
   </title>
   @vite(['resources/css/admin.css', 'resources/js/admin.js'])
   {{-- font awesome cdn --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   {{-- color picker cdn --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />

   <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
</head>

<body
   x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
   x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
   :class="{'dark bg-[#101828]': darkMode === true}">

   <div class="flex h-screen overflow-hidden">
      <x-admin.partials.side-bar />
      <x-toast />


      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
         <x-admin.partials.over-lay />
         <x-admin.partials.header />
         <main>
            {{ $slot }}
         </main>
      </div>
   </div>
   <script src="{{ asset('assets/js/toast.js') }}"></script>
   {{-- color picker cdn --}}
   <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

   @stack('script')

</body>

</html>