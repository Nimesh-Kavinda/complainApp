@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-red-600 to-gray-800 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white">Department Management</h1>
                        <p class="text-red-100 text-lg mt-2">Create departments and assign department heads</p>
                    </div>
                </div>
                <button onclick="openAddDepartmentModal()"
                        class="bg-white text-red-600 hover:bg-red-50 font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Department
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Departments</p>
                        <p class="text-3xl font-bold" id="totalDepartments">{{ $departments->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Active Departments</p>
                        <p class="text-3xl font-bold" id="activeDepartments">{{ $departments->where('is_active', true)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Department Heads</p>
                        <p class="text-3xl font-bold" id="departmentHeads">{{ $departments->where('head_of_department', '!=', null)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Inactive Departments</p>
                        <p class="text-3xl font-bold" id="inactiveDepartments">{{ $departments->where('is_active', false)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Departments Table -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    All Departments
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full" id="departmentsTable">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Department</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Department Head</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600" id="departmentsTableBody">
                        @forelse($departments as $department)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" data-department-id="{{ $department->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $department->name }}</div>
                                    @if($department->description)
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($department->description, 50) }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($department->headOfDepartment)
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-gray-800 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                        {{ strtoupper(substr($department->headOfDepartment->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $department->headOfDepartment->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $department->headOfDepartment->email }}</div>
                                    </div>
                                </div>
                                @else
                                <span class="text-sm text-gray-500 dark:text-gray-400">No head assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $department->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        @if($department->is_active)
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        @else
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        @endif
                                    </svg>
                                    {{ $department->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $department->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="viewDepartment({{ $department->id }})"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="toggleDepartmentStatus({{ $department->id }}, {{ $department->is_active ? 'false' : 'true' }})"
                                            class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteDepartment({{ $department->id }})"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-500 dark:text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No departments found</p>
                                    <p class="text-sm">Start by creating your first department</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Department Modal -->
<div id="addDepartmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-2xl w-full max-h-[95vh] overflow-y-auto border border-gray-200 dark:border-gray-600">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-red-500 to-gray-800 rounded-t-3xl">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Add New Department</h3>
                        <p class="text-red-100 text-sm">Create department and assign department head</p>
                    </div>
                </div>
                <button onclick="closeAddDepartmentModal()" type="button" class="text-white/80 hover:text-white transition-colors p-2 hover:bg-white/10 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8">
                <!-- Department Form -->
                <form id="addDepartmentForm" class="space-y-6">
                    @csrf

                    <!-- Department Information -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Department Information
                        </h4>

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Department Name -->
                            <div>
                                <label for="department_name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                    Department Name *
                                </label>
                                <input type="text" id="department_name" name="department_name" required
                                       class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                                       placeholder="e.g., Information Technology, Human Resources">
                            </div>

                            <!-- Department Description -->
                            <div>
                                <label for="department_description" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                    Department Description
                                </label>
                                <textarea id="department_description" name="department_description" rows="3"
                                          class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                                          placeholder="Brief description of the department's responsibilities and functions"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Department Head Information -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Department Head Information
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Head Name -->
                            <div>
                                <label for="head_name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                    Full Name *
                                </label>
                                <input type="text" id="head_name" name="head_name" required
                                       class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                                       placeholder="Enter department head's full name">
                            </div>

                            <!-- Head Email -->
                            <div>
                                <label for="head_email" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                    Email Address *
                                </label>
                                <input type="email" id="head_email" name="head_email" required
                                       class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                                       placeholder="department.head@vampiordesigns.com">
                            </div>

                            <!-- Head Password -->
                            <div class="md:col-span-2">
                                <label for="head_password" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                    Login Password *
                                </label>
                                <div class="relative">
                                    <input type="password" id="head_password" name="head_password" required
                                           class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 pr-12"
                                           placeholder="Create a secure password (min 8 characters)">
                                    <button type="button" onclick="generatePassword()"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-500 transition-colors"
                                            title="Generate Password">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">This password will be used by the department head to login</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" onclick="closeAddDepartmentModal()"
                                class="px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            Cancel
                        </button>
                        <button type="submit" id="submitDepartmentBtn"
                                class="px-8 py-3 bg-gradient-to-r from-red-600 to-gray-800 hover:from-red-700 hover:to-gray-900 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2 hidden" id="submitSpinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Create Department
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Modal Functions
function openAddDepartmentModal() {
    document.getElementById('addDepartmentModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeAddDepartmentModal() {
    document.getElementById('addDepartmentModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    resetForm();
}

function resetForm() {
    document.getElementById('addDepartmentForm').reset();
}

// Generate random password
function generatePassword() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
    let password = '';
    for (let i = 0; i < 12; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('head_password').value = password;
    showNotification('Password generated successfully', 'success');
}

// Submit form
document.getElementById('addDepartmentForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitDepartmentBtn');
    const spinner = document.getElementById('submitSpinner');

    // Show loading state
    submitBtn.disabled = true;
    spinner.classList.remove('hidden');
    submitBtn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Creating...';

    try {
        const formData = new FormData(this);

        const response = await fetch('/admin/departments', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (data.success) {
            showNotification(data.message, 'success');
            closeAddDepartmentModal();
            location.reload(); // Refresh to show new department
        } else {
            if (data.errors) {
                Object.values(data.errors).forEach(errors => {
                    errors.forEach(error => showNotification(error, 'error'));
                });
            } else {
                showNotification(data.message || 'Failed to create department', 'error');
            }
        }
    } catch (error) {
        console.error('Error creating department:', error);
        showNotification('Failed to create department. Please try again.', 'error');
    } finally {
        // Reset loading state
        submitBtn.disabled = false;
        spinner.classList.add('hidden');
        submitBtn.innerHTML = 'Create Department';
    }
});

// Department management functions
async function viewDepartment(departmentId) {
    try {
        const response = await fetch(`/admin/departments/${departmentId}`);
        const data = await response.json();

        if (data.success) {
            // Show department details modal (you can implement this)
            console.log('Department details:', data.department);
            showNotification('Department details loaded', 'success');
        }
    } catch (error) {
        console.error('Error viewing department:', error);
        showNotification('Failed to load department details', 'error');
    }
}

async function toggleDepartmentStatus(departmentId, newStatus) {
    try {
        const response = await fetch(`/admin/departments/${departmentId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ is_active: newStatus })
        });

        const data = await response.json();

        if (data.success) {
            showNotification(data.message, 'success');
            location.reload(); // Refresh to show updated status
        } else {
            showNotification(data.message || 'Failed to update status', 'error');
        }
    } catch (error) {
        console.error('Error updating status:', error);
        showNotification('Failed to update department status', 'error');
    }
}

async function deleteDepartment(departmentId) {
    if (!confirm('Are you sure you want to delete this department? This action cannot be undone.')) {
        return;
    }

    try {
        const response = await fetch(`/admin/departments/${departmentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (data.success) {
            showNotification(data.message, 'success');
            location.reload(); // Refresh to remove deleted department
        } else {
            showNotification(data.message || 'Failed to delete department', 'error');
        }
    } catch (error) {
        console.error('Error deleting department:', error);
        showNotification('Failed to delete department', 'error');
    }
}

// Close modal when clicking outside
document.getElementById('addDepartmentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAddDepartmentModal();
    }
});

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'error' ? 'bg-red-500 text-white' :
        type === 'success' ? 'bg-green-500 text-white' :
        'bg-blue-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                ${type === 'error' ?
                    '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>' :
                    '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>'
                }
            </svg>
            ${message}
        </div>
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}
</script>

@endsection
