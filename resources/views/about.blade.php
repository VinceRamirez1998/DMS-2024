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
    <img src="{{ asset('../img/DHVSU_Logo.png') }}" class="w-[200px]" alt="">
    <p class="text-2xl font-bold mt-2 mb-0 text-center">DON HONORIO VENTURA STATE UNIVERSITY</p>
    <p class="mt-1 text-sm text-center">"Shaping Minds, Advancing Technologies, and Creating Brighter Futures"</p>
  </div>
  <div class="col-span-6 md:col-span-3 flex flex-col justify-start items-center px-5 md:px-10 md:px-17 text-center mb-5">
    <p class="text-2xl font-medium">MISSION</p>
    <hr class="border-t-2 border-gray-600 w-[240px] my-3">
    <p class="text-lg">DHVSU commits itself to provide a conductive environment for the holistic development of students to become globally competitive professionals through quality instruction and services; innovation and research towards the sustainable development of society.</p>
  </div>
  <div class="col-span-6 md:col-span-3 flex flex-col justify-start items-center px-5 md:px-10 md:px-17 text-center mb-5">
    <p class="text-2xl font-medium">VISION</p>
    <hr class="border-t-2 border-gray-600 w-[240px] my-3">
    <p class="text-lg">DHVSU envisions of becoming one of the lead universities in the ASEAN Region in producing globally competitive professionals who are capable of creating, applying, and transferring knowledge and technology for the sustainable development of the humanity and society.</p>
  </div>
  <div class="col-span-6 flex flex-col mt-20 mb-20 md:pt-20 justify-center items-center">
    <img src="{{ asset('../img/ESM.png') }}" class="w-[200px]" alt="">
    <p class="text-2xl font-bold mt-2 mb-0 text-center">EXTENSION SERVICES MANAGEMENT OFFICE</p>
  </div>
  <div class="col-span-6 md:col-span-3 flex flex-col justify-start items-center px-5 md:px-10 md:px-17 text-center mb-5">
    <p class="text-2xl font-medium">MISSION</p>
    <hr class="border-t-2 border-gray-600 w-[240px] my-3">
    <p class="text-lg">DHVSU commits itself to provide a conductive environment for the holistic development of students to become globally competitive professionals through quality instruction and services; innovation and research towards the sustainable development of society.</p>
  </div>
  <div class="col-span-6 md:col-span-3 flex flex-col justify-start items-center px-5 md:px-10 md:px-17 text-center mb-5">
    <p class="text-2xl font-medium">VISION</p>
    <hr class="border-t-2 border-gray-600 w-[240px] my-3">
    <p class="text-lg">DHVSU envisions of becoming one of the lead universities in the ASEAN Region in producing globally competitive professionals who are capable of creating, applying, and transferring knowledge and technology for the sustainable development of the humanity and society.</p>
  </div>
  <div class="col-span-6 flex flex-col justify-center items-center px-3 md:px-17 md:pt-20 pb-10 text-center mb-5">
    <p class="text-2xl font-medium">QUALITY POLICY</p>
    <hr class="border-t-2 border-gray-600 w-[240px] my-3">
    <p class="text-lg md:w-[55%]">The Extension Services Management Office commits to consistently provide quality and client-responsive extension programs, projects, activities and services that facilitates transfer of knowledge, skills, and/or technology to our target beneficiaries, in accordance with partners, funding donors, sponsors, and other benefactors expectations, and inaccordance with legal and regulatory laws.</p>
  </div>
</div>
  

</body>

</html>