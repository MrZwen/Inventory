<?php 

namespace App\Services;

use App\Repositories\ItemsRepository;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ItemService
{
    protected $itemsRepository;

    public function __construct(ItemsRepository $itemsRepository)
    {
        $this->itemsRepository = $itemsRepository;
    }

    public function dashboard()
    {
        $totalStock = $this->itemsRepository->getAll()->sum('stock');
        $lowStockItems = $this->itemsRepository->getAll()->where('stock', '<=', 10)->count();
        $totalCategories = Category::count();

        $data = compact('totalStock', 'lowStockItems', 'totalCategories');

        $roleName = Auth::user()->role->name;
        $view = $roleName == 'admin' ? 'admins.pages.dashboard' : 'staff.pages.dashboard';

        return ['view' => $view, 'items' => $data];
    }

    public function getAll()
    {
        $items = $this->itemsRepository->getAll();
        $categories = Category::select('id', 'name')->get();

        $data = compact('items', 'categories');

        $roleName = Auth::user()->role->name;
        $view = $roleName == 'admin' ? 'admins.pages.items' : 'staff.pages.items';

        return ['view' => $view, 'items' => $data];
    }

    public function findById($id)
    {
        return $this->itemsRepository->findById($id);
    }

    public function create(array $data, $userId)
    {
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

        if (isset($data['image'])) {
            $imageName = time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image'] = 'storage/' . $data['image']->storeAs('images/items', $imageName, 'public');
        }

        $data['id'] = Str::uuid()->toString();
        $data['users_id'] = $userId;

        $item = $this->itemsRepository->create($data);

        $message = $item ? 'Item created successfully!' : 'Failed to create item.';
        $type = $item ? 'success' : 'error';
        Alert::toast($message, $type, ['timer' => 3000]);

        return ['success' => true, 'item' => $item];
    }

    public function updateItem($id, Request $request): array
    {
        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|max:2048',
        ]);

        // Ambil data item lama dari repository
        $item = $this->itemsRepository->findById($id);

        // Tangani gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $data['image'] = 'storage/' . $request->image->storeAs('images/items', $imageName, 'public');
        } else {
            // Jika tidak ada gambar baru, pertahankan gambar lama
            $data['image'] = $item->image;
        }

        // Update status berdasarkan stok
        $data['status'] = $data['stock'] == 0 ? 'unavailable' : 'available';

        // Update item
        $updated = $this->itemsRepository->update($id, $data);

        // Kembalikan hasil
        return [
            'success' => $updated,
        ];
    }


    public function delete($id)
    {
        $this->itemsRepository->delete($id);
        Alert::toast('Item deleted successfully!', 'success', ['timer' => 3000]);
    }
}
?>
