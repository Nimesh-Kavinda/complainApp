@extends('layouts.admin')

@section('content')

    <section class="p-6 bg-white dark:bg-gray-900 min-h-screen">


    <div class="max-w-7xl mx-auto">
        <!-- Page Title -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 sm:mb-0">
                All Users
                @if(request('role'))
                    <span class="text-lg font-normal text-gray-600 dark:text-gray-400">
                        - Filtered by: {{ ucfirst(str_replace('_', ' ', request('role'))) }}
                    </span>
                @endif
            </h2>

            <!-- User Count Badge -->
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                    {{ count($users) }} {{ count($users) === 1 ? 'User' : 'Users' }}
                </span>
            </div>
        </div>

        <!-- Enhanced Filter Form -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 mb-6 border border-gray-200 dark:border-gray-700">
            <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex items-center gap-2">
                    <label for="role" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter by Role:
                    </label>
                    <select name="role" id="role"
                            class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors min-w-[150px]"
                            onchange="this.form.submit()">
                        <option value="" {{ !request('role') ? 'selected' : '' }}>All Roles</option>
                        @foreach ($roles as $role)
                            @php
                                $roleCount = \App\Models\User::where('role', $role)->count();
                            @endphp
                            <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $role)) }}
                                ({{ $roleCount }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    @if(request('role'))
                        <a href="{{ route('admin.users') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            @if(count($users) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">User Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Registered At</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" id="user-row-{{ $user->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</div>
                                    </td>
                                    @php
                                        $roleColors = [
                                            'client' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                            'staff_member' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                            'department_head' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                            'senior_board' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                            'md' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                        ];
                                    @endphp
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium role-badge-{{ $user->id }} {{ $roleColors[$user->role] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $user->created_at->format('M d, Y') }}
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->format('h:i A') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <!-- Role Update Dropdown -->
                                            <div class="relative">
                                                <select onchange="updateUserRole({{ $user->id }}, this.value, '{{ $user->name }}')"
                                                        class="role-select-{{ $user->id }} text-xs border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded px-2 py-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 min-w-[120px] cursor-pointer hover:border-blue-400 transition-colors"
                                                        title="Change user role">
                                                    <option value="" class="text-gray-500">Change Role</option>
                                                    @foreach(['client', 'staff_member', 'department_head', 'senior_board', 'md'] as $role)
                                                        @if($role !== $user->role)
                                                            <option value="{{ $role }}">
                                                                {{ ucfirst(str_replace('_', ' ', $role)) }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Loading Indicator -->
                                            <div class="loading-{{ $user->id }} hidden items-center">
                                                <svg class="animate-spin h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">Updating...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                        @if(request('role'))
                            No users found with role "{{ ucfirst(str_replace('_', ' ', request('role'))) }}"
                        @else
                            No users found
                        @endif
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">
                        @if(request('role'))
                            Try selecting a different role or clear the filter to see all users.
                        @else
                            There are no users registered in the system yet.
                        @endif
                    </p>
                    @if(request('role'))
                        <a href="{{ route('admin.users') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Filter
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Success/Error Toast Notification -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-4 max-w-sm">
        <div class="flex items-center">
            <div id="toast-icon" class="flex-shrink-0 mr-3">
                <!-- Success Icon -->
                <svg class="hidden success-icon w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <!-- Error Icon -->
                <svg class="hidden error-icon w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <div>
                <p id="toast-message" class="text-sm font-medium text-gray-900 dark:text-gray-100"></p>
            </div>
        </div>
    </div>
</div>

<script>
// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                  '{{ csrf_token() }}';

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    const successIcon = toast.querySelector('.success-icon');
    const errorIcon = toast.querySelector('.error-icon');

    // Set message
    toastMessage.textContent = message;

    // Show appropriate icon
    if (type === 'success') {
        successIcon.classList.remove('hidden');
        errorIcon.classList.add('hidden');
    } else {
        successIcon.classList.add('hidden');
        errorIcon.classList.remove('hidden');
    }

    // Show toast
    toast.classList.remove('hidden');

    // Hide after 3 seconds
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Update user role function
function updateUserRole(userId, newRole, userName) {
    if (!newRole) return;

    // Confirm the action
    if (!confirm(`Are you sure you want to change ${userName}'s role to ${newRole.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}?`)) {
        // Reset dropdown if cancelled
        document.querySelector(`.role-select-${userId}`).value = '';
        return;
    }

    // Show loading indicator
    const loadingIndicator = document.querySelector(`.loading-${userId}`);
    const roleSelect = document.querySelector(`.role-select-${userId}`);

    loadingIndicator.classList.remove('hidden');
    loadingIndicator.classList.add('flex');
    roleSelect.disabled = true;

    // Make AJAX request
    fetch(`/admin/users/${userId}/role`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            role: newRole
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        loadingIndicator.classList.add('hidden');
        loadingIndicator.classList.remove('flex');
        roleSelect.disabled = false;

        if (data.success) {
            // Update role badge
            updateRoleBadge(userId, newRole);

            // Reset dropdown
            roleSelect.value = '';
            updateDropdownOptions(userId, newRole);

            // Show success message
            showToast(`${userName}'s role updated to ${newRole.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())} successfully!`, 'success');
        } else {
            showToast(data.message || 'Failed to update user role', 'error');
            roleSelect.value = '';
        }
    })
    .catch(error => {
        loadingIndicator.classList.add('hidden');
        loadingIndicator.classList.remove('flex');
        roleSelect.disabled = false;
        roleSelect.value = '';
        console.error('Error:', error);
        showToast('An error occurred while updating the user role', 'error');
    });
}

// Update role badge colors and text
function updateRoleBadge(userId, newRole) {
    const roleBadge = document.querySelector(`.role-badge-${userId}`);
    if (!roleBadge) return;

    // Remove old color classes
    const colorClasses = [
        'bg-blue-100', 'text-blue-800', 'dark:bg-blue-900', 'dark:text-blue-200',
        'bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200',
        'bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-200',
        'bg-purple-100', 'text-purple-800', 'dark:bg-purple-900', 'dark:text-purple-200',
        'bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-200',
        'bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-200'
    ];

    roleBadge.classList.remove(...colorClasses);

    // Add new color classes based on role
    const roleColors = {
        'client': ['bg-blue-100', 'text-blue-800', 'dark:bg-blue-900', 'dark:text-blue-200'],
        'staff_member': ['bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200'],
        'department_head': ['bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-200'],
        'senior_board': ['bg-purple-100', 'text-purple-800', 'dark:bg-purple-900', 'dark:text-purple-200'],
        'md': ['bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-200']
    };

    const colors = roleColors[newRole] || ['bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-200'];
    roleBadge.classList.add(...colors);

    // Update badge text
    roleBadge.textContent = newRole.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
}

// Update dropdown options to exclude current role
function updateDropdownOptions(userId, currentRole) {
    const roleSelect = document.querySelector(`.role-select-${userId}`);
    if (!roleSelect) return;

    const allRoles = ['client', 'staff_member', 'department_head', 'senior_board', 'md'];
    const roleLabels = {
        'client': 'Client',
        'staff_member': 'Staff Member',
        'department_head': 'Department Head',
        'senior_board': 'Senior Board',
        'md': 'MD'
    };

    // Clear existing options except the first one
    roleSelect.innerHTML = '<option value="">Change Role</option>';

    // Add options excluding current role
    allRoles.forEach(role => {
        if (role !== currentRole) {
            const option = document.createElement('option');
            option.value = role;
            option.textContent = roleLabels[role];
            roleSelect.appendChild(option);
        }
    });
}
</script>


@endsection
