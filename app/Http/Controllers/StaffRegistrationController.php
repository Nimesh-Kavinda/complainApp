<?php

namespace App\Http\Controllers;

use App\Models\StaffMember;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StaffRegistrationController extends Controller
{
    /**
     * Get departments for the registration form
     */
    public function getDepartments()
    {
        try {
            $departments = Department::active()->orderBy('name')->get();

            return response()->json([
                'success' => true,
                'departments' => $departments
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch departments', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load departments.'
            ], 500);
        }
    }

    /**
     * Store staff registration
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'staff_id' => 'required|string|max:50|unique:staff_members,staff_id',
            'department' => 'required|string|exists:departments,name',
            'date_of_birth' => 'required|date|before:today',
            'nic_number' => 'required|string|max:20',
            'staff_id_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ], [
            'staff_id.unique' => 'This Staff ID has already been registered.',
            'date_of_birth.before' => 'Date of birth must be in the past.',
            'staff_id_image.required' => 'Staff ID image is required.',
            'staff_id_image.image' => 'Staff ID file must be an image.',
            'staff_id_image.max' => 'Staff ID image must not exceed 5MB.'
        ]);

        try {
            $user = Auth::user();

            // Check if user already has a pending or approved registration
            $existingRegistration = StaffMember::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'approved'])
                ->first();

            if ($existingRegistration) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have a ' . $existingRegistration->status . ' staff registration.'
                ], 422);
            }

            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('staff_id_image')) {
                $file = $request->file('staff_id_image');
                $filename = time() . '_' . $user->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('staff_id_images', $filename, 'public');
            }

            // Get department by name to get department_id
            $department = Department::where('name', $request->department)->first();

            // Create staff registration
            $staffMember = StaffMember::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'staff_id' => $request->staff_id,
                'department' => $request->department, // Keep for backward compatibility
                'department_id' => $department->id, // Add department_id relationship
                'date_of_birth' => $request->date_of_birth,
                'nic_number' => $request->nic_number,
                'staff_id_image_path' => $imagePath,
                'status' => 'pending' // Default status
            ]);

            Log::info('New staff registration submitted', [
                'user_id' => $user->id,
                'staff_member_id' => $staffMember->id,
                'staff_id' => $request->staff_id,
                'department' => $request->department
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Staff registration submitted successfully! Your application is now pending review by the department head.',
                'staff_member' => $staffMember
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to submit staff registration', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->except(['staff_id_image'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit staff registration. Please try again.'
            ], 500);
        }
    }

    /**
     * Get user's registration status
     */
    public function getRegistrationStatus()
    {
        try {
            $user = Auth::user();
            $registration = StaffMember::where('user_id', $user->id)
                ->with(['reviewer', 'department'])
                ->orderBy('created_at', 'desc')
                ->first();

            return response()->json([
                'success' => true,
                'registration' => $registration,
                'has_registration' => $registration !== null
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch registration status', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load registration status.'
            ], 500);
        }
    }

    /**
     * View staff registrations (for department heads/admins)
     */
    public function index()
    {
        $registrations = StaffMember::with(['user', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.staff-registrations', compact('registrations'));
    }

    /**
     * Approve or reject staff registration
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500'
        ]);

        try {
            $registration = StaffMember::findOrFail($id);
            $reviewer = Auth::user();

            $registration->update([
                'status' => $request->status,
                'reviewed_by' => $reviewer->id,
                'reviewed_at' => now(),
                'rejection_reason' => $request->rejection_reason
            ]);

            // If approved, update user role
            if ($request->status === 'approved') {
                $registration->user->update(['role' => 'staff_member']);

                Log::info('Staff registration approved', [
                    'registration_id' => $registration->id,
                    'user_id' => $registration->user_id,
                    'reviewer_id' => $reviewer->id
                ]);
            } else {
                Log::info('Staff registration rejected', [
                    'registration_id' => $registration->id,
                    'user_id' => $registration->user_id,
                    'reviewer_id' => $reviewer->id,
                    'reason' => $request->rejection_reason
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Registration status updated successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to update registration status', [
                'error' => $e->getMessage(),
                'registration_id' => $id,
                'reviewer_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update registration status.'
            ], 500);
        }
    }
}
