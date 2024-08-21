<!DOCTYPE html>
<html lang="en">
<head>
    @include('admins.includes.head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-[Poppins]">
    @include('sweetalert::alert')
    <header>
        @include('admins.includes.header')   
    </header>
    @include('admins.layouts.sidebar')
    <div class="main flex min-h-screen bg-gray-50 pt-16 lg:ml-[305px]">
        @yield('content')
    </div>
    @include('admins.includes.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        function dropdown() {
            const submenu = document.querySelector('#submenu');
            const arrow = document.querySelector('#arrow');
            
            submenu.classList.toggle('hidden');
            
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
        };

        function confirmDelete(itemId) {
            console.log("Delete confirmed for ID: " + itemId);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("Submitting form for ID: " + itemId);
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>