<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Fetch all categories to display in the view
        $users = User::all(); // Fetch all users to display in the view
        return view('admin.index', compact('users'));
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

    public function users(Request $request)
    {
        $query = User::query();

        // Filter only if role is not empty and not null
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        // Get all available roles from the database
        $roles = User::distinct('role')->pluck('role')->toArray();

        // If no roles exist in database, use default roles
        if (empty($roles)) {
            $roles = ['client', 'staff_member', 'department_head', 'senior_board', 'md'];
        }

        return view('admin.users', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'role' => 'required|in:client,staff_member,department_head,senior_board,md'
        ]);

        try {
            // Find the user
            $user = User::findOrFail($id);

            // Store old role for logging
            $oldRole = $user->role;

            // Update the user's role
            $user->role = $request->role;
            $user->save();

            // Log the role change (optional)
            Log::info("User role updated", [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'old_role' => $oldRole,
                'new_role' => $request->role,
                'updated_by' => 'admin' // You can update this to track who made the change
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User role updated successfully!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role,
                    'old_role' => $oldRole
                ]
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid role selected.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error("Failed to update user role", [
                'user_id' => $id,
                'new_role' => $request->role,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update user role. Please try again.'
            ], 500);
        }
    }
}



