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
        {{-- Change Password --}}
        <form action="{{ route('settings.password.update') }}" method="POST" class="mx-auto">
          @csrf
        <div class="grid grid-cols-5 gap-4 md:gap-4 mt-5 pb-5">
          {{-- Current Password --}}
          <div class="col-span-5 md:col-span-5">
            <div class="flex flex-col">
              <p>Current Password</p>
              <input name="current_password" type="password" class="w-full py-1 rounded-md p-2 border-2 border-red-500" placeholder="Current Password">
            </div>
          </div>
          {{-- New Password --}}
          <div class="col-span-5 md:col-span-5">
            <div class="flex flex-col">
                <p>Password</p>
                <input name="password" type="password" class="w-full py-1 rounded-md p-2 border-2 border-red-500" placeholder="Enter New Password">
            </div>
        </div>
          {{-- Confirm Password --}}
          <div class="col-span-5 md:col-span-5">
            <div class="flex flex-col">
              <p>Confirm Password</p>
              <input name="password_confirmation" type="password" class="w-full py-1 rounded-md p-2 border-2 border-red-500" placeholder="Enter Confirm Password">
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

          {{-- Save and Cancel --}}
          <div class="col-span-5 mt-5">
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