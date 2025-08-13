@extends('layouts.departmentHead')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
    <!-- Animated background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 right-1/4 w-60 h-60 bg-purple-600/5 rounded-full blur-3xl animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('department.head.staff.complaints') }}"
               class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Staff Complaints
            </a>
        </div>

        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 mb-8 overflow-hidden">
            <!-- Status indicator bar -->
            <div class="h-2 bg-gradient-to-r
                {{ $complaint->status === 'pending' ? 'from-yellow-400 to-yellow-500' :
                ($complaint->status === 'in_review' ? 'from-blue-400 to-blue-500' :
                ($complaint->status === 'resolved' ? 'from-green-400 to-green-500' :
                ($complaint->status === 'rejected' ? 'from-red-400 to-red-500' :
                    'from-gray-400 to-gray-500'))) }}">
            </div>


            <div class="p-8">
                <div class="flex flex-col lg:flex-row lg:items-start justify-between mb-6">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $complaint->complaint_title }}
                        </h1>
                        <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                                </svg>
                                {{ $complaint->reference_number }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $complaint->created_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-4 lg:mt-0">
                        <span class="px-4 py-2 rounded-xl text-sm font-semibold
                            {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' :
                            ($complaint->status === 'in_review' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' :
                            ($complaint->status === 'resolved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                            ($complaint->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                                'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400'))) }}">
                            {{ ucfirst($complaint->status) }}
                        </span>

                        <span class="px-4 py-2 rounded-xl text-sm font-semibold
                            {{ $complaint->priority === 'low' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                            ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' :
                            ($complaint->priority === 'high' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' :
                            ($complaint->priority === 'urgent' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : ''))) }}">
                            {{ ucfirst($complaint->priority) }} Priority
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Staff Member Info -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Staff Member Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</label>
                            <p class="text-gray-900 dark:text-white font-semibold">{{ $complaint->staffMember->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                            <p class="text-gray-900 dark:text-white">{{ $complaint->staffMember->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Staff ID</label>
                            <p class="text-gray-900 dark:text-white font-mono">{{ $complaint->staffMember->staff_id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Department</label>
                            <p class="text-gray-900 dark:text-white">{{ $complaint->department->name }}</p>
                        </div>
                        @if($complaint->staff_email)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Work Email</label>
                            <p class="text-gray-900 dark:text-white">{{ $complaint->staff_email }}</p>
                        </div>
                        @endif
                        @if($complaint->contact_phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Phone</label>
                            <p class="text-gray-900 dark:text-white">{{ $complaint->contact_phone }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Complaint Details -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Complaint Description
                    </h2>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                        <p class="text-gray-900 dark:text-white leading-relaxed whitespace-pre-wrap">{{ $complaint->complaint_details }}</p>
                    </div>
                </div>

                <!-- Evidence Files -->
                @if($complaint->evidence_files && count($complaint->evidence_files) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        Evidence Files
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($complaint->evidence_files as $index => $file)
                        @php
                            // Handle both string paths and array file objects
                            if (is_array($file)) {
                                $filePath = $file['path'] ?? $file['file_path'] ?? '';
                                $fileName = $file['name'] ?? $file['original_name'] ?? basename($filePath);
                            } else {
                                $filePath = $file;
                                $fileName = basename($file);
                            }
                        @endphp
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $fileName }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Evidence {{ $index + 1 }}</p>
                                </div>
                            </div>
                            <button onclick="previewFile('{{ route('department.head.staff.complaint.evidence', [$complaint, $index]) }}', '{{ $fileName }}')"
                                    class="px-3 py-1 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-700 dark:text-blue-400 rounded-lg text-sm font-medium transition-colors">
                                View
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @if($complaint->evidence_description)
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                        <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Evidence Description:</h4>
                        <p class="text-blue-800 dark:text-blue-200 leading-relaxed">{{ $complaint->evidence_description }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Department Responses -->
                @if($complaint->department_responses && count($complaint->department_responses) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Previous Responses
                    </h2>
                    <div class="space-y-4">
                        @foreach(collect($complaint->department_responses)->sortBy('created_at') as $response)
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-4 border-l-4 border-purple-500">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-purple-900 dark:text-purple-100">{{ $response['responder_name'] }}</span>
                                    <span class="px-2 py-1 bg-purple-100 dark:bg-purple-800 text-purple-700 dark:text-purple-300 text-xs rounded-lg">
                                        {{ ucfirst($response['status_set']) }}
                                    </span>
                                </div>
                                <span class="text-sm text-purple-600 dark:text-purple-400">{{ $response['formatted_date'] }}</span>
                            </div>
                            <p class="text-purple-800 dark:text-purple-200 leading-relaxed whitespace-pre-wrap">{{ $response['message'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Add Response Form -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Response
                    </h3>
                    <form id="responseForm">
                        @csrf
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Update Status
                            </label>
                            <select id="status" name="status" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $complaint->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="response_message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Response Message
                            </label>
                            <textarea id="response_message" name="response_message" rows="4" required
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"
                                      placeholder="Provide a detailed response or solution to this complaint..."></textarea>
                        </div>
                        <button type="submit"
                                class="w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-lg font-medium transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-purple-500/25">
                            <span class="submit-text">Send Response</span>
                            <span class="loading-text hidden">Sending...</span>
                        </button>
                    </form>
                </div>



                <!-- Complaint Info -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Complaint Info</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Submitted:</span>
                            <span class="text-gray-900 dark:text-white">{{ $complaint->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Last Updated:</span>
                            <span class="text-gray-900 dark:text-white">{{ $complaint->updated_at->format('M d, Y') }}</span>
                        </div>
                        @if($complaint->reviewed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Last Reviewed:</span>
                            <span class="text-gray-900 dark:text-white">{{ $complaint->reviewed_at->format('M d, Y') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Responses:</span>
                            <span class="text-gray-900 dark:text-white">{{ $complaint->department_responses ? count($complaint->department_responses) : 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- File Preview Modal -->
<div id="filePreviewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="fileModalTitle">
                    File Preview
                </h3>
                <button onclick="closeFilePreview()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="py-4">
                <div id="filePreviewContent" class="text-center">
                    <!-- File content will be displayed here -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// Form submission
document.getElementById('responseForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const submitText = submitBtn.querySelector('.submit-text');
    const loadingText = submitBtn.querySelector('.loading-text');

    // Disable form during submission
    submitBtn.disabled = true;
    submitText.classList.add('hidden');
    loadingText.classList.remove('hidden');

    try {
        const response = await fetch('{{ route("department.head.staff.complaint.response", $complaint) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            showToast(data.message, 'success');
            // Refresh the page to show the new response
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast(data.message || 'Failed to send response', 'error');
        }
    } catch (error) {
        console.error('Error sending response:', error);
        showToast('An error occurred while sending the response', 'error');
    } finally {
        // Re-enable form
        submitBtn.disabled = false;
        submitText.classList.remove('hidden');
        loadingText.classList.add('hidden');
    }
});

// File preview functionality
function previewFile(filePath, fileName) {
    const modal = document.getElementById('filePreviewModal');
    const title = document.getElementById('fileModalTitle');
    const content = document.getElementById('filePreviewContent');

    title.textContent = fileName;

    const fileExt = fileName.split('.').pop().toLowerCase();

    // Use the filePath directly (it's now a route URL)
    const fullPath = filePath;

    if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExt)) {
        content.innerHTML = `<img src="${fullPath}" alt="${fileName}" class="max-w-full h-auto rounded-lg shadow-lg">`;
    } else if (['mp4', 'webm', 'ogg'].includes(fileExt)) {
        content.innerHTML = `<video controls class="max-w-full h-auto rounded-lg shadow-lg">
            <source src="${fullPath}" type="video/${fileExt}">
            Your browser does not support the video tag.
        </video>`;
    } else if (fileExt === 'pdf') {
        content.innerHTML = `<iframe src="${fullPath}" class="w-full h-96 rounded-lg shadow-lg"></iframe>
            <div class="mt-4">
                <a href="${fullPath}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Open in New Tab
                </a>
            </div>`;
    } else {
        content.innerHTML = `<div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Preview not available for this file type</p>
            <a href="${fullPath}" download class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Download File
            </a>
        </div>`;
    }

    modal.classList.remove('hidden');
}

function closeFilePreview() {
    document.getElementById('filePreviewModal').classList.add('hidden');
    location.reload();
}



// Toast notification function
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-600 text-white' :
        type === 'error' ? 'bg-red-600 text-white' :
        'bg-blue-600 text-white'
    }`;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Close modal when clicking outside
document.getElementById('filePreviewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFilePreview();
    }
});
</script>
@endsection
