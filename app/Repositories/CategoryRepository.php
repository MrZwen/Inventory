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
        $categories = Category::orderBy('created_at', 'desc')->get();
        return $categories;
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return $this->category->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->category->update($data, $id);
    }

    public function delete($id)
    {
        return $this->category->delete($id);
    }
}

?>