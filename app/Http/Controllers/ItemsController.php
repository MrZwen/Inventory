<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Items;
use App\Services\ItemService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ItemsController extends Controller
{
    protected $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    
    public function index()
    {
        $items = $this->itemService->dashboard();
        return view($items['view'], $items['items']);
    }

    public function items()
    {
        $items = $this->itemService->getAll();
        return view($items['view'], $items['items']);
    }

    // public function show($id)
    // {
    //     $result = ['status' => 200];

    //     try {
    //         $result['data'] = $this->itemService->findById($id);
    //     } catch (Exception $e) {
    //         $result = [
    //             'status' => 500,
    //             'error' => $e->getMessage(),
    //         ];
    //     }

    //     return response()->json($result, $result['status']);
    // }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $result = $this->itemService->create($request->all(), $userId);

        if (!$result['success']) {
            return redirect()->back()->withErrors($result['errors'])->withInput();
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        return $this->itemService->updateItem($id, $request);
    }

    // public function updateStaff(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'category_id' => 'required|exists:categories,id',
    //         'description' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'stock' => 'required|integer|min:0',
    //         'status' => 'required|in:available,unavailable',
    //         'image' => 'nullable|image|max:2048', 
    //     ]);

    //     $item = $this->itemService->updateItem($id, $request);

    //     if ($item) {
    //         // Alert::success('Success', 'Item updated successfully!');
    //         Alert::toast('Item updated successfully!', 'Success', ['timer' => 3000]);
    //         return redirect()->back();
    //     } else {
    //         Alert::error('Failed', 'Failed to update item.');
    //         return redirect()->back();
    //     }

    // }

    public function delete($id){
        $this->itemService->delete($id);
    }
}
