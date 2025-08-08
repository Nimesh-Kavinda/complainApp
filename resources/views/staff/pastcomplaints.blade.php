@extends('layouts.app')

@section('content')
<div class="min-h-screen my-12 bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-red-600 to-gray-800 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white">Past Complaints</h1>
                        <p class="text-red-100 text-lg mt-2">Track your submitted complaints</p>
                        <p class="text-red-200 text-sm">Staff ID: {{ $staffMember->staff_id }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('staff.complaint.form') }}"
                       class="bg-white/20 text-white hover:bg-white/30 font-medium py-2 px-4 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        New Complaint
                    </a>
                    <a href="{{ route('staff.index') }}"
                       class="bg-white/20 text-white hover:bg-white/30 font-medium py-2 px-4 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Complaints</p>
                        <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Pending</p>
                        <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">In Progress</p>
                        <p class="text-3xl font-bold">{{ $stats['in_progress'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Resolved</p>
                        <p class="text-3xl font-bold">{{ $stats['resolved'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Complaints List -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Your Complaints</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-1">View and manage your submitted complaints</p>
            </div>

            @if($complaints->count() > 0)
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($complaints as $complaint)
                <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $complaint->complaint_title ?: 'Complaint #' . $complaint->id }}
                                </h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                       ($complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300' :
                                       ($complaint->status === 'resolved' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' :
                                       ($complaint->status === 'closed' ? 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300'))) }}">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $complaint->priority === 'low' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' :
                                       ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                       ($complaint->priority === 'high' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')) }}">
                                    {{ ucfirst($complaint->priority) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Reference</p>
                                    <p class="font-mono text-sm text-gray-900 dark:text-white">{{ $complaint->reference_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Department</p>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $complaint->department->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
                                {{ Str::limit($complaint->complaint_details, 150) }}
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span>{{ $complaint->created_at->format('M j, Y') }}</span>
                                    <span>{{ $complaint->created_at->diffForHumans() }}</span>
                                    @if($complaint->evidence_files && count($complaint->evidence_files) > 0)
                                    <span class="flex items-center cursor-pointer text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                          onclick="showEvidenceModal({{ $complaint->id }}, {{ json_encode($complaint->evidence_files) }})">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ count($complaint->evidence_files) }} file(s) - Preview
                                    </span>
                                    @endif
                                </div>

                                <div class="flex items-center space-x-3">
                                    @if($complaint->canBeEdited())
                                    <button onclick="showFeedbackModal({{ $complaint->id }}, '{{ $complaint->staff_feedback ?? '' }}', {{ $complaint->satisfaction_rating ?? 0 }})"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        Add Feedback
                                    </button>
                                    @endif

                                    <a href="{{ route('staff.complaint.view', $complaint->id) }}"
                                       class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($complaints->hasPages())
            <div class="px-8 py-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                {{ $complaints->links() }}
            </div>
            @endif

            @else
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-6 text-lg font-medium text-gray-900 dark:text-white">No complaints yet</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                    You haven't submitted any complaints yet. Click the button below to submit your first complaint.
                </p>
                <div class="mt-8">
                    <a href="{{ route('staff.complaint.form') }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-gray-800 hover:from-red-700 hover:to-gray-900 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Submit New Complaint
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Feedback Modal -->
<div id="feedbackModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Add Feedback</h3>
                <form id="feedbackForm">
                    <input type="hidden" id="complaintId" name="complaint_id">

                    <div class="mb-4">
                        <label for="staffFeedback" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Your Feedback:
                        </label>
                        <textarea id="staffFeedback" name="staff_feedback" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                  placeholder="Please provide your feedback on this complaint..."></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="satisfactionRating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Satisfaction Rating:
                        </label>
                        <select id="satisfactionRating" name="satisfaction_rating"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Select a rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4">⭐⭐⭐⭐ Good</option>
                            <option value="3">⭐⭐⭐ Average</option>
                            <option value="2">⭐⭐ Poor</option>
                            <option value="1">⭐ Very Poor</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeFeedbackModal()"
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded-lg transition-colors">
                            Submit Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Evidence Preview Modal -->
<div id="evidenceModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Evidence Files</h3>
                    <button onclick="closeEvidenceModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6 max-h-[70vh] overflow-y-auto">
                <div id="evidenceContent" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Evidence files will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showEvidenceModal(complaintId, evidenceFiles) {
    const modal = document.getElementById('evidenceModal');
    const content = document.getElementById('evidenceContent');

    // Clear previous content
    content.innerHTML = '';

    if (!evidenceFiles || evidenceFiles.length === 0) {
        content.innerHTML = '<p class="text-gray-500 dark:text-gray-400 text-center col-span-2">No evidence files found.</p>';
    } else {
        evidenceFiles.forEach((file, index) => {
            const fileCard = document.createElement('div');
            fileCard.className = 'bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600';

            let previewContent = '';

            // Image preview
            if (file.mime_type && file.mime_type.startsWith('image/')) {
                previewContent = `
                    <div class="mb-3">
                        <img src="/storage/${file.file_path}" alt="${file.original_name}"
                             class="w-full h-48 object-cover rounded-lg cursor-pointer"
                             onclick="openImageFullscreen('/storage/${file.file_path}', '${file.original_name}')">
                    </div>
                `;
            }
            // Video preview
            else if (file.mime_type && file.mime_type.startsWith('video/')) {
                previewContent = `
                    <div class="mb-3">
                        <video controls class="w-full h-48 rounded-lg">
                            <source src="/storage/${file.file_path}" type="${file.mime_type}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                `;
            }
            // PDF preview
            else if (file.mime_type === 'application/pdf') {
                previewContent = `
                    <div class="mb-3 h-48 bg-gray-100 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-red-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-600 dark:text-gray-300">PDF File</p>
                            <button onclick="window.open('/storage/${file.file_path}', '_blank')"
                                    class="mt-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 text-sm">
                                Open in new tab
                            </button>
                        </div>
                    </div>
                `;
            }
            // Other file types
            else {
                previewContent = `
                    <div class="mb-3 h-48 bg-gray-100 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-600 dark:text-gray-300">File</p>
                        </div>
                    </div>
                `;
            }

            fileCard.innerHTML = `
                ${previewContent}
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate" title="${file.original_name}">
                            ${file.original_name}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            ${(file.file_size / 1024).toFixed(2)} KB
                        </p>
                    </div>
                    <a href="/staff/complaint/${complaintId}/evidence/${index}"
                       class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                        Download
                    </a>
                </div>
            `;

            content.appendChild(fileCard);
        });
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeEvidenceModal() {
    document.getElementById('evidenceModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function openImageFullscreen(src, alt) {
    const fullscreenModal = document.createElement('div');
    fullscreenModal.className = 'fixed inset-0 z-[60] bg-black bg-opacity-90 flex items-center justify-center';
    fullscreenModal.innerHTML = `
        <div class="relative max-w-full max-h-full p-4">
            <img src="${src}" alt="${alt}" class="max-w-full max-h-full object-contain">
            <button onclick="this.parentElement.parentElement.remove()"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    document.body.appendChild(fullscreenModal);
}

function showFeedbackModal(complaintId, feedback = '', rating = 0) {
    document.getElementById('complaintId').value = complaintId;
    document.getElementById('staffFeedback').value = feedback;
    document.getElementById('satisfactionRating').value = rating;
    document.getElementById('feedbackModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeFeedbackModal() {
    document.getElementById('feedbackModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Handle feedback form submission
document.getElementById('feedbackForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const complaintId = document.getElementById('complaintId').value;
    const formData = new FormData(this);
    const data = {
        staff_feedback: formData.get('staff_feedback'),
        satisfaction_rating: formData.get('satisfaction_rating')
    };

    try {
        const response = await fetch(`/staff/complaint/${complaintId}/feedback`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification('Feedback submitted successfully!', 'success');
            closeFeedbackModal();
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(result.message || 'Failed to submit feedback', 'error');
        }
    } catch (error) {
        console.error('Error submitting feedback:', error);
        showNotification('Failed to submit feedback', 'error');
    }
});

// Close modal when clicking outside
document.getElementById('feedbackModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFeedbackModal();
    }
});

// Close evidence modal when clicking outside
document.getElementById('evidenceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEvidenceModal();
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

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeFeedbackModal();
        closeEvidenceModal();
    }
});
</script>

@endsection
