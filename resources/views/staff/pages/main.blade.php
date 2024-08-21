<!DOCTYPE html>
<html lang="en">
<head>
    @include('staff.includes.head')
</head>
<body class="font-[Poppins]">
    <header>
        @include('staff.includes.header')   
    </header>
    @include('staff.layouts.sidebar')
    <div class="main flex min-h-screen bg-gray-50 pt-16 lg:ml-[305px]">
        @yield('content')
    </div>
    @include('staff.includes.footer')

    <script type="text/javascript">
        function dropdown() {
            const submenu = document.querySelector('#submenu');
            const arrow = document.querySelector('#arrow');
            
            submenu.classList.toggle('hidden');
            
            // Mengecek apakah submenu memiliki class 'hidden' atau tidak
            if (submenu.classList.contains('hidden')) {
                arrow.classList.remove('rotate-180');
            } else {
                arrow.classList.add('rotate-180');
            }
        }

        dropdown();

        function Open(){
            const sidebar = document.querySelector('.sidebar');
            const navbar = document.querySelector('nav > div');

            sidebar.classList.toggle('left-[-300px]');
            navbar.classList.toggle('navbar-shift');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>