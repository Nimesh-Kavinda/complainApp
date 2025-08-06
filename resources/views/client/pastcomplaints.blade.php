@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        My Complaint History
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Track your complaints, view solutions, and communicate with our support team
                    </p>
                </div>
                <div class="mt-4 lg:mt-0">
                    <a href="{{ route('client.complain') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Complaint
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">In Progress</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['in_progress'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Resolved</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['resolved'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Closed</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['closed'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Complaints List -->
        @if($complaints->count() > 0)
            <div class="space-y-6">
                @foreach($complaints as $complaint)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-200"
                         id="complaint-card-{{ $complaint->id }}">

                        <!-- Card Header -->
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $complaint->reference_number }}
                                        </h3>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $complaint->status_color }}">
                                            {{ $complaint->status_label }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $complaint->priority_color }}">
                                            {{ $complaint->priority_label }}
                                        </span>
                                    </div>

                                    @if($complaint->complaint_title)
                                        <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-2">
                                            {{ $complaint->complaint_title }}
                                        </h4>
                                    @endif

                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        {{ Str::limit($complaint->complaint_details, 200) }}
                                    </p>

                                    <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            {{ $complaint->category->category_name }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $complaint->created_at->format('M d, Y h:i A') }}
                                        </span>
                                        @if($complaint->getConversationCount() > 0)
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                {{ $complaint->getConversationCount() }} message(s)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <!-- Current Solution/Last Admin Message -->
                            @if($complaint->solution || $complaint->getLastMessage())
                                <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border-l-4 border-blue-500">
                                    <h5 class="text-sm font-medium text-blue-900 dark:text-blue-300 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                        Latest Update
                                    </h5>
                                    @php
                                        $lastMessage = $complaint->getLastMessage();
                                    @endphp
                                    @if($lastMessage && $lastMessage['sender_type'] === 'admin')
                                        <p class="text-sm text-blue-800 dark:text-blue-200">
                                            {{ $lastMessage['message'] }}
                                        </p>
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                            - {{ $lastMessage['sender_name'] }} ({{ \Carbon\Carbon::parse($lastMessage['timestamp'])->format('M d, Y h:i A') }})
                                        </p>
                                    @elseif($complaint->solution)
                                        <p class="text-sm text-blue-800 dark:text-blue-200">{{ $complaint->solution }}</p>
                                    @endif
                                </div>
                            @endif

                            <!-- Evidence Files -->
                            @if($complaint->hasEvidence())
                                <div class="mb-4">
                                    <h5 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Evidence Files</h5>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($complaint->evidence_files as $index => $file)
                                            <a href="{{ route('client.complaint.evidence', ['id' => $complaint->id, 'fileIndex' => $index]) }}"
                                               class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-xs hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ $file['original_name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between flex-wrap gap-3">
                                <div class="flex items-center gap-2">
                                    <!-- Conversation Button -->
                                    <button onclick="openConversationModal({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                            class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        Chat
                                    </button>

                                    <!-- Close Complaint Button (only for resolved complaints) -->
                                    @if($complaint->status === 'resolved' && $complaint->status !== 'closed')
                                        <button onclick="openCloseModal({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                                class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Close Complaint
                                        </button>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <!-- Send to Senior Board Button -->
                                    @if(!in_array($complaint->status, ['closed', 'rejected']))
                                        <button onclick="showSeniorBoardModal({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                                class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                                            </svg>
                                            Senior Board
                                        </button>
                                    @endif

                                    <!-- Status Timeline -->
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        @if($complaint->resolved_at)
                                            Resolved: {{ $complaint->resolved_at->format('M d, Y') }}
                                        @elseif($complaint->closed_at)
                                            Closed: {{ $complaint->closed_at->format('M d, Y') }}
                                        @else
                                            Created: {{ $complaint->created_at->format('M d, Y') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">No complaints found</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        You haven't submitted any complaints yet. When you do, they'll appear here for tracking and communication.
                    </p>
                    <a href="{{ route('client.complain') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Submit Your First Complaint
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Conversation Modal -->
<div id="conversationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="conversationModalTitle">
                    Conversation
                </h3>
                <button onclick="closeConversationModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Conversation Messages -->
            <div class="py-4 max-h-96 overflow-y-auto" id="conversationMessages">
                <div class="flex justify-center items-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <form id="messageForm" class="flex gap-3">
                    <input type="hidden" id="conversationComplaintId" value="">
                    <textarea id="messageInput"
                              placeholder="Type your message here..."
                              rows="3"
                              class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"></textarea>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors flex items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Close Complaint Modal -->
<div id="closeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="closeModalTitle">
                    Close Complaint
                </h3>
                <button onclick="closeCloseModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="py-6">
                <div class="mb-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border-l-4 border-yellow-400">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-800 dark:text-yellow-200">
                                Are you sure you want to close this complaint? Once closed, you won't be able to reopen it or add new messages.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="closingReason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Reason for closing (Optional)
                    </label>
                    <textarea id="closingReason"
                              rows="3"
                              placeholder="Please provide a reason for closing this complaint..."
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"></textarea>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button onclick="closeCloseModal()"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg font-medium transition-colors">
                    Cancel
                </button>
                <button onclick="confirmCloseComplaint()"
                        id="confirmCloseButton"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                    Close Complaint
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Senior Board Modal -->
<div id="seniorBoardModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="seniorBoardModalTitle">
                    Send to Senior Board
                </h3>
                <button onclick="closeSeniorBoardModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="py-6">
                <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border-l-4 border-blue-400">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800 dark:text-blue-200">
                                This feature will escalate your complaint to the senior board for further review. This action will be logged and you will receive an update once the senior board has reviewed your case.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Senior Board Escalation</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        This feature is currently being developed and will be available soon. You will be able to escalate unresolved complaints to the senior board for additional review and intervention.
                    </p>
                    <div class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Coming Soon
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button onclick="closeSeniorBoardModal()"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg font-medium transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentConversationId = null;
let currentCloseId = null;

// Conversation Modal Functions
function openConversationModal(complaintId, referenceNumber) {
    currentConversationId = complaintId;
    document.getElementById('conversationModalTitle').textContent = `Conversation - ${referenceNumber}`;
    document.getElementById('conversationComplaintId').value = complaintId;
    document.getElementById('conversationModal').classList.remove('hidden');

    // Load conversation
    loadConversation(complaintId);
}

function closeConversationModal() {
    document.getElementById('conversationModal').classList.add('hidden');
    document.getElementById('messageInput').value = '';
    currentConversationId = null;
}

async function loadConversation(complaintId) {
    try {
        const response = await fetch(`/client/complaint/${complaintId}/conversation`);
        const data = await response.json();

        const messagesContainer = document.getElementById('conversationMessages');

        if (data.success && data.conversation && data.conversation.length > 0) {
            messagesContainer.innerHTML = data.conversation.map(message => {
                const isClient = message.sender_type === 'client';
                const messageTime = new Date(message.timestamp).toLocaleString();

                return `
                    <div class="mb-4 ${isClient ? 'text-right' : 'text-left'}">
                        <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                            isClient
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white'
                        }">
                            <p class="text-sm">${message.message}</p>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            ${message.sender_name} - ${messageTime}
                        </div>
                    </div>
                `;
            }).join('');
        } else {
            messagesContainer.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-500 dark:text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p>No messages yet. Start the conversation!</p>
                    </div>
                </div>
            `;
        }

        // Scroll to bottom
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    } catch (error) {
        console.error('Error loading conversation:', error);
        document.getElementById('conversationMessages').innerHTML = `
            <div class="text-center py-8 text-red-600 dark:text-red-400">
                <p>Error loading conversation. Please try again.</p>
            </div>
        `;
    }
}

// Message Form Submission
document.getElementById('messageForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();
    const complaintId = document.getElementById('conversationComplaintId').value;

    if (!message) {
        alert('Please enter a message');
        return;
    }

    try {
        const response = await fetch(`/client/complaint/${complaintId}/message`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        });

        const data = await response.json();

        if (data.success) {
            messageInput.value = '';
            // Reload conversation
            await loadConversation(complaintId);
        } else {
            alert(data.message || 'Error sending message');
        }
    } catch (error) {
        console.error('Error sending message:', error);
        alert('Error sending message. Please try again.');
    }
});

// Close Complaint Modal Functions
function openCloseModal(complaintId, referenceNumber) {
    currentCloseId = complaintId;
    document.getElementById('closeModalTitle').textContent = `Close Complaint - ${referenceNumber}`;
    document.getElementById('closeModal').classList.remove('hidden');
}

function closeCloseModal() {
    document.getElementById('closeModal').classList.add('hidden');
    document.getElementById('closingReason').value = '';
    currentCloseId = null;
}

async function confirmCloseComplaint() {
    if (!currentCloseId) return;

    const reason = document.getElementById('closingReason').value.trim();
    const button = document.getElementById('confirmCloseButton');

    button.disabled = true;
    button.textContent = 'Closing...';

    try {
        const response = await fetch(`/client/complaint/${currentCloseId}/close`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ reason: reason })
        });

        const data = await response.json();

        if (data.success) {
            closeCloseModal();
            // Reload page to show updated status
            window.location.reload();
        } else {
            alert(data.message || 'Error closing complaint');
        }
    } catch (error) {
        console.error('Error closing complaint:', error);
        alert('Error closing complaint. Please try again.');
    } finally {
        button.disabled = false;
        button.textContent = 'Close Complaint';
    }
}

// Senior Board Modal Functions
function showSeniorBoardModal(complaintId, referenceNumber) {
    document.getElementById('seniorBoardModalTitle').textContent = `Senior Board - ${referenceNumber}`;
    document.getElementById('seniorBoardModal').classList.remove('hidden');
}

function closeSeniorBoardModal() {
    document.getElementById('seniorBoardModal').classList.add('hidden');
}

// Close modals when clicking outside
window.addEventListener('click', function(event) {
    const conversationModal = document.getElementById('conversationModal');
    const closeModal = document.getElementById('closeModal');
    const seniorBoardModal = document.getElementById('seniorBoardModal');

    if (event.target === conversationModal) {
        closeConversationModal();
    }
    if (event.target === closeModal) {
        closeCloseModal();
    }
    if (event.target === seniorBoardModal) {
        closeSeniorBoardModal();
    }
});
</script>

@endsection
