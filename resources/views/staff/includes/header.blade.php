<nav class="w-full bg-white fixed">
    <div class="py-2 px-2 flex items-center lg:ml-[300px] shadow-md shadow-black/5">
        <button type="button" class="text-2xl font-bold text-gray-600" onclick="Open()">
            <i class="bi bi-list"></i>
        </button>
        <ul class="flex items-center text-sm">
            <li class="ml-2">
                <a href="/admin-dashboard" class="text-gray-400 hover:text-gray-300 font-medium">Dashboard</a>
            </li>
            <li class="text-gray-600 ml-2 font-medium">/</li>
            <li class="text-gray-600 ml-2 font-medium">@yield('title')</li>
        </ul>
        {{-- <ul class="ml-auto flex items-center">
            <li>
                <button type="button">
                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded-full block object-cover align-middle">
                </button>
            </li>
        </ul> --}}
    </div>
</nav>