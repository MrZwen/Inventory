<div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] p-2 w-[300px]  overflow-y-auto text-center bg-slate-900">
    <div class="text-gray-900 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-800"></i>
            <h1 class="font-bold text-gray-200 text-[15px] ml-3">Inventory</h1>
            <i class="bi bi-x ml-32 cursor-pointer text-white lg:hidden" onclick="Open()"></i>
        </div>
        <hr class="my-2 text-gray-600">
    </div>

    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white">
        <i class="bi bi-house-door-fill text-white "></i>
        <a href="/staff-dashboard" class="text-[15px] ml-4 text-gray-200">Dashboard</a>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white">
        <i class="bi bi-clipboard-check-fill text-white"></i>
        <a href="/items-staff" class="text-[15px] ml-4 text-gray-200">Items</a>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white">
        <i class="bi bi-tags-fill text-white"></i>
        <a href="/categories-staff" class="text-[15px] ml-4 text-gray-200">Category</a>
    </div>

    <hr class="my-4 text-gray-600">
    {{-- <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-800 text-white" onclick="dropdown()">
        <i class="bi bi-people-fill text-white"></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-gray-200">Users</span>
            <span class="text-sm rotate-180" id="arrow">
                <i class="bi bi-chevron-down"></i>
            </span>
        </div>
    </div>
    <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-white" id="submenu">
        <h1 class="cursor-pointer p-2 hover:bg-slate-700 rounded-md mt-1">
            <a href="/profile-user" id="users">Profile</a>
        </h1>
        <h1 class="cursor-pointer p-2 hover:bg-slate-700 rounded-md mt-1">
            <a href="/edit-user" id="users">Edit Profile</a>
        </h1>
    </div> --}}
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