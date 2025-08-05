<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function category()
    {

        // Fetch all categories to display in the view
        $categories = Category::all();
        return view('admin.category', compact('categories'));
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

    public function category_destroy($id)
    {
        // Find the category by ID and delete it
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }

    public function users(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }
}
