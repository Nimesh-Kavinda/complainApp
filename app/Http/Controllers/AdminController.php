<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function category()
    {
        return view('admin.category');
    }

    public function category_store(Request $request)
    {
        // Validate and store the category data
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->input('category');
        $category->save();

        return redirect()->route('admin.category')->with('success', 'Category created successfully.');
    }


}
