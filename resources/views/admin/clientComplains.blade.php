@extends('layouts.admin')

@section('content')
<div class="p-4">
    <div class="mt-14">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4 sm:mb-0">
                Client Complaints Management
            </h2>

            <!-- Statistics Cards -->
            <div class="flex gap-4">
                <div class="bg-blue-100 dark:bg-blue-900 px-4 py-2 rounded-lg">
                    <div class="text-sm text-blue-600 dark:text-blue-300">Total</div>
                    <div class="font-bold text-blue-800 dark:text-blue-200">{{ $stats['total'] }}</div>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900 px-4 py-2 rounded-lg">
                    <div class="text-sm text-yellow-600 dark:text-yellow-300">Pending</div>
                    <div class="font-bold text-yellow-800 dark:text-yellow-200">{{ $stats['pending'] }}</div>
                </div>
                <div class="bg-green-100 dark:bg-green-900 px-4 py-2 rounded-lg">
                    <div class="text-sm text-green-600 dark:text-green-300">Resolved</div>
                    <div class="font-bold text-green-800 dark:text-green-200">{{ $stats['resolved'] }}</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <form method="GET" action="{{ route('admin.complaints') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Reference, name, NIC, or details..."
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                        <option value="">All Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Priority</label>
                    <select name="priority" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                        <option value="">All Priorities</option>
                        @foreach($priorities as $priority)
                            <option value="{{ $priority }}" {{ request('priority') == $priority ? 'selected' : '' }}>
                                {{ ucfirst($priority) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                    <select name="category" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('admin.complaints') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Complaints Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700">
            @if($complaints->count() > 0)
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-300">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-4 py-3">Reference</th>
                            <th scope="col" class="px-4 py-3">Client Info</th>
                            <th scope="col" class="px-4 py-3">Category</th>
                            <th scope="col" class="px-4 py-3">Complaint</th>
                            <th scope="col" class="px-4 py-3">Priority</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Evidence</th>
                            <th scope="col" class="px-4 py-3">Submitted</th>
                            <th scope="col" class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $complaint)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700" id="complaint-row-{{ $complaint->id }}">
                                <!-- Reference Number -->
                                <td class="px-4 py-4">
                                    <div class="font-mono text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $complaint->reference_number }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        ID: #{{ $complaint->id }}
                                    </div>
                                </td>

                                <!-- Client Information -->
                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $complaint->client_name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $complaint->client_email }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">NIC: {{ $complaint->nic }}</div>
                                    @if($complaint->contact_phone)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $complaint->contact_phone }}</div>
                                    @endif
                                </td>

                                <!-- Category -->
                                <td class="px-4 py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                        {{ $complaint->category->category_name }}
                                    </span>
                                </td>

                                <!-- Complaint Details -->
                                <td class="px-4 py-4 max-w-xs">
                                    @if($complaint->complaint_title)
                                        <div class="font-medium text-gray-900 dark:text-white text-sm mb-1">
                                            {{ Str::limit($complaint->complaint_title, 30) }}
                                        </div>
                                    @endif
                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ Str::limit($complaint->complaint_details, 80) }}
                                    </div>
                                </td>

                                <!-- Priority -->
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $complaint->priority_color }}">
                                        {{ $complaint->priority_label }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium status-badge-{{ $complaint->id }} {{ $complaint->status_color }}">
                                        {{ $complaint->status_label }}
                                    </span>
                                    @if($complaint->assigned_to)
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Assigned to: {{ $complaint->assignedTo->name ?? 'Unknown' }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Evidence -->
                                <td class="px-4 py-4">
                                    @if($complaint->hasEvidence())
                                        <button onclick="showEvidenceModal({{ $complaint->id }}, {{ json_encode($complaint->evidence_files) }})"
                                                class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded hover:bg-purple-200 dark:bg-purple-900 dark:text-purple-300">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                            {{ $complaint->getEvidenceCount() }} file(s)
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-400 dark:text-gray-500">No evidence</span>
                                    @endif
                                </td>

                                <!-- Submitted Date -->
                                <td class="px-4 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $complaint->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $complaint->created_at->format('h:i A') }}
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <!-- Reply Button -->
                                        <button onclick="openReplyModal({{ $complaint->id }}, '{{ $complaint->client_name }}', '{{ $complaint->reference_number }}')"
                                                class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                            Reply
                                        </button>

                                        <!-- Delete Button -->
                                        <button onclick="deleteComplaint({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                                class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition-colors">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                    {{ $complaints->appends(request()->query())->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No complaints found</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        @if(request()->hasAny(['search', 'status', 'priority', 'category']))
                            Try adjusting your search criteria or clear the filters.
                        @else
                            No client complaints have been submitted yet.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Evidence Preview Modal -->
<div id="evidenceModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Evidence Files</h3>
                <button onclick="closeEvidenceModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="evidenceContent" class="p-4">
                <!-- Evidence files will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-2xl w-full">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Reply to Complaint</h3>
                <button onclick="closeReplyModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <form id="replyForm">
                    <input type="hidden" id="complaintId" name="complaint_id">

                    <div class="mb-4">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 mb-4">
                            <div class="text-sm text-gray-600 dark:text-gray-400">Replying to:</div>
                            <div id="complaintInfo" class="font-medium text-gray-900 dark:text-white"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Status</label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="solution" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Solution/Response</label>
                        <textarea id="solution" name="solution" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200"
                                  placeholder="Provide your response or solution to the client..."></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Admin Notes (Internal)</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200"
                                  placeholder="Internal notes (not visible to client)..."></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeReplyModal()"
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <span class="submit-text">Update Complaint</span>
                            <span class="loading-text hidden">Updating...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
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
// CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                  '{{ csrf_token() }}';

// Evidence Modal Functions
function showEvidenceModal(complaintId, evidenceFiles) {
    const modal = document.getElementById('evidenceModal');
    const content = document.getElementById('evidenceContent');

    let evidenceHtml = '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';

    evidenceFiles.forEach((file, index) => {
        const isImage = file.mime_type && file.mime_type.startsWith('image/');
        const isVideo = file.mime_type && file.mime_type.startsWith('video/');
        const isAudio = file.mime_type && file.mime_type.startsWith('audio/');

        evidenceHtml += '<div class="border border-gray-200 dark:border-gray-600 rounded-lg p-3">';

        if (isImage) {
            evidenceHtml += `
                <img src="/storage/${file.path}" alt="${file.original_name}"
                     class="w-full h-48 object-cover rounded mb-2 cursor-pointer"
                     onclick="window.open('/storage/${file.path}', '_blank')">
            `;
        } else if (isVideo) {
            evidenceHtml += `
                <video controls class="w-full h-48 rounded mb-2">
                    <source src="/storage/${file.path}" type="${file.mime_type}">
                    Your browser does not support the video tag.
                </video>
            `;
        } else if (isAudio) {
            evidenceHtml += `
                <div class="flex items-center justify-center h-24 bg-gray-100 dark:bg-gray-700 rounded mb-2">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                </div>
                <audio controls class="w-full mb-2">
                    <source src="/storage/${file.path}" type="${file.mime_type}">
                    Your browser does not support the audio element.
                </audio>
            `;
        } else {
            evidenceHtml += `
                <div class="flex items-center justify-center h-24 bg-gray-100 dark:bg-gray-700 rounded mb-2">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            `;
        }

        evidenceHtml += `
            <div class="text-sm">
                <div class="font-medium text-gray-900 dark:text-white">${file.original_name}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    Size: ${formatFileSize(file.size)} | Type: ${file.mime_type || 'Unknown'}
                </div>
                <a href="/storage/${file.path}" download="${file.original_name}"
                   class="inline-flex items-center mt-2 text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download
                </a>
            </div>
        </div>`;
    });

    evidenceHtml += '</div>';
    content.innerHTML = evidenceHtml;
    modal.classList.remove('hidden');
}

function closeEvidenceModal() {
    document.getElementById('evidenceModal').classList.add('hidden');
}

// Reply Modal Functions
function openReplyModal(complaintId, clientName, referenceNumber) {
    document.getElementById('complaintId').value = complaintId;
    document.getElementById('complaintInfo').textContent = `${clientName} - ${referenceNumber}`;
    document.getElementById('replyModal').classList.remove('hidden');
}

function closeReplyModal() {
    document.getElementById('replyModal').classList.add('hidden');
    document.getElementById('replyForm').reset();
}

// Form submission
document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const complaintId = document.getElementById('complaintId').value;
    const formData = new FormData(this);

    const submitBtn = this.querySelector('button[type="submit"]');
    const submitText = submitBtn.querySelector('.submit-text');
    const loadingText = submitBtn.querySelector('.loading-text');

    submitBtn.disabled = true;
    submitText.classList.add('hidden');
    loadingText.classList.remove('hidden');

    fetch(`/admin/complaints/${complaintId}/status`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            closeReplyModal();
            location.reload(); // Refresh the page to show updated data
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while updating the complaint', 'error');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitText.classList.remove('hidden');
        loadingText.classList.add('hidden');
    });
});

// Delete complaint function
function deleteComplaint(complaintId, referenceNumber) {
    if (!confirm(`Are you sure you want to delete complaint ${referenceNumber}? This action cannot be undone.`)) {
        return;
    }

    fetch(`/admin/complaints/${complaintId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            document.getElementById(`complaint-row-${complaintId}`).remove();
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while deleting the complaint', 'error');
    });
}

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    const successIcon = toast.querySelector('.success-icon');
    const errorIcon = toast.querySelector('.error-icon');

    toastMessage.textContent = message;

    if (type === 'success') {
        successIcon.classList.remove('hidden');
        errorIcon.classList.add('hidden');
    } else {
        successIcon.classList.add('hidden');
        errorIcon.classList.remove('hidden');
    }

    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 5000);
}

// Utility function to format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.id === 'evidenceModal') {
        closeEvidenceModal();
    }
    if (e.target.id === 'replyModal') {
        closeReplyModal();
    }
});
</script>
@endsection
