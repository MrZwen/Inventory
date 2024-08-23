<?php

namespace App\Http\Controllers;

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
        $dashboardData = $this->itemService->dashboard();
        return view($dashboardData['view'], $dashboardData['items']);
    }

    public function items()
    {
        $itemsData = $this->itemService->getAll();
        return view($itemsData['view'], $itemsData['items']);
    }

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
        $result = $this->itemService->updateItem($id, $request);

        if ($result['success']) {
            Alert::toast('Item updated successfully!', 'success', ['timer' => 3000]);
        } else {
            Alert::toast('Failed to update item.', 'error', ['timer' => 3000]);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $this->itemService->delete($id);
            Alert::toast('Item deleted successfully', 'success', ['timer' => 3000]);
        } catch (Exception $e) {
            Alert::toast('Failed to delete item', 'error', ['timer' => 3000]);
        }

        return redirect()->back();
    }
}
