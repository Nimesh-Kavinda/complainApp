<?php

namespace App\Http\Controllers;

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
        return view('client.complainform');
    }
}
