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
    <div class="grid grid-cols-12 bg-[{{ (Auth()->user()->role == 'president' || Auth()->user()->role == 'vicepresident' || Auth()->user()->role == 'director' ) ? '#FAF9F6' : 'bg-white'}}] rounded-lg md:mx-8 md:mt-8 gap-4 m-2 md:m-0 h-auto shadow-xl">
    @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator'|| auth()->user()->role == 'areaspecialist'|| auth()->user()->role == 'centermanagement')
      {{-- Video --}}
      <div class="col-span-12 md:col-span-7">
        {{-- Users and Coordinator --}}
        @if(auth()->user()->position != null && auth()->user()->role == null || auth()->user()->role == 'coordinator')
        <iframe class="p-2 bg-[#FAF9F6] w-[100%] md:w-[620px] h-100 md:h-[349px] shadow-xl" src="https://www.youtube.com/embed/bc4v0ZgfI1w?autoplay=0&loop=1&playlist=bc4v0ZgfI1w&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        {{-- Area Specialist and Center Management --}}
        @elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement')
        <div class="grid grid-cols-4 grid-rows-8 gap-4 h-full lg:px-20">
          <div class="col-span-2 row-span-4 flex flex-col justify-center items-center rounded-md bg-[#FAF9F6] shadow-2xl shadow-black/50"><p class="text-4xl font-extrabold  pt-5">{{ $total_inquiries ?? '0' }}</p><p class="text-lg font-semibold mt-5 pb-5">Total Inquiries</p></div>
          <div class="col-span-2 row-span-4 col-start-3 flex flex-col justify-center items-center rounded-md bg-[#FAF9F6] shadow-2xl shadow-black/50"><p class="text-4xl font-extrabold  pt-5">{{ $total_requests ?? '0' }}</p><p class="text-lg font-semibold mt-5 pb-5">Total Requests</p></div>
          <div class="col-span-2 row-span-4 row-start-5 flex flex-col justify-center items-center rounded-md bg-[#FAF9F6] shadow-2xl shadow-black/50"><p class="text-4xl font-extrabold  pt-5">2</p><p class="text-lg font-semibold mt-5 pb-5 text-center">Total On-going Projects</p></div>
          <div class="col-span-2 row-span-4 col-start-3 row-start-5 flex flex-col justify-center items-center rounded-md bg-[#FAF9F6] shadow-2xl shadow-black/50"><p class="text-4xl font-extrabold  pt-5">2</p><p class="text-lg font-semibold mt-5 pb-5 text-center">Total Completed Projects</p></div>
        </div>
        @endif
      </div>
      {{-- Notice Board --}}
      <div class="col-span-12 md:col-span-5 bg-[#FAF9F6] rounded-md border-2 border-red-500 shadow-xl">
    <div class="container-fluid w-100">
        <p class="text-2xl ps-3 mt-2 mb-0 py-3 bg-[#800000] text-white font-bold">Notice Board</p>
        <div class="flex flex-col container px-7 h-[277px] overflow-y-scroll">

            {{-- Check if there are notices --}}
            @if ($notices->isEmpty())
                <p class="text-center text-red-600 my-auto">No announcements available at the moment.</p>
            @else
                {{-- Iterate notices --}}
                @foreach ($notices as $notice)
                <div class="cursor-pointer text-red-700 hover:underline text-sm notice-item" 
                    data-title="{{ $notice->title }}" 
                    data-image="{{ asset('storage/' . $notice->image) }}" 
                    data-content="{!! $notice->content !!}" 
                    data-created-at="{{ $notice->created_at->format('F d, Y') }}">
                    <p class="text-[1.5rem]">
                        {{ "•"}} <span class="me-1"></span>{{ $notice->title }} | {{ $notice->created_at->format('F d, Y') }}
                    </p>
                </div>
                @endforeach
                {{-- end of iteration --}}
            @endif

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
        <div class="flex flex-col gap-2 h-full bg-[#eeeeee] {{ $projects->isEmpty() ? 'text-center align-center' : '' }} rounded-md p-3 border-2 border-red-500">
        
          {{-- Iterate 5 ongoing projects --}}
          @if($projects->isEmpty())
          <p class="text-center text-red-600 my-auto py-[13vh]">No projects available at the moment.</p>
          @else
          @foreach($projects as $key => $project)
          <div class="ms-1 py-2 px-3 rounded-md bg-[#cccccc] font-bold border-2 border-red-500">
          <button id="toggleOngoingBtn" onclick="toggleOngoingContent('ongoingContent{{ $key }}')">
            <p>{{ $project->project_title }}</p>
          </button>
          <div id="ongoingContent{{$key}}" class="grid grid-col-12 md:ml-5 text-justify md:text-left mt-5 hidden transition-all duration-500">
            <p class="text-sm font-normal">One of the objectives of the DHVSU-UESO is to assist communities that are eager for development and innovation. As part of the extension project of the College of Computing Studies at Potrero National High School, we conducted a preliminary visit and assessed the need of the community and to check their computers that will be utilized for the “Upgrading Skills through ICT Training Program” on October 2019.
            <br><br>
                The skills to be developed among its beneficiaries one of the following:
                    <span><br><br>
                        1.            File Organization and Security <br>
                        2.            Social Media and Etiquette <br>
                        3.            Microsoft Word Microsoft Power Point <br>
                        4.            Microsoft Excel <br>
                        5.            ICT Integration on Creating Instructional Material <br>
                        6.            Basic PC Trouble Shooting <br>
                        7.            Graphic Software <br>
                        8.            Video Editing <br>
                        9.            Technical Drafting   and Animation <br><br>
                    </span>
                The said training was handled by different faculty members from the College of Computing Studies of the Don Honorio Ventura State University.</p>
            <p class="text-sm font-normal my-10"> <a href = " https://dhvsu.edu.ph/index.php/gallery-menu/extension#upgrading-skills-through-ict-program-october-2019" class = "text-blue-400 underline"><p>
                <span>
                    See project here
                </span>
            </p></a></p>
          </div>
        </div>
        <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
          <div class="relative max-w-100 justify-center flex">
            <button id="closeImageBtn" class="absolute top-[-50px] right-5 text-white text-[3rem]">&times;</button>
            <img src="{{ asset('../img/DHVSU_Logo.png') }}" alt="Project Basa Photo" class="max-w-[50%] max-h-[70rem]">
          </div>
        </div>
          @endforeach
          @endif



          {{-- end of iterate 5 ongoing projects --}}
      </div>
      @elseif(auth()->user()->role == 'areaspecialist' || auth()->user()->role == 'centermanagement')
        <div class="flex flex-col gap-2 bg-[#FAF9F6] rounded-md px-0 p-3 border-2 border-red-500 w-100 lg:mb-[7rem] shadow-lg">
          <div class="w-100 bg-[#800000] pl-2 lg:pl-5 py-3">
            <p class="text-white text-lg font-bold">Recent Files</p>
          </div>
          {{-- Table with title --}}
          <div class="overflow-x-auto px-3 max-h-[16rem] overflow-y-scroll">
            <table class="table-auto w-full">
              <thead>
                  <tr class="bg-[#FAF9F6]">
                      <th class="border border-[#800000] px-4 py-2">File Name</th>
                      <th class="border border-[#800000] px-4 py-2">User</th>
                      <th class="border border-[#800000] px-4 py-2">Date Uploaded</th>
                      <th class="border border-[#800000] px-4 py-2">Type</th>
                      <th class="border border-[#800000] px-4 py-2">Status</th>
                      <th class="border border-[#800000] px-4 py-2">Action</th>
                  </tr>
              </thead>
              <tbody class="bg-[#cdcdcd]">
                @foreach ($recent_files as $recent_file)
                  <tr class="odd:bg-[#E2DFD2] even:bg-[#FAF9F6]">
                      <td class="border border-[#800000] px-4 py-2">{{ $recent_file->title }}</td>
                      <td class="border border-[#800000] px-4 py-2">{{ $recent_file->username }}</td>
                      <td class="border border-[#800000] px-4 py-2">{{ $recent_file->created_at->format('m/d/Y') }}</td>
                      <td class="border border-[#800000] px-4 py-2">{{ pathinfo($recent_file->file, PATHINFO_EXTENSION) }}</td>
                      <td class="border border-[#800000] px-4 py-2">{{ $recent_file->status }}</td>
                      <td class="border border-[#800000] px-4 py-2">N/A</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          
          </div>
        </div>
      @endif
    </div>
  @elseif(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident' || auth()->user()->role == 'director')
    <div class="order-1 col-span-12 md:col-span-6 flex justify-center">
      <div class="container flex flex-col p-3">
        <div class="container flex items-center mt-10 justify-center relative">
          <div id="piechart" class="piechart relative"></div>
          <div id="tooltip" class="tooltip hidden absolute bg-white text-black p-1 rounded shadow"></div>
        </div>
        
        {{-- Percentage --}}
        <div class="flex flex-row justify-between container mt-[5rem] md:mb-[6rem]">
          <div class="">
            <a href="#" class="flex items-center me-2 text-black-400">
              <span class="h-4 w-4 bg-[#f3c96b]"></span>
              <p class="ms-1 hover:underline hover:text-blue-400">{{ intval($ccs_percentage ?? 0) }}%&nbsp;CCS</p>
            </a>
            <a href="#" class="flex items-center me-2 text-black-400">
              <span class="h-4 w-4 bg-[#de6e6a]"></span>
              <p class="ms-1 hover:underline hover:text-blue-400">{{ intval($cea_percentage ?? 0) }}%&nbsp;CEA</p>
            </a>
          </div>
          <div class="">
          <a href="#" class="flex items-center me-2 text-black-400">
            <span class="h-4 w-4 bg-[#5971c0]"></span>
            <p class="ms-1 hover:underline hover:text-blue-400">{{ intval($chs_percentage ?? 0) }}%&nbsp;CHS</p>
          </a>
          <a href="#" class="flex items-center me-2 text-black-400">
            <span class="h-4 w-4 bg-[#9ec97f]"></span>
            <p class="ms-1 hover:underline hover:text-blue-400">{{ intval($shs_percentage ?? 0) }}%&nbsp;SHS</p>
          </a>
          </div>
        </div>
      </div>
    </div>
    <div class="order-2 md:order-3 col-span-12 px-3">
      <div class="flex container-fluid justify-center md:justify-start mb-2">
        <p class="text-lg font-bold rounded-lg px-2 py-3 bg-[#FFD700] text-black-400">College of Computing Studies</p>
      </div>
      <div class="flex flex-col md:flex-row justify-between md:justify-start container-fluid">
        <div class="flex font-bold">
          <p class="text-md font-bold text-black-400">Total Projects:</p>
          <p class="text-md font-bold text-black-400 ms-2">4</p>
        </div>
        <div class="flex">
          <p class="text-md font-bold text-black-400 md:ms-5">Total Faculty Extensionists:</p>
          <p class="text-md font-bold text-black-400 ms-2">55</p>
        </div>
      </div>
      <div class="text-black-400 overflow-y-scroll md:overflow-auto">
        <div class="text-black-400 overflow-y-scroll md:overflow-auto">
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
      <div class="container-fluid w-[80%] bg-[#FAF9F6] rounded-lg border-2 border-[#800000] mb-5 mt-5 overflow-hidden shadow-lg">
        <p class="text-xl ps-3 mt-2 mb-0 py-3 bg-[#800000] text-white font-semibold">Notice Board</p>
        <div class="flex flex-col container px-12 pb-20 h-full overflow-y-scroll">
          {{-- Check if there are notices --}}
          @if ($notices->isEmpty())
              <p class="text-center text-red-600 my-auto">No announcements available at the moment.</p>
          @else
              {{-- Iterate notices --}}
              @foreach ($notices as $notice)
              <div class="cursor-pointer text-red-700 hover:underline text-sm notice-item" 
                  data-title="{{ $notice->title }}" 
                  data-image="{{ asset('storage/' . $notice->image) }}" 
                  data-content="{!! $notice->content !!}" 
                  data-created-at="{{ $notice->created_at->format('F d, Y') }}">
                  <p class="text-[1.5rem]">
                      {{ "•"}} <span class="me-1"></span>{{ $notice->title }} | {{ $notice->created_at->format('F d, Y') }}
                  </p>
              </div>
              @endforeach
              {{-- end of iteration --}}
          @endif
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
@if(auth()->user()->role == 'president' || auth()->user()->role == 'vicepresident' || auth()->user()->role == 'director')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const data = [
        { name: 'CCS', value: {{ $ccs_percentage }}, color: '#de6e6a' },
        { name: 'CEA', value: {{ $cea_percentage }}, color: '#f3c96b' },
        { name: 'CHS', value: {{ $chs_percentage }}, color: '#5971c0' },
        { name: 'SHS', value: {{ $shs_percentage }}, color: '#9ec97f' },
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

<!-- Modal -->
<!-- Modal -->
<div id="noticeModal" class="modal fixed inset-0 hidden bg-black bg-opacity-70 flex items-center justify-center">
    <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-[800px] max-h-[60vh] overflow-y-auto">
        <span class="close-modal cursor-pointer text-red-500 float-right text-2xl hover:text-red-700 transition duration-200">&times;</span>
        
        <div class="flex mb-4"> <!-- Flex container for image and text -->
            <img id="modalImage" src="" alt="" class="w-1/3 h-auto max-h-48 object-cover rounded-md mr-4 shadow-md" /> <!-- Image with shadow -->
            <div class="flex flex-col w-2/3"> <!-- Text container -->
                <h2 id="modalTitle" class="text-2xl font-bold text-white mb-1 bg-red-800 p-2 rounded-md"></h2> <!-- Bold title -->
                <div class="flex justify-between items-center bg-gray-800 p-2 rounded-md mb-4"> <!-- Flex for title and created_at -->
                    <p id="modalCreatedAt" class="text-white text-sm"></p> <!-- Created_at -->
                </div>
            </div>
        </div>
        
        <div id="modalContent" class="text-gray-700 leading-relaxed">
            { $notice->content } <!-- Ensure content is rendered as HTML -->
        </div>
    </div>
</div>

  



<!-- Add the following script at the bottom of your body -->
<script>
 const noticeItems = document.querySelectorAll('.notice-item');
const modal = document.getElementById('noticeModal');
const modalImage = document.getElementById('modalImage');
const modalTitle = document.getElementById('modalTitle');
const modalCreatedAt = document.getElementById('modalCreatedAt');
const modalContent = document.getElementById('modalContent');
const closeModal = document.querySelector('.close-modal');
noticeItems.forEach(item => {
    item.addEventListener('click', () => {
        const title = item.getAttribute('data-title');
        const image = item.getAttribute('data-image');
        const content = item.getAttribute('data-content');
        const createdAt = item.getAttribute('data-created-at');

        modalTitle.textContent = title;
        modalImage.src = image;
        modalCreatedAt.textContent = createdAt;
        modalContent.innerHTML = content; // Use innerHTML to insert raw HTML

        modal.classList.remove('hidden');
    });
});

closeModal.addEventListener('click', () => {
    modal.classList.add('hidden');
});

modal.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.classList.add('hidden');
    }
});
</script>
</body>

</html>