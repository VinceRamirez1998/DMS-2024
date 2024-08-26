<!doctype html>
<html>
  @include('layouts.header')
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>DHVSU</title>
  <style>
    .dropzone {
        transition: background-color 0.3s, border-color 0.3s;
    }
    .dropzone.dragover {
        background-color: #e2e8f0; /* Tailwind's bg-gray-200 */
        border-color: #3b82f6; /* Tailwind's border-blue-500 */
    }
</style>
</head>
<body>
  <div class="flex">
  @include('layouts.sidenav')
  <div class="w-screen  h-full pb-10">
    <div class="grid grid-cols-12 md:px-2 md:pt-8 gap-4 p-2 md:p-0 md:mt-3">
      {{-- Projects --}}
      
      <div class="col-span-12">
        <form action="{{ route('submit.inquiry') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col bg-[#9d4d4d] rounded-md p-3 mx-2 md:mx-10 border-2">
          <div class="grid grid-cols-12 gap-0 md:flex-row mt-10">
            
            <div class="col-span-12 md:col-span-9 flex flex-col px-2">
              <p class="font-bold text-md text-white mb-2">Project Initiatior</p>
              <div class="flex flex-col md:flex-row items-center gap-4">
                <input name="last_name" type="text" class="w-full  rounded-md p-2 border-2 border-red-500" placeholder="Last Name">
                <input name="first_name" type="text" class="w-full rounded-md p-2 border-2 border-red-500" placeholder="First Name">
              </div>
              <div class="flex flex-col md:flex-row items-center gap-4 mt-5">
                <div class="w-full">
                  <label for="" class="font-bold text-md text-white mb-2">Email Address</label>
                  <input name="last_name" type="text" class="w-full  rounded-md p-2 border-2 pt-2 border-red-500" placeholder="Email Address">
                </div>
                <div class="w-full">
                  <label for="" class="font-bold text-md text-white mb-2">Position</label>
                  <select name="position" type="text" class="w-full  rounded-md p-2 border-2 pt-2 border-red-500" placeholder="Position">
                    <option value="" disabled selected>Select Position</option>
                    <option value="president">President</option>
                    <option value="vicepresident">Vice President</option>
                    <option value="director">Director</option>
                    <option value="centermanagement">Center Management</option>
                    <option value="areaspecialist">Area Specialist</option>
                    <option value="coordinator">Coordinator</option>
                    <option value="faculty">Faculty Extensionist</option>
                  </select>
                </div>
              </div>
              <label for="" class="font-bold text-md text-white mb-2 mt-5">Project Title</label>
              <input name="last_name" type="text" class="w-full  rounded-md p-2 border-2 pt-2 border-red-500" placeholder="Enter Project Title">
              <label for="" class="font-bold text-md text-white mb-2 mt-5">Project Description</label>
              <textarea name="last_name" type="text" class="w-full h-[10rem]  rounded-md p-2 border-2 pt-2 border-red-500 resize-none" placeholder="Enter Project Description"></textarea>
              
              </div>
            
            <div class="col-span-12 mt-5 md:mt-0 md:col-span-3 flex items-center justify-center">
              <div class="relative w-[480px] h-full">
                <div id="dropzone" class="dropzone flex items-center py-[120px] h-full border-4 border-solid border-gray-300 bg-[#9d9d9d] rounded-lg p-8 text-center cursor-pointer hover:bg-gray-50">
                  <p id="status" class="">Drag and drop files here or click to select file</p>
                  <input name="file" type="file" id="fileInput" accept=".doc,.docx,.pdf" hidden>
                </div>
              </div>
            </div>

          </div>

          <div class="col-span-12 flex justify-center items-center flex-col">
            @if ($errors->any())
                <div class="rounded-md bg-red-400  w-full md:w-[20rem] px-2 md:px-10 my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="my-1">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
            <div class="rounded-md bg-green-400 text-center w-full md:w-[20rem] px-2 md:px-10 my-2">
                    <p class="text-lg font-semibold text-white">{{ session('success') }}</p>
                </div>
            @endif
            <div class="col-span-12">
              <button class="bg-red-900 text-md font-semibold text-white w-[240px] py-1 rounded-md mt-10 mb-5">Send</button>
            </div>
            
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

  

</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
      const dropzone = document.getElementById('dropzone');
      const fileInput = document.getElementById('fileInput');
      const status = document.getElementById('status');

      // Show file input dialog when dropzone is clicked
      dropzone.addEventListener('click', () => {
          fileInput.click();
      });

      // Handle file selection via file input
      fileInput.addEventListener('change', handleFiles);

      // Handle dragover event to provide visual feedback
      dropzone.addEventListener('dragover', (event) => {
          event.preventDefault();
          dropzone.classList.add('dragover');
      });

      // Handle dragleave event to remove visual feedback
      dropzone.addEventListener('dragleave', () => {
          dropzone.classList.remove('dragover');
      });

      // Handle drop event to get files
      dropzone.addEventListener('drop', (event) => {
          event.preventDefault();
          dropzone.classList.remove('dragover');
          const files = event.dataTransfer.files;
          handleFiles({ target: { files } });
      });

      function handleFiles(event) {
          const files = event.target.files;
          const fileCount = files.length;
          
          // Update status message based on the number of files
          if (fileCount > 0) {
              status.textContent = `Uploaded ${fileCount} file${fileCount > 1 ? 's' : ''}`;
          } else {
              status.textContent = 'No files uploaded';
          }

          // Process the files here (e.g., upload them)
          console.log('Files selected:', files);
      }
  });
</script>

</html>