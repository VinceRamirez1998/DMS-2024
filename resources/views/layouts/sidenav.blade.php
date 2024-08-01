<style>
  .collapsed {
    /* width: 298.21px !important; */
    width: 37px;
  }
  .hideicons {
    display: none!important;
  }
  .menu-content {
    /* display: none; */
    display: block;
  }
  .margin-min-top {
    margin-top: 208px;
  }
</style>

<div id="menu" class="bg-red-900 hidden md:block w-[298.21px] h-screen transition-width duration-300">
  <button class="ms-1 mt-1" id="menubtn" onclick="showmenu()">
      <i class="fa-solid fa-bars text-white text-3xl"></i>
  </button>
  <div class="container-fluid">
    <div class="container flex justify-center">
      <div class="menu-content w-[150px] h-[150px] flex justify-center items-center rounded-full overflow-hidden">
        <img src="{{ asset('img/DHVSU_Logo.png') }}" class="w-full h-auto object-cover" alt="DHVSU Logo">
      </div>
    </div>
    <p class="menu-content text-center mt-2 text-white font-bold text-xl mb-5">{{ '@' . auth()->user()->username }}</p>

    {{-- Content --}}
    <div id="icon-arrange" class="container-fluid">
      {{-- Dashboard --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="" class="flex flex-nowrap items-center hover:bg-red-800 pl-0 py-1"><i class="ms-1 mt-1 fa-solid fa-gauge-high text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Dashboard</p></a>
      {{-- Repository --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-solid fa-magnifying-glass text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Repository</p></a>
      {{-- Inquiry --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-regular fa-envelope text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Inquiry</p></a>
      {{-- Notification --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-regular fa-bell text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Notification</p></a>
      {{-- Settings --}}
      <hr class="menu-content border-t-2 border-t-red-950">
      <a href="" class="flex flex-nowrap items-center hover:bg-red-800 py-1"><i class="ms-1 mt-1 fa-solid fa-sliders text-2xl text-white pb-[-15px] overflow-hidden"></i><p class="menu-content text-lg text-white text-extrabold ms-2">Settings</p></a>
    
    </div>
  </div>
</div>

<script>
  document.getElementById('menubtn').addEventListener('click', function() {
      const menu = document.getElementById('menu');
      menu.classList.toggle('collapsed');

      var icons = document.querySelectorAll('.menu-content');
      icons.forEach(function(icon) {
          icon.classList.toggle('hideicons');
      });

      var margin = document.getElementById('icon-arrange');
      margin.classList.toggle('margin-min-top');
  });
</script>
