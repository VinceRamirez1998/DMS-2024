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
    <form action="{{ route('notification.update') }}" method="POST">
    @csrf
    <div class="grid grid-cols-12 md:px-2 md:pt-8 gap-2 p-2 md:p-0 md:mt-3">
      <div class="col-span-12 flex items-center">
          <a href="/notifications" name="category" value="all" type="submit" class="bg-red-900 text-white font-bold px-3 py-2 rounded-md me-1">All</a>
          <a href="{{ route('notification.route', ['route'=>'read']) }}" value="read" type="submit" class="bg-red-900 text-white font-bold px-3 py-2 rounded-md me-1">Read</a>
          <a href="{{ route('notification.route',['route'=>'unread']) }}" value="unread" type="submit" class="bg-red-900 text-white font-bold px-3 py-2 rounded-md me-1">Unread</a>
          <button name="category" value="delete" class=" py-2 px-3 ">Delete</button>
          <button name="category" value="markasread" class=" py-2 px-3 ">Mark as read</button>
      </div>

      <div class="col-span-12 h-[85vh] overflow-y-auto">
        <div class="col-span-12 flex items-center mb-2">
            <input type="checkbox" name="" id="selectAll" class="rounded-md">
            <label for="selectAll" class="ms-2 cursor-pointer">Select All</label>
        </div>
        @if(count($notifications) > 0)
          @foreach($notifications as $notification)
          <div class="flex flex-col bg-[#eeeeee] rounded-md px-0 border-2 border-red-500">
    
            <div class="flex items-center ps-2 border-b-2 {{ $notification->status == 'unread' ? 'bg-[#eeeeee]' : 'bg-[#c5c2c2]' }} border-gray-500 py-2 pe-2">
                <input type="checkbox" name="id[]" value="{{ $notification->id }}" id="mail{{$notification->id}}" class="rounded-md me-1 item-checkbox">
                <div class="flex flex-col container">
                  <button type="submit" name="read" value="{{ $notification->id }}" class="text-left">Subject: {{ $notification->title }}</button>
                  <p class="text-xs mb-1">From: <span class="italic">{{ $notification->sender }}</span></p>
                  <hr class="border-t border-gray-900 my-2">
                  <p class="text-sm">{{ $notification->message }}</p>
                </div>
                <p class="ml-auto">{{ $notification->created_at->format('m/y') }}</p>
            </div>
          </div>
            @endforeach
          @else
          <p>No notifications yet.</p>
          @endif
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