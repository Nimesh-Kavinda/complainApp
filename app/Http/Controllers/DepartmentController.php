<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display the department management page.
     */
    public function index()
    {
        $departments = Department::with('headOfDepartment')->get();
        return view('admin.departments', compact('departments'));
    }

    /**
     * Store a new department and create department head.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'department_name' => 'required|string|max:255|unique:departments,name',
                'department_description' => 'nullable|string|max:1000',
                'head_name' => 'required|string|max:255',
                'head_email' => 'required|email|unique:users,email',
                'head_password' => 'required|string|min:8',
            ]);

            DB::beginTransaction();

            // Create department head user
            $departmentHead = User::create([
                'name' => $validated['head_name'],
                'email' => $validated['head_email'],
                'password' => Hash::make($validated['head_password']),
                'role' => 'department_head',
            ]);

            // Create department
            $department = Department::create([
                'name' => $validated['department_name'],
                'description' => $validated['department_description'],
                'head_of_department' => $departmentHead->id,
                'is_active' => true,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Department and department head created successfully!',
                'department' => $department->load('headOfDepartment')
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create department: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update department status.
     */
    public function updateStatus(Request $request, Department $department)
    {
        try {
            $validated = $request->validate([
                'is_active' => 'required|boolean',
            ]);

            $department->update(['is_active' => $validated['is_active']]);

            return response()->json([
                'success' => true,
                'message' => 'Department status updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get department details.
     */
    public function show(Department $department)
    {
        $department->load(['headOfDepartment', 'staffMembers.user']);

        return response()->json([
            'success' => true,
            'department' => $department
        ]);
    }

    /**
     * Delete department (only if no staff members).
     */
    public function destroy(Department $department)
    {
        try {
            // Check if department has staff members
            if ($department->staffMembers()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete department with active staff members.'
                ], 400);
            }

            DB::beginTransaction();

            // Delete department head user
            if ($department->headOfDepartment) {
                $department->headOfDepartment->delete();
            }

            // Delete department
            $department->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete department: ' . $e->getMessage()
            ], 500);
        }
    }
}
