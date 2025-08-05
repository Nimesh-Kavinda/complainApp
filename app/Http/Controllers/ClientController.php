<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display the client's dashboard.
     */
    public function index()
    {
        return view('client.index');
    }

    public function complainForm() {

        // Fetch all categories to display in the view
        $categories = Category::all();

        return view('client.complainform', compact('categories'));
    }
}
