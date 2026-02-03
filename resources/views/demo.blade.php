<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Laravel App</title>

  <!-- Toast CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">

  @stack('styles')
</head>

<body>
  <!-- Toast Component - IMPORTANT: Place this here -->
  <x-toast />
  <!-- Toast JS -->
  <script src="{{ asset('assets/js/toast.js') }}"></script>

  @stack('scripts')
</body>

</html>