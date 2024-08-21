@extends('staff.pages.main')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-700">Total Stock</h2>
            <p class="text-3xl font-bold text-green-500 mt-2">{{ $totalStock }}</p>
            <p class="text-sm text-gray-500 mt-1">Total item stock</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-700">Low Stock Items</h2>
            <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $lowStockItems }}</p>
            <p class="text-sm text-gray-500 mt-1">Items with low stock</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-700">Total Categories</h2>
            <p class="text-3xl font-bold text-blue-500 mt-2">{{ $totalCategories }}</p>
            <p class="text-sm text-gray-500 mt-1">Total number of categories</p>
        </div>
    </div>
</div>
@endsection
