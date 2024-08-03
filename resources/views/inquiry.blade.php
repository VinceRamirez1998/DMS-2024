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
  <div class="w-screen pb-3">
    <div class="grid grid-cols-12 md:px-2 md:pt-8 gap-4 p-2 md:p-0 md:mt-10">
      {{-- Projects --}}
      <div class="col-span-12">
        <div class="flex flex-col gap-2 bg-[#bd8889] rounded-md p-3 border-2 border-red-500">
          <label for="title" class="text-lg">Title</label>
          <input type="text" id="title" class="w-full md:w-[370px] rounded-md p-2 border-2 border-red-500" placeholder="">
          <label for="position" class="text-lg">Position</label>
          <input type="text" id="position" class="w-full md:w-[370px] rounded-md p-2 border-2 border-red-500" placeholder="">
          <label for="location" class="text-lg">Location</label>
          <input type="text" id="location" class="w-full md:w-[370px] rounded-md p-2 border-2 border-red-500" placeholder="">
          <label for="inquiry" class="text-lg">Inquiry</label>
          <textarea type="text" id="inquiry" class="w-full h-[290px] rounded-md p-2 border-2 border-red-500 resize-none" placeholder=""></textarea>

          <div class="col-span-12 flex justify-center">
            <button class="bg-red-900 text-md font-semibold text-white w-[240px] py-1 rounded-md">Send</button>
          </div>
          
      </div>
    </div>
  </div>
</div>

  

</body>

</html>