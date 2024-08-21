<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function categories()
    {
        $categories = $this->categoryService->getAll();

        if (Auth::user()->role->name == 'admin') {
            return view('admins.pages.category', compact('categories'));
        } elseif(Auth::user()->role->name == 'staff') {
            return view('staff.pages.category', compact('categories'));
        }
    }

    public function store(Request $request)
    {
        try {
            $this->categoryService->create($request->all());
            if (Auth::user()->role->name == 'admin') {
                return redirect()->back()->with('success', 'Category created successfully');
            } elseif(Auth::user()->role->name == 'staff') {
                return redirect()->back()->with('success', 'Category created successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->categoryService->update($request->all(), $id);
            if (Auth::user()->role_id == 1) {
                return redirect()->back()->with('success', 'Category updated successfully');
            } elseif(Auth::user()->role_id == 2) {
                return redirect()->back()->with('success', 'Category updated successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->categoryService->delete($id);
            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
