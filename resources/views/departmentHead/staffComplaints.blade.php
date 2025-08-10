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
                        Staff Complaints Review
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg">
                        {{ $department->name }} Department - Review and respond to staff complaints
                    </p>
                </div>
                <div class="mt-4 lg:mt-0">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 shadow-lg">
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="text-center">
                                <div class="font-bold text-gray-900 dark:text-white">{{ $complaints->count() }}</div>
                                <div class="text-gray-500 dark:text-gray-400">Total</div>
                            </div>
                            <div class="text-center">
                                <div class="font-bold text-yellow-600">{{ $complaints->where('status', 'pending')->count() }}</div>
                                <div class="text-gray-500 dark:text-gray-400">Pending</div>
                            </div>
                            <div class="text-center">
                                <div class="font-bold text-green-600">{{ $complaints->where('status', 'resolved')->count() }}</div>
                                <div class="text-gray-500 dark:text-gray-400">Resolved</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($complaints->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-blue-100 dark:from-purple-900/30 dark:to-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No Staff Complaints</h3>
                <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                    There are currently no complaints from staff members in your department.
                </p>
            </div>
        @else
            <!-- Complaints List -->
            <div class="space-y-6">
                @foreach($complaints as $complaint)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 group overflow-hidden">
                    <!-- Status indicator bar -->
                    <div class="h-1 bg-gradient-to-r
                        {{ $complaint->status === 'pending' ? 'from-yellow-400 to-yellow-500' :
                        ($complaint->status === 'in_review' ? 'from-blue-400 to-blue-500' :
                        ($complaint->status === 'resolved' ? 'from-green-400 to-green-500' :
                        ($complaint->status === 'rejected' ? 'from-red-400 to-red-500' :
                            'from-gray-400 to-gray-500'))) }}">
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                        {{ $complaint->complaint_title }}
                                    </h3>
                                   <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                        ($complaint->status === 'in_review' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' :
                                        ($complaint->status === 'resolved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                                        ($complaint->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                                            'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400'))) }}">
                                        {{ ucfirst($complaint->status) }}
                                    </span>

                                </div>

                                <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $complaint->staffMember->user->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                                        </svg>
                                        <span>{{ $complaint->reference_number }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $complaint->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>

                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                    {{ Str::limit($complaint->complaint_details, 200) }}
                                </p>

                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-1 rounded-lg text-xs font-medium
                                        {{ $complaint->priority === 'low' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                                        ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                        ($complaint->priority === 'high' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' :
                                        ($complaint->priority === 'urgent' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : ''))) }}">
                                        {{ ucfirst($complaint->priority) }} Priority
                                    </span>


                                    @if($complaint->evidence_files && count($complaint->evidence_files) > 0)
                                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-xs font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                            {{ count($complaint->evidence_files) }} file(s)
                                        </span>
                                    @endif

                                    @if($complaint->department_responses && count($complaint->department_responses) > 0)
                                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded-lg text-xs font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ count($complaint->department_responses) }} response(s)
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 ml-4">
                                <a href="{{ route('department.head.staff.complaint.show', $complaint) }}"
                                   class="px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 shadow-lg hover:shadow-purple-500/25 text-sm text-center">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Review
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
