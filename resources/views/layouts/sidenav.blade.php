<style>
  .collapsed {
    width: 298.21px !important;
    /* width: 37px; */
  }
  .hideicons {
    /* display: none!important; */
    display:block!important;
  }
  .menu-content {
    display: none;
    /* display: block; */
  }
  .margin-min-top {
    margin-top: 0px;
  }
</style>
<div id="menu" class="bg-red-900 hidden md:block w-[37px] h-auto transition-width duration-300 col-auto">
  <button class="ms-1 mt-1" id="menubtn">
      <i class="fa-solid fa-bars text-white text-3xl"></i>
  </button>
  <div class="container-fluid">
    <div class="container flex justify-center">
      <div id="profile-container" class="w-[150px] h-[150px] invisible flex justify-center items-center rounded-full overflow-hidden">
        @if(auth()->user()->profile_picture)
        <img src="{{ asset('img/profile/'.auth()->user()->profile_picture) }}" alt="" class="w-full h-full object-cover">
        @else
        <img src="https://via.placeholder.com/180" alt="" class="w-full h-auto object-cover">
        @endif
      </div>
    </div>
    <p class="menu-content text-center mt-2 text-white font-bold text-xl mb-5">{{ '@' . auth()->user()->username }}</p>

    {{-- Content --}}
    <div id="icon-arrange" class="container-fluid overflow-hidden relative">
      {{-- Dashboard --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="/dashboard" class="flex flex-nowrap items-center hover:bg-red-800 pl-0 py-1"><i class="ms-1 mt-1 fa-solid fa-gauge-high text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Dashboard</p></a>

      {{-- Repository --}}
      @if(Auth()->user()->position != null)
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="{{ route('repository',['category' => 'ongoing']) }}" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-solid fa-magnifying-glass text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Repository</p></a>
      @endif
      @if(Auth()->user()->purpose == 'request' && Auth()->user()->position != null)
      {{-- Downloadable Forms --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="/downloadable" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-2 mt-1 fa-regular fa-file-lines text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Downloadable Forms</p></a>
      @endif
      {{-- Dropdown Proposal --}}
      @if(Auth()->user()->role == 'president' || Auth()->user()->role == 'vicepresident' || Auth()->user()->role == 'director')
      <hr class="menu-content border-t-2 border-t-red-950">
      <button onclick="dropdownproposal()" class="flex flex-nowrap flex-row items-center py-1"><i class="ms-1 mt-1 fa-solid fa-folder text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Repository</p><i id="caret-proposal" class="fa-solid fa-caret-up transition text-white absolute right-5 hidden"></i></button>
      @endif
      <div id="dropdown-proposal" class="hidden">
        <ul>
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href=""><b>+</b> Projects</a></li>
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="/proposals"><b>+</b> Proposals</a></li>
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="/requests"><b>+</b> Requests</a></li>
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="/inquiry"><b>+</b> Inquiries</a></li>
          @if(Auth()->user()->role == 'coordinator')
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="{{ route('proposal.form') }}">• Upload Proposal</a></li>
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="">• Folder</a></li>
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="">• Remarks</a></li>
          @elseif(Auth()->user()->role == 'areaspecialist' || Auth()->user()->role == 'centermanagement')
          <li class="ps-5 text-white hover:bg-red-800 py-1"><a href="/projectsandrequests">• Projects and Requests</a></li>
          @endif
        </ul>
      </div>
      {{-- Inquiry --}}
      @if(Auth()->user()->position != null)
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="/inquiry" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-regular fa-envelope text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Inquiry</p></a>
      @endif

      {{-- Notification --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="/notification" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-regular fa-bell text-2xl text-white pb-[-15px] overflow-hidden relative">
        {{-- If there is notification --}}
        {{-- <span class="p-1 rounded-full bg-yellow-300 absolute top-[7px] right-0"></span> --}}

      </i><p class="menu-content text-lg text-white text-extrabold ms-2">Notification</p></a>
      {{-- Settings --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="/settings" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-solid fa-sliders text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Settings</p></a>
      </div>
    </div>
</div>

<script>
  document.getElementById('menubtn').addEventListener('click', function() {
      const menu = document.getElementById('menu');
      const profile = document.getElementById('profile-container');
      menu.classList.toggle('collapsed');
      profile.classList.toggle('invisible');

      var icons = document.querySelectorAll('.menu-content');
      icons.forEach(function(icon) {
          icon.classList.toggle('hideicons');
      });

      var caret = document.getElementById("caret-proposal");
      caret.classList.toggle('hidden');

      if (caret.classList.contains("rotate-180")) {
      caret.classList.toggle("rotate-180");
      }

      var dropdownproposal = document.getElementById("dropdown-proposal");
      dropdownproposal.classList.add("hidden");

      var margin = document.getElementById('icon-arrange');
      margin.classList.toggle('margin-min-top');
  });

  function dropdownproposal() {
          var dropdown = document.getElementById("dropdown-proposal");
          var caret = document.getElementById("caret-proposal");
          var menu = document.getElementById('menu');
          
          if(menu.classList.contains('collapsed')){
            dropdown.classList.toggle("hidden");
          }else{
            dropdown.classList.add("hidden");
          }
        
          caret.classList.toggle("rotate-180");
        }
</script>
