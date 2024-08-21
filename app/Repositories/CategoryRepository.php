<?php 

namespace App\Repositories;
use App\Models\Category;

class CategoryRepository
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function getAll()
    {
        return Category::orderBy('created_at', 'desc')->get();
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(array $data, $id)
    {
        $category = $this->findById($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->findById($id);
        $category->delete();
        return $category;
    }
}

?>