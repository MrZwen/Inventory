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

    public function dashboard() {
        return $this->itemService->dashboard();
    }

    public function getAll()
    {
        $this->itemService->getAll();
    }

    public function findById($id){
        $items = Items::where('id', $id)->firstOrFail();

        return $items;
    }

    public function create(array $data, $userId){
        return Items::create($data, $userId);  
    }

    public function update(array $data, $id)
    {
       $this->itemService->update($data, $id);
    }

    public function delete($id)
    {
        $this->itemService->delete($id);
    }

}


?>