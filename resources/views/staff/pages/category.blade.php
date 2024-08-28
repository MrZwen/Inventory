@extends('staff.pages.main')

@section('title', 'Category')

@section('content')
<div class="w-full p-5 flex flex-col gap-4">
    <!-- Header and Button Container -->
    <div class="flex items-center justify-between mb-4 relative z-10">
        <h2 class="text-2xl font-bold text-gray-800">Items</h2>
        <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-3 py-1.5 shadow-md transform transition-all duration-300 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="bi bi-plus"></i> Add Category
        </button>
    </div>

    <div class="w-full flex flex-col bg-white shadow-md rounded-lg p-4">
        <table class="display w-full flex-grow text-sm text-gray-700 table-auto" id="example">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 w-1/4">No</th>
                    <th class="px-4 py-2 w-1/4">Name</th>
                    <th class="px-4 py-2 w-1/4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{$category->name}}</td>
                        <td class="px-4 py-2 flex justify-center space-x-2">
                            <button data-modal-target="modal-{{ $category->id }}" data-modal-toggle="modal-{{ $category->id }}" class="block text-white bg-green-500 hover:p-1.5 hover:bg-green-600 font-medium rounded-lg text-md p-1.5 text-center" type="button">
                                <i class="bi bi-pencil-fill"></i>
                            </button>                  
                        </td>
                    </tr>
                    @include('staff.modals.editcategory', ['category' => $category])
                @endforeach
            </tbody>
        </table>
    </div>
   @include('staff.modals.addcategory')
</div>
@endsection
