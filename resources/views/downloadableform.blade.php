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
  <div class="w-screen pb-5 overflow-y-scroll h-screen overflow-hidden">
    <div class="grid grid-cols-12 md:px-8 md:pt-8 gap-4 p-2 md:p-0">

      <div class="col-span-12">
      {{-- Downloadable Forms --}}
      <div id="forms" class="flex flex-col gap-2 bg-[#eeeeee] rounded-md py-3 border-2 border-red-500">
        <p class="text-lg text-white font-bold w-100 py-3 bg-red-900 ps-3 mt-2">Downloadable Forms</p>
        {{-- Request Letter --}}
        <div class="py-2 px-3 mx-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleCompletedBtn" class="container text-left"><p>Request Letter</p></button>
          <div id="completedContent" class="grid grid-col-12 md:ml-5 pb-10 text-justify mt-5 hidden transition-all duration-500">
            <a href="{{ asset('img/DHVSU_Logo.png') }}" download="{{ asset('img/DHVSU_Logo.png') }}" id="showImageBtnCompleted" class="font-normal flex flex-col justify-center items-center text-center">
              <img src="{{ asset('img/DHVSU_Logo.png') }}" class="h-100 max-h-[306px]" alt="">
              Click to download
            </a>
          </div>
        </div>
        {{-- Customer Survey Form --}}
        <div class="py-2 px-3 mx-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleCompletedBtn1" class="container text-left"><p>Customer Survey Form</p></button>
          <div id="completedContent1" class="grid grid-col-12 md:ml-5 pb-10 text-justify mt-5 hidden transition-all duration-500">
            <a href="{{ asset('img/DHVSU_Logo.png') }}" download="{{ asset('img/DHVSU_Logo.png') }}" id="showImageBtnCompleted" class="font-normal flex flex-col justify-center items-center text-center">
              <img src="{{ asset('img/DHVSU_Logo.png') }}" class="h-100 max-h-[306px]" alt="">
              Click to download
            </a>
          </div>
        </div>
        {{-- Monitoring Form --}}
        <div class="py-2 px-3 mx-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleCompletedBtn2" class="container text-left"><p>Monitoring Form</p></button>
          <div id="completedContent2" class="grid grid-col-12 md:ml-5 pb-10 text-justify mt-5 hidden transition-all duration-500">
            <a href="{{ asset('img/DHVSU_Logo.png') }}" download="{{ asset('img/DHVSU_Logo.png') }}" id="showImageBtnCompleted" class="font-normal flex flex-col justify-center items-center text-center">
              <img src="{{ asset('img/DHVSU_Logo.png') }}" class="h-100 max-h-[306px]" alt="">
              Click to download
            </a>
          </div>
        </div>
        {{-- Evaluation Form --}}
        <div class="py-2 px-3 mx-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleCompletedBtn3" class="container text-left"><p>Evaluation Form</p></button>
          <div id="completedContent3" class="grid grid-col-12 md:ml-5 pb-10 text-justify mt-5 hidden transition-all duration-500">
            <a href="{{ asset('img/DHVSU_Logo.png') }}" download="{{ asset('img/DHVSU_Logo.png') }}" id="showImageBtnCompleted" class="font-normal flex flex-col justify-center items-center text-center">
              <img src="{{ asset('img/DHVSU_Logo.png') }}" class="h-100 max-h-[306px]" alt="">
              Click to download
            </a>
          </div>
        </div>
        {{-- Satisfaction Survey Form --}}
        <div class="py-2 px-3 mx-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleCompletedBtn4" class="container text-left"><p>Satisfaction Survey Form</p></button>
          <div id="completedContent4" class="grid grid-col-12 md:ml-5 pb-10 text-justify mt-5 hidden transition-all duration-500">
            <a href="{{ asset('img/DHVSU_Logo.png') }}" download="{{ asset('img/DHVSU_Logo.png') }}" id="showImageBtnCompleted" class="font-normal flex flex-col justify-center items-center text-center">
              <img src="{{ asset('img/DHVSU_Logo.png') }}" class="h-100 max-h-[306px]" alt="">
              Click to download
            </a>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

</script>

{{-- Completed Project --}}
<script>
  // Toggle Ongoing Project Content
  document.getElementById('toggleCompletedBtn').addEventListener('click', function() {
    var content = document.getElementById('completedContent');
    content.classList.toggle('hidden');

    var content1 = document.getElementById('completedContent1');
    var content2 = document.getElementById('completedContent2');
    var content3 = document.getElementById('completedContent3');
    var content4 = document.getElementById('completedContent4');
    content1.classList.add('hidden');
    content2.classList.add('hidden');
    content3.classList.add('hidden');
    content4.classList.add('hidden');
    
  });

  document.getElementById('toggleCompletedBtn1').addEventListener('click', function() {
    var content = document.getElementById('completedContent1');
    content.classList.toggle('hidden');

    var content0 = document.getElementById('completedContent');
    var content2 = document.getElementById('completedContent2');
    var content3 = document.getElementById('completedContent3');
    var content4 = document.getElementById('completedContent4');
    content0.classList.add('hidden');
    content2.classList.add('hidden');
    content3.classList.add('hidden');
    content4.classList.add('hidden');
  });

  document.getElementById('toggleCompletedBtn2').addEventListener('click', function() {
    var content = document.getElementById('completedContent2');
    content.classList.toggle('hidden');

    var content1 = document.getElementById('completedContent1');
    var content0 = document.getElementById('completedContent');
    var content3 = document.getElementById('completedContent3');
    var content4 = document.getElementById('completedContent4');
    content1.classList.add('hidden');
    content0.classList.add('hidden');
    content3.classList.add('hidden');
    content4.classList.add('hidden');
  });

  document.getElementById('toggleCompletedBtn3').addEventListener('click', function() {
    var content = document.getElementById('completedContent3');
    content.classList.toggle('hidden');

    var content1 = document.getElementById('completedContent1');
    var content2 = document.getElementById('completedContent2');
    var content0 = document.getElementById('completedContent');
    var content4 = document.getElementById('completedContent4');
    content1.classList.add('hidden');
    content2.classList.add('hidden');
    content0.classList.add('hidden');
    content4.classList.add('hidden');
  });

  document.getElementById('toggleCompletedBtn4').addEventListener('click', function() {
    var content = document.getElementById('completedContent4');
    content.classList.toggle('hidden');

    var content1 = document.getElementById('completedContent1');
    var content2 = document.getElementById('completedContent2');
    var content3 = document.getElementById('completedContent3');
    var content0 = document.getElementById('completedContent');
    content1.classList.add('hidden');
    content2.classList.add('hidden');
    content3.classList.add('hidden');
    content0.classList.add('hidden');
  });
</script>

</body>

</html>