<!doctype html>
<html>
  @include('layouts.header')
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/piechart.css') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>DHVSU</title>
</head>
<body>
  <div class="flex h-auto">
  @include('layouts.sidenav')
  <div class="w-screen h-full pb-5">
    <div class="grid grid-cols-12 md:pl-8 md:pt-8 gap-4 p-2 md:p-0 h-auto">
    @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator'|| auth()->user()->role == 'areaspecialist'|| auth()->user()->role == 'centermanagement')
      {{-- Video --}}
      <div class="col-span-12 md:col-span-7">
        {{-- Users and Coordinator --}}
        @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator')
        <iframe class="p-2 bg-[#bd8889] w-[100%] md:w-[620px] h-100 md:h-[349px] rounded-md border-2 border-red-500" src="https://www.youtube.com/embed/hwTrdzc6NmY?autoplay=1&loop=1&playlist=hwTrdzc6NmY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        {{-- Area Specialist and Center Management --}}
        @elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement')
        <div class="grid grid-cols-4 grid-rows-8 gap-4 h-full lg:px-20">
          <div class="col-span-2 row-span-4 flex flex-col justify-center items-center rounded-md bg-[#bc8888]"><p class="text-4xl font-extrabold  pt-5">{{ $total_inquiries ?? '0' }}</p><p class="text-lg font-semibold mt-5 pb-5">Total Inquiries</p></div>
          <div class="col-span-2 row-span-4 col-start-3 flex flex-col justify-center items-center rounded-md bg-[#bc8888]"><p class="text-4xl font-extrabold  pt-5">{{ $total_requests ?? '0' }}</p><p class="text-lg font-semibold mt-5 pb-5">Total Requests</p></div>
          <div class="col-span-2 row-span-4 row-start-5 flex flex-col justify-center items-center rounded-md bg-[#bc8888]"><p class="text-4xl font-extrabold  pt-5">2</p><p class="text-lg font-semibold mt-5 pb-5 text-center">Total On-going Projects</p></div>
          <div class="col-span-2 row-span-4 col-start-3 row-start-5 flex flex-col justify-center items-center rounded-md bg-[#bc8888]"><p class="text-4xl font-extrabold  pt-5">2</p><p class="text-lg font-semibold mt-5 pb-5 text-center">Total Completed Projects</p></div>
        </div>
        @endif
      </div>
      {{-- Announcement --}}
      <div class="col-span-12 md:col-span-5 bg-[#bd8889] rounded-md border-2 border-red-500">
        <div class="container-fluid w-100">
          <p class="text-xl ps-3 mt-2 mb-0 py-3 bg-red-900 text-white font-semibold">Notice Board</p>
          <div class="flex flex-col container px-7 h-[277px] overflow-y-scroll">

            {{-- Iterate announcements --}}
            @for ($i=1; $i<30; $i++)
            <p class="ms-1">• Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, in!</p>
            @endfor
            {{-- end of iteration --}}

          </div>
        </div>
      </div>
      {{-- Projects --}}
         <div class="col-span-12 mb-3">
         <div class="flex flex-row justify-between mb-4 gap-2">
          <!-- Inquiries Box -->
          <div class="flex items-center bg-blue-500 p-4 rounded-md text-white font-semibold w-1/3">
              <!-- Heroicon for Question Mark -->
              <svg class="h-16 w-16 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
              </svg>
              <div>
                  <h2 class="text-lg">Inquiries</h2>
                  <p class="text-2xl font-bold">0</p> <!-- Replace with dynamic count if needed -->
              </div>
          </div>
          
          <!-- Requests Box -->
          <div class="flex items-center bg-green-500 p-4 rounded-md text-white font-semibold w-1/3">
              <!-- Heroicon for Paper Airplane -->
              <svg class="h-16 w-16 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
              </svg>              
              <div>
                  <h2 class="text-lg">Requests</h2>
                  <p class="text-2xl font-bold">0</p> <!-- Replace with dynamic count if needed -->
              </div>
          </div>
          
          <!-- Project List Box -->
          <div class="flex items-center bg-yellow-500 p-4 rounded-md text-white font-semibold w-1/3">
              <!-- Heroicon for List -->
              <svg class="h-16 w-16 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
              </svg>              
              <div>
                  <h2 class="text-lg">Project List</h2>
                  <p class="text-2xl font-bold">0</p> <!-- Replace with dynamic count if needed -->
              </div>
          </div>
      </div>
      @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator')
        <div class="flex flex-row">
          <a href="{{ route('repository',['category' => 'ongoing']) }}" class="bg-red-900 p-3 py-1 rounded-md text-white text-center md:text-left font-semibold">On-going Projects</a>
          <a href="{{ route('repository',['category' => 'completed']) }}" class="bg-red-900 p-3 py-1 rounded-md text-white text-center md:text-left font-semibold">Completed Projects</a>
        </div>
        <div class="flex flex-col gap-2 bg-[#bd8889] rounded-md p-3 border-2 border-red-500">
        
          {{-- Iterate 5 ongoing projects --}}
          @for ($i=0; $i<5; $i++)
          <div class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
            <button class="container text-left" onclick="toggleOngoingContent('ongoingContent{{ $i }}')"><p>Project Basa {{ $i }}</p></button>
            <div id="ongoingContent{{ $i }}" class="grid grid-col-12 md:ml-5 text-justify md:text-left mt-5 hidden transition-all duration-500">
              <p class="text-sm font-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p class="text-sm font-normal my-10">Check Photos <button onclick="showImageModal('imageModal{{ $i }}')" class="text-blue-600 underline">here</button></p>
            </div>
          </div>
          <div id="imageModal{{ $i }}" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
            <div class="relative max-w-100 justify-center flex">
              <button onclick="closeImageModal('imageModal{{ $i }}')" class="absolute top-[-50px] right-5 text-white text-[3rem]">&times;</button>
              <img src="{{ asset('../img/DHVSU_Logo.png') }}" alt="Project Basa Photo" class="max-w-[50%] max-h-[70rem]">
            </div>
          </div>
          @endfor



          {{-- end of iterate 5 ongoing projects --}}
      </div>
      @elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement')
        <div class="flex flex-col gap-2 bg-[#bd8889] rounded-md px-0 p-3 border-2 border-red-500 w-100 lg:mb-20">
          <div class="w-100 bg-red-900 pl-2 lg:pl-5 py-3">
            <p class="text-white text-lg font-bold">Recent Files</p>
          </div>
          {{-- Table with title --}}
          <div class="overflow-x-auto px-3 max-h-[16rem] overflow-y-scroll">
            <table class="table-auto w-full">
              <thead>
                  <tr class="bg-[#b2b2b2]">
                      <th class="border border-black px-4 py-2">File Name</th>
                      <th class="border border-black px-4 py-2">User</th>
                      <th class="border border-black px-4 py-2">Date Uploaded</th>
                      <th class="border border-black px-4 py-2">Type</th>
                      <th class="border border-black px-4 py-2">Status</th>
                      <th class="border border-black px-4 py-2">Action</th>
                  </tr>
              </thead>
              <tbody class="bg-[#cdcdcd]">
                @foreach ($recent_files as $recent_file)
                  <tr class="odd:bg-[#cdcdcd] even:bg-[#b2b2b2]">
                      <td class="border border-black px-4 py-2">{{ $recent_file->title }}</td>
                      <td class="border border-black px-4 py-2">{{ $recent_file->username }}</td>
                      <td class="border border-black px-4 py-2">{{ $recent_file->created_at->format('m/d/Y') }}</td>
                      <td class="border border-black px-4 py-2">{{ pathinfo($recent_file->file, PATHINFO_EXTENSION) }}</td>
                      <td class="border border-black px-4 py-2">{{ $recent_file->status }}</td>
                      <td class="border border-black px-4 py-2">N/A</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          
          </div>
        </div>
      @endif
    </div>
  @elseif(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident')
    <div class="col-span-12 md:col-span-6 flex justify-center">
      <div class="border-2 border-gray-400 container flex flex-col p-3">
        <p class="text-left mb-10">Chart</p>
        <div class="container flex items-center justify-center">
          <div id="piechart" class="piechart"></div>
        </div>
        <div class="flex flex-col container mt-[13rem]">
          <div class="flex items-center">
            <span class="h-4 w-4 bg-[#a9a9a9]"></span>
            <p class="ms-2">{{ $requests_percentage }}% Requests</p>
          </div>
          <div class="flex items-center">
            <span class="h-4 w-4 bg-[#808080]"></span>
            <p class="ms-2">{{ $proposals_percentage }}% Proposals</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-12 md:col-span-6 flex justify-center overflow-hidden h-screen">
      <div class="container-fluid w-100 bg-[#bd8889]">
        <p class="text-xl ps-3 mt-2 mb-0 py-3 bg-red-900 text-white font-semibold">Announcement Board</p>
        <div class="flex flex-col container px-12 h-full overflow-y-scroll">
          @for ($i=0; $i<50; $i++)
          <p class="ms-1">• あの日の悲しみさえ あの日の苦しみさえあの日の悲しみさえ あの日の苦しみさえ</p>
          @endfor
        </div>
      </div>
    </div>
  @endif
  </div>
</div>


{{-- Ongoing Project --}}
<script>
  function toggleOngoingContent(contentId) {
  const allContents = document.querySelectorAll('[id^="ongoingContent"]');
  
  allContents.forEach(content => {
    if (content.id !== contentId) {
      content.classList.add('hidden'); // Hide all other content sections
    }
  });

  const content = document.getElementById(contentId);
  if (content) {
    content.classList.toggle('hidden'); // Toggle visibility of the clicked content
  }
}

function showImageModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('hidden');
  }
}

function closeImageModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('hidden');
  }
}

// Optional: Close the modal when clicking outside of the image content
document.addEventListener('click', function(event) {
  const target = event.target;
  if (target.matches('.fixed.bg-black.bg-opacity-75')) {
    target.classList.add('hidden');
  }
});



</script>
{{-- Piechart --}}
@if(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const data = [
        { name: 'Requests', value: {{ $requests_percentage }}, color: 'gray' },
        { name: 'Proposal', value: {{ $proposals_percentage }}, color: 'darkgray' },
    ];

    function updatePieChart(data) {
        const total = data.reduce((sum, item) => sum + item.value, 0);
        let currentAngle = 0;
        const gradientParts = data.map(item => {
            const angle = (item.value / total) * 360;
            const startAngle = currentAngle;
            currentAngle += angle;
            return `${item.color} ${startAngle}deg ${currentAngle}deg`;
        }).join(', ');

        const pieChart = document.getElementById('piechart');
        pieChart.style.backgroundImage = `conic-gradient(${gradientParts})`;

        // console.log(`conic-gradient(${gradientParts})`);
    }

    updatePieChart(data);
});

<script src="https://unpkg.com/heroicons@2.0.10/heroicons.min.js"></script>
</script>
@endif
</body>

</html>