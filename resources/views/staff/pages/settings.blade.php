@extends('staff.pages.main')

@section('title', 'Settings')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Settings</h1>

    <form action="{{ route('settings.update.staff') }}" method="POST" class="bg-white p-6 max-w-md rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="low_stock_threshold" class="block text-gray-700 font-medium mb-2">Low Stock Items</label>
            <input type="number" name="low_stock_threshold" id="low_stock_threshold" value="{{ $threshold }}"
                class="border border-gray-300 p-2 w-full rounded">
            @error('low_stock_threshold')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection