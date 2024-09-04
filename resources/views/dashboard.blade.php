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
    <div class="grid grid-cols-12 bg-[#3c3b3b] rounded-lg md:mx-8 md:mt-8 gap-4 m-2 md:m-0 h-auto">
    @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator'|| auth()->user()->role == 'areaspecialist'|| auth()->user()->role == 'centermanagement')
      {{-- Video --}}
      <div class="col-span-12 md:col-span-7">
        {{-- Users and Coordinator --}}
        @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator')
        <iframe class="p-2 bg-[#bd8889] w-[100%] md:w-[620px] h-100 md:h-[349px]" src="https://www.youtube.com/embed/hwTrdzc6NmY?autoplay=1&loop=1&playlist=hwTrdzc6NmY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
    <div class="order-1 col-span-12 md:col-span-6 flex justify-center">
      <div class="container flex flex-col p-3">
        <div class="container flex items-center mt-10 justify-center relative">
          <div id="piechart" class="piechart relative"></div>
          <div id="tooltip" class="tooltip hidden absolute bg-white text-black p-1 rounded shadow"></div>
        </div>
        
        {{-- Percentage --}}
        <div class="flex flex-row justify-between container mt-[5rem] md:mb-[6rem]">
          <div class="">
            <a href="#" class="flex items-center me-2 text-white">
              <span class="h-4 w-4 bg-[#f3c96b]"></span>
              <p class="ms-1">{{ intval($ccs_percentage) }}%&nbsp;CCS</p>
            </a>
            <a href="#" class="flex items-center me-2 text-white">
              <span class="h-4 w-4 bg-[#de6e6a]"></span>
              <p class="ms-1">{{ intval($cea_percentage) }}%&nbsp;CEA</p>
            </a>
          </div>
          <div class="">
          <a href="#" class="flex items-center me-2 text-white">
            <span class="h-4 w-4 bg-[#5971c0]"></span>
            <p class="ms-1">{{ intval($chs_percentage) }}%&nbsp;CHS</p>
          </a>
          <a href="#" class="flex items-center me-2 text-white">
            <span class="h-4 w-4 bg-[#9ec97f]"></span>
            <p class="ms-1">{{ intval($shs_percentage) }}%&nbsp;SHS</p>
          </a>
          </div>
        </div>
      </div>
    </div>
    <div class="order-2 md:order-3 col-span-12 px-3">
      <div class="flex container-fluid justify-center md:justify-start mb-2">
        <p class="text-lg font-bold rounded-lg px-2 py-3 bg-[#767474] text-white">College of Computing Studies</p>
      </div>
      <div class="flex flex-col md:flex-row justify-between md:justify-start container-fluid">
        <div class="flex font-bold">
          <p class="text-md font-bold text-white">Total Projects:</p>
          <p class="text-md font-bold text-white ms-2">3</p>
        </div>
        <div class="flex">
          <p class="text-md font-bold text-white md:ms-5">Total Faculty Extensionists:</p>
          <p class="text-md font-bold text-white ms-2">55</p>
        </div>
      </div>
      <div class="text-white overflow-y-scroll md:overflow-auto">
        <div class="text-white overflow-y-scroll md:overflow-auto">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
              <!-- Project List Table -->
              <div>
                  <p class="font-bold mt-10 mb-3">Project List</p>
                  <table class="min-w-full border-collapse">
                      <thead>
                          <tr class="border-y-2 border-black">
                              <th class="px-4 py-2 text-left">#</th>
                              <th class="px-4 py-2 text-left">Project Name</th>
                              <th class="px-4 py-2 text-left">Total Participant</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">1</td>
                              <td class="px-4 py-2">Project A</td>
                              <td class="px-4 py-2">10</td>
                          </tr>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">2</td>
                              <td class="px-4 py-2">Project B</td>
                              <td class="px-4 py-2">15</td>
                          </tr>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">3</td>
                              <td class="px-4 py-2">Project C</td>
                              <td class="px-4 py-2">20</td>
                          </tr>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">4</td>
                              <td class="px-4 py-2">Project D</td>
                              <td class="px-4 py-2">25</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
      
              <!-- Faculty List Table -->
              <div>
                  <p class="font-bold mt-10 mb-3">Faculty List</p>
                  <table class="min-w-full border-collapse">
                      <thead>
                          <tr class="border-y-2 border-black">
                              <th class="px-4 py-2 text-left">#</th>
                              <th class="px-4 py-2 text-left">Faculty Name</th>
                              <th class="px-4 py-2 text-left">No. of Project Participated</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">1</td>
                              <td class="px-4 py-2">Dr. Smith</td>
                              <td class="px-4 py-2">12</td>
                          </tr>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">2</td>
                              <td class="px-4 py-2">Prof. Johnson</td>
                              <td class="px-4 py-2">8</td>
                          </tr>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">3</td>
                              <td class="px-4 py-2">Dr. Lee</td>
                              <td class="px-4 py-2">5</td>
                          </tr>
                          <tr class="border-b border-black">
                              <td class="px-4 py-2">4</td>
                              <td class="px-4 py-2">Prof. Brown</td>
                              <td class="px-4 py-2">7</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>      
    </div>
    <div class="order-3 md:order-2 col-span-12 lg:mt-5 md:col-span-6 flex justify-center lg:justify-end lg:me-5 overflow-hidden h-[30rem]">
      <div class="container-fluid w-[80%] bg-[#5f5c5c] rounded-lg border-2 border-[#6f6d6d] mb-5 mt-5 overflow-hidden">
        <p class="text-xl ps-3 mt-2 mb-0 py-3 bg-[#3c3b3b] text-white font-semibold">Notice Board</p>
        <div class="flex flex-col container px-12 pb-20 h-full overflow-y-scroll">
          @for ($i=0; $i<20; $i++)
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
        { name: 'CCS', value: {{ $ccs_percentage }}, color: '#de6e6a' },
        { name: 'CEA', value: {{ $cea_percentage }}, color: '#f3c96b' },
        { name: 'CHS', value: {{ $chs_percentage }}, color: '#9ec97f' },
        { name: 'SHS', value: {{ $shs_percentage }}, color: '#5971c0' },
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
</script>
@endif
</body>

</html>