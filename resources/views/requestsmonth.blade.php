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
            <i class="fa-solid fa-chevron-left mr-3"></i>
            <a href="{{ route('requests') }}" class="">Requests</a>
            <i class="fa-solid fa-chevron-left mx-3"></i>
            <a href="{{ route('requests.month', ['month' => $month]) }}">{{ $month }}</a>
        </p>
        <div class="h-screen w-full overflow-y-scroll">
        <div class="grid grid-cols-12 gap-2 pb-3 px-3 md:px-5">

          
          @foreach($file as $file)
          <div class="col-span-12 md:col-span-3 bg-slate-200 flex justify-between items-center px-3 py-2 rounded-md">

            <div class="flex-1 min-w-0">
                <a href="{{ route('requests.folder', ['month' => $month, 'folder' => $file->id]) }}" class="flex items-center">
                    <i class="fa-solid fa-folder text-2xl me-2"></i>
                    <p class="overflow-hidden whitespace-nowrap text-ellipsis">{{ $file->title }}</p>
                </a>
            </div>

            <div class="relative">
                <button class="p-2" id="dropdownButton{{ $file->id }}">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div id="dropdownMenu{{ $file->id }}" class="hidden flex flex-col absolute right-5 top-1 z-10 bg-white border border-gray-400 mt-2 rounded-md">
                 
                    <form action="{{ route('requests.option',['month'=>$month, 'folder'=>$file->id]) }}" method="POST">
                        @csrf
                        <button name="option" value="rename" type="button" id="rename-button-{{ $file->id }}" class="p-2">Rename</button>
                        <hr class="border-b border-gray-400">
                        <button name="option" value="delete" type="button" id="delete-button-{{ $file->id }}" class="p-2">Delete</button>

                        <!-- Rename Modal -->
                        <div id="rename-modal-{{ $file->id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-5 rounded-lg">
                                <h2 class="text-lg font-semibold mb-4">Rename Folder</h2>
                                <input type="text" name="new_name" class="w-full p-2 border border-gray-300 rounded mb-4" value="{{ $file->title }}" placeholder="Rename Folder" required>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" id="cancel-button-{{ $file->id }}" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                                    <button name="option" value="rename" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Rename</button>
                                    <input type="hidden" name="folder_id" value="{{ $file->id }}">
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div id="delete-modal-{{ $file->id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-5 rounded-lg">
                                <h2 class="text-lg font-semibold mb-4">Delete Folder?</h2>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" id="cancel-delete-{{ $file->id }}" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                                    <button name="option" value="delete" type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                                    <input type="hidden" name="folder_id" value="{{ $file->id }}">
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const dropdownButton{{ $file->id }} = document.getElementById('dropdownButton{{ $file->id }}');
                            const dropdownMenu{{ $file->id }} = document.getElementById('dropdownMenu{{ $file->id }}');
            
                            dropdownButton{{ $file->id }}.addEventListener('click', function () {
                                document.querySelectorAll('[id^=dropdownMenu]').forEach(menu => {
                                    if (menu.id !== 'dropdownMenu{{ $file->id }}') {
                                        menu.classList.add('hidden');
                                    }
                                });
            
                                dropdownMenu{{ $file->id }}.classList.toggle('hidden');
                            });
            
                            document.addEventListener('click', function (event) {
                                if (!dropdownButton{{ $file->id }}.contains(event.target) && !dropdownMenu{{ $file->id }}.contains(event.target)) {
                                    dropdownMenu{{ $file->id }}.classList.add('hidden');
                                }
                            });
                        });
                    </script>

                    <script>
                        document.getElementById('rename-button-{{ $file->id }}').addEventListener('click', function() {
                            document.getElementById('rename-modal-{{ $file->id }}').classList.remove('hidden');
                        });
                
                        document.getElementById('cancel-button-{{ $file->id }}').addEventListener('click', function() {
                            document.getElementById('rename-modal-{{ $file->id }}').classList.add('hidden');
                        });

                        document.getElementById('delete-button-{{ $file->id }}').addEventListener('click', function() {
                            document.getElementById('delete-modal-{{ $file->id }}').classList.remove('hidden');
                        });
                
                        document.getElementById('cancel-delete-{{ $file->id }}').addEventListener('click', function() {
                            document.getElementById('delete-modal-{{ $file->id }}').classList.add('hidden');
                        });
                    </script>
               
                </div>
            </div>
        </div>
        
   
          @endforeach
        </div>
      </div>
      </div>
    </div>

  

</body>



</html>