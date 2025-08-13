<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\StaffMember;
use App\Models\StaffComplaint;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function index()
    {
        $staffMember = StaffMember::where('user_id', Auth::id())->first();
        $staffId = $staffMember->staff_id ?? null;

        $status = $staffMember->status ?? null; // get status if it exists, otherwise null

        $isPending = $status === 'pending';
        $isApproved = $status === 'approved';
        $isRejected = $status === 'rejected';

        // This method will display the staff management page
        return view('staff.index', compact('staffId', 'isPending', 'isApproved', 'isRejected'));
    }

    public function complainForm()
    {
        // Fetch user's staff ID and related information
        $staffMember = StaffMember::where('user_id', Auth::id())->first();
        $staffId = $staffMember->staff_id ?? null;

        return view('staff.complainform', compact('staffId'));
    }

    public function storeComplaint(Request $request)
    {
        try {
            // Get the current staff member
            $staffMember = StaffMember::where('user_id', Auth::id())->first();

            if (!$staffMember) {
                return redirect()->back()->with('error', 'Staff member record not found. Please contact administrator.');
            }

            // Validation
            $request->validate([
                'complaint_title' => 'nullable|string|max:255',
                'details' => 'required|string|min:10',
                'priority' => 'required|in:low,medium,high,urgent',
                'contact_phone' => 'nullable|string|max:20',
                'evidence' => 'nullable|array|max:10',
                'evidence.*' => 'file|max:10240|mimes:jpg,jpeg,png,gif,mp4,avi,mov,mp3,wav,pdf,doc,docx,txt',
                'evidence_description' => 'nullable|string|max:1000'
            ]);

            // Handle file uploads
            $evidenceFiles = [];
            if ($request->hasFile('evidence')) {
                foreach ($request->file('evidence') as $file) {
                    $path = $file->store('staff_complaints_evidence', 'public');
                    $evidenceFiles[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getMimeType()
                    ];
                }
            }

            // Create the complaint
            $complaint = StaffComplaint::create([
                'user_id' => Auth::id(),
                'staff_member_id' => $staffMember->id,
                'staff_id' => $staffMember->staff_id,
                'staff_name' => Auth::user()->name,
                'staff_email' => Auth::user()->email,
                'department_id' => $staffMember->department_id,
                'complaint_title' => $request->complaint_title,
                'complaint_details' => $request->details,
                'priority' => $request->priority,
                'contact_phone' => $request->contact_phone,
                'evidence_files' => $evidenceFiles,
                'evidence_description' => $request->evidence_description,
                'status' => 'pending'
            ]);

            Log::info('Staff complaint created', [
                'complaint_id' => $complaint->id,
                'staff_id' => $staffMember->staff_id,
                'department_id' => $staffMember->department_id
            ]);

            return redirect()->route('staff.pastcomplaints')->with('success', 'Your complaint has been submitted successfully! Reference: ' . $complaint->reference_number);

        } catch (\Exception $e) {
            Log::error('Staff complaint submission failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return redirect()->back()->with('error', 'Failed to submit complaint. Please try again.')->withInput();
        }
    }

    public function pastComplaints()
    {
        // Get current staff member
        $staffMember = StaffMember::where('user_id', Auth::id())->first();

        if (!$staffMember) {
            return redirect()->route('staff.index')->with('error', 'Staff member record not found.');
        }

        // Get all complaints for this staff member
        $complaints = StaffComplaint::forStaff($staffMember->id)
            ->with(['department', 'assignedTo', 'reviewedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate stats
        $stats = [
            'total' => StaffComplaint::forStaff($staffMember->id)->count(),
            'pending' => StaffComplaint::forStaff($staffMember->id)->where('status', 'pending')->count(),
            'in_progress' => StaffComplaint::forStaff($staffMember->id)->where('status', 'in_progress')->count(),
            'resolved' => StaffComplaint::forStaff($staffMember->id)->whereIn('status', ['resolved', 'closed'])->count(),
        ];

        return view('staff.pastcomplaints', compact('complaints', 'staffMember', 'stats'));
    }

    public function viewComplaint($id)
    {
        // Get current staff member
        $staffMember = StaffMember::where('user_id', Auth::id())->first();

        if (!$staffMember) {
            return redirect()->route('staff.index')->with('error', 'Staff member record not found.');
        }

        // Get the specific complaint
        $complaint = StaffComplaint::where('id', $id)
            ->where('staff_member_id', $staffMember->id)
            ->with(['department', 'reviewedBy'])
            ->firstOrFail();

        return view('staff.complaint-details', compact('complaint', 'staffMember'));
    }

    public function downloadEvidence($complaintId, $fileIndex)
    {
        // Get current staff member
        $staffMember = StaffMember::where('user_id', Auth::id())->first();

        if (!$staffMember) {
            abort(403, 'Unauthorized');
        }

        // Get the complaint
        $complaint = StaffComplaint::where('id', $complaintId)
            ->where('staff_member_id', $staffMember->id)
            ->firstOrFail();

        $evidenceFiles = $complaint->evidence_files ?? [];

        if (!isset($evidenceFiles[$fileIndex])) {
            abort(404, 'File not found');
        }

        $file = $evidenceFiles[$fileIndex];
        $filePath = storage_path('app/public/' . $file['file_path']);

        if (!file_exists($filePath)) {
            abort(404, 'File not found on server');
        }

        return response()->download($filePath, $file['original_name']);
    }

    public function updateComplaintStatus(Request $request, $id)
    {
        // This method can be used for staff to provide feedback
        $staffMember = StaffMember::where('user_id', Auth::id())->first();

        if (!$staffMember) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $complaint = StaffComplaint::where('id', $id)
            ->where('staff_member_id', $staffMember->id)
            ->firstOrFail();

        $request->validate([
            'staff_feedback' => 'nullable|string|max:1000',
            'satisfaction_rating' => 'nullable|integer|min:1|max:5'
        ]);

        $complaint->update([
            'staff_feedback' => $request->staff_feedback,
            'satisfaction_rating' => $request->satisfaction_rating
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Feedback submitted successfully'
        ]);
    }

    // Method for department heads to view their department's staff complaints
    public function departmentComplaints()
    {
        // Get current user's department (if they are a department head)
        $user = Auth::user();
        $department = Department::where('head_id', $user->id)->first();

        if (!$department) {
            abort(403, 'You are not authorized to view department complaints.');
        }

        // Get all complaints from staff in this department
        $complaints = StaffComplaint::forDepartment($department->id)
            ->with(['staffMember', 'category', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('departmentHead.staff-complaints', compact('complaints', 'department'));
    }

    public function departmentComplaintDetails($id)
    {
        // Get current user's department
        $user = Auth::user();
        $department = Department::where('head_id', $user->id)->first();

        if (!$department) {
            abort(403, 'You are not authorized to view department complaints.');
        }

        // Get the specific complaint
        $complaint = StaffComplaint::with(['staffMember', 'category', 'department', 'assignedTo'])
            ->where('id', $id)
            ->where('department_id', $department->id)
            ->firstOrFail();

        return view('departmentHead.staff-complaint-details', compact('complaint', 'department'));
    }

    public function updateDepartmentComplaintStatus(Request $request, $id)
    {
        // Department head updates complaint status
        $user = Auth::user();
        $department = Department::where('head_id', $user->id)->first();

        if (!$department) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $complaint = StaffComplaint::where('id', $id)
            ->where('department_id', $department->id)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed,rejected',
            'admin_notes' => 'nullable|string|max:1000',
            'solution' => 'nullable|string|max:2000'
        ]);

        $updateData = [
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'reviewed_by' => $user->id,
            'reviewed_at' => now()
        ];

        if ($request->status === 'resolved') {
            $updateData['solution'] = $request->solution;
            $updateData['resolved_at'] = now();
        }

        if ($request->status === 'closed') {
            $updateData['closed_at'] = now();
        }

        $complaint->update($updateData);

        Log::info('Staff complaint status updated by department head', [
            'complaint_id' => $complaint->id,
            'old_status' => $complaint->getOriginal('status'),
            'new_status' => $request->status,
            'updated_by' => $user->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Complaint status updated successfully'
        ]);
    }
}
