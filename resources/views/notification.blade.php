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
  <div class="w-screen pb-3 h-screen">
    <form action="" method="POST">
      @csrf
    <div class="grid grid-cols-12 md:px-2 md:pt-8 gap-2 p-2 md:p-0 md:mt-3">
      <div class="col-span-12 flex items-center">
          <button name="category" value="all" type="submit" class="bg-red-900 text-white font-bold px-3 py-2 rounded-md me-1">All</button>
          <button name="category" value="read" type="submit" class="bg-red-900 text-white font-bold px-3 py-2 rounded-md me-1">Read</button>
          <button name="category" value="unread" type="submit" class="bg-red-900 text-white font-bold px-3 py-2 rounded-md me-1">Unread</button>
          <button name="delete" class=" py-2 px-3 ">Delete</button>
      </div>

      <div class="col-span-12">
        <div class="col-span-12 flex items-center mb-2">
            <input type="checkbox" name="" id="selectAll" class="rounded-md">
            <label for="selectAll" class="ms-2">Select All</label>
        </div>
        <div class="flex flex-col gap-2 bg-[#eeeeee] rounded-md px-0 border-2 border-red-500 overflow-y-scroll max-h-[83vh]">
    
            @for ($i=1; $i<30; $i++)
            <div class="flex items-center ps-2 border-b-2 border-gray-500 py-2 pe-2">
                <input type="checkbox" name="" id="mail{{$i}}" class="rounded-md me-1 item-checkbox">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus, quas.</p>
                <p class="ml-auto">07/24</p>
            </div>
            @endfor
        </div>
    </div>
        

        </div>
      </div>
    </div>
    </form>
  </div>
</div>

<script>
  document.getElementById('selectAll').addEventListener('change', function() {
      var checkboxes = document.querySelectorAll('.item-checkbox');
      checkboxes.forEach(function(checkbox) {
          checkbox.checked = this.checked;
      }, this);
  });
</script>

</body>


</html>