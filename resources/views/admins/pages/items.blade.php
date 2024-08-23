@extends('admins.pages.main')

@section('title', 'Items')

@section('content')
<div class="w-full p-5 flex flex-col gap-4">
    <!-- Header and Button Container -->
    <div class="flex items-center justify-between mb-4 relative z-10">
        <h2 class="text-2xl font-bold text-gray-800">Items</h2>
        <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-3 py-1.5 shadow-md transform transition-all duration-300 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="bi bi-plus"></i> Add Items
        </button>
    </div>

    <!-- Table Container -->
    <div class="w-full flex flex-col bg-white shadow-md rounded-lg p-4">
        <table class="display w-full flex-grow text-sm text-gray-700 table-auto" id="example">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 w-1/4">No</th>
                    <th class="px-4 py-2 w-1/4">Name</th>
                    <th class="px-4 py-2 w-1/4">Description</th>
                    <th class="px-4 py-2 w-1/4">Category</th>
                    <th class="px-4 py-2 w-1/4">Price</th>
                    <th class="px-4 py-2 w-1/4">Stock</th>
                    <th class="px-4 py-2 w-1/4">Status</th>
                    <th class="px-4 py-2 w-1/4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->name }}</td>
                        <td class="px-4 py-2">{{ \Illuminate\Support\Str::limit($item->description, 15, $end='...') }}</td>
                        <td class="px-4 py-2">{{ $item->category->name }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-center">{{ $item->stock }}</td>
                        <td class="px-4 py-2 text-center">
                            @if ($item->status == 'unavailable')
                                <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-full">Unavailable</span>
                            @else
                                <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Available</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 flex justify-center space-x-2">
                            <button data-modal-target="modal-{{ $item->id }}" data-modal-toggle="modal-{{ $item->id }}" class="text-white bg-blue-500 hover:bg-blue-600 p-1.5 rounded">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button data-modal-target="modal-edit-{{ $item->id }}" data-modal-toggle="modal-edit-{{ $item->id }}" class="block text-white bg-green-500 hover:p-1.5 hover:bg-green-600 font-medium rounded-lg text-md p-1.5 text-center" type="button">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <form action="{{ route('items.destroy.admins', $item->id) }}" method="POST" class="inline-block" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('{{ $item->id }}', 'item')" class="block text-white bg-red-500 hover:p-1.5 hover:bg-red-600 font-medium rounded-lg text-md p-1.5 text-center">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>                            
                        </td>
                    </tr>
                    {{-- Detail Modal --}}
                    @include('admins.modals.detailitems', ['item' => $item])
                    {{-- Edit Modal --}}
                    @include('admins.modals.edititems', ['item' => $item])
                @endforeach
            </tbody>
        </table>
    </div>
   @include('admins.modals.additems')
</div>
@endsection
