@extends('layouts.app')

@section('content')
<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-in-right {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 5px rgba(59, 130, 246, 0.3), 0 0 10px rgba(147, 51, 234, 0.2), 0 0 15px rgba(34, 197, 94, 0.1);
    }
    50% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.6), 0 0 30px rgba(147, 51, 234, 0.4), 0 0 40px rgba(34, 197, 94, 0.3);
    }
}

/* Dark mode pulse-glow for red theme */
.dark .animate-pulse-glow {
    animation: pulse-glow-dark 2s ease-in-out infinite;
}

@keyframes pulse-glow-dark {
    0%, 100% {
        box-shadow: 0 0 5px rgba(239, 68, 68, 0.3);
    }
    50% {
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.6), 0 0 30px rgba(239, 68, 68, 0.4);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.animate-slide-in-right {
    animation: slide-in-right 0.6s ease-out forwards;
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}

.stat-card {
    opacity: 0;
    animation: fade-in-up 0.6s ease-out forwards;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }
.stat-card:nth-child(5) { animation-delay: 0.5s; }

.complaint-card {
    opacity: 0;
    animation: fade-in-up 0.6s ease-out forwards;
}

.complaint-card:nth-child(1) { animation-delay: 0.2s; }
.complaint-card:nth-child(2) { animation-delay: 0.3s; }
.complaint-card:nth-child(3) { animation-delay: 0.4s; }
.complaint-card:nth-child(4) { animation-delay: 0.5s; }
.complaint-card:nth-child(5) { animation-delay: 0.6s; }

/* Floating background elements */
.bg-floating {
    position: absolute;
    border-radius: 50%;
    opacity: 0.05;
    animation: float 8s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

.bg-floating:nth-child(1) {
    top: 5%; left: 5%; width: 100px; height: 100px;
    animation-delay: 0s; background: linear-gradient(135deg, #3b82f6, #8b5cf6);
}
.bg-floating:nth-child(2) {
    top: 15%; right: 10%; width: 80px; height: 80px;
    animation-delay: 3s; background: linear-gradient(135deg, #8b5cf6, #22c55e);
}
.bg-floating:nth-child(3) {
    bottom: 20%; left: 15%; width: 60px; height: 60px;
    animation-delay: 6s; background: linear-gradient(135deg, #22c55e, #3b82f6);
}
.bg-floating:nth-child(4) {
    bottom: 5%; right: 20%; width: 90px; height: 90px;
    animation-delay: 9s; background: linear-gradient(135deg, #3b82f6, #8b5cf6);
}

/* Dark mode floating elements */
.dark .bg-floating:nth-child(1) {
    background: #ef4444;
}
.dark .bg-floating:nth-child(2) {
    background: #000000;
}
.dark .bg-floating:nth-child(3) {
    background: #ef4444;
}
.dark .bg-floating:nth-child(4) {
    background: #000000;
}
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-100 to-purple-100 dark:from-black dark:via-gray-900 dark:to-red-950 mt-12 relative overflow-hidden">
    <!-- Floating Background Elements -->
    <div class="bg-floating"></div>
    <div class="bg-floating"></div>
    <div class="bg-floating"></div>
    <div class="bg-floating"></div>

    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/8 dark:bg-red-600/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/8 dark:bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 right-1/4 w-60 h-60 bg-green-500/8 dark:bg-red-600/3 rounded-full blur-3xl animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        <!-- Header Section -->
        <div class="mb-8 animate-fade-in-up">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6">
                <div>
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-blue-200/50 via-purple-200/50 to-green-200/50 dark:from-red-600/20 dark:to-red-700/20 border border-blue-300/50 dark:border-red-500/30 text-blue-700 dark:text-red-400 text-sm font-medium mb-4 backdrop-blur-sm">
                        <svg class="w-4 h-4 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Complaint Tracking Dashboard
                    </div>
                    <h1 class="text-4xl font-black text-transparent bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-white dark:to-red-400 bg-clip-text mb-3">
                        My Complaint History
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg">
                        Track your complaints, view solutions, and communicate with our support team
                    </p>
                </div>
                <div class="mt-4 lg:mt-0 animate-slide-in-right">
                    <a href="{{ route('client.complain') }}" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 dark:from-red-600 dark:to-black dark:hover:from-red-700 dark:hover:to-gray-900 text-white rounded-xl text-sm font-bold transition-all duration-300 hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-blue-500/25 dark:hover:shadow-red-500/25 relative overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-white/10 to-purple-500/0 dark:from-red-500/0 dark:via-white/10 dark:to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="relative z-10">New Complaint</span>
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="stat-card bg-white/90 dark:bg-black/90 backdrop-blur-lg rounded-2xl shadow-xl border border-blue-200/30 dark:border-red-800/30 p-6 hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 dark:from-red-500 dark:to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-red-400 transition-colors duration-300">Total</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/90 dark:bg-black/90 backdrop-blur-lg rounded-2xl shadow-xl border border-orange-200/30 dark:border-red-800/30 p-6 hover:shadow-2xl hover:shadow-orange-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-yellow-500 dark:from-yellow-500 dark:to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-300">Pending</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['pending'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/90 dark:bg-black/90 backdrop-blur-lg rounded-2xl shadow-xl border border-green-200/30 dark:border-red-800/30 p-6 hover:shadow-2xl hover:shadow-green-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 dark:from-green-500 dark:to-emerald-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">Resolved</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['resolved'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/90 dark:bg-black/90 backdrop-blur-lg rounded-2xl shadow-xl border border-purple-200/30 dark:border-red-800/30 p-6 hover:shadow-2xl hover:shadow-purple-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-500 dark:from-blue-500 dark:to-indigo-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-purple-600 dark:group-hover:text-blue-400 transition-colors duration-300">In Progress</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['in_progress'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/90 dark:bg-black/90 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200/30 dark:border-red-800/30 p-6 hover:shadow-2xl hover:shadow-gray-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-gray-600 dark:from-black dark:to-gray-700 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-400 transition-colors duration-300">Closed</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['closed'] }}</p>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Complaints List -->
        @if($complaints->count() > 0)
            <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.4s;">
                @foreach($complaints as $complaint)
                    <div class="bg-white/90 dark:bg-black/90 backdrop-blur-lg rounded-2xl shadow-xl border border-blue-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 hover:scale-102 hover:-translate-y-1 group relative overflow-hidden"
                         id="complaint-card-{{ $complaint->id }}">

                        <!-- Animated border gradient -->
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/20 to-red-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <!-- Card Header -->
                        <div class="p-6 border-b border-red-100/50 dark:border-red-800/30 relative z-10">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2 flex-wrap">
                                        <h3 class="text-lg font-black text-gray-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-300">
                                            {{ $complaint->reference_number }}
                                        </h3>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $complaint->status_color }} shadow-lg animate-pulse">
                                            {{ $complaint->status_label }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $complaint->priority_color }} shadow-lg">
                                            {{ $complaint->priority_label }}
                                        </span>
                                    </div>

                                    @if($complaint->complaint_title)
                                        <h4 class="text-md font-bold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-300">
                                            {{ $complaint->complaint_title }}
                                        </h4>
                                    @endif

                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 leading-relaxed">
                                        {{ Str::limit($complaint->complaint_details, 200) }}
                                    </p>

                                    <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 flex-wrap">
                                        <span class="flex items-center bg-red-50 dark:bg-red-950/50 px-2 py-1 rounded-lg">
                                            <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            {{ $complaint->category->category_name }}
                                        </span>
                                        <span class="flex items-center bg-gray-50 dark:bg-gray-800/50 px-2 py-1 rounded-lg">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $complaint->created_at->format('M d, Y h:i A') }}
                                        </span>
                                        @if($complaint->getConversationCount() > 0)
                                            <span class="flex items-center bg-blue-50 dark:bg-blue-950/50 px-2 py-1 rounded-lg">
                                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="p-6 relative z-10">
                            <!-- Current Solution/Last Admin Message -->
                            @if($complaint->solution || $complaint->getLastMessage())
                                <div class="mb-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/30 rounded-xl border-l-4 border-blue-500 shadow-lg">
                                    <h5 class="text-sm font-black text-blue-900 dark:text-blue-300 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                        Latest Update
                                    </h5>
                                    @php
                                        $lastMessage = $complaint->getLastMessage();
                                    @endphp
                                    @if($lastMessage && $lastMessage['sender_type'] === 'admin')
                                        <p class="text-sm text-blue-800 dark:text-blue-200 font-medium">
                                            {{ $lastMessage['message'] }}
                                        </p>
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1 font-bold">
                                            - {{ $lastMessage['sender_name'] }} ({{ \Carbon\Carbon::parse($lastMessage['timestamp'])->format('M d, Y h:i A') }})
                                        </p>
                                    @elseif($complaint->solution)
                                        <p class="text-sm text-blue-800 dark:text-blue-200 font-medium">{{ $complaint->solution }}</p>
                                    @endif
                                </div>
                            @endif

                            <!-- Evidence Files -->
                            @if($complaint->hasEvidence())
                                <div class="mb-4">
                                    <h5 class="text-sm font-black text-gray-700 dark:text-gray-300 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Evidence Files
                                    </h5>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($complaint->evidence_files as $index => $file)
                                            <a href="{{ route('client.complaint.evidence', ['id' => $complaint->id, 'fileIndex' => $index]) }}"
                                               class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-300 rounded-xl text-xs font-bold hover:from-red-100 hover:to-red-200 dark:hover:from-red-900/50 dark:hover:to-red-800/50 hover:text-red-700 dark:hover:text-red-300 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50/80 to-red-50/80 dark:from-gray-800/50 dark:to-red-950/50 border-t border-red-100/50 dark:border-red-800/30 relative z-10">
                            <div class="flex items-center justify-between flex-wrap gap-3">
                                <div class="flex items-center gap-2">
                                    <!-- Conversation Button -->
                                    <button onclick="openConversationModal({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                            class="group inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-blue-500/25 relative overflow-hidden">
                                        <span class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-white/10 to-blue-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                                        <svg class="w-4 h-4 mr-2 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="relative z-10">Chat</span>
                                    </button>

                                    <!-- Close Complaint Button (only for resolved complaints) -->
                                    @if($complaint->status === 'resolved' && $complaint->status !== 'closed')
                                        <button onclick="openCloseModal({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                                class="group inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-bold rounded-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-green-500/25 relative overflow-hidden">
                                            <span class="absolute inset-0 bg-gradient-to-r from-green-500/0 via-white/10 to-green-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                                            <svg class="w-4 h-4 mr-2 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="relative z-10">Close Complaint</span>
                                        </button>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3 justify-between flex-wrap">
                                    <!-- Send to Senior Board Button -->
                                    @if(!in_array($complaint->status, ['closed', 'rejected']))
                                        <button onclick="showSeniorBoardModal({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                                class="group inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-sm font-bold rounded-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-purple-500/25 relative overflow-hidden">
                                            <span class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-white/10 to-purple-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                                            <svg class="w-4 h-4 mr-2 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8m-8 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-8 0L5 3"></path>
                                            </svg>
                                            <span class="relative z-10">Senior Board</span>
                                        </button>
                                    @endif

                                    <!-- Status Timeline -->
                                    <div class="flex items-center text-xs font-bold">
                                        @if($complaint->resolved_at)
                                            <div class="flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-lg">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Resolved: {{ $complaint->resolved_at->format('M d, Y') }}
                                            </div>
                                        @elseif($complaint->closed_at)
                                            <div class="flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Closed: {{ $complaint->closed_at->format('M d, Y') }}
                                            </div>
                                        @else
                                            <div class="flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 rounded-lg">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Created: {{ $complaint->created_at->format('M d, Y') }}
                                            </div>
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
            <div class="text-center py-16 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl animate-bounce" style="animation-duration: 3s;">
                        <svg class="w-12 h-12 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-transparent bg-gradient-to-r from-black to-red-600 dark:from-white dark:to-red-400 bg-clip-text mb-3">No Complaints Found</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 text-lg leading-relaxed">
                        You haven't submitted any complaints yet. When you do, they'll appear here for tracking and communication with our support team.
                    </p>
                    <a href="{{ route('client.complain') }}" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 text-white rounded-xl text-sm font-bold transition-all duration-300 hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-red-500/25 relative overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="relative z-10">Submit Your First Complaint</span>
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
