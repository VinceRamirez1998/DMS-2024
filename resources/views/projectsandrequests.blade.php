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
  <div class="w-screen pb-3 h-screen p-2 lg:p-10">
    <div class="bg-[#f6f6f6] rounded-md h-full p-3 lg:px-10">
      <p class="font-semibold text-lg my-3 flex items-center">Proposals and Requests</p>
      <div class="grid grid-cols-12 gap-2">
        <div class="col-span-6 md:col-span-3 bg-slate-200 flex flex-row justify-between items-center px-3 py-2 rounded-md">
          <a href="" class="flex items-center container"><i class="fa-solid fa-folder text-2xl me-2"></i>Proposals</a>
        </div>
        
        <div class="col-span-6 md:col-span-3 bg-slate-200 flex flex-row justify-between items-center px-3 py-2 rounded-md">
          <a href="{{ route('requests', ['type' => 'requests']) }}" class="flex items-center container"><i class="fa-solid fa-folder text-2xl me-2"></i>Requests</a>
        </div>

      </div>
    </div>
    
  </div>
</div>

  

</body>


</html>