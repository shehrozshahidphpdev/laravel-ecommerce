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
</head>

<body
   x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
   x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
   :class="{'dark bg-[#101828]': darkMode === true}">

   <div class="flex h-screen overflow-hidden">
      <x-admin.partials.side-bar />

      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
         <x-admin.partials.over-lay />
         <x-admin.partials.header />
         <main>
            {{ $slot }}
         </main>
      </div>
   </div>
</body>

</html>