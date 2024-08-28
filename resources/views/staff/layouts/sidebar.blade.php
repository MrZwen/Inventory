<div class="fixed top-0 left-0 bottom-0 w-[300px] bg-slate-900 text-center overflow-y-auto z-10 p-2">
    <div class="text-gray-900 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-800"></i>
            <h1 class="font-bold text-gray-200 text-[15px] ml-3">Inventory</h1>
            <i class="bi bi-x ml-32 cursor-pointer text-white lg:hidden" onclick="Open()"></i>
        </div>
        <hr class="my-2 text-gray-600">
    </div>

    <!-- Dashboard Link -->
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white 
        {{ request()->is('staff-dashboard') ? 'bg-blue-800' : '' }}">
        <i class="bi bi-house-door-fill text-white"></i>
        <a href="/staff-dashboard" class="text-[15px] ml-4 text-gray-200">Dashboard</a>
    </div>

    {{-- <!-- Users Link -->
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white 
        {{ request()->is('users') ? 'bg-blue-800' : '' }}">
        <i class="bi bi-people-fill text-white"></i>
        <a href="/users" class="text-[15px] ml-4 text-gray-200">Users</a>
    </div> --}}

    <!-- Items Link -->
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white 
        {{ request()->routeIs('items.index.staff') ? 'bg-blue-800' : '' }}">
        <i class="bi bi-clipboard-check-fill text-white"></i>
        <a href="{{ route('items.index.staff') }}" class="text-[15px] ml-4 text-gray-200">Items</a>
    </div>

    <!-- Category Link -->
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white 
        {{ request()->is('categories-staff') ? 'bg-blue-800' : '' }}">
        <i class="bi bi-tags-fill text-white"></i>
        <a href="{{ route('category.index.staff') }}" class="text-[15px] ml-4 text-gray-200">Category</a>
    </div>

    <hr class="my-4 text-gray-600">

    <!-- Logout Link -->
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white">
        <i class="bi bi-box-arrow-in-right text-white"></i>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-4">
            @csrf
            <button type="submit" class="text-[15px] text-gray-200 bg-transparent border-0 cursor-pointer">
                Logout
            </button>
        </form>
    </div>
</div>
