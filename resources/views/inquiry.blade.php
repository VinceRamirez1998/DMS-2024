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
  <div class="w-screen pb-3">
    <div class="grid grid-cols-12 md:px-2 md:pt-8 gap-4 p-2 md:p-0 md:mt-3">
      {{-- Projects --}}
      <div class="col-span-12">
        <div class="flex flex-col gap-2 bg-[#eeeeee] rounded-md p-3 border-2 border-red-500">
          <label for="title" class="text-lg">Title</label>
          <input type="text" id="title" class="w-full md:w-[370px] rounded-md p-2 border-2 border-red-500" placeholder="">
          <label for="position" class="text-lg">Position</label>
          <input type="text" id="position" class="w-full md:w-[370px] rounded-md p-2 border-2 border-red-500" placeholder="">
          <label for="location" class="text-lg">Location</label>
          <input type="text" id="location" class="w-full md:w-[370px] rounded-md p-2 border-2 border-red-500" placeholder="">
          @if(Auth()->user()->purpose == 'inquire')
          <label for="inquiry" class="text-lg">Inquiry</label>
          <textarea type="text" id="inquiry" class="w-full h-[290px] rounded-md p-2 border-2 border-red-500 resize-none" placeholder=""></textarea>
          @elseif(Auth()->user()->purpose == 'request')
          <div class="flex items-center justify-center mt-10">
            <div class="relative w-[480px]">
              <div id="dropzone" class="dropzone py-[120px] border-2 border-dashed border-gray-300 bg-white rounded-lg p-8 text-center cursor-pointer hover:bg-gray-50">
                <p id="status" class="text-gray-600">Drag and drop files here or click to select file</p>
                <input type="file" id="fileInput" accept=".doc,.docx,.pdf" hidden>
              </div>
            </div>
        </div>
          @endif
          <div class="col-span-12 flex justify-center">
            <button class="bg-red-900 text-md font-semibold text-white w-[240px] py-1 rounded-md">Send</button>
          </div>
          
      </div>
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