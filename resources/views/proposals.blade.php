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
  <div class="flex h-auto">
  @include('layouts.sidenav')
  <div class="w-screen pb-3 min-h-screen p-2 lg:p-10">
    <div class="bg-[#f6f6f6] rounded-md flex flex-col h-full overflow-hidden">
        <p class="font-semibold text-lg my-3 pl-3 md:pl-5 flex items-center">
            <a href="{{ route('projectsandrequests') }}" class="me-3"><i class="fa-solid fa-chevron-left"></i></a>Proposals
        </p>
        <div class="h-screen w-full overflow-y-scroll">
        <div class="grid grid-cols-12 gap-2 pb-3 px-3 md:px-5">

        @foreach($proposal->unique('project_title') as $proposal)
        <div class="col-span-6 md:col-span-3 bg-slate-200 flex justify-between items-center px-3 py-2 rounded-md">
            <div class="flex-1 min-w-0">
                <a href="{{ route('proposals.folder', ['folder' => $proposal->project_title]) }}" class="flex items-center">
                    <i class="fa-solid fa-folder text-2xl me-2"></i>
                    <p class="overflow-hidden whitespace-nowrap text-ellipsis">{{ $proposal->project_title }}</p>
                </a>
            </div>
        </div>
        @endforeach
        </div>
      </div>
      </div>
    </div>

  

</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const toggleDropdown = (buttonId, menuId) => {
          const dropdownButton = document.getElementById(buttonId);
          const dropdownMenu = document.getElementById(menuId);

          dropdownButton.addEventListener('click', function () {
              document.querySelectorAll('[id^=dropdownMenu]').forEach(menu => {
                  if (menu.id !== menuId) {
                      menu.classList.add('hidden');
                  }
              });

              dropdownMenu.classList.toggle('hidden');
          });
      };

      @for ($i = 1; $i <= 12; $i++)
          toggleDropdown('dropdownButton{{ $i }}', 'dropdownMenu{{ $i }}');
      @endfor

      document.addEventListener('click', function (event) {
          document.querySelectorAll('[id^=dropdownMenu]').forEach(menu => {
              const button = document.getElementById(menu.id.replace('Menu', 'Button'));
              if (!button.contains(event.target) && !menu.contains(event.target)) {
                  menu.classList.add('hidden');
              }
          });
      });
  });
</script>


</html>