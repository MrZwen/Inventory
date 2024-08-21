<?php 
namespace App\Services;

use App\Models\Category;
use App\Models\Items;
use App\Repositories\ItemsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Stringable;

class ItemService
{
    protected $itemsRepository;
    public function __construct(ItemsRepository $itemsRepository)
    {
        $this->itemsRepository = $itemsRepository;
    }

    public function dashboard(){
        $totalStock = Items::sum('stock');
        $lowStockItems = Items::where('stock', '<=', 10)->count();
        $totalCategories = Category::count();
        $data = compact('totalStock', 'lowStockItems', 'totalCategories');
        
        if (Auth::user()->role->name == 'admin') {
            $view = 'admins.pages.dashboard';
        } elseif(Auth::user()->role->name == 'staff') {
            $view = 'staff.pages.dashboard';
        }
        return ['view' => $view, 'items' => $data];
    }

    public function getAll()
    {
        $items = Items::with(['user:id,username', 'category:id,name'])
        ->orderBy('created_at', 'desc')
        ->get();

        $categories = Category::all();

        $data = compact('items', 'categories');

        $roleName = Auth::user()->role->name;

        if ($roleName == 'admin') {
            $view = 'admins.pages.items';
        } elseif ($roleName == 'staff') {
            $view = 'staff.pages.items';
        }

        return ['view' => $view, 'items' => $data];
    }

    public function findById($id)
    {
        return $this->itemsRepository->findById($id);
    }

    public function create(array $data, $userId)
    {
        // Debugging untuk memastikan gambar ada
        if (!isset($data['image'])) {
            Alert::toast('Image is not present in the request!', 'error', ['timer' => 3000]);
            return ['success' => false, 'errors' => ['image' => 'Image is required']];
        }

        // Validasi data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|in:available,unavailable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::toast('Validation failed!', 'error', ['timer' => 3000]);
            return ['success' => false, 'errors' => $validator->errors()];
        }

        // Proses upload gambar
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Tambahkan path gambar ke array data
            $data['image'] = 'storage/' . $imagePath;
        }

        $data['id'] = Str::uuid()->toString();
        $data['users_id'] = $userId;

        $item = $this->itemsRepository->create($data, $userId);

        if (Auth::user()->role->name == 'admin') {
            if ($item) {
                Alert::toast('Item created successfully!', 'success', ['timer' => 3000]);
            } else {
                Alert::toast('Failed to create item.', 'error', ['timer' => 1500]);
            }
        } elseif (Auth::user()->role->name == 'staff') {
            Alert::toast('Item created successfully!', 'success', ['timer' => 1500]);
            Alert::success('Success', 'Item created successfully!');
        }

        return ['success' => true, 'item' => $item];
    }

    public function updateItem($id, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $item = $this->findById($id);
    
        if ($item) {
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($item->image) {
                    $oldImagePath = str_replace('storage/', '', $item->image);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
    
                // Upload dan simpan path gambar baru
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images', $imageName, 'public');
    
                // Tambahkan path gambar baru ke array data
                $data['image'] = 'storage/' . $imagePath;
            }
    
            // Update status jika stok 0
            if ($data['stock'] == 0) {
                $data['status'] = 'unavailable';
            } else {
                $data['status'] = 'available';
            }
    
            // Lakukan update item
            $item->update($data);

            if (Auth::user()->role->name == 'admin') {
                Alert::toast('Item updated successfully!', 'success', ['timer' => 3000]);
            } elseif (Auth::user()->role->name == 'staff') {
                Alert::toast('Item updated successfully!', 'success', ['timer' => 1500]);
            }         

            return redirect()->back();
        }
        Alert::toast('Failed to update item.', 'error', ['timer' => 1500]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $item = Items::find($id);

        if ($item->image) {
            $imagePath = str_replace('storage/', '', $item->image);
    
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    
        $item->delete();
    }
}   
?>