<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = $request->user(); // get the authenticated user

    // Role-based redirection
    switch ($user->role) {
        case 'client':
            return redirect()->route('client.index');
        case 'md':
            return redirect()->route('md.index');
        case 'department_head':
            return redirect()->route('department_head.index');
        case 'senior_board':
            return redirect()->route('senior_board.index');
        case 'staff_member':
            return redirect()->route('staff.index');
        default:
            return redirect()->route('dashboard'); // fallback
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
