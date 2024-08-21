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
        return $this->categoryService->getAll();
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return $this->categoryService->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->categoryService->update($data, $id);
    }

    public function delete($id)
    {
        return $this->categoryService->delete($id);
    }
}

?>