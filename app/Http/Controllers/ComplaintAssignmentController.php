<?php

namespace App\Http\Controllers;

use App\Models\ClientComplaint;
use App\Models\ComplaintAssignment;
use App\Models\ComplaintDiscussion;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ComplaintAssignmentController extends Controller
{
    /**
     * Assign a complaint to multiple departments
     */
    public function assignComplaint(Request $request, $id): JsonResponse
    {
        $complaint = ClientComplaint::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'departments' => 'required|array|min:1',
            'departments.*' => 'exists:departments,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'deadline' => 'nullable|date|after:today',
            'assignment_notes' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $assignments = [];

            foreach ($request->departments as $departmentId) {
                $department = Department::find($departmentId);

                if (!$department || !$department->head_of_department) {
                    continue;
                }

                // Check if already assigned to this department
                $existingAssignment = ComplaintAssignment::where('client_complaint_id', $complaint->id)
                    ->where('department_id', $departmentId)
                    ->where('status', '!=', 'cancelled')
                    ->first();

                if ($existingAssignment) {
                    continue; // Skip if already assigned
                }

                $assignment = ComplaintAssignment::create([
                    'client_complaint_id' => $complaint->id,
                    'department_id' => $departmentId,
                    'assigned_by' => Auth::id(),
                    'assigned_to' => $department->head_of_department,
                    'status' => 'assigned',
                    'priority' => $request->priority,
                    'deadline' => $request->deadline,
                    'assignment_notes' => $request->assignment_notes
                ]);

                $assignments[] = $assignment->load(['department', 'assignedTo']);
            }

            // Update complaint status
            $complaint->update([
                'status' => 'in_progress',
                'assigned_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Complaint assigned successfully to ' . count($assignments) . ' department(s)',
                'data' => [
                    'assignments' => $assignments,
                    'complaint' => $complaint->fresh()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign complaint: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get complaint assignments with discussions
     */
    public function getComplaintAssignments($id): JsonResponse
    {
        $complaint = ClientComplaint::findOrFail($id);

        try {
            $assignments = $complaint->assignments()
                ->with([
                    'department',
                    'assignedBy',
                    'assignedTo',
                    'discussions' => function ($query) {
                        $query->with('sender')->orderBy('sent_at', 'asc');
                    }
                ])
                ->get()
                ->map(function ($assignment) {
                    // Count unread messages for admin
                    // Unread messages for admin are department head messages not yet read
                    $unreadCount = $assignment->discussions()
                        ->where('sender_type', 'department_head')
                        ->whereNull('read_at')
                        ->count();

                    return [
                        'id' => $assignment->id,
                        'department' => $assignment->department,
                        'status' => $assignment->status,
                        'created_at' => $assignment->created_at,
                        'unread_messages_count' => $unreadCount
                    ];
                });

            return response()->json([
                'success' => true,
                'assignments' => $assignments
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch assignments: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send a message in assignment discussion
     */
    public function sendMessage(Request $request, ComplaintAssignment $assignment): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required_without:attachments|string|max:2000',
            'message_type' => 'required|in:text,file,image,video,document',
            'is_important' => 'boolean',
            'is_confidential' => 'boolean',
            'reply_to_message_id' => 'nullable|exists:complaint_discussions,id',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|max:10240' // 10MB max per file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            $attachments = [];

            // Handle file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('complaint-discussions/' . $assignment->id, 'public');

                    $attachments[] = [
                        'name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'size' => $file->getSize(),
                        'type' => $this->getFileType($file->getClientMimeType()),
                        'mime_type' => $file->getClientMimeType()
                    ];
                }
            }

            // Determine sender type
            $senderType = $user->role === 'admin' ? 'admin' : 'department_head';

            $discussion = ComplaintDiscussion::create([
                'complaint_assignment_id' => $assignment->id,
                'sender_id' => $user->id,
                'sender_type' => $senderType,
                'message' => $request->message,
                'message_type' => $request->message_type,
                'attachments' => $attachments,
                'is_important' => $request->boolean('is_important', false),
                'is_confidential' => $request->boolean('is_confidential', false),
                'reply_to_message_id' => $request->reply_to_message_id,
                'sent_at' => now()
            ]);

            $discussion->load(['sender', 'replyTo']);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => $discussion
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update assignment status
     */
    public function updateAssignmentStatus(Request $request, ComplaintAssignment $assignment): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:assigned,in_progress,pending_feedback,resolved,cancelled',
            'resolution_notes' => 'required_if:status,resolved|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $updateData = ['status' => $request->status];

            if ($request->status === 'resolved') {
                $updateData['resolved_at'] = now();
                $updateData['resolution_notes'] = $request->resolution_notes;
            }

            $assignment->update($updateData);

            // Check if all assignments for this complaint are resolved
            $this->checkComplaintResolution($assignment->clientComplaint);

            return response()->json([
                'success' => true,
                'message' => 'Assignment status updated successfully',
                'data' => $assignment->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark messages as read
     */
    public function markMessagesAsRead(Request $request, ComplaintAssignment $assignment): JsonResponse
    {
        try {
            $messageIds = $request->input('message_ids', []);

            if (empty($messageIds)) {
                // Mark all unread messages as read
                $assignment->discussions()
                    ->whereNull('read_at')
                    ->where('sender_id', '!=', Auth::id())
                    ->update(['read_at' => now()]);
            } else {
                // Mark specific messages as read
                $assignment->discussions()
                    ->whereIn('id', $messageIds)
                    ->whereNull('read_at')
                    ->where('sender_id', '!=', Auth::id())
                    ->update(['read_at' => now()]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Messages marked as read'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark messages as read: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get dashboard statistics for assignments
     */
    public function getDashboardStats(): JsonResponse
    {
        try {
            $user = Auth::user();
            $stats = [];

            if ($user->role === 'admin') {
                $stats = [
                    'total_assignments' => ComplaintAssignment::count(),
                    'active_assignments' => ComplaintAssignment::active()->count(),
                    'overdue_assignments' => ComplaintAssignment::overdue()->count(),
                    'resolved_assignments' => ComplaintAssignment::where('status', 'resolved')->count(),
                    'unread_messages' => ComplaintDiscussion::unread()->count()
                ];
            } elseif ($user->role === 'department_head') {
                $stats = [
                    'my_assignments' => ComplaintAssignment::where('assigned_to', $user->id)->count(),
                    'active_assignments' => ComplaintAssignment::where('assigned_to', $user->id)->active()->count(),
                    'overdue_assignments' => ComplaintAssignment::where('assigned_to', $user->id)->overdue()->count(),
                    'resolved_assignments' => ComplaintAssignment::where('assigned_to', $user->id)->where('status', 'resolved')->count(),
                    'unread_messages' => ComplaintDiscussion::whereHas('complaintAssignment', function ($query) use ($user) {
                        $query->where('assigned_to', $user->id);
                    })->unread()->where('sender_id', '!=', $user->id)->count()
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if complaint should be marked as resolved
     */
    private function checkComplaintResolution(ClientComplaint $complaint): void
    {
        $activeAssignments = $complaint->activeAssignments()->count();

        if ($activeAssignments === 0) {
            $complaint->update([
                'status' => 'resolved',
                'resolved_at' => now()
            ]);
        }
    }

    /**
     * Determine file type based on MIME type
     */
    private function getFileType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            return 'video';
        } elseif (in_array($mimeType, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ])) {
            return 'document';
        } else {
            return 'file';
        }
    }

    /**
     * Send admin response to department head discussion
     */
    public function sendAdminResponse(Request $request, $assignmentId): JsonResponse
    {
        $assignment = ComplaintAssignment::findOrFail($assignmentId);

        // Verify user is admin
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Only admins can respond to discussions.'
            ], 403);
        }

        $request->validate([
            'message' => 'required_without:file|string|max:2000',
            'file' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,webm,pdf,doc,docx,txt',
            'is_important' => 'boolean'
        ]);

        try {
            $filePath = null;
            $fileName = null;
            $attachment = null;
            $messageType = 'text';

            // Handle single file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $storedPath = $file->store('complaint_discussions', 'public');

                // Determine message type based on mime
                $mime = $file->getClientMimeType();
                if (str_starts_with($mime, 'image/')) {
                    $messageType = 'image';
                } elseif (str_starts_with($mime, 'video/')) {
                    $messageType = 'video';
                } elseif (in_array($mime, [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'text/plain'
                ])) {
                    $messageType = 'document';
                } else {
                    $messageType = 'file';
                }

                $attachment = [
                    'name' => $fileName,
                    'path' => $storedPath,
                    'size' => $file->getSize(),
                    'type' => $messageType,
                    'mime_type' => $mime,
                ];
                $filePath = $storedPath; // for response compatibility
            }

            $discussion = ComplaintDiscussion::create([
                'complaint_assignment_id' => $assignment->id,
                'sender_id' => Auth::id(),
                'sender_type' => 'admin',
                'message' => $request->message,
                'message_type' => $messageType,
                'attachments' => $attachment ? [$attachment] : null,
                'is_important' => $request->boolean('is_important', false),
                'sent_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Response sent successfully',
                'discussion' => [
                    'id' => $discussion->id,
                    'message' => $discussion->message,
                    'message_type' => $discussion->message_type,
                    'sender_name' => Auth::user()->name,
                    'sender_type' => 'admin',
                    // Derive file fields for frontend compatibility
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'created_at' => $discussion->sent_at,
                    'sent_at' => $discussion->sent_at->format('M d, Y h:i A'),
                    'is_important' => $discussion->is_important
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send response. Please try again.'
            ], 500);
        }
    }

    /**
     * Get assignment discussions for admin view
     */
    public function getAssignmentDiscussions($assignmentId): JsonResponse
    {
        $assignment = ComplaintAssignment::findOrFail($assignmentId);

        // Verify user is admin
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Only admins can view discussions.'
            ], 403);
        }

        $discussions = $assignment->discussions()
            ->with('sender')
            ->orderBy('sent_at', 'asc')
            ->get()
            ->map(function($discussion) {
                // Map attachments to simple file fields for UI if present
                $filePath = null;
                $fileName = null;
                if (is_array($discussion->attachments) && count($discussion->attachments) > 0) {
                    $first = $discussion->attachments[0];
                    $filePath = $first['path'] ?? null;
                    $fileName = $first['name'] ?? null;
                }
                return [
                    'id' => $discussion->id,
                    'message' => $discussion->message,
                    'message_type' => $discussion->message_type,
                    'sender_name' => $discussion->sender->name,
                    'sender_type' => $discussion->sender_type,
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'created_at' => $discussion->sent_at,
                    'sent_at' => $discussion->sent_at->format('M d, Y h:i A'),
                    'attachments' => $discussion->attachments,
                    'is_important' => $discussion->is_important
                ];
            });

        // Mark messages as read by admin
        // Mark unread dept messages as read for admin
        $assignment->discussions()
            ->where('sender_type', 'department_head')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'discussions' => $discussions
        ]);
    }
}
