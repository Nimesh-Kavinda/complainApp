<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\StaffMember;
use App\Models\StaffComplaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DepartmentHeadController extends Controller
{
    /**
     * Display the department head dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Get the department this user heads
        $department = $user->departmentAsHead;

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        // Get department statistics
        $stats = [
            'total_staff' => $department->staffMembers()->count(),
            'pending_registrations' => $department->staffMembers()->where('status', 'pending')->count(),
            'approved_staff' => $department->staffMembers()->where('status', 'approved')->count(),
            'rejected_registrations' => $department->staffMembers()->where('status', 'rejected')->count(),
        ];

        // Get recent staff registrations
        $recentRegistrations = $department->staffMembers()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('departmentHead.index', compact('department', 'stats', 'recentRegistrations'));
    }

    /**
     * Display staff members of the department.
     */
    public function staffMembers()
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        $staffMembers = $department->staffMembers()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('departmentHead.staff', compact('department', 'staffMembers'));
    }

    /**
     * View specific staff member details.
     */
    public function viewStaffMember(StaffMember $staffMember)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        // Check if this staff member belongs to the department head's department
        if (!$department || $staffMember->department_id !== $department->id) {
            abort(403, 'You can only view staff members from your department.');
        }

        $staffMember->load('user', 'reviewer');

        return view('departmentHead.staff-details', compact('staffMember', 'department'));
    }

    /**
     * Update staff member status (approve/reject).
     */
    public function updateStaffStatus(Request $request, StaffMember $staffMember)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        // Check if this staff member belongs to the department head's department
        if (!$department || $staffMember->department_id !== $department->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only manage staff members from your department.'
            ], 403);
        }

        try {
            $validated = $request->validate([
                'status' => 'required|in:approved,rejected',
                'rejection_reason' => 'nullable|string|max:500|required_if:status,rejected',
            ]);

            $staffMember->update([
                'status' => $validated['status'],
                'reviewed_by' => $user->id,
                'reviewed_at' => now(),
                'rejection_reason' => $validated['rejection_reason'] ?? null,
            ]);

            // If approved, update the user's role to 'staff_member'
            if ($validated['status'] === 'approved') {
                $staffMember->user->update(['role' => 'staff_member']);

                // Log the role update for debugging
                Log::info('Staff member approved and user role updated', [
                    'staff_id' => $staffMember->staff_id,
                    'user_id' => $staffMember->user_id,
                    'old_role' => $staffMember->user->getOriginal('role'),
                    'new_role' => 'staff_member',
                    'approved_by' => $user->id
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Staff member status updated successfully!',
                'staff_member' => $staffMember->load('user', 'reviewer')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get department statistics for AJAX requests.
     */
    public function getStats()
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            return response()->json(['success' => false, 'message' => 'Department not found'], 404);
        }

        $stats = [
            'total_staff' => $department->staffMembers()->count(),
            'pending_registrations' => $department->staffMembers()->where('status', 'pending')->count(),
            'approved_staff' => $department->staffMembers()->where('status', 'approved')->count(),
            'rejected_registrations' => $department->staffMembers()->where('status', 'rejected')->count(),
        ];

        return response()->json(['success' => true, 'stats' => $stats]);
    }

    public function staffcomplaints()
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            abort(403, 'You do not have access to this department.');
        }

        $complaints = $department->staffComplaints()
            ->with(['staffMember.user', 'department'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('departmentHead.staffComplaints', compact('complaints', 'department'));
    }

    /**
     * Show detailed view of a staff complaint
     */
    public function showStaffComplaint(StaffComplaint $complaint)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        // Check if this complaint belongs to the department head's department
        if (!$department || $complaint->department_id !== $department->id) {
            abort(403, 'You do not have access to this complaint.');
        }

        $complaint->load(['staffMember.user', 'department']);

        return view('departmentHead.staffComplaintDetails', compact('complaint', 'department'));
    }

    /**
     * Add response/solution to staff complaint
     */
    public function addStaffComplaintResponse(Request $request, StaffComplaint $complaint)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        // Check if this complaint belongs to the department head's department
        if (!$department || $complaint->department_id !== $department->id) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have access to this complaint.'
            ], 403);
        }

        try {
            $validated = $request->validate([
                'response_message' => 'required|string|max:2000',
                'status' => 'required|in:pending,in_progress,resolved,closed'
            ]);

            // Get existing responses or create new array
            $responses = $complaint->department_responses ?? [];

            // Add new response
            $newResponse = [
                'id' => count($responses) + 1,
                'message' => $validated['response_message'],
                'responded_by' => $user->id,
                'responder_name' => $user->name,
                'status_set' => $validated['status'],
                'created_at' => now()->toISOString(),
                'formatted_date' => now()->format('M d, Y h:i A')
            ];

            $responses[] = $newResponse;

            // Update complaint
            $complaint->update([
                'department_responses' => $responses,
                'status' => $validated['status'],
                'reviewed_by' => $user->id,
                'reviewed_at' => now(),
                'solution' => $validated['response_message'] // Also save as main solution
            ]);

            Log::info('Department head added response to staff complaint', [
                'complaint_id' => $complaint->id,
                'department_head_id' => $user->id,
                'status' => $validated['status']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Response added successfully!',
                'response' => $newResponse,
                'complaint' => $complaint->fresh(['staffMember.user', 'department'])
            ]);

        } catch (\Exception $e) {
            Log::error('Error adding staff complaint response', [
                'complaint_id' => $complaint->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to add response: ' . $e->getMessage()
            ], 500);
        }
    }

}
