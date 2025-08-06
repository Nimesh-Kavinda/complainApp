<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClientComplaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Fetch all categories to display in the view
        $users = User::all(); // Fetch all users to display in the view
        $complaints = ClientComplaint::all(); // Fetch all complaints to display in the view
        return view('admin.index', compact('users', 'complaints'));
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

    public function complains(Request $request)
    {
        $query = ClientComplaint::with(['category', 'assignedTo']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter for multiple complaints from same NIC
        if ($request->filled('multiple_complaints') && $request->multiple_complaints == 'yes') {
            // Get NICs that have more than one complaint
            $nicWithMultiple = ClientComplaint::select('nic')
                ->whereNotNull('nic')
                ->groupBy('nic')
                ->havingRaw('COUNT(*) > 1')
                ->pluck('nic');

            $query->whereIn('nic', $nicWithMultiple);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('reference_number', 'like', "%{$searchTerm}%")
                  ->orWhere('client_name', 'like', "%{$searchTerm}%")
                  ->orWhere('nic', 'like', "%{$searchTerm}%")
                  ->orWhere('complaint_details', 'like', "%{$searchTerm}%");
            });
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get complaints count by NIC for highlighting multiple complaints
        $nicComplaintCounts = ClientComplaint::select('nic')
            ->selectRaw('COUNT(*) as complaint_count')
            ->whereNotNull('nic')
            ->groupBy('nic')
            ->pluck('complaint_count', 'nic');

        // Attach complaint count to each complaint
        $complaints->getCollection()->transform(function ($complaint) use ($nicComplaintCounts) {
            $complaint->complaint_count_for_nic = $nicComplaintCounts->get($complaint->nic, 1);
            $complaint->has_multiple_complaints = $complaint->complaint_count_for_nic > 1;
            return $complaint;
        });

        // Get filter options
        $categories = Category::all();
        $statuses = ['pending', 'in_progress', 'resolved', 'closed', 'rejected'];
        $priorities = ['low', 'medium', 'high', 'urgent'];

        // Get statistics
        $stats = [
            'total' => ClientComplaint::count(),
            'pending' => ClientComplaint::where('status', 'pending')->count(),
            'in_progress' => ClientComplaint::where('status', 'in_progress')->count(),
            'resolved' => ClientComplaint::where('status', 'resolved')->count(),
            'multiple_nic_users' => ClientComplaint::select('nic')
                ->whereNotNull('nic')
                ->groupBy('nic')
                ->havingRaw('COUNT(*) > 1')
                ->count()
        ];

        return view('admin.clientComplains', compact('complaints', 'categories', 'statuses', 'priorities', 'stats', 'nicComplaintCounts'));
    }

    public function updateComplaintStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed,rejected',
            'message' => 'nullable|string|max:5000',
            'admin_notes' => 'nullable|string|max:5000'
        ]);

        try {
            $complaint = ClientComplaint::findOrFail($id);

            // Log the update attempt
            Log::info('Updating complaint status', [
                'complaint_id' => $id,
                'old_status' => $complaint->status,
                'new_status' => $request->status,
                'admin_id' => Auth::id(),
                'has_message' => !empty($request->message),
                'has_admin_notes' => !empty($request->admin_notes)
            ]);

            $updateData = [
                'status' => $request->status,
                'assigned_to' => Auth::id(),
                'resolved_at' => $request->status === 'resolved' ? now() : null,
                'closed_at' => $request->status === 'closed' ? now() : null,
            ];

            // Only update admin notes if provided
            if ($request->filled('admin_notes')) {
                $updateData['admin_notes'] = $request->admin_notes;
            }

            // Add message to conversation if provided
            if ($request->filled('message')) {
                $complaint->addConversationMessage(
                    $request->message,
                    'admin',
                    Auth::id(),
                    Auth::user()->name
                );
            }

            $complaint->update($updateData);

            Log::info('Complaint status updated successfully', [
                'complaint_id' => $id,
                'new_status' => $complaint->fresh()->status,
                'conversation_count' => $complaint->fresh()->getConversationCount()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Complaint updated successfully! The client will be notified of the status change.',
                'complaint' => $complaint->fresh(),
                'data' => [
                    'status' => $complaint->fresh()->status,
                    'status_label' => $complaint->fresh()->status_label,
                    'status_color' => $complaint->fresh()->status_color,
                    'assigned_to' => Auth::user()->name,
                    'updated_at' => $complaint->fresh()->updated_at->format('M d, Y h:i A')
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed for complaint update', [
                'complaint_id' => $id,
                'errors' => $e->errors()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', collect($e->errors())->flatten()->toArray())
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Complaint not found', ['complaint_id' => $id]);

            return response()->json([
                'success' => false,
                'message' => 'Complaint not found.'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Failed to update complaint status', [
                'complaint_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update complaint: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getComplaintConversation($id)
    {
        try {
            $complaint = ClientComplaint::with('category')->findOrFail($id);

            return response()->json([
                'success' => true,
                'conversation' => $complaint->getConversation(),
                'complaint_info' => [
                    'id' => $complaint->id,
                    'reference_number' => $complaint->reference_number,
                    'client_name' => $complaint->client_name,
                    'client_email' => $complaint->client_email,
                    'nic' => $complaint->nic,
                    'status' => $complaint->status,
                    'status_label' => $complaint->status_label,
                    'priority' => $complaint->priority,
                    'priority_label' => $complaint->priority_label,
                    'complaint_title' => $complaint->complaint_title,
                    'complaint_details' => $complaint->complaint_details,
                    'category_name' => $complaint->category ? $complaint->category->category_name : 'Uncategorized',
                    'evidence_count' => $complaint->hasEvidence() ? $complaint->getEvidenceCount() : 0,
                    'created_at' => $complaint->created_at->toISOString(),
                    'updated_at' => $complaint->updated_at->toISOString(),
                    'solution' => $complaint->solution,
                    'admin_notes' => $complaint->admin_notes
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load conversation.'
            ], 500);
        }
    }

    public function deleteComplaint($id)
    {
        try {
            $complaint = ClientComplaint::findOrFail($id);

            // Delete associated evidence files
            if ($complaint->evidence_files) {
                foreach ($complaint->evidence_files as $file) {
                    $filePath = storage_path('app/public/' . $file['path']);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            $complaint->delete();

            return response()->json([
                'success' => true,
                'message' => 'Complaint deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete complaint.'
            ], 500);
        }
    }

}



