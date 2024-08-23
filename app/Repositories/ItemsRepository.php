<?php
 
namespace App\Repositories;

use App\Models\Items;
use Illuminate\Support\Facades\Storage;

class ItemsRepository
{
    protected $items;

    public function __construct(Items $items)
    {
        $this->items = $items;
    }

    public function getAll()
    {
        return $this->items->with(['user:id,username', 'category:id,name'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findById($id)
    {
        return $this->items->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->items->create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->findById($id);
        return $item->update($data);
    }

    public function delete($id)
    {
        $item = $this->findById($id);

        if ($item->image) {
            $imagePath = str_replace('storage/', '', $item->image);
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        return $item->delete();
    }
}
?>
