<!DOCTYPE html>
<html lang="en">
<head>
    @include('staff.includes.head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-[Poppins]">
    @include('sweetalert::alert')
    <header>
        @include('staff.includes.header')   
    </header>
    @include('staff.layouts.sidebar')
    <div class="main flex min-h-screen bg-gray-50 pt-16 lg:ml-[305px]">
        @yield('content')
    </div>
    @include('staff.includes.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.tailwindcss.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
            $('#example').DataTable({
                "dom":
                    "<'flex justify-between text-sm items-center mb-4'<'flex-grow'l><'flex-grow text-right'f>>" +
                    "<'overflow-x-auto'<'w-full't>>" +
                    "<'flex justify-between text-sm items-center mt-4'<'text-sm text-gray-700 flex-grow'i><'pagination flex-grow text-right'p>>",
                "language": {
                    "lengthMenu": "Showing _MENU_ entries",
                    "search": "Search:",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    },
                    "zeroRecords": "No data found",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)"
                }
            });
        });
    </script>
</body>
</html>