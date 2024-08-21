<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryService $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function categories()
    {
        $categories = $this->categoryRepository->getAll();
        return view($categories['view'], $categories['categories']);
    }

    public function store(Request $request)
    {
        return $this->categoryRepository->create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->categoryRepository->update($request->all(), $id);
    }

    public function delete($id)
    {
        try {
            $this->categoryRepository->delete($id);
            Alert::toast('Category deleted successfully', 'success', ['timer' => 3000]);
            return redirect()->back();
        } catch (Exception $e) {
            Alert::toast($e->getMessage(), 'error', ['timer' => 3000]);
            return redirect()->back();
        }
    }
}
