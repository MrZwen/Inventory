<?php 

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function findById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->categoryRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}  


?>