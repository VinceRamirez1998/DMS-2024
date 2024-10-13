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
    <p class="text-lg font-semibold mb-2"><a href="/" class="me-[18px] font-bold"><i class="fa-solid fa-chevron-left"></i></a>Forgot Password</p>

    {{-- Password Reset Form --}}
    <form action="{{ route('password.update') }}" method="POST">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="w-full flex flex-col justify-center items-center md:px-8">

        {{-- Email --}}
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
                <i class="fa-regular fa-envelope"></i>
            </span>
            <input type="text" name="email" value="{{ $email ?? old('email') }}" placeholder="Enter Email" readonly class="pl-10 pr-4 py-1 pb-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2">
        </div>

        {{-- Password --}}
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
              </span>
            <input type="password" name="password" placeholder="Enter Password" class="pl-10 pr-4 py-1 pb-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2" required autocomplete="new-password" autofocus>
        </div>

        {{-- Confirm Password --}}
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 pl-3 pb-2 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
              </span>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="pl-10 pr-4 py-1 pb-1 w-full border border-gray-300 rounded focus:outline-none focus:border-indigo-500 mb-2" required autocomplete="new-password" autofocus>
        </div>
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

       
    
        <button class="bg-red-900 text-white mt-3 mb-5 lg:mb-20 rounded px-9 py-1">Change Password</button>
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
    <button name="content" value="newsandupdates" class="bg-red-900 flex-grow p-3 py-1 text-white border-solid border-r-2 border-rose-900" style="padding-left: 8px; padding-right: 0px;">News & Updates</button>
      <button name="content" value="announcement" class="bg-red-900 col-span-2 p-3 lg:px-4 py-1 text-white">Announcement</button>
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


                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
