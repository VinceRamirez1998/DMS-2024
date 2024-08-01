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
    <div class="grid grid-cols-12 md:pl-8 md:pt-8 gap-4 p-2 md:p-0">
      {{-- Video --}}
      <div class="col-span-12 md:col-span-7">
        <iframe class="p-2 bg-[#bd8889] w-[100%] md:w-[620px] h-100 md:h-[349px] rounded-md border-2 border-red-500" src="https://www.youtube.com/embed/hwTrdzc6NmY?autoplay=1&loop=1&playlist=hwTrdzc6NmY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      {{-- Announcement --}}
      <div class="col-span-12 md:col-span-5 bg-[#bd8889] rounded-md border-2 border-red-500">
        <div class="container w-[100%]">
          <p class="text-xl ps-3 mt-2 mb-0 py-3 bg-red-900 text-white font-semibold">Announcement Board</p>
          <div class="flex flex-col container pl-7 h-[277px] overflow-y-scroll">
            <a href="" class="ms-1">• あの日の悲しみさえ あの日の苦しみさえ</a>
            <a href="" class="ms-1">• そのすべてを愛してた あなたとともに</a>
            <a href="" class="ms-1">• 胸に残り離れない 苦いレモンの匂い</a>
            <a href="" class="ms-1">• 雨が降り止むまでは帰れない</a>
            <a href="" class="ms-1">• 今でもあなたはわたしの光</a>
            <a href="" class="ms-1">• 暗闇であなたの背をなぞった</a>
          </div>
        </div>

      </div>
      {{-- Projects --}}
      <div class="col-span-12">
        <div class="flex flex-row">
          <a href="" class="bg-red-900 p-3 py-1 rounded-md text-white font-semibold">On-going Projects</a>
          <a href="" class="bg-red-900 p-3 py-1 rounded-md text-white font-semibold">Completed Projects</a>
        </div>
        <div class="flex flex-col gap-2 bg-[#bd8889] rounded-md p-3 max-h-[350px] overflow-y-scroll border-2 border-red-500">
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