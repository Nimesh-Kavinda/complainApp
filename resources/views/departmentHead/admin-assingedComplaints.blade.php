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
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6">
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-gradient-to-r from-gray-900 to-purple-600 dark:from-white dark:to-purple-400 bg-clip-text mb-3">
                        Admin Assigned Complaints
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg">
                        {{ $department->name }} Department - Manage complaints assigned by admin
                    </p>
                </div>
                <div class="mt-4 lg:mt-0">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 shadow-lg">
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="text-center">
                                <div class="font-bold text-gray-900 dark:text-white">{{ $assignments->count() }}</div>
                                <div class="text-gray-500 dark:text-gray-400">Total</div>
                            </div>
                            <div class="text-center">
                                <div class="font-bold text-yellow-600">{{ $assignments->whereIn('status', ['assigned', 'in_progress'])->count() }}</div>
                                <div class="text-gray-500 dark:text-gray-400">Active</div>
                            </div>
                            <div class="text-center">
                                <div class="font-bold text-green-600">{{ $assignments->where('status', 'resolved')->count() }}</div>
                                <div class="text-gray-500 dark:text-gray-400">Resolved</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($assignments->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-blue-100 dark:from-purple-900/30 dark:to-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No Assigned Complaints</h3>
                <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                    There are currently no complaints assigned to your department by the admin.
                </p>
            </div>
        @else
            <!-- Assignments List -->
            <div class="space-y-6">
                @foreach($assignments as $assignment)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 group overflow-hidden">
                    <!-- Status indicator bar -->
                    <div class="h-1 bg-gradient-to-r
                        {{ $assignment->status === 'assigned' ? 'from-blue-400 to-blue-500' :
                        ($assignment->status === 'in_progress' ? 'from-yellow-400 to-yellow-500' :
                        ($assignment->status === 'pending_feedback' ? 'from-orange-400 to-orange-500' :
                        ($assignment->status === 'resolved' ? 'from-green-400 to-green-500' :
                        ($assignment->status === 'cancelled' ? 'from-red-400 to-red-500' :
                            'from-gray-400 to-gray-500')))) }}">
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                        {{ $assignment->clientComplaint->complaint_title }}
                                    </h3>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $assignment->status === 'assigned' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' :
                                        ($assignment->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                        ($assignment->status === 'pending_feedback' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' :
                                        ($assignment->status === 'resolved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                                        ($assignment->status === 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                                            'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400')))) }}">
                                        {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $assignment->clientComplaint->client_name }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                                        </svg>
                                        <span>{{ $assignment->clientComplaint->reference_number }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Assigned: {{ $assignment->created_at->format('M d, Y') }}</span>
                                    </div>
                                    @if($assignment->deadline)
                                    <div class="flex items-center gap-1 {{ $assignment->isOverdue() ? 'text-red-600 dark:text-red-400' : '' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                                        </svg>
                                        <span>Due: {{ $assignment->deadline->format('M d, Y') }}</span>
                                        @if($assignment->isOverdue())
                                            <span class="text-xs font-semibold">(OVERDUE)</span>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                    {{ Str::limit($assignment->clientComplaint->complaint_details, 200) }}
                                </p>

                                @if($assignment->assignment_notes)
                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-3 mb-4">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-blue-900 dark:text-blue-300">Admin Notes:</span>
                                    </div>
                                    <p class="text-sm text-blue-800 dark:text-blue-300">{{ $assignment->assignment_notes }}</p>
                                </div>
                                @endif

                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-1 rounded-lg text-xs font-medium
                                        {{ $assignment->priority === 'low' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                                        ($assignment->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                        ($assignment->priority === 'high' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' :
                                        ($assignment->priority === 'urgent' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : ''))) }}">
                                        {{ ucfirst($assignment->priority) }} Priority
                                    </span>

                                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-xs font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Assigned by: {{ $assignment->assignedBy->name }}
                                    </span>

                                    @if($assignment->discussions && $assignment->discussions->count() > 0)
                                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded-lg text-xs font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ $assignment->discussions->count() }} message(s)
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 ml-4">
                                <button onclick="openDiscussionModal({{ $assignment->id }})"
                                   class="px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 shadow-lg hover:shadow-purple-500/25 text-sm text-center">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    Discussion
                                </button>

                                @if(!$assignment->isResolved())
                                <button onclick="openStatusModal({{ $assignment->id }}, '{{ $assignment->status }}')"
                                   class="px-4 py-2 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 shadow-lg hover:shadow-green-500/25 text-sm text-center">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Update Status
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Discussion Modal -->
<div id="discussionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Discussion</h3>
                <button onclick="closeDiscussionModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-col h-[70vh]">
            <!-- Messages Area -->
            <div id="messagesArea" class="flex-1 p-6 overflow-y-auto bg-gray-50 dark:bg-gray-900">
                <div id="messagesList" class="space-y-4">
                    <!-- Messages will be loaded here -->
                </div>
            </div>

            <!-- Message Input Area -->
            <div class="p-6 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <form id="messageForm" enctype="multipart/form-data">
                    <div class="space-y-4">
                        <div>
                            <textarea id="messageInput" name="message" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"
                                placeholder="Type your message here..." required></textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="file" name="attachments[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt" class="hidden" id="fileInput">
                                    <div class="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        <span class="text-sm">Attach Files</span>
                                    </div>
                                </label>

                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_important" class="mr-2 text-purple-600 focus:ring-purple-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Mark as Important</span>
                                </label>
                            </div>

                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-xl font-medium transition-all duration-300">
                                Send Message
                            </button>
                        </div>

                        <div id="selectedFiles" class="hidden">
                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Selected Files:</div>
                            <div id="filesList" class="space-y-1"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Update Status</h3>
                <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6">
            <form id="statusForm">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select id="statusSelect" name="status" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-white" required>
                            <option value="assigned">Assigned</option>
                            <option value="in_progress">In Progress</option>
                            <option value="pending_feedback">Pending Feedback</option>
                            <option value="resolved">Resolved</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div id="resolutionNotesDiv" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Resolution Notes</label>
                        <textarea id="resolutionNotes" name="resolution_notes" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"
                            placeholder="Describe how the complaint was resolved..."></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white rounded-xl font-medium transition-all duration-300">
                            Update Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentAssignmentId = null;

// CSRF Token
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

console.log('CSRF Token:', csrfToken);

if (!csrfToken) {
    console.error('CSRF token not found!');
} else {
    console.log('CSRF token found successfully');
}

// Discussion Modal Functions
function openDiscussionModal(assignmentId) {
    currentAssignmentId = assignmentId;
    document.getElementById('discussionModal').classList.remove('hidden');
    document.getElementById('discussionModal').classList.add('flex');
    loadDiscussionMessages(assignmentId);
}

function closeDiscussionModal() {
    document.getElementById('discussionModal').classList.add('hidden');
    document.getElementById('discussionModal').classList.remove('flex');
    currentAssignmentId = null;
    document.getElementById('messageInput').value = '';
    document.getElementById('fileInput').value = '';
    document.getElementById('selectedFiles').classList.add('hidden');
    location.reload();
}

// Status Modal Functions
function openStatusModal(assignmentId, currentStatus) {
    currentAssignmentId = assignmentId;
    document.getElementById('statusSelect').value = currentStatus;

    // Show resolution notes field if status is resolved
    if (currentStatus === 'resolved') {
        document.getElementById('resolutionNotesDiv').classList.remove('hidden');
    } else {
        document.getElementById('resolutionNotesDiv').classList.add('hidden');
    }

    document.getElementById('statusModal').classList.remove('hidden');
    document.getElementById('statusModal').classList.add('flex');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
    document.getElementById('statusModal').classList.remove('flex');
    currentAssignmentId = null;
    document.getElementById('statusForm').reset();
    location.reload();
}

// Load Discussion Messages
async function loadDiscussionMessages(assignmentId) {
    console.log('Loading messages for assignment:', assignmentId);

    try {
        const response = await fetch(`/department-head/admin-assigned-complaints/${assignmentId}/discussions`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });

        console.log('Load messages response status:', response.status);

        const data = await response.json();
        console.log('Load messages response data:', data);

        if (data.success) {
            displayMessages(data.discussions);
        } else {
            console.error('Failed to load messages:', data.message);
        }
    } catch (error) {
        console.error('Error loading messages:', error);
    }
}

// Display Messages
function displayMessages(discussions) {
    console.log('Displaying messages:', discussions);

    const messagesList = document.getElementById('messagesList');
    messagesList.innerHTML = '';

    if (discussions.length === 0) {
        console.log('No discussions found, showing empty state');
        messagesList.innerHTML = `
            <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="font-medium text-gray-800 dark:text-gray-200">No messages yet. Start the conversation!</p>
            </div>
        `;
        return;
    }

    console.log(`Rendering ${discussions.length} messages`);

    discussions.forEach((discussion, index) => {
        console.log(`Rendering message ${index}:`, discussion);

        const messageDiv = document.createElement('div');
        const isFromAdmin = discussion.sender_type === 'admin';

        messageDiv.className = `flex ${isFromAdmin ? 'justify-start' : 'justify-end'}`;

        let attachmentsHtml = '';
        if (discussion.attachments && discussion.attachments.length > 0) {
            attachmentsHtml = `
                <div class="mt-2 space-y-1">
                    ${discussion.attachments.map(attachment => `
                        <div class="flex items-center space-x-2 text-xs bg-gray-100 dark:bg-gray-700 rounded p-2">
                            <svg class="w-4 h-4 text-gray-400 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">${attachment.original_name}</span>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        messageDiv.innerHTML = `
            <div class="max-w-xs lg:max-w-md px-4 py-3 rounded-2xl ${
                isFromAdmin
                    ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100'
                    : 'bg-gradient-to-r from-purple-600 to-blue-600 text-white'
            } ${discussion.is_important ? 'ring-2 ring-red-400' : ''}">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-medium ${isFromAdmin ? 'text-gray-600 dark:text-gray-400' : 'text-purple-200'}">
                        ${discussion.sender_name}
                    </span>
                    ${discussion.is_important ? `
                        <span class="text-xs bg-red-500 text-white px-2 py-1 rounded-full">Important</span>
                    ` : ''}
                </div>
                <p class="text-sm leading-relaxed">${discussion.message}</p>
                ${attachmentsHtml}
                <div class="text-xs ${isFromAdmin ? 'text-gray-500 dark:text-gray-400' : 'text-purple-200'} mt-2">
                    ${discussion.sent_at}
                </div>
            </div>
        `;

        messagesList.appendChild(messageDiv);
    });

    // Scroll to bottom
    const messagesArea = document.getElementById('messagesArea');
    messagesArea.scrollTop = messagesArea.scrollHeight;

    console.log('Messages rendered successfully');
}

// Handle Message Form Submission
document.getElementById('messageForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    if (!currentAssignmentId) return;

    const formData = new FormData(this);

    console.log('Sending message for assignment:', currentAssignmentId);
    console.log('Form data:', {
        message: formData.get('message'),
        files: formData.getAll('attachments[]'),
        is_important: formData.get('is_important')
    });

    try {
        const response = await fetch(`/department-head/admin-assigned-complaints/${currentAssignmentId}/discussion`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        console.log('Response status:', response.status);
        const data = await response.json();
        console.log('Response data:', data);

        if (data.success) {
            // Clear the form
            document.getElementById('messageInput').value = '';
            document.getElementById('fileInput').value = '';
            document.getElementById('selectedFiles').classList.add('hidden');

            // Reload messages
            loadDiscussionMessages(currentAssignmentId);
        } else {
            console.error('Error response:', data);
            alert(data.message || 'Failed to send message');
        }
    } catch (error) {
        console.error('Error sending message:', error);
        alert('Failed to send message. Please try again.');
    }
});

// Handle Status Form Submission
document.getElementById('statusForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    if (!currentAssignmentId) return;

    const formData = new FormData(this);

    try {
        const response = await fetch(`/department-head/admin-assigned-complaints/${currentAssignmentId}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: formData.get('status'),
                resolution_notes: formData.get('resolution_notes')
            })
        });

        const data = await response.json();

        if (data.success) {
            closeStatusModal();
            // Reload the page to show updated status
            window.location.reload();
        } else {
            alert(data.message || 'Failed to update status');
        }
    } catch (error) {
        console.error('Error updating status:', error);
        alert('Failed to update status. Please try again.');
    }
});

// Handle File Selection
document.getElementById('fileInput').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    const selectedFiles = document.getElementById('selectedFiles');
    const filesList = document.getElementById('filesList');

    if (files.length > 0) {
        selectedFiles.classList.remove('hidden');
        filesList.innerHTML = '';

        files.forEach((file, index) => {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'flex items-center justify-between bg-gray-100 dark:bg-gray-700 rounded px-3 py-2';
            fileDiv.innerHTML = `
                <span class="text-sm text-gray-700 dark:text-gray-300">${file.name}</span>
                <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            filesList.appendChild(fileDiv);
        });
    } else {
        selectedFiles.classList.add('hidden');
    }
});

// Remove File Function
function removeFile(index) {
    const fileInput = document.getElementById('fileInput');
    const dt = new DataTransfer();
    const files = Array.from(fileInput.files);

    files.forEach((file, i) => {
        if (i !== index) {
            dt.items.add(file);
        }
    });

    fileInput.files = dt.files;
    fileInput.dispatchEvent(new Event('change'));
}

// Show/Hide Resolution Notes based on status
document.getElementById('statusSelect').addEventListener('change', function(e) {
    const resolutionNotesDiv = document.getElementById('resolutionNotesDiv');

    if (e.target.value === 'resolved') {
        resolutionNotesDiv.classList.remove('hidden');
        document.getElementById('resolutionNotes').required = true;
    } else {
        resolutionNotesDiv.classList.add('hidden');
        document.getElementById('resolutionNotes').required = false;
    }
});
</script>
@endsection
