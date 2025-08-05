<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\ClientComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display the client's dashboard.
     */
    public function index()
    {
        // Get recent complaints for dashboard
        $recentComplaints = ClientComplaint::where('client_email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $complaintStats = [
            'total' => ClientComplaint::where('client_email', Auth::user()->email)->count(),
            'pending' => ClientComplaint::where('client_email', Auth::user()->email)->where('status', 'pending')->count(),
            'in_progress' => ClientComplaint::where('client_email', Auth::user()->email)->where('status', 'in_progress')->count(),
            'resolved' => ClientComplaint::where('client_email', Auth::user()->email)->where('status', 'resolved')->count(),
        ];

        return view('client.index', compact('recentComplaints', 'complaintStats'));
    }

    /**
     * Show the complaint form
     */
    public function complainForm()
    {
        // Fetch all categories to display in the view
        $categories = Category::all();
        return view('client.complainform', compact('categories'));
    }

    /**
     * Show client's complaint history
     */
    public function myComplaints()
    {
        $complaints = ClientComplaint::with('category', 'assignedTo')
            ->where('client_email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.my-complaints', compact('complaints'));
    }
}
