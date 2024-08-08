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
  <div class="flex h-screen">
    @include('layouts.sidenav')
  <div class="w-screen py-20">
    <div class="grid grid-cols-12 md:px-8 md:pt-8 gap-4 p-2 md:p-0">
    <div class="col-span-12 lg:col-span-6 lg:col-start-4 flex bg-[#bd8889] rounded-md p-3 border-2 border-red-500">
      <div class="flex flex-col justify-center w-full">
      <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="mx-auto">
      @csrf
        {{-- Profile Picture --}}
      <div class="justify-center flex">
          <div class="relative mt-10">
            <div class="h-[180px] w-[180px] flex justify-center items-center border-4 border-black rounded-full overflow-hidden">
              <img id="profile-image" src="{{ auth()->user()->profile_picture ? asset('img/profile/'.auth()->user()->profile_picture) : 'https://via.placeholder.com/180' }}" alt="" class="w-full h-full object-cover">
          </div>
          <input name="profile" id="image-input" type="file" class="hidden" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
          <label for="image-input" class="absolute z-1 bottom-0 right-0 bg-white rounded-full p-2 px-3 border-2 border-gray-500 cursor-pointer">
            <i class="fa-solid fa-camera text-gray-500 text-2xl"></i>
          </label>
        </div>
      </div>
      {{-- Success and Error Message --}}
      <div class="col-span-5 mt-5">
        @if(session('success'))
        <div class="bg-[#eeeeee] text-black p-2 rounded-md">
          {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-900 text-white p-2 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="grid grid-cols-5 gap-4 md:gap-4 mt-5 pb-5">
          <div class="col-span-5 mt-10">
            <div class="flex flex-row justify-center">
              <button type="submit" name="btn" value="save" class="bg-red-900 text-white rounded-md font-semibold px-[55px] py-1">Save</button>
              <button type="submit" name="btn" value="cancel" class="bg-red-900 text-white rounded-md font-semibold px-12 py-1 ms-2">Cancel</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
      
       

    </div>
  </div>
</div>

<script>
  function previewImage(event) {
      const fileInput = event.target;
      const profileImage = document.getElementById('profile-image');

      // Check if file input is not empty
      if (fileInput.files && fileInput.files[0]) {
          const file = fileInput.files[0];
          const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

          // Validate file type
          if (!allowedTypes.includes(file.type)) {
              alert('Please select a valid image file (PNG, JPG, or JPEG).');
              fileInput.value = ''; // Clear the input
              return;
          }

          const reader = new FileReader();

          reader.onload = function(e) {
              profileImage.src = e.target.result;
          }

          reader.readAsDataURL(file);
      }
  }
</script>


</body>

</html>