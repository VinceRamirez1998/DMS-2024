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
      <div class="col-span-12">
        <div class="flex flex-row">
          <a href="" class="bg-red-900 p-3 py-1 rounded-md text-white text-center md:text-left font-semibold">On-going Projects</a>
          <a href="" class="bg-red-900 p-3 py-1 rounded-md text-white text-center md:text-left font-semibold">Completed Projects</a>
        </div>
        <div class="flex flex-col gap-2 bg-[#bd8889] rounded-md p-3 border-2 border-red-500">
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores!</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet.</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores! Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores!</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint quos corrupti est fugiat velit.</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem, ipsum dolor.</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores!</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet.</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores! Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores!</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint quos corrupti est fugiat velit.</a>
          <a href="" class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">Lorem, ipsum dolor.</a>
          
      </div>
    </div>
  </div>
</div>

  

</body>

</html>