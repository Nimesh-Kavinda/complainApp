@extends('layouts.app')

@section('content')

<div class="my-16 min-h-screen bg-white dark:bg-gradient-to-br dark:from-gray-900 dark:via-gray-800 dark:to-black">
    <div class="bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-red-600 dark:to-gray-800 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mr-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-white">Complaint Details</h1>
                    <p class="text-red-100 text-lg mt-2">Reference: {{ $complaint->reference_number }}</p>
                    <p class="text-red-200 text-sm">Staff ID: {{ $staffMember->staff_id }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('staff.pastcomplaints') }}"
                   class="bg-white/20 text-white hover:bg-white/30 font-medium py-2 px-4 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Complaints
                </a>
            </div>
        </div>
    </div>
</div>


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Complaint Details Card -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Complaint Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $complaint->complaint_title ?: 'Complaint #' . $complaint->id }}
                                </h2>
                                <div class="flex items-center space-x-3 mt-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                           ($complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800' :
                                           ($complaint->status === 'resolved' ? 'bg-green-100 text-green-800' :
                                           ($complaint->status === 'closed' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800'))) }}">
                                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $complaint->priority === 'low' ? 'bg-green-100 text-green-800' :
                                           ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' :
                                           ($complaint->priority === 'high' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst($complaint->priority) }} Priority
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Complaint Information -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                            <!-- Basic Information -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Basic Information
                                </h3>

                                <div class="space-y-4">
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Reference Number</label>
                                        <p class="text-lg font-mono text-gray-900 dark:text-white">{{ $complaint->reference_number }}</p>
                                    </div>

                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Department</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $complaint->department->name ?? 'N/A' }}</p>
                                    </div>

                                    @if($complaint->contact_phone)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Contact Phone</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $complaint->contact_phone }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Timeline Information -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Timeline
                                </h3>

                                <div class="space-y-4">
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Submitted</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $complaint->created_at->format('F j, Y g:i A') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $complaint->created_at->diffForHumans() }}</p>
                                    </div>

                                    @if($complaint->reviewed_at)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Reviewed</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $complaint->reviewed_at->format('F j, Y g:i A') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">by {{ $complaint->reviewedBy->name ?? 'Department Head' }}</p>
                                    </div>
                                    @endif

                                    @if($complaint->resolved_at)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Resolved</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $complaint->resolved_at->format('F j, Y g:i A') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $complaint->resolved_at->diffForHumans() }}</p>
                                    </div>
                                    @endif

                                    @if($complaint->closed_at)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                        <label class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Closed</label>
                                        <p class="text-lg text-gray-900 dark:text-white">{{ $complaint->closed_at->format('F j, Y g:i A') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $complaint->closed_at->diffForHumans() }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Complaint Details -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Complaint Details
                            </h3>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                                <p class="text-gray-900 dark:text-white leading-relaxed whitespace-pre-wrap">{{ $complaint->complaint_details }}</p>
                            </div>
                        </div>

                        <!-- Admin Response -->
                        @if($complaint->admin_notes || $complaint->solution)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Department Head Response
                            </h3>

                            @if($complaint->admin_notes)
                            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 mb-4">
                                <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Notes:</h4>
                                <p class="text-blue-800 dark:text-blue-200 leading-relaxed whitespace-pre-wrap">{{ $complaint->admin_notes }}</p>
                            </div>
                            @endif

                            @if($complaint->solution)
                            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6">
                                <h4 class="font-semibold text-green-900 dark:text-green-100 mb-2">Solution:</h4>
                                <p class="text-green-800 dark:text-green-200 leading-relaxed whitespace-pre-wrap">{{ $complaint->solution }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Staff Feedback -->
                        @if($complaint->staff_feedback)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z"></path>
                                </svg>
                                Your Feedback
                            </h3>
                            <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6">
                                <p class="text-purple-800 dark:text-purple-200 leading-relaxed whitespace-pre-wrap">{{ $complaint->staff_feedback }}</p>
                                @if($complaint->satisfaction_rating)
                                <div class="mt-4 flex items-center">
                                    <span class="text-purple-800 dark:text-purple-200 font-medium mr-2">Rating:</span>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $complaint->satisfaction_rating)
                                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-purple-800 dark:text-purple-200">({{ $complaint->satisfaction_rating }}/5)</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Evidence & Actions Sidebar -->
            <div class="space-y-6">

                <!-- Evidence Files -->
                @if($complaint->evidence_files && count($complaint->evidence_files) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-500 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            Evidence Files
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @foreach($complaint->evidence_files as $index => $file)
                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if(str_contains($file['mime_type'], 'image/'))
                                            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif(str_contains($file['mime_type'], 'video/'))
                                            <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                                            </svg>
                                        @elseif(str_contains($file['mime_type'], 'application/pdf'))
                                            <svg class="w-6 h-6 text-blue-500 dark:text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate" title="{{ $file['original_name'] }}">
                                            {{ $file['original_name'] }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ number_format($file['file_size'] / 1024, 2) }} KB
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('staff.complaint.evidence', [$complaint->id, $index]) }}"
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>
                            </div>
                            @endforeach
                        </div>

                        @if($complaint->evidence_description)
                        <div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                            <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">Evidence Description:</h4>
                            <p class="text-sm text-blue-700 dark:text-blue-300">{{ $complaint->evidence_description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Actions -->
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
                        @if($complaint->canBeEdited())
                        <button onclick="showFeedbackModal()"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 dark:bg-gradient-to-r dark:from-gray-300 dark:to-gray-400 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Add Feedback
                        </button>
                        @endif

                        <a href="{{ route('staff.pastcomplaints') }}"
                           class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 dark:bg-gradient-to-r dark:from-gray-500 dark:to-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Back to All Complaints
                        </a>

                        <a href="{{ route('staff.complaint.form') }}"
                           class="w-full bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 dark:bg-gradient-to-r dark:from-purple-600 dark:to-purple-800 dark:hover:from-purple-700 dark:hover:to-purple-900 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            New Complaint
                        </a>
                    </div>
                </div>
            </div>
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
                    <div class="mb-4">
                        <label for="staffFeedback" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Your Feedback:
                        </label>
                        <textarea id="staffFeedback" name="staff_feedback" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                  placeholder="Please provide your feedback on this complaint...">{{ $complaint->staff_feedback }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="satisfactionRating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Satisfaction Rating:
                        </label>
                        <select id="satisfactionRating" name="satisfaction_rating"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Select a rating</option>
                            <option value="5" {{ $complaint->satisfaction_rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4" {{ $complaint->satisfaction_rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ Good</option>
                            <option value="3" {{ $complaint->satisfaction_rating == 3 ? 'selected' : '' }}>⭐⭐⭐ Average</option>
                            <option value="2" {{ $complaint->satisfaction_rating == 2 ? 'selected' : '' }}>⭐⭐ Poor</option>
                            <option value="1" {{ $complaint->satisfaction_rating == 1 ? 'selected' : '' }}>⭐ Very Poor</option>
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

<script>
function showFeedbackModal() {
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

    const formData = new FormData(this);
    const data = {
        staff_feedback: formData.get('staff_feedback'),
        satisfaction_rating: formData.get('satisfaction_rating')
    };

    try {
        const response = await fetch(`/staff/complaint/{{ $complaint->id }}/feedback`, {
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
    }
});
</script>

@endsection
