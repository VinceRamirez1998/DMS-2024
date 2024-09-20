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
    <div class="w-screen pb-3 min-h-screen p-2 lg:p-10">
      <div class="bg-[#3b3b3b] text-white rounded-md flex flex-col h-full overflow-hidden">
        <p class="font-semibold text-lg my-3 pl-3 md:pl-5 flex items-center">
          <a href="{{ route('projectsandrequests') }}" class="me-3"><i class="fa-solid fa-chevron-left"></i></a>Inquiries
        </p>
        <div class="h-screen w-full overflow-y-scroll">
          <div class="grid grid-cols-12 gap-2 pb-3 px-3 md:px-5">
            @foreach($inquiry as $inquiry)
              <div class="col-span-12 bg-slate-200 flex justify-between items-center px-3 py-2 rounded-md">
                <div class="flex-1 min-w-0">
                  <!-- Folder link triggers modal by setting a unique ID -->
                  <a href="#" target="_blank" class="flex items-center">
                    <i class="fa-solid text-black fa-solid fa-feather text-2xl me-2"></i>  
                    <p class="overflow-hidden whitespace-nowrap text-ellipsis text-black">
                      {{ $inquiry->title . ' - '}} 
                      <span class="italic text-gray-500">{{ $inquiry->username }}</span>
                    </p>
                  </a>
                </div>
        
                <!-- Vertical Ellipsis Dropdown -->
                <div class="relative flex">
                @if($inquiry->reply_status != null)
                  <p class="text-gray-500 italic me-1">Replied - </p>
                @endif
                  <p class="text-gray-500 italic">{{ date('m/d') }}</p>
                  <button onclick="toggleDropdown('{{ $inquiry->id }}')" class="text-gray-500 hover:text-gray-700 px-3">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                  </button>
                  
                  <!-- Dropdown Menu -->
                  <div id="dropdown-{{ $inquiry->id }}" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                    <ul class="py-1">
                      <li>
                        <button onclick="openModal('{{ $inquiry->id }}'); hideDropdown('{{ $inquiry->id }}')" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          View
                        </button>
                      </li>
                      <li>
                        <button onclick="openModalComments('{{ $inquiry->id }}'); hideDropdownComments('{{ $inquiry->id }}')" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            See comments
                        </button>
                      </li>
                      @if(auth()->user()->role === 'director')
                      <li>
                        <button onclick="opensendModal('{{ $inquiry->id }}');" class="w-full text-[#fab005] font-bold text-left px-4 py-2 text-sm">
                          Send
                        </button>
                      </li>
                      @elseif(auth()->user()->role === 'president' ||  auth()->user()->role === 'vicepresident')
                      <li>
                        <form action="{{ route('request.transfer') }}" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{ $inquiry->id }}">
                          <button type="submit" class="w-full text-[#fab005] font-bold text-left px-4 py-2 text-sm">
                            Send
                          </button>
                        </form>
                      </li>
                      @endif
                    </ul>
                  </div>
                </div>
        
                <!-- View Modal -->
                <div id="modal-{{ $inquiry->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                  <div class="bg-[#282828] text-white rounded-lg shadow-lg w-3/4 max-w-xl">
                    <div class="p-4 border-b flex justify-between items-center">
                      <h2 class="text-lg font-semibold">{{ $inquiry->title }}</h2>
                      <button onclick="closeModal('{{ $inquiry->id }}')" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-times"></i>
                      </button>
                    </div>
                    {{-- Comments --}}
                    <div class="p-4 flex flex-col gap-2">
                        <p>Subject</p>
                        <input readonly type="text" value="{{ $inquiry->title }}" id="" class="rounded-md bg-[#454845]">
                        <p>Message</p>
                        <textarea readonly id="" cols="30" rows="10" class='rounded-md p-3 bg-[#454845] resize-none'>{{ $inquiry->inquiry }}</textarea>
                    {{-- @if($inquiry->reply && $inquiry->reply->isNotEmpty())
                        @foreach ($inquiry->reply as $comment)
                          <p><b>:</b> {{ $comment->reply }}</p>
                        @endforeach
                    @else
                        <p>No comments yet.</p>
                    @endif
                    --}}
                    </div>
                    
                    <form action="{{ route('inquiry.comment.submit') }}" method="post">
                      @csrf
                      
                      <div class="flex flex-col justify-end p-4 border-t">
                        <div class="mb-3">
                            <p>Reply</p>
                        </div>
                        <div class="flex flex-row">
                        <input type="hidden" name="username" value={{ $inquiry->username }}>
                        <input name="reply" type="text" class="w-full rounded-md bg-[#454845]" placeholder="Reply...">
                        <input type="hidden" name="request_id" value="{{ $inquiry->id }}">
                        <input type="hidden" name="title" value="{{ $inquiry->title }}">
                        <button class="text-white px-3 py-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send rotate-45" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                          </svg>
                        </button>
                        </div>
                    </div>
                    </form>
                  </div>
                </div>

                <!-- Comments Modal -->
                <div id="modal-comments-{{ $inquiry->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                  <div class="bg-[#282828] text-white rounded-lg shadow-lg w-3/4 max-w-xl">
                    <div class="p-4 border-b flex justify-between items-center">
                      <h2 class="text-lg font-semibold">{{ $inquiry->title }}</h2>
                      <button onclick="closeModalComments('{{ $inquiry->id }}')" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-times"></i>
                      </button>
                    </div>
                    {{-- Comments --}}
                    <div class="p-4 flex flex-col gap-2">
                      
                      @php
                          $hasComments = false;
                      @endphp

                      @foreach ($inquiry_comments as $comment)
                          @if ($comment->inquiry_id == $inquiry->id)
                              @php
                                  $hasComments = true;
                              @endphp
                              <p><b>{{ ucfirst($comment->position) }}:</b> {{ $comment->reply }}</p>
                          @endif
                      @endforeach

                      @if (!$hasComments)
                          <p>No comments yet.</p>
                      @endif
                   
                    </div>
                  </div>
                </div>

                <!-- Send Modal -->
                <div id="modal-send-{{ $inquiry->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                  <div class="bg-[#282828] text-white rounded-lg shadow-lg w-3/4 max-w-xl">
                    <div class="p-4 border-b flex justify-between items-center">
                      <h2 class="text-lg font-semibold">{{ $inquiry->title }}</h2>
                      <button onclick="closesendModal('{{ $inquiry->id }}')" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-times"></i>
                      </button>
                    </div>

                    {{-- Select Department --}}
                    <form action="#" method="post">
                      @csrf
                      <div class="flex flex-col justify-end p-4 border-t">
                        {{-- Content --}}
                        <div class="flex justify-end w-full">
                          <button name="request_id" value="{{ $inquiry->id }}" class="px-3 py-2 mt-3 text-center bg-[#fab005] text-white font-semibold rounded-md">Send&nbsp;Request</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Functions -->
  <script>
    function openModal(id) {
      document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
      document.getElementById('modal-' + id).classList.add('hidden');
    }

    function openModalComments(id) {
      document.getElementById('modal-comments-' + id).classList.remove('hidden');
    }

    function closeModalComments(id) {
      document.getElementById('modal-comments-' + id).classList.add('hidden');
    }

    function hideDropdown(id) {
      const dropdown = document.getElementById('dropdown-' + id);
      dropdown.classList.add('hidden');
    }

    function toggleDropdown(id) {
      const dropdown = document.getElementById('dropdown-' + id);
      dropdown.classList.toggle('hidden');
    }


    function opensendModal(id) {
      document.getElementById('modal-send-' + id).classList.remove('hidden');
    }

    function closesendModal(id) {
      document.getElementById('modal-send-' + id).classList.add('hidden');
    }
  </script>
</body>
</html>
