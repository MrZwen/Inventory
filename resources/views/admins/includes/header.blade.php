<div class="fixed top-0 left-[300px] w-[calc(100%-300px)] bg-white shadow-md z-20 py-2 px-4">
    <div class="flex items-center">
        <button type="button" class="text-2xl font-bold text-gray-600" onclick="Open()">
            <i class="bi bi-list"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li>
                <a href="/admin-dashboard" class="text-gray-400 hover:text-gray-300 font-medium">Dashboard</a>
            </li>
            <li class="text-gray-600 mx-2 font-medium"> > </li>
            <li class="text-gray-600 font-medium">@yield('title')</li>
        </ul>
    </div>
</div>
