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
<div class="grid grid-cols-6 pt-10">
  <div class="col-span-6 flex flex-col mb-20 justify-center items-center">
    <img src="{{ asset('../img/ESM.png') }}" class="w-[200px]" alt="">
    <p class="text-2xl font-bold mt-2 mb-3 text-center">EXTENSION SERVICES MANAGEMENT OFFICE</p>
    <div class="md:w-50">
      <p class="mt-1 px-3 text-sm flex flex-col md:flex-row items-center break-normal">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 me-1">
          <path fill-rule="evenodd" d="M1 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H4a3 3 0 0 1-3-3V6Zm4 1.5a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm2 3a4 4 0 0 0-3.665 2.395.75.75 0 0 0 .416 1A8.98 8.98 0 0 0 7 14.5a8.98 8.98 0 0 0 3.249-.604.75.75 0 0 0 .416-1.001A4.001 4.001 0 0 0 7 10.5Zm5-3.75a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75Zm0 6.5a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75Zm.75-4a.75.75 0 0 0 0 1.5h2.5a.75.75 0 0 0 0-1.5h-2.5Z" clip-rule="evenodd" />
        </svg>
        <span class="font-bold flex me-2">
          Address:
        </span>
        Cabambangan, Bacolor, Pampanga, Philippines, 2001
      </p>
      <p class="mt-1 px-3 text-sm flex flex-col md:flex-row items-center break-all">
        <i class="fa-brands fa-square-facebook text-lg me-1"></i>
        <span class="font-bold flex me-2">
          Facebook:
        </span>
        <a href="https://www.facebook.com/DHVSUextensionservices" target="_blank">https://www.facebook.com/DHVSUextensionservices</a>
      </p>
      <p class="mt-1 px-3 text-sm flex flex-col md:flex-row items-center break-normal">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 ms-[-3px]">
          <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
        </svg>
        <span class="font-bold flex me-2">
          Google Map:
        </span>
        <a href="https://maps.app.goo.gl/CyvsyfQYyNBYQx698" target="_blank">https://maps.app.goo.gl/CyvsyfQYyNBYQx698</a>
      </p>
    </div>
  </div>
  
  
</div>
  

</body>

</html>