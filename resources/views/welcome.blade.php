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
  <div class="col-span-12 order-2 lg:order-1 lg:col-span-5 justify-center items-center flex bg-[#bd8889] rounded-md">
      {{-- <img src="{{ asset('../img/hero.png') }}" alt="" class="w-full h-full object-cover rounded"> --}}
      <iframe class="p-2 bg-[#bd8889] w-[100%] md:w-[100%] h-100 md:h-[100%] rounded-md " src="https://www.youtube.com/embed/hwTrdzc6NmY?autoplay=1&loop=1&playlist=hwTrdzc6NmY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>

  {{-- LOGIN FORM--}}
  <div id="loginForm" class="toggleForm col-span-12 order-1 p-5 lg:order-2 lg:col-start-6 bg-gray-100 rounded border-2 border-gray-400">
    <p class="text-lg font-semibold mb-2">Login</p>

    {{-- Login Form --}}
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="w-full flex flex-col justify-center items-center md:px-8">

        {{-- Username --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
          </span>
            <input type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Username">
        </div>

        {{-- Password --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
          </span>
            <input type="password" name="password" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Password">
        </div>
        @error('username')
        <div class="col-span-12">
          <p class="invalid-feedback text-sm text-red-500" role="alert"><span class="me-1">•</span> {{ $message }}</p>
        </div>
        @enderror
        @error('email')
        <div class="col-span-12">
          <p class="invalid-feedback text-sm text-red-500" role="alert"><span class="me-1">•</span> {{ $message }}</p>
        </div>
        @enderror
        @error('password')
        <div class="col-span-12">
          <p class="invalid-feedback text-sm text-red-500" role="alert"><span class="me-1">•</span> {{ $message }}</p>
        </div>
        @enderror
        <div class="flex justify-between items-center flex-column md:flex-row w-full">
          <div>
            <input type="checkbox" name="" id="RememberMe">
            <label for="RememberMe" style="font-size: 12px;">Keep me logged in</label>
          </div>
          <div>
            <a href="{{ route('password.request') }}" class="flex underline text-blue-600" style="font-size: 12px; margin-top: 5px;">Forgot&nbsp;Password</a>
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
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="w-full flex flex-col justify-center items-center">

        {{-- First Name --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
            </svg>
          </span>
            <input name="firstname" type="text" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2" id="" placeholder="First Name">
        </div>

        {{-- Last Name --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
            </svg>
          </span>
            <input name="lastname" type="text" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Last Name">
        </div>

        {{-- Username --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
          </span>
            <input name="username" type="text" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Username">
        </div>

        {{-- Email --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
          </span>
            <input name="email" type="email" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Email">
        </div>

        {{-- Position --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
            </svg>
          </span>
          <input name="position" type="text" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Position">
        </div>

        {{-- Select Purpose --}}
        <div class="relative w-full">
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
              </svg>
            </span>
            <select name="purpose" id="purpose-select" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2 text-gray-400">
                <option selected disabled value="">Select Purpose</option>
                <option value="inquire">Inquire</option>
                <option value="request">Send Request Letter</option>
            </select>
          </div>
        </div>

        {{-- Password --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
          </span>
            <input name="password" type="password" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Password">
        </div>

        {{-- Confirm Password --}}
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
          </span>
            <input name="password_confirmation" type="password" class="pl-10 pr-4 py-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2"  id="" placeholder="Confirm Password">
        </div>
        <div class="w-full text-sm">

          {{-- Terms of Service --}}
          <div class="flex items-center">
            <input type="checkbox"  id="TOS" class="me-2 rounded">
            <label for="TOS">I agree to the <a href="" target="_blank" class="text-blue-600 underline">Terms of Service</a></label>
          </div>

          {{-- Data Privacy Policy --}}
          <div class="flex items-center">
            <input type="checkbox"  id="DPP" class="me-2 rounded">
            <label for="DPP">I agree to the <a href="" target="_blank" class="text-blue-600 underline">Data Privacy Policy</a></label>
          </div>
        </div>

        <button id="submitBtn" type="submit" class="bg-red-900 text-white mt-3 mb-5 lg:mb-6 rounded px-9 py-1 opacity-50 cursor-not-allowed" tooltip="asd" disabled>Request</button>
    </form> 
        <hr class="border-t-2 border-gray-400 w-full mb-2 lg:mt-0">
        <p class="text-sm">Already have an account? <button id="loginBtn" type="button" class="text-sm text-blue-600 underline">Log In</button></p>
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
    <p><span class="me-1">•</span>12345</p>
    <p><span class="me-1">•</span>12345</p>
    <p><span class="me-1">•</span>12345</p>
    <p><span class="me-1">•</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, voluptate.</p>
    <p><span class="me-1">•</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur molestiae sint ratione a commodi perferendis architecto</p>
    <p><span class="me-1">•</span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis deleniti doloremque accusamus cum sit.</p>
  </div>
  <div class="hidden md:block col-span-12 lg:col-start-6"></div>
</div>

<script>
  // Toggle Login Form
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

  // Toggle Signup Form
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

{{-- Change option to black when selected --}}
<script>
  document.getElementById('purpose-select').addEventListener('change', function() {
      if (this.value) {
          this.classList.remove('text-gray-400');
          this.classList.add('text-gray-600');
      } else {
          this.classList.remove('text-gray-600');
          this.classList.add('text-gray-400');
      }
  });
</script>

{{-- Enable Submit Button --}}
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const tosCheckbox = document.getElementById('TOS');
        const dppCheckbox = document.getElementById('DPP');
        const submitBtn = document.getElementById('submitBtn');

        function toggleButtonState() {
            if (tosCheckbox.checked && dppCheckbox.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        tosCheckbox.addEventListener('change', toggleButtonState);
        dppCheckbox.addEventListener('change', toggleButtonState);
    });
</script>

</body>

</html>