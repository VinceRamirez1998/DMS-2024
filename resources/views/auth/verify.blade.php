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
  @php
    $announcements = App\Models\Announcement::all();
    $newsAndEvents = App\Models\NewsAndEvents::all();
    
    // Get the section from the request, defaulting to 'announcements'
    $section = request()->get('section', 'announcements');
  @endphp
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
    <div class="col-span-6 lg:col-span-5 flex">
      <a href="{{ route('verification.notice', ['section' => 'news']) }}" class="bg-red-900 flex-grow p-3 py-1 text-white border-solid border-r-2 border-rose-900"  style="padding-left: 8px; padding-right: 0px; white-space: nowrap;">News & Events</a>
      <a href="{{ route('verification.notice', ['section' => 'announcements']) }}" class="bg-red-900 col-span-2 p-3 lg:px-4 py-1 text-white">Announcement</a>
    </div>
  </form>

  {{-- Block --}}
  <div class="hidden md:block col-span-12 lg:col-start-6"></div>
  
  {{-- Announcements Section --}}
  <div id="announcementsSection" class="{{ $section === 'announcements' ? '' : 'hidden' }} col-span-12 lg:col-span-5 flex flex-col mb-3 bg-gray-300 p-2 border-2 rounded-r rounded-bl border-gray-800">
    @if($announcements->isEmpty())
        <p class="text-center">No Announcements</p>
    @else
    @foreach($announcements as $announcement)
        <div class="announcement-item cursor-pointer" 
             data-title="{{ $announcement->title }}" 
             data-content="{!! $announcement->content !!}">
             
            <h3 class="font-bold">{{ $announcement->title }}</h3>
        </div>
    @endforeach
    @endif
  </div>

  {{-- News and Events Block --}}
  <div id="newsSection" class="{{ $section === 'news' ? '' : 'hidden' }} col-span-12 lg:col-span-5 flex flex-col mb-3 bg-gray-300 p-2 border-2 rounded-r rounded-bl border-gray-800">
    @if($newsAndEvents->isEmpty())
        <p class="text-center">No News & Events</p>
    @else
    @foreach($newsAndEvents as $news)
        <div class="news-item cursor-pointer" 
             data-title="{{ $news->title }}" 
             data-content="{!! $news->content !!}">
             
            <h3 class="font-bold">{{ $news->title }}</h3>
        </div>
    @endforeach
    @endif
  </div>

  <div class="hidden md:block col-span-12 lg:col-start-6"></div>
</div>

<!-- Modal Structure -->
<div id="announcementModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-lg p-5 w-1/3">
      <h2 id="modalTitle" class="text-xl font-bold"></h2>
      <p id="modalContent" class="mt-2"></p>
      <button id="closeModal" class="mt-4 bg-red-500 text-white p-2 rounded">Close</button>
  </div>
</div>


{{-- Annoncements --}}
<script>
  // Function to show the modal
  const showModal = (title, content) => {
      document.getElementById('modalTitle').innerText = title;
      document.getElementById('modalContent').innerHTML = content;
      document.getElementById('announcementModal').classList.remove('hidden');
  };

  // Set up modal for announcements and news
  const setupModal = (itemClass) => {
      document.querySelectorAll(itemClass).forEach(item => {
          item.addEventListener('click', () => {
              const title = item.getAttribute('data-title');
              const content = item.getAttribute('data-content');
              showModal(title, content);
          });
      });
  };

  // Set up modals for both sections
  setupModal('.announcement-item');
  setupModal('.news-item');

  // Close modal functionality
  document.getElementById('closeModal').addEventListener('click', () => {
      document.getElementById('announcementModal').classList.add('hidden');
  });

  // Switch between announcements and news
  document.getElementById('announcementButton').addEventListener('click', () => {
      document.getElementById('announcementsSection').classList.remove('hidden');
      document.getElementById('newsSection').classList.add('hidden');
  });

  document.getElementById('newsButton').addEventListener('click', () => {
      document.getElementById('newsSection').classList.remove('hidden');
      document.getElementById('announcementsSection').classList.add('hidden');
  });
</script>

</body>
</html>
