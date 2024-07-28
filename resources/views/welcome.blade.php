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
    <img src="{{ asset('../img/hero.png') }}" alt="Description of image" class="w-full h-auto rounded">
  </div>
  
  {{-- LOGIN FORM--}}
  <div id="loginForm" class="toggleForm col-span-12 order-1 p-5 lg:order-2 lg:col-start-6 bg-gray-100 rounded border-2 border-gray-400">
    <p class="text-lg font-semibold mb-2">Login</p>
    <form action="" method="POST">
      @csrf
      <div class="w-full flex flex-col justify-center items-center">
        <input type="text" class="rounded-md w-[80%] py-1 mb-2" name="" id="">
        <input type="password" class="rounded-md w-[80%] py-1" name="" id="">
        <div class="flex justify-between items-center flex-column md:flex-row md:px-8 w-full">
          <div>
            <input type="checkbox" name="" id="RememberMe">
            <label for="RememberMe" style="font-size: 12px;">Keep me logged in</label>
          </div>
          <div>
            <a href="" class="flex underline text-blue-600" style="font-size: 12px; margin-top: 5px;">Forgot&nbsp;Password?</a>
          </div>
        </div>
        <button class="bg-red-900 text-white mt-3 mb-5 lg:mb-20 rounded px-9 py-1">Log In</button>
    </form>
        <hr class="border-t-2 border-gray-400 w-full mb-2 lg:mt-9">
        <p class="text-sm">Doesn't have an account yet? <button id="signupBtn" type="button" class="text-sm text-blue-600 underline">Sign up</button></p>
      </div>
  </div>

  {{-- SIGN UP FORM--}}
  <div id="signupForm" class="hidden col-span-12 order-1 p-5 lg:order-2 lg:col-start-6 bg-gray-100 rounded border-2 border-gray-400">
    <p class="text-lg font-semibold mb-2">Sign up</p>
    <form action="" method="POST">
      @csrf
      <div class="w-full flex flex-col justify-center items-center">
        <input type="text" class="rounded-md w-[80%] py-1 mb-2" name="" id="" placeholder="First Name">
        <input type="text" class="rounded-md w-[80%] py-1 mb-2" name="" id="" placeholder="Last Name">
        <input type="text" class="rounded-md w-[80%] py-1 mb-2" name="" id="" placeholder="Username">
        <input type="email" class="rounded-md w-[80%] py-1 mb-2" name="" id="" placeholder="Email">
        <select name="" id="" class="rounded-md w-[80%] py-1 mb-2 px-3 text-gray-400">
          <option selected disabled value="">Select Purpose</option>
          <option value="">Faculty Staff</option>
        </select>
        <input type="password" class="rounded-md w-[80%] py-1 mb-2" name="" id="" placeholder="Password">
        <input type="password" class="rounded-md w-[80%] py-1 mb-2" name="" id="" placeholder="Confirm Password">
        <div class="w-full px-8 text-sm">
          <div class="flex items-center">
            <input type="checkbox" name="" id="TOS" class="me-2 rounded">
            <label for="TOS">I agree to the <a href="" target="_blank" class="text-blue-600 underline">Terms of Service</a></label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" name="" id="DPP" class="me-2 rounded">
            <label for="DPP">I agree to the <a href="" target="_blank" class="text-blue-600 underline">Data Privacy Policy</a></label>
          </div>
        </div>
        <button class="bg-red-900 text-white mt-3 mb-5 lg:mb-6 rounded px-9 py-1">Request</button>
    </form>
        <hr class="border-t-2 border-gray-400 w-full mb-2 lg:mt-0">
        <p class="text-sm">Already have an account? <button id="loginBtn" type="button" class="text-sm text-blue-600 underline">Log In</button></p>
      </div>
    
  </div>
</div>
</div>



<div class="grid grid-cols-6 lg:gap-x-4 pt-2 px-5">
  {{-- Announcement Header --}}
  <form action="">
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
    <a href=""><p><span class="me-1">•</span>asdasd</p></a>
    <a href=""><p><span class="me-1">•</span>hehehe</p></a>
    <a href=""><p><span class="me-1">•</span>hehehe</p></a>
  </div>
  <div class="hidden md:block col-span-12 lg:col-start-6"></div>
</div>

<script>
  document.getElementById('loginBtn').addEventListener('click', function(){
    var form = document.getElementById('signupForm');
    var loginForm = document.getElementById('loginForm');
    if(form.style.display == 'none'){
      form.style.display = 'block';
    } else {
      form.style.display = 'none';
      loginForm.style.display = 'block';
    }
  });

  document.getElementById('signupBtn').addEventListener('click', function(){
    var form = document.getElementById('loginForm');
    var loginForm = document.getElementById('signupForm');
    if(form.style.display == 'none'){
      form.style.display = 'block';
    } else {
      form.style.display = 'none';
      loginForm.style.display = 'block';
    }
  });
</script>
</body>

</html>