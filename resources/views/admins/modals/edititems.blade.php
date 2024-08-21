<!-- Main modal -->
<div id="modal-edit-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Item
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-edit-{{ $item->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4 overflow-y-auto max-h-96">
                <form action="{{ route('items.update.admin', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" id="name-{{ $item->id }}" value="{{ $item->name }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                        </div>
                        <div>
                            <label for="category_id-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category_id" id="category_id-{{ $item->id }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                                @foreach($categories->sortBy(function($category) {
                                    return $category->name == 'Lainnya' ? 'zzz' : $category->name;
                                }) as $category)
                                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="description-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description-{{ $item->id }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>{{ $item->description }}</textarea>
                        </div>
                        <div>
                            <label for="price-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" name="price" id="price-{{ $item->id }}" value="{{ $item->price }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                        </div>
                        <div>
                            <label for="stock-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                            <input type="number" name="stock" id="stock-{{ $item->id }}" value="{{ $item->stock }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                        </div>
                        <div>
                            <label for="status-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status-{{ $item->id }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                                <option value="available" {{ $item->status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ $item->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                        </div>
                        <div>
                            <label for="image-{{ $item->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input type="file" name="image" id="image-{{ $item->id }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Current Image: <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="h-16"></p>
                        </div>
                    </div>
                    <!-- Button moved to the footer -->
                
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Update</button>

                <button data-modal-hide="modal-edit-{{ $item->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
