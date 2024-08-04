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
  <div class="flex">
    @include('layouts.sidenav')
  <div class="w-screen pb-5">
    <div class="grid grid-cols-12 md:px-8 md:pt-8 gap-4 p-2 md:p-0">
    {{-- Projects --}}
    <div class="col-span-12 lg:col-span-6 lg:col-start-4 flex bg-[#eeeeee] rounded-md p-3 border-2 border-red-500">
      <div class="flex flex-col justify-center w-full">
        {{-- Profile Picture --}}
        <div class=" justify-center flex">
          <div class="relative mt-10">
            <div class="h-[180px] w-[180px] flex justify-center items-center object-cover border-4 border-black rounded-full overflow-hidden">
              <img src="{{ asset('img/ESM.png') }}" alt="Profile Picture" class="w-100 h-100">
            </div>
            <a href="#" class="absolute z-[999] bottom-0 right-0 bg-white rounded-full p-2 px-3 border-2 border-gray-500"><i class="fa-solid fa-camera text-gray-500 text-2xl"></i></a>
          </div>
        </div>
        <div class="grid grid-cols-5 grid-rows-5 gap-4 mx-auto mt-5 pb-5">
          {{-- Full Name --}}
          <div class="col-span-5 md:col-span-3">
            <div class="flex flex-col">
              <p>Full Name</p>
              <input type="text" class="w-full py-1 rounded-md p-2 border-2 border-red-500"  value="{{ Auth()->user()->firstname . ' ' . Auth()->user()->lastname }}" readonly>
            </div>
          </div>
          {{-- Email --}}
          <div class="col-span-5 md:col-span-3">
            <div class="flex flex-col">
              <p>Email</p>
              <input type="text" class="w-full py-1 rounded-md p-2 border-2 border-red-500" value="{{ Auth()->user()->email }}" readonly>
            </div>
          </div>
          {{-- Username --}}
          <div class="col-span-5 md:col-span-3">
            <div class="flex flex-col">
              <p>Username</p>
              <input type="text" class="w-full py-1 rounded-md p-2 border-2 border-red-500" value="{{ '@' . Auth()->user()->username }}" readonly>
            </div>
          </div>
          {{-- Password --}}
          <div class="col-span-5 md:col-span-3">
            <div class="flex flex-col">
              <p>Password</p>
              <input type="text" class="w-full py-1 rounded-md p-2 border-2 border-red-500" placeholder="Enter Password">
              <button class="bg-red-900 text-white rounded-md font-semibold px-7 py-1 h-[32px] md:hidden">Change&nbsp;Password</button>
            </div>
          </div>
          <div class="col-span-3 md:col-span-2 md:col-start-4 md:items-end flex hidden md:block items-end">
              <button class="bg-red-900 text-white rounded-md font-semibold px-7 py-1 h-[32px]">Change&nbsp;Password</button>
          </div>
          {{-- Contact --}}
          <div class="col-span-5 md:col-span-3">
            <div class="flex flex-col">
              <p>Contact No.</p>
              <input type="text" class="w-full py-1 rounded-md p-2 border-2 border-red-500" placeholder="Enter Contact No.">
              <button class="bg-red-900 text-white rounded-md font-semibold px-7 py-1 h-[32px] md:hidden">Change&nbsp;Number</button>
            </div>
          </div>
          
          <div class="col-span-5 mt-5">
            <div class="flex flex-row justify-center">
              <button class="bg-red-900 text-white rounded-md font-semibold px-[55px] py-1">Save</button>
              <button class="bg-red-900 text-white rounded-md font-semibold px-12 py-1 ms-2">Cancel</button>
            </div>
          </div>
      </div>
      </div>
    </div>
      
       

    </div>
  </div>
</div>

</script>

{{-- Ongoing Project --}}
<script>
  // Toggle Ongoing Project Content
  document.getElementById('toggleOngoingBtn').addEventListener('click', function() {
    var content = document.getElementById('ongoingContent');
    content.classList.toggle('hidden');
  });

  // Show Image
  document.getElementById('showImageBtn').addEventListener('click', function() {
    document.getElementById('imageModal').classList.remove('hidden');
  });

  // Close Button
  document.getElementById('closeImageBtn').addEventListener('click', function() {
    document.getElementById('imageModal').classList.add('hidden');
  });

  // Close Ongoing Modal
  document.getElementById('imageModal').addEventListener('click', function(event) {
    if (event.target === this) {
      this.classList.add('hidden');
    }
  });
</script>

{{-- Completed Project --}}
<script>
  // Toggle Ongoing Project Content
  document.getElementById('toggleCompletedBtn').addEventListener('click', function() {
    var content = document.getElementById('completedContent');
    content.classList.toggle('hidden');
  });

  // Show Image
  document.getElementById('showImageBtnCompleted').addEventListener('click', function() {
    document.getElementById('imageModalCompleted').classList.remove('hidden');
  });

  // Close Button
  document.getElementById('closeImageBtnCompleted').addEventListener('click', function() {
    document.getElementById('imageModalCompleted').classList.add('hidden');
  });

  // Close Ongoing Modal
  document.getElementById('imageModalCompleted').addEventListener('click', function(event) {
    if (event.target === this) {
      this.classList.add('hidden');
    }
  });
</script>

</body>

</html>