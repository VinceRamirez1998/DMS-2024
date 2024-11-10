<!doctype html>
<html>
  @include('layouts.header')
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>DHVSU</title>
  <style>
    .underline-important {
        text-decoration: underline !important;
    }
  </style>
</head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>DHVSU</title>
</head>
<body>
  <div class="flex h-auto">
    @include('layouts.sidenav')
    <div class="w-screen pb-3 h-screen">
      <p class="text-lg">Reports</p>
    </div>
  </div>
</body>
</html>