<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\StaffMember;
use App\Models\StaffComplaint;
use App\Models\User;
use App\Models\ComplaintAssignment;
use App\Models\ComplaintDiscussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        return view('departmentHead.staff-details', compact('staffMember', 'department',));
    }

    /**
     * Download staff ID image securely.
     */
    public function downloadStaffIdImage(StaffMember $staffMember)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        // Check if this staff member belongs to the department head's department
        if (!$department || $staffMember->department_id !== $department->id) {
            abort(403, 'You can only view staff members from your department.');
        }

        // Check if staff member has an ID image
        if (!$staffMember->staff_id_image_path) {
            abort(404, 'Staff ID image not found.');
        }

        // Get the full path to the file
        $filePath = storage_path('app/public/' . ltrim($staffMember->staff_id_image_path, '/'));

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404, 'Staff ID image file not found.');
        }

        // Get the file extension for proper MIME type
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $mimeType = match (strtolower($extension)) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'bmp' => 'image/bmp',
            'svg' => 'image/svg+xml',
            default => 'application/octet-stream'
        };

        // Return the file response
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
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

    /**
     * Download staff complaint evidence file securely.
     */
    public function downloadStaffComplaintEvidence(StaffComplaint $complaint, $fileIndex)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        // Check if this complaint belongs to the department head's department
        if (!$department || $complaint->department_id !== $department->id) {
            abort(403, 'You do not have access to this complaint.');
        }

        // Check if complaint has evidence files
        if (!$complaint->evidence_files || !is_array($complaint->evidence_files)) {
            abort(404, 'No evidence files found.');
        }

        // Check if file index exists
        if (!isset($complaint->evidence_files[$fileIndex])) {
            abort(404, 'Evidence file not found.');
        }

        $file = $complaint->evidence_files[$fileIndex];

        // Handle both string paths and array file objects
        if (is_array($file)) {
            $filePath = $file['path'] ?? $file['file_path'] ?? '';
            $fileName = $file['name'] ?? $file['original_name'] ?? basename($filePath);
        } else {
            $filePath = $file;
            $fileName = basename($file);
        }

        // Get the full path to the file
        $fullPath = storage_path('app/public/' . ltrim($filePath, '/'));

        // Check if file exists
        if (!file_exists($fullPath)) {
            abort(404, 'Evidence file not found on disk.');
        }

        // Get the file extension for proper MIME type
        $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
        $mimeType = match (strtolower($extension)) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'bmp' => 'image/bmp',
            'svg' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'ogg' => 'video/ogg',
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            default => 'application/octet-stream'
        };

        // Return the file response
        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }


    /**
     * Display admin assigned complaints for this department head
     */
    public function adminAssignedComplaints()
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            abort(403, 'You are not assigned as a department head.');
        }

        // Get all complaint assignments for this department head
        $assignments = ComplaintAssignment::with([
            'clientComplaint.category',
            'department',
            'assignedBy',
            'discussions.sender',
            'discussions' => function($query) {
                $query->orderBy('sent_at', 'desc');
            }
        ])
        ->where('assigned_to', $user->id)
        ->where('department_id', $department->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('departmentHead.admin-assingedComplaints', compact('assignments', 'department'));
    }

    /**
     * Send a message in complaint discussion
     */
    public function sendDiscussionMessage(Request $request, $assignmentId)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'You are not assigned as a department head.'
            ], 403);
        }

        $assignment = ComplaintAssignment::findOrFail($assignmentId);

        // Verify this assignment belongs to the current department head
        if ($assignment->assigned_to !== $user->id || $assignment->department_id !== $department->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only send messages for your assigned complaints.'
            ], 403);
        }

        $request->validate([
            'message' => 'required|string|max:2000',
            'attachments.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,txt',
            'is_important' => 'boolean'
        ]);

        try {
            $attachments = [];

            // Handle file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->store('complaint_discussions', 'public');

                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => $filename,
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType()
                    ];
                }
            }

            $discussion = ComplaintDiscussion::create([
                'complaint_assignment_id' => $assignment->id,
                'sender_id' => $user->id,
                'sender_type' => 'department_head',
                'message' => $request->message,
                'message_type' => 'text',
                'attachments' => $attachments,
                'is_important' => $request->boolean('is_important', false),
                'sent_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'discussion' => [
                    'id' => $discussion->id,
                    'message' => $discussion->message,
                    'sender_name' => $user->name,
                    'sender_type' => 'department_head',
                    'sent_at' => $discussion->sent_at->format('M d, Y h:i A'),
                    'attachments' => $discussion->attachments,
                    'is_important' => $discussion->is_important
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending discussion message: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get discussion messages for a complaint assignment
     */
    public function getDiscussionMessages($assignmentId)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'You are not assigned as a department head.'
            ], 403);
        }

        $assignment = ComplaintAssignment::findOrFail($assignmentId);

        // Verify this assignment belongs to the current department head
        if ($assignment->assigned_to !== $user->id || $assignment->department_id !== $department->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only view messages for your assigned complaints.'
            ], 403);
        }

        $discussions = $assignment->discussions()
            ->with('sender')
            ->orderBy('sent_at', 'asc')
            ->get()
            ->map(function($discussion) {
                return [
                    'id' => $discussion->id,
                    'message' => $discussion->message,
                    'sender_name' => $discussion->sender->name,
                    'sender_type' => $discussion->sender_type,
                    'sent_at' => $discussion->sent_at->format('M d, Y h:i A'),
                    'attachments' => $discussion->attachments,
                    'is_important' => $discussion->is_important
                ];
            });

        return response()->json([
            'success' => true,
            'discussions' => $discussions
        ]);
    }

    /**
     * Update assignment status
     */
    public function updateAssignmentStatus(Request $request, $assignmentId)
    {
        $user = Auth::user();
        $department = $user->departmentAsHead;

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'You are not assigned as a department head.'
            ], 403);
        }

        $assignment = ComplaintAssignment::findOrFail($assignmentId);

        // Verify this assignment belongs to the current department head
        if ($assignment->assigned_to !== $user->id || $assignment->department_id !== $department->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your assigned complaints.'
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:assigned,in_progress,pending_feedback,resolved,cancelled',
            'resolution_notes' => 'nullable|string|max:1000'
        ]);

        try {
            $assignment->update([
                'status' => $request->status,
                'resolution_notes' => $request->resolution_notes,
                'resolved_at' => $request->status === 'resolved' ? now() : null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assignment status updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating assignment status: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update status. Please try again.'
            ], 500);
        }
    }

}
