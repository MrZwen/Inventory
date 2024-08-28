<div class="fixed top-0 left-[300px] w-[calc(100%-300px)] bg-white shadow-md z-20 py-2 px-4">
    <div class="flex items-center justify-between">
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
        <div class="relative ml-auto">
            <button id="settingsButton" class="flex items-center text-gray-600 focus:outline-none">
                <i class="bi bi-gear-fill"></i>
                <span class="ml-2 text-sm font-medium">Settings</span>
                <i id="chevronIcon" class="bi bi-chevron-down ml-1 transition-transform duration-200"></i>
            </button>
            <!-- Dropdown -->
            <div id="settingsDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-30">
                {{-- <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a> --}}
                <a href="{{ route('settings.edit.staff') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                {{-- <a href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a> --}}
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('settingsButton').onclick = function() {
    var dropdown = document.getElementById('settingsDropdown');
    var chevron = document.getElementById('chevronIcon');
    
    // Toggle the dropdown visibility
    dropdown.classList.toggle('hidden');
    
    // Rotate the chevron
    if (dropdown.classList.contains('hidden')) {
        chevron.classList.remove('rotate-180');
    } else {
        chevron.classList.add('rotate-180');
    }
};

// Close the dropdown if clicked outside
document.addEventListener('click', function(event) {
    var isClickInside = document.getElementById('settingsButton').contains(event.target) ||
                        document.getElementById('settingsDropdown').contains(event.target);

    if (!isClickInside) {
        document.getElementById('settingsDropdown').classList.add('hidden');
        document.getElementById('chevronIcon').classList.remove('rotate-180');
    }
});
</script>