@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modern Page Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Client Complaints Management
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Manage and respond to client complaints efficiently
                    </p>
                </div>

                <!-- Action Buttons -->

                    <button onclick="refreshData()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>

            <!-- Enhanced Statistics Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Complaints</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Multiple NIC Users</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['multiple_nic_users'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Filters Panel -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8 mx-2">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Filters & Search</h3>
                    <button type="button" id="toggleFilters" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 text-sm font-medium">
                        <span class="filter-toggle-text">Show Advanced</span>
                        <svg class="inline-block w-4 h-4 ml-1 transform transition-transform filter-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                <form method="GET" action="{{ route('admin.complaints') }}" class="space-y-4">
                    <!-- Quick Search -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search by reference number, client name, NIC, or complaint details..."
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Advanced Filters (Initially Hidden) -->
                    <div id="advancedFilters" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
                            <select name="priority" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Priorities</option>
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority }}" {{ request('priority') == $priority ? 'selected' : '' }}>
                                        {{ ucfirst($priority) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Multiple Complaints</label>
                            <select name="multiple_complaints" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Complaints</option>
                                <option value="yes" {{ request('multiple_complaints') == 'yes' ? 'selected' : '' }}>
                                    Show Only Multiple NIC Users
                                </option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-4">
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search & Filter
                        </button>
                        <a href="{{ route('admin.complaints') }}" class="inline-flex items-center px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Clear All
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modern Complaints Display -->
        @if($complaints->count() > 0)
            <!-- View Toggle -->
            <div class="flex items-center justify-between mb-6 mx-2">
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">View:</span>
                    <div class="flex bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                        <button onclick="toggleView('cards')" id="cardsViewBtn" class="px-3 py-1 text-sm rounded-md bg-blue-600 text-white transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Cards
                        </button>
                        <button onclick="toggleView('table')" id="tableViewBtn" class="px-3 py-1 text-sm rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18m-18 8h18m-18 4h18"></path>
                            </svg>
                            Table
                        </button>
                    </div>
                </div>
            </div>

            <!-- Legend for Multiple Complaints -->
            @if(request('multiple_complaints') == 'yes' || $complaints->where('has_multiple_complaints', true)->count() > 0)
                <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-800 rounded-xl p-4 mb-6 mx-2">
                    <div class="flex items-center text-sm text-orange-800 dark:text-orange-200">
                        <div class="flex-shrink-0 w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium mb-1">Multiple Complaints Alert</p>
                            <p class="text-xs opacity-90">Highlighted complaints indicate users with multiple submissions from the same NIC. Click the document icon to view all complaints for that user.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Cards View (Default) -->
            <div id="cardsView" class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mx-3">
                @foreach($complaints as $complaint)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-200 {{ $complaint->has_multiple_complaints ? 'ring-2 ring-orange-200 dark:ring-orange-800' : '' }}"
                         id="complaint-card-{{ $complaint->id }}">

                        <!-- Card Header -->
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $complaint->reference_number }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        ID: #{{ $complaint->id }}
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $complaint->priority_color }}">
                                        {{ $complaint->priority_label }}
                                    </span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium status-badge-{{ $complaint->id }} {{ $complaint->status_color }}">
                                        {{ $complaint->status_label }}
                                    </span>
                                </div>
                            </div>

                            <!-- Client Info -->
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $complaint->client_name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        {{ $complaint->client_email }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">NIC: {{ $complaint->nic }}</span>
                                        @if($complaint->has_multiple_complaints)
                                            <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200" title="This NIC has {{ $complaint->complaint_count_for_nic }} complaints">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                                {{ $complaint->complaint_count_for_nic }}
                                            </span>
                                            <button onclick="showAllComplaintsForNIC('{{ $complaint->nic }}')"
                                                    class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                                    title="View all complaints for this NIC">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <!-- Category -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $complaint->category->category_name }}
                                </span>
                                @if($complaint->assigned_to)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        <span class="font-medium">Assigned to:</span> {{ $complaint->assignedTo->name ?? 'Unknown' }}
                                    </div>
                                @endif
                            </div>

                            <!-- Complaint Content -->
                            <div class="mb-4">
                                @if($complaint->complaint_title)
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                        {{ Str::limit($complaint->complaint_title, 50) }}
                                    </h4>
                                @endif
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    {{ Str::limit($complaint->complaint_details, 120) }}
                                </p>
                            </div>

                            <!-- Evidence & Date -->
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-4">
                                <div class="flex items-center">
                                    @if($complaint->hasEvidence())
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        {{ $complaint->getEvidenceCount() }} file(s)
                                    @else
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        No evidence
                                    @endif
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $complaint->created_at->format('M d, Y h:i A') }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 rounded-b-xl border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <!-- Evidence Button -->
                                @if($complaint->hasEvidence())
                                    <button onclick="showEvidenceModal({{ $complaint->id }}, {{ json_encode($complaint->evidence_files) }})"
                                            class="inline-flex items-center px-3 py-2 bg-purple-100 hover:bg-purple-200 text-purple-800 text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        View Evidence
                                    </button>
                                @else
                                    <div></div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex items-center space-x-2">
                                    <button onclick="openReplyModal({{ $complaint->id }}, '{{ $complaint->client_name }}', '{{ $complaint->reference_number }}')"
                                            class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                        Reply
                                    </button>

                                    <button onclick="deleteComplaint({{ $complaint->id }}, '{{ $complaint->reference_number }}')"
                                            class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Ignore
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Table View (Hidden by default) -->
            <div id="tableView" class="hidden bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden mx-3">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-4">Reference</th>
                                <th scope="col" class="px-6 py-4">Client Info</th>
                                <th scope="col" class="px-6 py-4">Category</th>
                                <th scope="col" class="px-6 py-4">Complaint</th>
                                <th scope="col" class="px-6 py-4">Priority</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4">Evidence</th>
                                <th scope="col" class="px-6 py-4">Submitted</th>
                                <th scope="col" class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $complaint)
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 {{ $complaint->has_multiple_complaints ? 'bg-orange-50 dark:bg-orange-900/20' : '' }}" id="complaint-row-{{ $complaint->id }}">
                                    <!-- Reference Number -->
                                    <td class="px-6 py-4">
                                        <div class="font-mono text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $complaint->reference_number }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            ID: #{{ $complaint->id }}
                                        </div>
                                    </td>

                                    <!-- Client Information -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-900 dark:text-white">{{ $complaint->client_name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $complaint->client_email }}</div>
                                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                    <span>NIC: {{ $complaint->nic }}</span>
                                                    @if($complaint->has_multiple_complaints)
                                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                            {{ $complaint->complaint_count_for_nic }} complaints
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Other columns remain the same as original table -->
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                            {{ $complaint->category->category_name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 max-w-xs">
                                        @if($complaint->complaint_title)
                                            <div class="font-medium text-gray-900 dark:text-white text-sm mb-1">
                                                {{ Str::limit($complaint->complaint_title, 30) }}
                                            </div>
                                        @endif
                                        <div class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ Str::limit($complaint->complaint_details, 80) }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $complaint->priority_color }}">
                                            {{ $complaint->priority_label }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium status-badge-{{ $complaint->id }} {{ $complaint->status_color }}">
                                            {{ $complaint->status_label }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($complaint->hasEvidence())
                                            <button onclick="showEvidenceModal({{ $complaint->id }}, {{ json_encode($complaint->evidence_files) }})"
                                                    class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded hover:bg-purple-200">
                                                {{ $complaint->getEvidenceCount() }} file(s)
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-400">No evidence</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $complaint->created_at->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $complaint->created_at->format('h:i A') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <button onclick="openReplyModal({{ $complaint->id }}, '{{ $complaint->client_name }}', '{{ $complaint->reference_number }}')"
                                                    class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                Reply
                                            </button>
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
                </div>
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 px-6 py-4">
                {{ $complaints->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">No complaints found</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        @if(request()->hasAny(['search', 'status', 'priority', 'category']))
                            We couldn't find any complaints matching your current filters. Try adjusting your search criteria or clearing the filters to see all complaints.
                        @else
                            No client complaints have been submitted yet. When clients submit complaints, they will appear here for your review and response.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'status', 'priority', 'category']))
                        <a href="{{ route('admin.complaints') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Clear All Filters
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Evidence Preview Modal -->
<div id="evidenceModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Evidence Files</h3>
                <button id="evidenceModalCloseBtn" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
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
let evidenceModalInstance = null;

function showEvidenceModal(complaintId, evidenceFiles) {
    const modal = document.getElementById('evidenceModal');
    const content = document.getElementById('evidenceContent');

    if (!modal || !content) {
        console.error('Evidence modal elements not found');
        return;
    }

    // Close any existing modal first
    if (evidenceModalInstance) {
        closeEvidenceModal();
    }

    // Clear content
    content.innerHTML = '';

    // Build evidence HTML
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

    // Show modal
    modal.classList.remove('hidden');
    evidenceModalInstance = modal;

    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeEvidenceModal() {
    const modal = document.getElementById('evidenceModal');
    if (!modal) return;

    // Hide modal
    modal.classList.add('hidden');
    evidenceModalInstance = null;

    // Restore body scroll
    document.body.style.overflow = '';

    // Clean up media elements
    const content = document.getElementById('evidenceContent');
    if (content) {
        const videos = content.querySelectorAll('video');
        const audios = content.querySelectorAll('audio');

        videos.forEach(video => {
            try {
                video.pause();
                video.currentTime = 0;
            } catch (e) {
                console.log('Error pausing video:', e);
            }
        });

        audios.forEach(audio => {
            try {
                audio.pause();
                audio.currentTime = 0;
            } catch (e) {
                console.log('Error pausing audio:', e);
            }
        });

        // Clear content after a short delay to prevent flashing
        setTimeout(() => {
            content.innerHTML = '';
        }, 300);
    }
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

// Show all complaints for a specific NIC
function showAllComplaintsForNIC(nic) {
    const currentUrl = new URL(window.location);
    currentUrl.searchParams.set('search', nic);
    currentUrl.searchParams.delete('multiple_complaints'); // Remove the filter to show all complaints for this NIC
    window.location.href = currentUrl.toString();
}

// Toggle between card and table view
function toggleView(viewType) {
    const cardsView = document.getElementById('cardsView');
    const tableView = document.getElementById('tableView');
    const cardsBtn = document.getElementById('cardsViewBtn');
    const tableBtn = document.getElementById('tableViewBtn');

    if (viewType === 'cards') {
        cardsView.classList.remove('hidden');
        tableView.classList.add('hidden');
        cardsBtn.classList.add('bg-blue-600', 'text-white');
        cardsBtn.classList.remove('text-gray-600', 'dark:text-gray-300', 'hover:bg-gray-200', 'dark:hover:bg-gray-600');
        tableBtn.classList.remove('bg-blue-600', 'text-white');
        tableBtn.classList.add('text-gray-600', 'dark:text-gray-300', 'hover:bg-gray-200', 'dark:hover:bg-gray-600');
    } else {
        cardsView.classList.add('hidden');
        tableView.classList.remove('hidden');
        tableBtn.classList.add('bg-blue-600', 'text-white');
        tableBtn.classList.remove('text-gray-600', 'dark:text-gray-300', 'hover:bg-gray-200', 'dark:hover:bg-gray-600');
        cardsBtn.classList.remove('bg-blue-600', 'text-white');
        cardsBtn.classList.add('text-gray-600', 'dark:text-gray-300', 'hover:bg-gray-200', 'dark:hover:bg-gray-600');
    }

    // Store preference in localStorage
    localStorage.setItem('complaintsViewType', viewType);
}


// Refresh data
function refreshData() {
    location.reload();
}

// Toggle advanced filters
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleFilters');
    const advancedFilters = document.getElementById('advancedFilters');
    const toggleText = toggleBtn.querySelector('.filter-toggle-text');
    const toggleArrow = toggleBtn.querySelector('.filter-arrow');

    // Load saved view preference
    const savedView = localStorage.getItem('complaintsViewType') || 'cards';
    toggleView(savedView);

    toggleBtn.addEventListener('click', function() {
        if (advancedFilters.classList.contains('hidden')) {
            advancedFilters.classList.remove('hidden');
            toggleText.textContent = 'Hide Advanced';
            toggleArrow.style.transform = 'rotate(180deg)';
        } else {
            advancedFilters.classList.add('hidden');
            toggleText.textContent = 'Show Advanced';
            toggleArrow.style.transform = 'rotate(0deg)';
        }
    });

    // Auto-submit search form with debounce
    const searchInput = document.querySelector('input[name="search"]');
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500);
        });
    }

    // Evidence Modal Event Listeners
    const evidenceModal = document.getElementById('evidenceModal');
    const evidenceCloseBtn = document.getElementById('evidenceModalCloseBtn');
    const replyModal = document.getElementById('replyModal');

    // Close evidence modal via close button
    if (evidenceCloseBtn) {
        evidenceCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeEvidenceModal();
        });
    }

    // Close modals when clicking on overlay
    if (evidenceModal) {
        evidenceModal.addEventListener('click', function(e) {
            if (e.target === evidenceModal) {
                closeEvidenceModal();
            }
        });
    }

    if (replyModal) {
        replyModal.addEventListener('click', function(e) {
            if (e.target === replyModal) {
                closeReplyModal();
            }
        });
    }

    // ESC key handling
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (evidenceModalInstance) {
                closeEvidenceModal();
            }
            if (replyModal && !replyModal.classList.contains('hidden')) {
                closeReplyModal();
            }
        }
    });
});

</script>

@endsection
