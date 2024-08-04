<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/heroicons@1.0.6/dist/heroicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<header>
  @if(!Auth::check())
  {{-- NOT LOGGED IN --}}
  <nav class="bg-red-900 w-full">
    <div class="flex flex-wrap items-center justify-between p-4 py-2">
      <a href="/" class="flex items-center rtl:space-x-reverse">
          <img src="{{ asset('../img/DHVSU_Logo.png') }}" class="h-10 rounded-2xl" alt="" />
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
          <li>
            <a href="#" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0" aria-current="page">Home</a>
          </li>
          <li>
            <a href="/about" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">About Us</a>
          </li>
          <li>
            <a href="/contact" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Contact Us</a>
          </li>
          <li>
            <a href="/" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Log In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @else
  {{-- LOGGED IN --}}
  <nav class="bg-red-900 w-full pr-1 pl-2 md:pl-0 md:pr-6">
    <div class="flex flex-wrap items-center justify-between">
      <a href="/dashboard" class="flex items-center rtl:space-x-reverse md:bg-[#eeeeee] py-1 px-0 md:px-[130px] md:rounded-tr-lg md:rounded-br-lg">
          <img src="{{ asset('../img/ESM.png') }}" class="h-10 rounded-3xl" alt="" />
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
          <li class="md:hidden flex justify-center items-center">
          <div class="flex flex-col">
            <p class="text-white text-center font-bold">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</p>
            <p class="text-white text-center font-bold">{{ '@' . auth()->user()->username }}</p>
          </div>
          </li>
          <li class="md:hidden">
            <a href="" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Dashboard</a>
          </li>
          <li class="md:hidden">
            <a href="" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Repository</a>
          </li>
          @if(Auth()->user()->purpose == 'request')
          <li class="md:hidden">
            <a href="/downloadable" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Downloadable Forms</a>
          <li>
          @endif
          <li class="md:hidden">
            <a href="/inquiry" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Inquiry</a>
          </li>
          <li class="md:hidden">
            <a href="" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Notification</a>
          </li>
          <li class="md:hidden">
            <a href="/settings" class="block py-2 px-1 text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Settings</a>
          </li>
          <li>
            <p class="text-white ms-[3px] md:ms-0 my-2 md:my-0">{{ date('m/d/Y') }}</p>
          </li>
          <li>
            <div class="flex flex-row items-center ms-1 mt-1 md:ms-0 md:mt-0">
              <i class="fa-solid fa-right-from-bracket text-white me-2 pt-1"></i>
              <a href="{{ route('logout') }}" class="text-white dark:hover:bg-red-500 md:dark:hover:bg-transparent rounded md:p-0">Log out</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @endif
</header>
<body>
    
</body>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</html>