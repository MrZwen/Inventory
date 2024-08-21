<div id="modal-{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-lg bg-white rounded-lg shadow dark:bg-gray-800">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Detail for {{ $item->name }}
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8" data-modal-hide="modal-{{ $item->id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <!-- Modal body -->
        <div class="p-4 grid grid-cols-2 gap-4">
            <div class="font-semibold text-gray-700 dark:text-gray-300">Name:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->name }}</div>
            
            <div class="font-semibold text-gray-700 dark:text-gray-300">Input By:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->user->username }}</div>
            
            <div class="font-semibold text-gray-700 dark:text-gray-300">Description:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->description }}</div>
            
            <div class="font-semibold text-gray-700 dark:text-gray-300">Category:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->category->name }}</div>
            
            <div class="font-semibold text-gray-700 dark:text-gray-300">Price:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->price }}</div>
            
            <div class="font-semibold text-gray-700 dark:text-gray-300">Stock:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->stock }}</div>
            
            <div class="font-semibold text-gray-700 dark:text-gray-300">Status:</div>
            <div class="text-gray-900 dark:text-white">{{ $item->status }}</div>

            <div class="font-semibold text-gray-700">Gambar:</div>
            <div class="">
                <img class="rounded-lg shadow-lg object-cover h-32 w-32" src="{{ asset($item->image) }}" alt="Image">
            </div>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end p-4 border-t dark:border-gray-600">
            <button data-modal-hide="modal-{{ $item->id }}" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Close</button>
        </div>
    </div>
</div>
