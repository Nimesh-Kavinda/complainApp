<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        // This method will display the staff management page
        // You can implement the logic to fetch and display staff members here
        return view('staff.index');
    }

    public function complainForm()
    {
        // Fetch user's staff ID related to user_ID in staff_members table
       $staffMember = StaffMember::where('user_id', Auth::id())->first();
       $staffId = $staffMember->staff_id ?? null;

       return view('staff.complainform', compact('staffId'));
    }


}
