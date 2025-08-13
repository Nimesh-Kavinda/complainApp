@extends('layouts.departmentHead')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gray-800/70 dark:bg-gray-500/20 rounded-2xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray dark:text-white">Staff Member Details</h1>
                        <p class="text-blue-500 dark:text-red-400 text-lg mt-2">{{ $department->name }} Department</p>
                        <p class="text-blue-900 dark:text-red-300 font-bold text-sm">Staff ID: {{ $staffMember->staff_id }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('department.head.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 dark:bg-green-500 dark:hover:bg-green-700 text-white font-medium py-2 px-4 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white dark:bg-gray-800">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Staff Member Profile Card -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Profile Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center">
                            <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-800 dark:from-red-500 dark:to-gray-800 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-6">
                                {{ strtoupper(substr($staffMember->user_name, 0, 1)) }}
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $staffMember->user_name }}</h2>
                                <p class="text-gray-600 dark:text-gray-400 text-lg">{{ $staffMember->user_email }}</p>
                                <div class="flex items-center mt-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $staffMember->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                           ($staffMember->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($staffMember->status) }}
                                    </span>
                                    <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">
                                        Applied {{ $staffMember->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            <!-- Personal Information -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Personal Information
                                </h3>

                                <div class="space-y-4">
                                    <!-- Staff ID -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Staff ID</label>
                                        <p class="text-lg font-mono text-gray-900 dark:text-white">{{ $staffMember->staff_id }}</p>
                                    </div>

                                    <!-- Full Name -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Full Name</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $staffMember->user_name }}</p>
                                    </div>

                                    <!-- Email -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Email Address</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $staffMember->user_email }}</p>
                                    </div>

                                    <!-- User Role -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Current Role</label>
                                        <p class="text-lg text-gray-900 dark:text-white capitalize">
                                            {{ $staffMember->user ? str_replace('_', ' ', $staffMember->user->role) : 'Not Set' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Official Details
                                </h3>

                                <div class="space-y-4">
                                    <!-- NIC Number -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">NIC Number</label>
                                        <p class="text-lg font-mono text-gray-900 dark:text-white">{{ $staffMember->nic_number }}</p>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Date of Birth</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $staffMember->date_of_birth->format('F j, Y') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Age: {{ $staffMember->date_of_birth->age }} years</p>
                                    </div>

                                    <!-- Department -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Department</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $staffMember->department }}</p>
                                    </div>

                                    <!-- Application Date -->
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Application Date</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $staffMember->created_at->format('F j, Y g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review Information -->
                        @if($staffMember->reviewed_at)
                        <div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                            <h4 class="text-lg font-bold text-blue-900 dark:text-blue-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                Review Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-blue-800 dark:text-blue-200">Reviewed By</label>
                                    <p class="text-blue-900 dark:text-blue-100">{{ $staffMember->reviewer ? $staffMember->reviewer->name : 'System' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-blue-800 dark:text-blue-200">Review Date</label>
                                    <p class="text-blue-900 dark:text-blue-100">{{ $staffMember->reviewed_at->format('F j, Y g:i A') }}</p>
                                </div>
                                @if($staffMember->rejection_reason)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-red-800 dark:text-red-200">Rejection Reason</label>
                                    <p class="text-red-900 dark:text-red-100 bg-red-50 dark:bg-red-900/30 p-3 rounded-lg mt-1">{{ $staffMember->rejection_reason }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Staff ID Image & Actions -->
            <div class="space-y-6">

                <!-- Staff ID Image Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Staff ID Document
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($staffMember->staff_id_image_path)
                        <div class="text-center">
                            <img src="{{ route('department.head.staff.id-image', $staffMember) }}"
                                 alt="Staff ID Document"
                                 class="w-full max-w-sm mx-auto rounded-xl shadow-lg border border-gray-200 dark:border-gray-600 cursor-pointer hover:shadow-xl transition-shadow duration-300"
                                 onclick="openImageModal('{{ route('department.head.staff.id-image', $staffMember) }}')">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">Click to view full size</p>
                        </div>
                        @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">No staff ID image uploaded</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            Actions
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($staffMember->status === 'pending')
                        <!-- Approve Button -->
                        <button onclick="updateStaffStatus({{ $staffMember->id }}, 'approved')"
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approve Application
                        </button>

                        <!-- Reject Button -->
                        <button onclick="showRejectModal({{ $staffMember->id }})"
                                class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Application
                        </button>
                        @endif

                        @if($staffMember->status === 'approved')
                        <!-- Revoke Approval -->
                        <button onclick="showRejectModal({{ $staffMember->id }})"
                                class="w-full bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Revoke Approval
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-90 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="relative max-w-4xl w-full">
            <button onclick="closeImageModal()"
                    class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Staff ID Document" class="w-full h-auto rounded-xl shadow-2xl">
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Reject Staff Registration</h3>
                <div class="mb-4">
                    <label for="rejectionReason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Reason for rejection:
                    </label>
                    <textarea id="rejectionReason" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Please provide a reason for rejecting this application..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button onclick="closeRejectModal()"
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button onclick="confirmReject()"
                            class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded-lg transition-colors">
                        Reject Application
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentStaffId = null;

// Image modal functions
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    location.reload();
}

// Reject modal functions
function showRejectModal(staffId) {
    currentStaffId = staffId;
    document.getElementById('rejectModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    document.getElementById('rejectionReason').value = '';
    currentStaffId = null;
}

function confirmReject() {
    const reason = document.getElementById('rejectionReason').value.trim();
    if (!reason) {
        showNotification('Please provide a reason for rejection', 'error');
        return;
    }
    updateStaffStatus(currentStaffId, 'rejected', reason);
    closeRejectModal();
}

// Staff management functions
async function updateStaffStatus(staffId, status, rejectionReason = null) {
    try {
        const data = { status };
        if (rejectionReason) {
            data.rejection_reason = rejectionReason;
        }

        const response = await fetch(`/department-head/staff/${staffId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification(result.message, 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showNotification(result.message || 'Failed to update status', 'error');
        }
    } catch (error) {
        console.error('Error updating staff status:', error);
        showNotification('Failed to update staff status', 'error');
    }
}

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

// Close modals when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
        closeRejectModal();
    }
});
</script>

@endsection
