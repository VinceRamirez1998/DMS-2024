<!doctype html>
<html>
  @include('layouts.header')
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>DHVSU</title>
</head>
<body>
  <div class="flex">
  @include('layouts.sidenav')
  <div class="w-screen pb-5">
    <div class="grid grid-cols-12 md:px-8 md:pt-8 gap-4 p-2 md:p-0">
      {{-- Projects --}}
      <div class="col-span-12 flex justify-end">
      {{-- Search --}}
      <form action="" method="POST">
        @csrf
        <span class="flex items-center">
          <button type="submit" class="mr-[-30px] px-1 py-1 z-10 rounded-md">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
          <input type="text" placeholder="Search" class="pl-9 py-1 rounded-md">
        </span>
      </form>
      </div>
      <div class="col-span-12">
        {{-- Categories --}}
        <form action="" method="POST">
          @csrf
        <div class="flex flex-row">
            <button class="bg-red-900 p-3 py-1 rounded-md text-white text-center md:text-left font-semibold">On-going Projects</button>
            <button class="bg-red-900 p-3 py-1 rounded-md text-white text-center md:text-left font-semibold">Completed Projects</button>
          </div>
        </form>
      <div class="flex flex-col gap-2 bg-[#bd8889] rounded-md p-3 border-2 border-red-500">
        <div class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleOngoingBtn"><p>Project Basa</p></button>
          <div id="ongoingContent" class="grid grid-col-12 md:ml-5 text-justify md:text-left mt-5 hidden transition-all duration-500">
            <p class="text-sm font-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, nihil hic? Nulla tenetur dolorum eveniet placeat!Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, nihil hic? Nulla tenetur dolorum eveniet placeat!Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, nihil hic? Nulla tenetur dolorum eveniet placeat!Lorem ipsum dolor sit amet consectetur ad</p>
            <p class="text-sm font-normal my-10">Check Photos <button id="showImageBtn" class="text-blue-600 underline">here</button></p>
          </div>
        </div>
        <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
          <div class="relative max-w-100 justify-center flex">
            <button id="closeImageBtn" class="absolute top-[-50px] right-5 text-white text-[3rem]">&times;</button>
            <img src="{{ asset('../img/DHVSU_Logo.png') }}" alt="Project Basa Photo" class="max-w-[50%] max-h-[70rem]">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</script>

{{-- Ongoing Project --}}
<script>
  // Toggle Ongoing Project Content
  document.getElementById('toggleOngoingBtn').addEventListener('click', function() {
    var content = document.getElementById('ongoingContent');
    content.classList.toggle('hidden');
  });

  // Show Image
  document.getElementById('showImageBtn').addEventListener('click', function() {
    document.getElementById('imageModal').classList.remove('hidden');
  });

  // Close Button
  document.getElementById('closeImageBtn').addEventListener('click', function() {
    document.getElementById('imageModal').classList.add('hidden');
  });

  // Close Ongoing Modal
  document.getElementById('imageModal').addEventListener('click', function(event) {
    if (event.target === this) {
      this.classList.add('hidden');
    }
  });
</script>

</body>

</html>