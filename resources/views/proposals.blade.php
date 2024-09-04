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
                    <!-- Folder link triggers modal by setting a unique ID -->
                    <a href="{{ route('proposals.folder', ['folder' => $proposal->project_title]) }}" class="flex items-center">
                        <i class="fa-solid fa-folder text-2xl me-2"></i>
                        <p class="overflow-hidden whitespace-nowrap text-ellipsis">{{ $proposal->project_title }}</p>
                    </a>
                </div>
        
                <!-- Vertical Ellipsis Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown('{{ $proposal->id }}')" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div 
                        id="dropdown-{{ $proposal->id }}" 
                        class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-10"
                    >
                        <ul class="py-1">
                            <li>
                                <button onclick="openModal('{{ $proposal->id }}'); hideDropdown('{{ $proposal->id }}')" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    See comments
                                </button>
                            </li>
                            <li>
                                <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                    Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <!-- Modal -->
                <div 
                    id="modal-{{ $proposal->id }}" 
                    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                >
                    <div class="bg-[#282828] text-white rounded-lg shadow-lg w-3/4 max-w-xl">
                        <div class="p-4 border-b flex justify-between items-center">
                            <h2 class="text-lg font-semibold">{{ $proposal->project_title }}</h2>
                            <button onclick="closeModal('{{ $proposal->id }}')" class="text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <!-- Proposal Details Here -->
                            <p>{{ $proposal->description }}</p>
                        </div>
                        <form action="#" method="post">
                        @csrf
                        <div class="flex justify-end p-4 border-t">
                                <input type="text" class="w-full rounded-3xl text-black" name="" placeholder="Write a comment..." id="">
                                <button class="text-white px-3 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send rotate-45" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                      </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        
        <!-- JavaScript Functions -->
        <script>
            function openModal(id) {
                document.getElementById('modal-' + id).classList.remove('hidden');
            }
        
            function closeModal(id) {
                document.getElementById('modal-' + id).classList.add('hidden');
            }
        
            function toggleDropdown(id) {
                const dropdown = document.getElementById('dropdown-' + id);
                dropdown.classList.toggle('hidden');
            }
        
            function hideDropdown(id) {
                const dropdown = document.getElementById('dropdown-' + id);
                dropdown.classList.add('hidden');
            }
        </script>
        
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