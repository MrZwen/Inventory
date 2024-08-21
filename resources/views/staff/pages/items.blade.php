@extends('staff.pages.main')

@section('title', 'Items')

@section('content')
    <div class="w-full p-5 flex flex-col gap-4">
        <h2 class="text-2xl font-semibold mb-2">Items</h2>

        <div class="overflow-x-auto rounded-lg shadow-lg shadow-black/15 mb-5">
            <table class="w-full">
                <thead class="bg-white border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Description</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Category</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Price</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Stock</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Status</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->name }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{$item->description}}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{$item->category->name}}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->stock }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">
                            @if ($item->status == 'unavailable')
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-red-500 rounded">{{$item->status}}</span>
                            @else
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-green-500 rounded">{{$item->status}}</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex justify-center gap-2">
                                <div class="">
                                    <button data-modal-target="modal-{{ $item->id }}" data-modal-toggle="modal-{{ $item->id }}" class="block text-white bg-blue-700 hover:p-2.5 hover:bg-blue-800 font-medium rounded-lg text-md p-2.5 text-center" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="">
                                    <button data-modal-target="modal-edit-{{ $item->id }}" data-modal-toggle="modal-edit-{{ $item->id }}" class="block text-white bg-green-500 hover:p-2.5 hover:bg-green-600 font-medium rounded-lg text-md p-2.5 text-center" type="button">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr> 
                    {{-- Detail Modal --}}
                    @include('staff.modals.detailitems', ['item' => $item])
                    {{-- Edit Modal --}}
                    @include('staff.modals.edititems', ['item' => $item])
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Form Tambah Data Items --}}
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Tambah Data Items</h3>
            <form action="{{ route('items.store.staff') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            @foreach($categories->sortBy(function($category) {
                                return $category->name == 'Lainnya' ? 'zzz' : $category->name;
                            }) as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" name="stock" id="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md">Submit</button>
                </div>
            </form>
        </div>
@endsection
