@extends('admins.pages.main')

@section('title', 'Users')

@section('content')
<div class="w-full p-5 flex flex-col gap-4">
    <!-- Header and Button Container -->
    <div class="flex items-center justify-between mb-4 relative z-10">
        <h2 class="text-2xl font-bold text-gray-800">Users</h2>
        <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-3 py-1.5 shadow-md transform transition-all duration-300 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="bi bi-plus"></i> Add Users
        </button>
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
                    <th class="px-4 py-2 w-1/4">Action</th>
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
                        <td class="px-4 py-2 flex justify-center space-x-2">
                            <button data-modal-target="modal-edit-user-{{ $user->id }}" data-modal-toggle="modal-edit-user-{{ $user->id }}" class="block text-white bg-green-500 hover:p-1.5 hover:bg-green-600 font-medium rounded-lg text-md p-1.5 text-center" type="button">
                                <i class="bi bi-pencil-fill"></i>
                            </button>                            
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" id="delete-form-{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        onclick="confirmDelete('{{ $user->id }}', 'user')" 
                                        class="block text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-md p-1.5 text-center {{ auth()->user()->id === $user->id ? 'cursor-not-allowed opacity-50' : '' }}" 
                                        {{ auth()->user()->id === $user->id ? 'disabled' : '' }}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    {{-- Edit Modal --}}
                    @include('admins.modals.editusers', ['users' => $user])
                @endforeach
            </tbody>
        </table>

        @include('admins.modals.addusers')
    </div>

</div>

@endsection