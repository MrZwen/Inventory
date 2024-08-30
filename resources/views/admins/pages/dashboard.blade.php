@extends('admins.pages.main')

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

    <div class="flex justify-between items-center mb-4 mt-4">
        <h1 class="text-3xl font-bold text-gray-800">Stock Report</h1>
    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-700">Total Stock per Category</h2>
            <canvas id="totalStockChart"></canvas>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-700">Total Item per Category</h2>
            <canvas id="itemCountChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const ctxTotalStock = document.getElementById('totalStockChart').getContext('2d');
        const ctxItemCount = document.getElementById('itemCountChart').getContext('2d');

        // Total Stock per Category
        new Chart(ctxTotalStock, {
            type: 'bar',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    label: 'Total Stock',
                    data: @json($stockPerCategory),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Jumlah Item per Category (Bar Chart)
        new Chart(ctxItemCount, {
            type: 'bar',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    label: 'Total Item',
                    data: @json($itemCountPerCategory),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', 
                    borderColor: 'rgba(75, 192, 192, 1)',      
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush