@extends('staff.pages.main')

@section('title', 'Users')

@section('content')
<div class="w-full p-5 flex flex-col gap-4">
    <!-- Header and Button Container -->
    <div class="flex items-center justify-between mb-4 relative z-10">
        <h2 class="text-2xl font-bold text-gray-800">Users</h2>
    </div>

    <div class="w-full flex flex-col bg-white shadow-md rounded-lg p-4">
        <table class="display w-full flex-grow text-sm text-gray-700 table-auto" id="example">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 w-1/4">No</th>
                    <th class="px-4 py-2 w-1/4">Name</th>
                    <th class="px-4 py-2 w-1/4">Username</th>
                    <th class="px-4 py-2 w-1/4">Email</th>
                    <th class="px-4 py-2 w-1/4">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->username }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection