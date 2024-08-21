<?php 

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryService
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        $data = compact('categories');

        $roleName = Auth::user()->role->name;
        
        if ($roleName == 'admin') {
            $view = 'admins.pages.category';
        } elseif($roleName == 'staff') {
            $view = 'staff.pages.category';
        }

        return ['view' => $view, 'categories' => $data];
    }

    public function findById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function create(array $data)
    {
        $category = Category::create($data);
        $roleName = Auth::user()->role->name;

        if ($category) {
            Alert::toast('Category created successfully!', 'success', ['timer' => 3000]);
            if ($roleName == 'admin') {
                return redirect()->route('category.index');
            } else if($roleName == 'staff'){
                return redirect()->route('category.index.staff');
            }
        } else {
            Alert::toast('Failed to create category!', 'error', ['timer' => 3000]);
            return redirect()->route('category.index');
        }
    }

    public function update(array $data, $id)
    {
        $category = $this->findById($id);
        $category->update($data);

        $roleName = Auth::user()->role->name;
        if ($category) {
            Alert::toast('Category updated successfully!', 'success', ['timer' => 3000]);
            if($roleName == 'admin'){
                return redirect()->route('category.index');
            } else if($roleName == 'staff'){
                return redirect()->route('category.index.staff');
            }
        } else {
            Alert::toast('Failed to update category!', 'error', ['timer' => 3000]);
            return redirect()->route('category.index');
        }
    }

    public function delete($id)
    {
        $category = $this->findById($id);
        $category->delete();
        return $category;
    }
}  


?>