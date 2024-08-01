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
  
<div class="grid grid-cols-6 gap-4 pt-2 px-5">
  {{-- Picture --}}
  <div class="col-span-12 order-2 lg:order-1 lg:col-span-5">
      <img src="{{ asset('../img/hero.png') }}" alt="" class="w-full h-full object-cover rounded">
  </div>

  {{-- RESET PASSWORD FORM--}}
  <div id="loginForm" class="toggleForm col-span-12 order-1 p-5 lg:order-2 lg:col-start-6 bg-gray-100 rounded border-2 border-gray-400">
    <p class="text-lg font-semibold mb-2">Email Verification</p>
    {{-- Password Reset Form --}}
    <form action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <div class="w-full flex flex-col justify-center items-center md:px-8">
            <img src="{{ asset('../img/phone.png') }}" width="100" class="rounded-full my-4" alt="">
            @if (session('resent'))
            <div class="container-fluid flex flex-col text-center mb-[47px]">
                <p class="text-md font-bold">Email has been sent!</p>
                <p class="text-sm mt-2 mb-1">Please check your inbox and click the link to verify email</p>
            </div>
            @endif
        <button type="submit" {{ session('resent') ? 'hidden' : '' }} class="bg-red-900 text-white mt-3 mb-5 lg:mb-20 rounded px-5 py-1">Send Verification Link</button>
        <hr class="border-t-2 border-gray-400 w-full mb-2 lg:mt-7">
        <p class="text-sm">Didn't receive the link? <button type="submit" class="text-sm text-blue-600 underline">Resend</button></p>
    </form>
        </div>
    </div>
  </div>
</div>
</div>

<div class="grid grid-cols-6 lg:gap-x-4 pt-2 px-5">

  {{-- Announcement Header --}}
  <form action="" method="POST">
    @csrf
  <div class="col-span-6 lg:col-span-5 flex">
      <button name="content" value="news" class="bg-red-900 col-span-2 p-3 lg:px-4 py-1 text-white border-solid border-r-2 border-rose-900">News</button>
      <button name="content" value="announcement" class="bg-red-900 col-span-2 p-3 lg:px-4 py-1 text-white">Announcement</button>
      <button name="content" value="events" class="bg-red-900 col-span-2 p-3 lg:px-4 py-1 text-white  border-solid border-l-2 border-rose-900">Events</button>
    </div>
  </form>
  
  {{-- Block --}}
  <div class="hidden md:block col-span-12 lg:col-start-6"></div>
  <div class="col-span-12 lg:col-span-5 flex flex-col mb-3 bg-gray-300 p-2 border-2 rounded-r rounded-bl border-gray-800">
    <a href=""><p><span class="me-1">•</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, voluptate.</p></a>
    <a href=""><p><span class="me-1">•</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur molestiae sint ratione a commodi perferendis architecto</p></a>
    <a href=""><p><span class="me-1">•</span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis deleniti doloremque accusamus cum sit.</p></a>
  </div>
  <div class="hidden md:block col-span-12 lg:col-start-6"></div>
</div>
</body>
</html>