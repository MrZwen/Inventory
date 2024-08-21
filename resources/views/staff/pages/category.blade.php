@extends('staff.pages.main')

@section('title', 'Category')

@section('content')
    <div class="w-full p-5">
        <h2 class="text-2xl font-semibold mb-2">Category</h2>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow-lg shadow-black/15 mb-6">
            <table class="w-full">
                <thead class="bg-white border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{$category->name}}</td>
                        <td>
                            <div class="flex justify-center gap-2">
                                <div class="">
                                    <button data-modal-target="modal-{{ $category->id }}" data-modal-toggle="modal-{{ $category->id }}" class="block text-white bg-green-500 hover:p-2.5 hover:bg-green-600 font-medium rounded-lg text-md p-2.5 text-center" type="button">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr> 
                    {{-- Detail Modal --}}
                    @include('staff.modals.editcategory', ['category' => $category])
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Tambah Category -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-lg shadow-black/15">
            <h3 class="text-xl font-semibold mb-4">Tambah Data Category</h3>
            <form action="{{ route('categories.store.staff') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-2.5 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="block text-white bg-blue-700 hover:p-1.5 hover:bg-blue-800 font-medium rounded-lg text-md p-1.5 text-center">Add Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
