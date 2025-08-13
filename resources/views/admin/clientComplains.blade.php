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
                <!-- Debug Info -->
                <div class="col-span-full mb-4 p-4 bg-yellow-100 border border-yellow-400 rounded">
                    <strong>Debug Info:</strong>
                    Total complaints loaded: {{ $complaints->count() }}
                    @if($complaints->count() > 0)
                        | First complaint ID: {{ $complaints->first()->id }}
                    @endif
                </div>

                @forelse($complaints as $complaint)
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

                                <!-- Action Buttons - Responsive Layout -->
                                <div class="flex flex-wrap gap-2 mt-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    @php
                                        $hasActiveAssignments = $complaint->activeAssignments()->exists();
                                    @endphp

                                    @if(!$hasActiveAssignments)
                                        <!-- Assign button - only show if not assigned -->
                                        <button onclick="openAssignModal({{ $complaint->id }}, {{ json_encode($complaint->client_name) }}, {{ json_encode($complaint->reference_number) }})"
                                                class="flex-1 min-w-0 sm:flex-none inline-flex items-center justify-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span class="hidden sm:inline">Assign to Departments</span>

                                        </button>
                                    @else
                                        <!-- Assignment status - show when already assigned -->
                                        <div class="flex-1 min-w-0 sm:flex-none inline-flex items-center justify-center px-3 py-2 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-sm font-medium rounded-lg">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="hidden sm:inline">Assigned ✓</span>

                                        </div>
                                    @endif

                                    @if($hasActiveAssignments)
                                        <!-- Discussion button - only show if assigned -->
                                        @php
                                            $unreadCount = $complaint->getUnreadDiscussionCount();
                                        @endphp
                                        <button onclick="openDiscussionModal({{ $complaint->id }}, {{ json_encode($complaint->client_name) }}, {{ json_encode($complaint->reference_number) }})"
                                                class="relative flex-1 min-w-0 sm:flex-none inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.955 8.955 0 01-3.9-.9L3 21l1.9-5.1A8.955 8.955 0 013 12a8 8 0 1118 0z"></path>
                                            </svg>
                                            <span class="hidden sm:inline">Discussion with Departments</span>
                                            @if($unreadCount > 0)
                                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                                </span>
                                            @endif
                                        </button>
                                    @endif

                                    <!-- Reply button - always available -->
                                    <button onclick="openReplyModal({{ $complaint->id }}, {{ json_encode($complaint->client_name) }}, {{ json_encode($complaint->reference_number) }})"
                                            class="flex-1 min-w-0 sm:flex-none inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                        <span class="hidden sm:inline">Reply to Client</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-8 text-center bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Complaints Found</h3>
                        <p class="text-gray-500 dark:text-gray-400">There are currently no complaints to display.</p>
                    </div>
                @endforelse
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
                                            @php
                                                $hasActiveAssignments = $complaint->activeAssignments()->exists();
                                            @endphp

                                            @if(!$hasActiveAssignments)
                                                <!-- Show Assign button only if no active assignments -->
                                                <button onclick="openAssignModal({{ $complaint->id }}, {{ json_encode($complaint->client_name) }}, {{ json_encode($complaint->reference_number) }})"
                                                        class="px-3 py-1 bg-purple-600 text-white text-xs rounded hover:bg-purple-700 transition-colors">
                                                    Assign
                                                </button>
                                            @else
                                                <!-- Show assignment status -->
                                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded">
                                                    Assigned
                                                </span>
                                            @endif

                                            @if($hasActiveAssignments)
                                                <!-- Show Discussion button only if assigned -->
                                                @php
                                                    $unreadCount = $complaint->getUnreadDiscussionCount();
                                                @endphp
                                                <button onclick="openDiscussionModal({{ $complaint->id }}, {{ json_encode($complaint->client_name) }}, {{ json_encode($complaint->reference_number) }})"
                                                        class="relative px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition-colors">
                                                    Discussion
                                                    @if($unreadCount > 0)
                                                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                                                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                                        </span>
                                                    @endif
                                                </button>
                                            @endif

                                            <button onclick="openReplyModal({{ $complaint->id }}, {{ json_encode($complaint->client_name) }}, {{ json_encode($complaint->reference_number) }})"
                                                    class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                Reply
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
<div id="evidenceModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 dark:border-gray-600">
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

<!-- Media Preview Modal -->
<div id="mediaPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-90 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-6xl w-full max-h-[95vh] overflow-hidden border border-gray-200 dark:border-gray-600">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="modal-title text-lg font-semibold text-gray-900 dark:text-white">File Preview</h3>
                <button id="mediaPreviewCloseBtn" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body p-4 flex items-center justify-center max-h-[80vh] overflow-auto">
                <!-- Media content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] border border-gray-200 dark:border-gray-600">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Conversation</h3>
                <button id="replyModalCloseBtn" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Complaint Info Header -->
            <div class="p-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <!-- Complaint Basic Info -->
                <div class="mb-4">
                    <div id="complaintInfo" class="font-medium text-gray-900 dark:text-white mb-2"></div>
                    <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                        <span>Status: <span id="currentStatus" class="font-medium"></span></span>
                        <span>Priority: <span id="currentPriority" class="font-medium"></span></span>
                        <span>Total Messages: <span id="messageCount" class="font-medium">0</span></span>
                    </div>
                </div>

                <!-- Complaint Details Section -->
                <div id="complaintDetails" class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                    <!-- Complaint Title -->
                    <div id="complaintTitleSection" class="mb-3 hidden">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Complaint Title:</h4>
                        <p id="complaintTitle" class="text-sm text-gray-900 dark:text-white font-medium"></p>
                    </div>

                    <!-- Complaint Description -->
                    <div class="mb-3">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Description:</h4>
                        <div id="complaintDescription" class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 p-3 rounded border max-h-24 overflow-y-auto"></div>
                    </div>

                    <!-- Additional Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                        <div>
                            <span class="font-medium text-gray-600 dark:text-gray-400">Category:</span>
                            <span id="complaintCategory" class="text-gray-900 dark:text-white ml-1"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600 dark:text-gray-400">Submitted:</span>
                            <span id="complaintDate" class="text-gray-900 dark:text-white ml-1"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600 dark:text-gray-400">Evidence:</span>
                            <span id="complaintEvidence" class="text-gray-900 dark:text-white ml-1"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conversation Thread -->
            <div class="flex-1 overflow-hidden bg-white dark:bg-gray-800">
                <div id="conversationThread" class="h-96 overflow-y-auto p-6 bg-gray-50 dark:bg-gray-900 border-t border-b border-gray-200 dark:border-gray-700">
                    <div id="conversationMessages">
                        <!-- Messages will be loaded here -->
                        <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                            <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="font-medium">Loading conversation...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Message Form -->
            <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <form id="replyForm">
                    <input type="hidden" id="complaintId" name="complaint_id">

                    <!-- Form Header -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Send Reply</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Update the complaint status and send a message to the client</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Update Status</label>
                            <select id="status" name="status" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm" required>
                                <option value="" class="text-gray-500 dark:text-gray-400">Select status...</option>
                                <option value="pending" class="text-gray-900 dark:text-gray-100">Pending</option>
                                <option value="in_progress" class="text-gray-900 dark:text-gray-100">In Progress</option>
                                <option value="resolved" class="text-gray-900 dark:text-gray-100">Resolved</option>
                                <option value="closed" class="text-gray-900 dark:text-gray-100">Closed</option>
                                <option value="rejected" class="text-gray-900 dark:text-gray-100">Rejected</option>
                            </select>
                        </div>
                        <div>
                            <label for="admin_notes" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Admin Notes (Internal)</label>
                            <input type="text" id="admin_notes" name="admin_notes"
                                   class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm"
                                   placeholder="Internal notes (not visible to client)...">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Message to Client</label>
                        <textarea id="message" name="message" rows="4"
                                  class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm resize-none"
                                  placeholder="Type your response or solution to the client..."></textarea>
                        <div class="mt-2 flex items-start space-x-2">
                            <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">This message will be visible to the client and added to the conversation thread. Be professional and helpful in your response.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button type="button" id="cancelReplyBtn"
                                class="w-full sm:w-auto px-6 py-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 transition-colors font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium shadow-sm">
                            <span class="submit-text flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send Reply
                            </span>
                            <span class="loading-text hidden">
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Sending...
                                </div>
                            </span>
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

<!-- Assignment Modal -->
<div id="assignModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] border border-gray-200 dark:border-gray-600">
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Assign Complaint</h3>
                <button id="assignModalCloseBtn" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Complaint Info Header -->
            <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <div id="assignComplaintInfo" class="font-medium text-gray-900 dark:text-white mb-2"></div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Select departments and set assignment details
                </div>
            </div>

            <!-- Assignment Form -->
            <div class="p-6">
                <form id="assignForm">
                    <input type="hidden" id="assignComplaintId" name="complaint_id">

                    <!-- Department Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Select Departments</label>
                        @if(isset($departments) && count($departments) > 0)
                            <div id="departmentsList" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($departments as $department)
                                    <label class="flex items-center p-3 border-2 border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                                        <input type="checkbox" name="departments[]" value="{{ $department->id }}"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600">
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $department->name }}</div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400">
                                                Head: {{ $department->headOfDepartment->name ?? 'Not assigned' }}
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg">
                                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <p class="text-gray-600 dark:text-gray-400 font-medium">No departments available</p>
                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">All departments must have assigned heads to be available for complaint assignment.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Priority and Deadline -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="assignPriority" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Priority</label>
                            <select id="assignPriority" name="priority" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <div>
                            <label for="assignDeadline" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Deadline</label>
                            <input type="datetime-local" id="assignDeadline" name="deadline"
                                   class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <!-- Assignment Notes -->
                    <div class="mb-6">
                        <label for="assignmentNotes" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Assignment Notes</label>
                        <textarea id="assignmentNotes" name="assignment_notes" rows="3"
                                  class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                  placeholder="Special instructions or notes for the assigned departments..."></textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button type="button" id="cancelAssignBtn"
                                class="w-full sm:w-auto px-6 py-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500 focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors font-medium shadow-sm">
                            <span class="assign-submit-text flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Assign Complaint
                            </span>
                            <span class="assign-loading-text hidden">
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Assigning...
                                </div>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Discussion Modal -->
<div id="discussionModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-7xl w-full max-h-[95vh] border border-gray-200 dark:border-gray-600 flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Department Discussions</h3>
                    <div id="discussionComplaintInfo" class="text-sm text-gray-600 dark:text-gray-400 mt-1"></div>
                </div>
                <button id="discussionModalCloseBtn" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Main Content Area -->
            <div class="flex flex-1 overflow-hidden">
                <!-- Assignments Sidebar -->
                <div class="w-1/3 border-r border-gray-200 dark:border-gray-700 flex flex-col">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Assigned Departments</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Click to view discussion</p>
                    </div>
                    <div id="assignmentsList" class="flex-1 overflow-y-auto">
                        <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                            <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <p class="font-medium">Loading assignments...</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-1 flex flex-col">
                    <!-- Chat Header -->
                    <div id="chatHeader" class="p-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 hidden">
                        <div class="flex items-center justify-between">
                            <div>
                                <h5 id="chatDepartmentName" class="font-semibold text-gray-900 dark:text-white"></h5>
                                <p id="chatAssignmentInfo" class="text-sm text-gray-600 dark:text-gray-400"></p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span id="chatStatus" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4 hidden">
                        <!-- Messages will be loaded here -->
                    </div>

                    <!-- Default State -->
                    <div id="defaultChatState" class="flex-1 flex items-center justify-center">
                        <div class="text-center text-gray-600 dark:text-gray-300">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.955 8.955 0 01-3.9-.9L3 21l1.9-5.1A8.955 8.955 0 013 12a8 8 0 1118 0z"></path>
                            </svg>
                            <p class="font-medium text-lg">Select an Assignment</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Choose a department assignment to view and respond to discussions</p>
                        </div>
                    </div>

                    <!-- Message Input Area -->
                    <div id="messageInputArea" class="p-4 border-t border-gray-200 dark:border-gray-700 hidden">
                        <form id="adminResponseForm" class="space-y-3">
                            <div class="flex space-x-3">
                                <div class="flex-1">
                                    <textarea
                                        id="adminMessageInput"
                                        placeholder="Type your response to the department..."
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"></textarea>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label class="flex items-center justify-center w-12 h-12 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                        <input type="file" id="adminMessageFile" name="file" accept="image/*,video/*,.pdf,.doc,.docx" class="hidden">
                                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                    </label>
                                    <button
                                        type="submit"
                                        class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div id="filePreview" class="hidden bg-gray-50 dark:bg-gray-700 p-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div id="fileIcon" class="flex-shrink-0"></div>
                                        <div>
                                            <p id="fileName" class="text-sm font-medium text-gray-900 dark:text-white"></p>
                                            <p id="fileSize" class="text-xs text-gray-600 dark:text-gray-400"></p>
                                        </div>
                                    </div>
                                    <button type="button" onclick="clearFileSelection()" class="text-red-600 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                  '{{ csrf_token() }}';

// Simple test function
// window.simpleTest = function() {
//     console.log('✅ Simple test function works!');
//     alert('JavaScript is working! Check console for details.');

//     // Check for modal elements
//     const assignModal = document.getElementById('assignModal');
//     const discussionModal = document.getElementById('discussionModal');
//     const replyModal = document.getElementById('replyModal');

//     console.log('Modal elements check:', {
//         assignModal: !!assignModal,
//         discussionModal: !!discussionModal,
//         replyModal: !!replyModal
//     });

//     // Check for complaint cards
//     const complaintCards = document.querySelectorAll('[id^="complaint-card-"]');
//     console.log('Found complaint cards:', complaintCards.length);

//     // Check for buttons
//     const assignButtons = document.querySelectorAll('[onclick*="openAssignModal"]');
//     const discussionButtons = document.querySelectorAll('[onclick*="openDiscussionModal"]');
//     const replyButtons = document.querySelectorAll('[onclick*="openReplyModal"]');

//     console.log('Button counts:', {
//         assign: assignButtons.length,
//         discussion: discussionButtons.length,
//         reply: replyButtons.length
//     });

//     return true;
// };

// Test function to check if JavaScript is working
// window.testJS = function() {
//     console.log('JavaScript is working!');
//     alert('JavaScript is working!');
//     return true;
// };

// Comprehensive test function for all modal functionality
// window.testAllFunctionality = function() {
//     console.log('Testing all complaint management functionality...');

//     // Get first complaint card
//     const firstCard = document.querySelector('[id^="complaint-card-"]');
//     if (!firstCard) {
//         alert('No complaint cards found! Make sure there are complaints to test with.');
//         return false;
//     }

//     const complaintId = firstCard.id.replace('complaint-card-', '');
//     console.log('Found complaint ID:', complaintId);

//     // Test 1: View Toggle
//     console.log('1. Testing view toggle...');
//     try {
//         toggleView('table');
//         setTimeout(() => {
//             toggleView('cards');
//             console.log('✅ View toggle working');
//         }, 500);
//     } catch (error) {
//         console.error('❌ View toggle failed:', error);
//     }

//     // Test 2: Modal Functions
//     setTimeout(() => {
//         console.log('2. Testing modal functions...');

//         // Test assign modal
//         try {
//             openAssignModal(complaintId, 'Test Client', 'TEST-001');
//             setTimeout(() => {
//                 closeAssignModal();
//                 console.log('✅ Assign modal working');

//                 // Test discussion modal
//                 try {
//                     openDiscussionModal(complaintId, 'Test Client', 'TEST-001');
//                     setTimeout(() => {
//                         closeDiscussionModal();
//                         console.log('✅ Discussion modal working');

//                         // Test reply modal
//                         try {
//                             openReplyModal(complaintId, 'Test Client', 'TEST-001');
//                             setTimeout(() => {
//                                 document.getElementById('cancelReplyBtn')?.click();
//                                 console.log('✅ Reply modal working');

//                                 alert('All functionality tests completed! Check console for detailed results.');
//                             }, 1000);
//                         } catch (error) {
//                             console.error('❌ Reply modal failed:', error);
//                         }
//                     }, 1000);
//                 } catch (error) {
//                     console.error('❌ Discussion modal failed:', error);
//                 }
//             }, 1000);
//         } catch (error) {
//             console.error('❌ Assign modal failed:', error);
//         }
//     }, 1000);

//     return true;
// };

// Test all modal opening functions directly
// window.testAllModals = function() {
//     console.log('Testing modal functions...');

//     // Get first complaint ID from the page
//     const firstCard = document.querySelector('[id^="complaint-card-"]');
//     if (!firstCard) {
//         alert('No complaint cards found!');
//         return false;
//     }

//     const complaintId = firstCard.id.replace('complaint-card-', '');
//     console.log('Found complaint ID:', complaintId);

//     // Test assign modal
//     console.log('Testing assign modal...');
//     try {
//         openAssignModal(complaintId, 'Test Client', 'TEST-001');
//         alert('Assign modal test completed - check if modal opened');
//     } catch (error) {
//         console.error('Assign modal error:', error);
//         alert('Assign modal failed: ' + error.message);
//     }

//     return true;
// };

// Essential Modal Functions - Simplified and Working

// Quick button click test
// window.testButtonClicks = function() {
//     console.log('🧪 Testing button clicks...');

//     // Find first complaint card
//     const firstCard = document.querySelector('[id^="complaint-card-"]');
//     if (!firstCard) {
//         alert('No complaint cards found to test!');
//         return false;
//     }

//     console.log('Found complaint card:', firstCard.id);

//     // Test assign button
//     const assignBtn = firstCard.querySelector('[onclick*="openAssignModal"]');
//     if (assignBtn) {
//         console.log('Testing assign button...');
//         assignBtn.click();
//         setTimeout(() => {
//             closeAssignModal();
//             console.log('✅ Assign button works!');
//         }, 500);
//     } else {
//         console.log('❌ Assign button not found');
//     }

//     // Test discussion button
//     setTimeout(() => {
//         const discussionBtn = firstCard.querySelector('[onclick*="openDiscussionModal"]');
//         if (discussionBtn) {
//             console.log('Testing discussion button...');
//             discussionBtn.click();
//             setTimeout(() => {
//                 closeDiscussionModal();
//                 console.log('✅ Discussion button works!');
//             }, 500);
//         } else {
//             console.log('❌ Discussion button not found');
//         }
//     }, 1000);

//     // Test reply button
//     setTimeout(() => {
//         const replyBtn = firstCard.querySelector('[onclick*="openReplyModal"]');
//         if (replyBtn) {
//             console.log('Testing reply button...');
//             replyBtn.click();
//             setTimeout(() => {
//                 closeReplyModal();
//                 console.log('✅ Reply button works!');
//                 alert('Button click tests completed! Check console for results.');
//             }, 500);
//         } else {
//             console.log('❌ Reply button not found');
//         }
//     }, 2000);

//     return true;
// };

// Essential Modal Functions - Simplified and Working
let assignModalInstance = null;
let discussionModalInstance = null;
let replyModalInstance = null;
let evidenceModalInstance = null;

// Assignment Modal
function openAssignModal(complaintId, clientName, referenceNumber) {


    const modal = document.getElementById('assignModal');
    if (!modal) {
        alert('Assign modal not found!');
        return;
    }

    const complaintInfo = document.getElementById('assignComplaintInfo');
    const complaintIdInput = document.getElementById('assignComplaintId');

    if (complaintInfo) {
        complaintInfo.textContent = `${referenceNumber} - ${clientName}`;
    }
    if (complaintIdInput) {
        complaintIdInput.value = complaintId;
    }

    modal.classList.remove('hidden');
    assignModalInstance = modal;
}

function closeAssignModal() {
    const modal = document.getElementById('assignModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    assignModalInstance = null;
    location.reload();
}

// Discussion Modal with Chat Interface
function openDiscussionModal(complaintId, clientName, referenceNumber) {


    const modal = document.getElementById('discussionModal');
    if (!modal) {
        alert('Discussion modal not found!');
        return;
    }

    const complaintInfo = document.getElementById('discussionComplaintInfo');
    if (complaintInfo) {
        complaintInfo.textContent = `Complaint: ${referenceNumber} - ${clientName}`;
    }

    // Store current complaint ID globally
    window.currentDiscussionComplaintId = complaintId;

    modal.classList.remove('hidden');
    discussionModalInstance = modal;

    // Reset chat area to default state
    resetChatArea();

    // Load assignments for this complaint and auto-display conversations
    loadComplaintAssignmentsAndDiscussions(complaintId);
}

function loadComplaintAssignmentsAndDiscussions(complaintId) {


    const assignmentsList = document.getElementById('assignmentsList');
    if (!assignmentsList) {
        return;
    }

    assignmentsList.innerHTML = `
        <div class="p-4 text-center">
            <div class="animate-spin w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full mx-auto mb-3"></div>
            <p class="text-gray-600 dark:text-gray-400">Loading assignments...</p>
        </div>
    `;

    fetch(`/complaints/${complaintId}/assignments`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        if (data.success) {
            displayAssignmentsWithDiscussions(data.assignments);
        } else {
            throw new Error(data.message || 'Failed to load assignments');
        }
    })
    .catch(error => {
        assignmentsList.innerHTML = `
            <div class="p-4 text-center text-red-600 dark:text-red-400">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm font-medium">Error loading assignments</p>
                <p class="text-xs">${error.message}</p>
                <button onclick="loadComplaintAssignmentsAndDiscussions(${complaintId})" class="mt-2 text-blue-600 hover:text-blue-700 text-sm underline">
                    Retry
                </button>
            </div>
        `;
    });
}

function displayAssignmentsWithDiscussions(assignments) {

    const assignmentsList = document.getElementById('assignmentsList');
    if (!assignments || assignments.length === 0) {
        assignmentsList.innerHTML = `
            <div class="p-4 text-center text-gray-600 dark:text-gray-400">
                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="font-medium">No assignments found</p>
                <p class="text-sm mt-1">This complaint hasn't been assigned to any department yet.</p>
            </div>
        `;
        return;
    }

    // Create assignment list with discussions preview
    const html = assignments.map((assignment, index) => {
        const unreadCount = assignment?.unread_messages_count || 0;
        const assignmentItemId = `assignment-item-${assignment.id}`;

        return `
        <div class="assignment-item border-b border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
             id="${assignmentItemId}"
             onclick="selectAssignmentAndLoadDiscussion(${assignment.id}, '${assignment.department.name}', '${assignment.status}', this)">
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex-1">
                        <h6 class="font-semibold text-gray-900 dark:text-white text-sm">${assignment.department.name}</h6>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Assignment #${assignment.id}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        ${unreadCount > 0 ? `
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                ${unreadCount}
                            </span>
                        ` : ''}
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${getStatusClass(assignment.status)}">
                            ${assignment.status}
                        </span>
                    </div>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-500">
                    Assigned ${formatDate(assignment.created_at)}
                </div>
            </div>
        </div>`;
    }).join('');

    assignmentsList.innerHTML = html;

    // Auto-select first assignment and load its discussion
    if (assignments.length > 0) {
        const firstAssignment = assignments[0];
        setTimeout(() => {
            selectAssignmentAndLoadDiscussion(
                firstAssignment.id,
                firstAssignment.department.name,
                firstAssignment.status,
                document.getElementById(`assignment-item-${firstAssignment.id}`)
            );
        }, 100);
    }
}

function selectAssignmentAndLoadDiscussion(assignmentId, departmentName, status, element) {


    // Store current assignment ID globally
    window.currentAssignmentId = assignmentId;

    // Update assignment selection UI
    document.querySelectorAll('.assignment-item').forEach(item => {
        item.classList.remove('bg-blue-50', 'dark:bg-blue-900/20', 'border-l-4', 'border-l-blue-500', 'selected');
    });

    if (element) {
        element.classList.add('bg-blue-50', 'dark:bg-blue-900/20', 'border-l-4', 'border-l-blue-500', 'selected');
        element.dataset.assignmentId = assignmentId; // Add assignment ID to element
    }

    // Show chat area
    document.getElementById('defaultChatState').classList.add('hidden');
    document.getElementById('chatHeader').classList.remove('hidden');
    document.getElementById('messagesContainer').classList.remove('hidden');
    document.getElementById('messageInputArea').classList.remove('hidden');

    // Update chat header
    document.getElementById('chatDepartmentName').textContent = departmentName;
    document.getElementById('chatAssignmentInfo').textContent = `Assignment #${assignmentId}`;

    const statusSpan = document.getElementById('chatStatus');
    statusSpan.textContent = status;
    statusSpan.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusClass(status)}`;

    // Load messages for this assignment
    loadAssignmentDiscussions(assignmentId);
}

function closeDiscussionModal() {
    const modal = document.getElementById('discussionModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    discussionModalInstance = null;
    window.currentDiscussionComplaintId = null;
    resetChatArea();
    location.reload();

}

function resetChatArea() {
    // Hide chat elements
    const chatHeader = document.getElementById('chatHeader');
    const messagesContainer = document.getElementById('messagesContainer');
    const messageInputArea = document.getElementById('messageInputArea');
    const defaultChatState = document.getElementById('defaultChatState');

    if (chatHeader) chatHeader.classList.add('hidden');
    if (messagesContainer) messagesContainer.classList.add('hidden');
    if (messageInputArea) messageInputArea.classList.add('hidden');
    if (defaultChatState) defaultChatState.classList.remove('hidden');

    // Clear messages and input
    if (messagesContainer) messagesContainer.innerHTML = '';
    const messageInput = document.getElementById('adminMessageInput');
    if (messageInput) messageInput.value = '';
    clearFileSelection();

}

function loadComplaintAssignments(complaintId) {
    const assignmentsList = document.getElementById('assignmentsList');
    if (!assignmentsList) {
        return;
    }

    // Show loading state
    assignmentsList.innerHTML = `
        <div class="p-6 text-center">
            <svg class="w-8 h-8 mx-auto mb-3 text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <p class="text-gray-600 dark:text-gray-300">Loading assignments...</p>
        </div>
    `;

    // Fetch assignments from backend
    fetch(`/complaints/${complaintId}/assignments`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayAssignments(data.assignments);
        } else {
            throw new Error(data.message || 'Failed to load assignments');
        }
    })
    .catch(error => {
        console.error('Error loading assignments:', error);
        assignmentsList.innerHTML = `
            <div class="p-6 text-center text-red-600 dark:text-red-400">
                <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-medium">Error loading assignments</p>
                <p class="text-sm">${error.message}</p>
                <button onclick="loadComplaintAssignments(${complaintId})" class="mt-2 text-blue-600 hover:text-blue-700 text-sm underline">
                    Try Again
                </button>
            </div>
        `;
    });
}

function displayAssignments(assignments) {
    const assignmentsList = document.getElementById('assignmentsList');
    if (!assignments || assignments.length === 0) {
        assignmentsList.innerHTML = `
            <div class="p-6 text-center text-gray-600 dark:text-gray-300">
                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-4.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                </svg>
                <p class="font-medium">No Assignments</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This complaint has not been assigned to any department yet.</p>
            </div>
        `;
        return;
    }

    const assignmentsHtml = assignments.map(assignment => {
        const statusClass = getStatusClass(assignment.status);
        const hasNewMessages = assignment.unread_messages_count > 0;

        return `
            <div class="assignment-item border-b border-gray-200 dark:border-gray-600 p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                 onclick="selectAssignment(${assignment.id}, ${JSON.stringify(assignment.department?.name ?? '')}, ${JSON.stringify(assignment.status ?? '')}, this)">
                <div class="flex items-center justify-between mb-2">
                    <h6 class="font-semibold text-gray-900 dark:text-white text-sm">${assignment.department?.name ?? 'Unknown Department'}</h6>
                    ${hasNewMessages ? '<div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>' : ''}
                </div>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${statusClass}">
                        ${assignment.status}
                    </span>
                    ${hasNewMessages ? `<span class="text-xs text-blue-600 dark:text-blue-400 font-medium">${assignment.unread_messages_count} new</span>` : ''}
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                    Assigned ${formatDate(assignment.created_at)}
                </p>
                ${assignment.deadline ? `<p class="text-xs text-orange-600 dark:text-orange-400 mt-1">Due: ${formatDate(assignment.deadline)}</p>` : ''}
            </div>
        `;
    }).join('');

    assignmentsList.innerHTML = assignmentsHtml;
}

function selectAssignment(assignmentId, departmentName, status, element) {


    // Store current assignment ID globally
    window.currentAssignmentId = assignmentId;

    // Update assignment selection UI
    document.querySelectorAll('.assignment-item').forEach(item => {
        item.classList.remove('bg-blue-50', 'dark:bg-blue-900/20', 'border-l-4', 'border-l-blue-500');
    });

    if (element) {
        element.classList.add('bg-blue-50', 'dark:bg-blue-900/20', 'border-l-4', 'border-l-blue-500');
    }

    // Show chat area
    document.getElementById('defaultChatState').classList.add('hidden');
    document.getElementById('chatHeader').classList.remove('hidden');
    document.getElementById('messagesContainer').classList.remove('hidden');
    document.getElementById('messageInputArea').classList.remove('hidden');

    // Update chat header
    document.getElementById('chatDepartmentName').textContent = departmentName;
    document.getElementById('chatAssignmentInfo').textContent = `Assignment #${assignmentId}`;

    const statusSpan = document.getElementById('chatStatus');
    statusSpan.textContent = status;
    statusSpan.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusClass(status)}`;

    // Load messages for this assignment
    loadAssignmentMessages(assignmentId);
}

function loadAssignmentMessages(assignmentId) {
    const messagesContainer = document.getElementById('messagesContainer');

    // Show loading state
    messagesContainer.innerHTML = `
        <div class="text-center py-8">
            <svg class="w-6 h-6 mx-auto text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Loading messages...</p>
        </div>
    `;

    fetch(`/admin/complaint-assignments/${assignmentId}/discussions`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayMessages(data.discussions);
        } else {
            throw new Error(data.message || 'Failed to load messages');
        }
    })
    .catch(error => {
        console.error('Error loading messages:', error);
        messagesContainer.innerHTML = `
            <div class="text-center text-red-600 dark:text-red-400 py-8">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm font-medium">Error loading messages</p>
                <p class="text-xs">${error.message}</p>
                <button onclick="loadAssignmentMessages(${assignmentId})" class="mt-2 text-blue-600 hover:text-blue-700 text-sm underline">
                    Retry
                </button>
            </div>
        `;
    });
}

function displayMessages(messages) {
    const messagesContainer = document.getElementById('messagesContainer');

    if (!messages || messages.length === 0) {
        messagesContainer.innerHTML = `
            <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.955 8.955 0 01-3.9-.9L3 21l1.9-5.1A8.955 8.955 0 013 12a8 8 0 1118 0z"></path>
                </svg>
                <p class="font-medium">No messages yet</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Start the conversation with the department</p>
            </div>
        `;
        return;
    }

    const messagesHtml = messages.map(message => {
        const isAdmin = message.sender_type === 'admin';
        const avatarClass = isAdmin ? 'bg-blue-500' : 'bg-green-500';
        const messageClass = isAdmin ? 'ml-auto bg-blue-600 text-white' : 'mr-auto bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white';
        const senderName = isAdmin ? 'Admin' : 'Department Head';
        const senderInitial = isAdmin ? 'A' : 'D';

        // Handle attachments - support both single file_path and multiple attachments
        let attachmentHtml = '';
        if (message.file_path && message.file_name) {
            // Single file attachment (legacy format)
            attachmentHtml = `
                <div class="mt-2 pt-2 border-t ${isAdmin ? 'border-blue-400' : 'border-gray-300 dark:border-gray-600'}">
                    ${renderFileAttachment(message.file_path, message.file_name, message.id)}
                </div>
            `;
        } else if (message.attachments && Array.isArray(message.attachments) && message.attachments.length > 0) {
            // Multiple attachments (new format)
            const attachmentsHtml = message.attachments.map(attachment => {
                const fileName = attachment.original_name || attachment.name || 'Unknown file';
                const filePath = attachment.path;
                return renderFileAttachment(filePath, fileName, message.id);
            }).join('');

            attachmentHtml = `
                <div class="mt-2 pt-2 border-t ${isAdmin ? 'border-blue-400' : 'border-gray-300 dark:border-gray-600'}">
                    ${attachmentsHtml}
                </div>
            `;
        }

        return `
            <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} items-end space-x-2 mb-4">
                ${!isAdmin ? `<div class="flex-shrink-0 w-8 h-8 ${avatarClass} rounded-full flex items-center justify-center text-white text-sm font-medium">${senderName.charAt(0)}</div>` : ''}
                <div class="max-w-xs lg:max-w-md">
                    <div class="${messageClass} rounded-lg px-4 py-3 shadow-sm">
                        <p class="text-sm whitespace-pre-wrap">${escapeHtml(message.message)}</p>
                        ${attachmentHtml}
                        ${message.is_important ? `
                            <div class="mt-2 pt-2 border-t ${isAdmin ? 'border-blue-400' : 'border-gray-300 dark:border-gray-600'}">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${isAdmin ? 'bg-red-200 text-red-800' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'}">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Important
                                </span>
                            </div>
                        ` : ''}
                    </div>
                    <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            ${senderName} • ${formatDateTime(message.created_at)}
                        </span>
                    </div>
                </div>
                ${isAdmin ? `<div class="flex-shrink-0 w-8 h-8 ${avatarClass} rounded-full flex items-center justify-center text-white text-sm font-medium">${senderName.charAt(0)}</div>` : ''}
            </div>
        `;
    }).join('');

    messagesContainer.innerHTML = messagesHtml;

    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}// Reply Modal
function openReplyModal(complaintId, clientName, referenceNumber) {

    const modal = document.getElementById('replyModal');
    if (!modal) {
        alert('Reply modal not found!');
        return;
    }

    const complaintInfo = document.getElementById('complaintInfo');
    const complaintIdInput = document.getElementById('complaintId');

    if (complaintInfo) {
        complaintInfo.textContent = `${referenceNumber} - ${clientName}`;
    }
    if (complaintIdInput) {
        complaintIdInput.value = complaintId;
    }

    modal.classList.remove('hidden');
    replyModalInstance = modal;

    // Load complaint details and conversation after a short delay
    // This ensures the modal is fully rendered
    setTimeout(() => {
        loadComplaintConversation(complaintId);
    }, 100);
}

function loadComplaintConversation(complaintId) {


    const conversationContainer = document.getElementById('conversationMessages');
    const complaintDetails = document.getElementById('complaintDetails');

    // Show loading state
    conversationContainer.innerHTML = `
        <div class="text-center text-gray-600 dark:text-gray-300 py-8">
            <svg class="w-6 h-6 mx-auto mb-3 text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <p class="font-medium">Loading conversation...</p>
        </div>
    `;

    fetch(`/admin/complaints/${complaintId}/conversation`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update complaint details (with error handling)
            if (data.complaint_info) {
                updateComplaintDetails(data.complaint_info);
            } else {
                console.warn('⚠️ No complaint_info in response');
            }

            // Display conversation
            if (data.conversation) {
                displayConversation(data.conversation);

                // Update message count
                const messageCount = document.getElementById('messageCount');
                if (messageCount) {
                    messageCount.textContent = data.conversation.length;
                }
            } else {
                console.warn('⚠️ No conversation in response');
                displayConversation([]);
            }
        } else {
            throw new Error(data.message || 'Failed to load conversation');
        }
    })
    .catch(error => {
        console.error('❌ Error loading conversation:', error);
        conversationContainer.innerHTML = `
            <div class="text-center text-red-600 dark:text-red-400 py-8">
                <svg class="w-6 h-6 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-medium">Error loading conversation</p>
                <p class="text-sm">${error.message}</p>
                <button onclick="loadComplaintConversation(${complaintId})" class="mt-2 text-blue-600 hover:text-blue-700 text-sm underline">
                    Retry
                </button>
            </div>
        `;
    });
}

function updateComplaintDetails(complaintInfo) {


    // Check if complaintInfo exists
    if (!complaintInfo) {
        console.error('❌ Complaint info is undefined');
        return;
    }

    // Update basic info with safe access
    const currentStatus = document.getElementById('currentStatus');
    const currentPriority = document.getElementById('currentPriority');

    if (currentStatus) {
        const statusText = complaintInfo.status_label || complaintInfo.status || 'Unknown';
        currentStatus.textContent = statusText;

    } else {
       console.warn('⚠️ currentStatus element not found');
    }

    if (currentPriority) {
        const priorityText = complaintInfo.priority_label || complaintInfo.priority || 'Normal';
        currentPriority.textContent = priorityText;

    } else {
        console.warn('⚠️ currentStatus element not found');
    }

    // Update detailed info
    const complaintTitle = document.getElementById('complaintTitle');
    const complaintDescription = document.getElementById('complaintDescription');
    const complaintCategory = document.getElementById('complaintCategory');
    const complaintDate = document.getElementById('complaintDate');
    const complaintEvidence = document.getElementById('complaintEvidence');

    if (complaintTitle) {
        complaintTitle.textContent = complaintInfo.complaint_title || 'No title provided';
        const titleSection = document.getElementById('complaintTitleSection');
        if (titleSection && complaintInfo.complaint_title) {
            titleSection.classList.remove('hidden');
        }
    }

    if (complaintDescription) {
        complaintDescription.textContent = complaintInfo.complaint_details || 'No description provided';
    }

    if (complaintCategory) {
        complaintCategory.textContent = complaintInfo.category_name || 'Uncategorized';
    }

    if (complaintDate) {
        const date = new Date(complaintInfo.created_at);
        complaintDate.textContent = date.toLocaleDateString();
    }

    if (complaintEvidence) {
        const evidenceCount = complaintInfo.evidence_count || 0;
        complaintEvidence.textContent = evidenceCount > 0 ? `${evidenceCount} files` : 'None';
    }

    // Pre-fill current status in form
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.value = complaintInfo.status;
    }
}

function displayConversation(conversation, complaintInfo) {


    const conversationContainer = document.getElementById('conversationMessages');
    if (!conversationContainer) {
        console.error('❌ Conversation container not found');
        return;
    }

    // Update complaint details if provided
    if (complaintInfo) {
        updateComplaintDetails(complaintInfo);
        // Also populate the detailed complaint info section
        populateComplaintDetails(complaintInfo);
    }

    // Update message count
    const messageCount = document.getElementById('messageCount');
    if (messageCount) {
        messageCount.textContent = conversation ? conversation.length : 0;
    }

    if (!conversation || conversation.length === 0) {
        conversationContainer.innerHTML = `
            <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="font-medium">No conversation yet</p>
                <p class="text-sm">Start by sending a reply below</p>
            </div>
        `;
        return;
    }


    const conversationHtml = conversation.map(message => {
        const isAdmin = message.sender_type === 'admin';
        const timeFormatted = formatDateTime(message.created_at || message.timestamp);

        return `
            <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} mb-4">
                <div class="max-w-xs lg:max-w-md ${isAdmin ? 'order-2' : 'order-1'}">
                    <div class="flex items-center mb-1 ${isAdmin ? 'justify-end' : 'justify-start'}">
                        <span class="text-xs font-medium text-gray-600 dark:text-gray-400">
                            ${isAdmin ? 'Admin' : 'Client'}
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-500 ml-2">
                            ${timeFormatted}
                        </span>
                    </div>
                    <div class="rounded-lg px-4 py-2 ${isAdmin ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white'}">
                        <p class="text-sm whitespace-pre-wrap">${escapeHtml(message.message)}</p>
                        ${message.status_update ? `
                            <div class="mt-2 pt-2 border-t ${isAdmin ? 'border-blue-500' : 'border-gray-300 dark:border-gray-600'}">
                                <p class="text-xs opacity-90">Status updated to: <strong>${message.status_update}</strong></p>
                            </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;
    }).join('');

    conversationContainer.innerHTML = conversationHtml;

    // Scroll to bottom
    const conversationThread = document.getElementById('conversationThread');
    if (conversationThread) {
        conversationThread.scrollTop = conversationThread.scrollHeight;
    }


}

// Utility functions for the conversation
function formatDateTime(dateString) {
    if (!dateString) return 'Unknown time';

    try {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);

        if (diffInSeconds < 60) return 'Just now';
        if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)}m ago`;
        if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)}h ago`;
        if (diffInSeconds < 604800) return `${Math.floor(diffInSeconds / 86400)}d ago`;

        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    } catch (e) {
        return 'Invalid date';
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Additional utility function to refresh page data
function refreshData() {

    location.reload();
}

// Function to close all modals
function closeAllModals() {
    closeReplyModal();
    closeEvidenceModal();
    closeAssignModal();
    closeDiscussionModal();
}

function closeReplyModal() {
    const modal = document.getElementById('replyModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    replyModalInstance = null;
    location.reload();
}

// Evidence Modal
function showEvidenceModal(complaintId, evidenceFiles) {


    const modal = document.getElementById('evidenceModal');
    if (!modal) {
        console.error('❌ Evidence modal not found');
        alert('Evidence modal not found!');
        return;
    }

    modal.classList.remove('hidden');
    evidenceModalInstance = modal;

}

function closeEvidenceModal() {
    const modal = document.getElementById('evidenceModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    evidenceModalInstance = null;
    location.reload();
}

// View Toggle Function
function toggleView(viewType) {


    const cardsView = document.getElementById('cardsView');
    const tableView = document.getElementById('tableView');
    const cardsBtn = document.getElementById('cardsViewBtn');
    const tableBtn = document.getElementById('tableViewBtn');

    if (!cardsView || !tableView) {
        console.error('❌ View elements not found');
        return;
    }

    if (viewType === 'cards') {
        cardsView.classList.remove('hidden');
        tableView.classList.add('hidden');

        if (cardsBtn) {
            cardsBtn.classList.add('bg-blue-600', 'text-white');
            cardsBtn.classList.remove('text-gray-600', 'dark:text-gray-300');
        }
        if (tableBtn) {
            tableBtn.classList.remove('bg-blue-600', 'text-white');
            tableBtn.classList.add('text-gray-600', 'dark:text-gray-300');
        }
    } else {
        cardsView.classList.add('hidden');
        tableView.classList.remove('hidden');

        if (tableBtn) {
            tableBtn.classList.add('bg-blue-600', 'text-white');
            tableBtn.classList.remove('text-gray-600', 'dark:text-gray-300');
        }
        if (cardsBtn) {
            cardsBtn.classList.remove('bg-blue-600', 'text-white');
            cardsBtn.classList.add('text-gray-600', 'dark:text-gray-300');
        }
    }


    localStorage.setItem('complaintsViewType', viewType);
}



// Show Toast Function
function showToast(message, type = 'success') {

    alert(`${type.toUpperCase()}: ${message}`);
}

// Load Assignments for Discussion Modal
// function loadComplaintAssignments(complaintId) {
//     console.log('📄 Loading assignments for complaint:', complaintId);

//     const assignmentsList = document.getElementById('assignmentsList');
//     if (!assignmentsList) {
//         console.error('❌ Assignments list not found');
//         return;
//     }

//     assignmentsList.innerHTML = `
//         <div class="p-4 text-center">
//             <p class="text-gray-600">Loading assignments...</p>
//         </div>
//     `;

//     // Fetch assignments (simplified version)
//     fetch(`/complaints/${complaintId}/assignments`, {
//         method: 'GET',
//         headers: {
//             'X-CSRF-TOKEN': csrfToken,
//             'Accept': 'application/json'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             displayAssignments(data.assignments);
//         } else {
//             assignmentsList.innerHTML = `<div class="p-4 text-center text-red-600">Error loading assignments</div>`;
//         }
//     })
//     .catch(error => {
//         console.error('Error loading assignments:', error);
//         assignmentsList.innerHTML = `<div class="p-4 text-center text-red-600">Error: ${error.message}</div>`;
//     });
// }

function displayAssignments(assignments) {
    const assignmentsList = document.getElementById('assignmentsList');
    if (!assignments || assignments.length === 0) {
        assignmentsList.innerHTML = `
            <div class="p-4 text-center text-gray-600">
                <p>No assignments found</p>
            </div>
        `;
        return;
    }

    const html = assignments.map(assignment => {
        const deptName = JSON.stringify(assignment?.department?.name ?? '');
        const status = JSON.stringify(assignment?.status ?? '');
        return `
        <div class="p-4 border-b border-gray-200 cursor-pointer hover:bg-gray-50"
             onclick="selectAssignment(${assignment.id}, ${deptName}, ${status})">
            <h6 class="font-semibold">${assignment?.department?.name ?? ''}</h6>
            <p class="text-sm text-gray-600">Status: ${assignment?.status ?? ''}</p>
        </div>`;
    }).join('');

    assignmentsList.innerHTML = html;
}

function selectAssignment(assignmentId, departmentName, status) {

    alert(`Selected: ${departmentName} (${status})`);
}

// File handling functions for discussion modal
function clearFileSelection() {
    const fileInput = document.getElementById('adminMessageFile');
    const filePreview = document.getElementById('filePreview');

    if (fileInput) fileInput.value = '';
    if (filePreview) filePreview.classList.add('hidden');
}

function handleFileSelection(event) {
    const file = event.target.files[0];
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const fileIcon = document.getElementById('fileIcon');

    if (!file) {
        if (filePreview) filePreview.classList.add('hidden');
        return;
    }

    // Show file preview
    if (fileName) fileName.textContent = file.name;
    if (fileSize) fileSize.textContent = formatFileSize(file.size);

    // Set file icon based on type
    const fileExtension = file.name.split('.').pop().toLowerCase();
    const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension);
    const isVideo = ['mp4', 'avi', 'mov', 'webm'].includes(fileExtension);

    if (fileIcon) {
        if (isImage) {
            fileIcon.innerHTML = `
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            `;
        } else if (isVideo) {
            fileIcon.innerHTML = `
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            `;
        } else {
            fileIcon.innerHTML = `
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                </svg>
            `;
        }
    }

    if (filePreview) filePreview.classList.remove('hidden');
}

// Admin response form submission
async function handleAdminResponseSubmit(e) {
    e.preventDefault();

    if (!window.currentAssignmentId) {
        showToast('No assignment selected', 'error');
        return;
    }

    const form = e.target;
    const messageInput = document.getElementById('adminMessageInput');
    const fileInput = document.getElementById('adminMessageFile');

    const message = messageInput ? messageInput.value.trim() : '';
    const file = fileInput ? fileInput.files[0] : null;

    if (!message && !file) {
        showToast('Please enter a message or attach a file', 'error');
        return;
    }

    // Prepare form data
    const submitData = new FormData();
    submitData.append('message', message);
    if (file) {
        submitData.append('file', file);
    }

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalHTML = submitBtn ? submitBtn.innerHTML : '';
    if (submitBtn) {
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        `;
        submitBtn.disabled = true;
    }

    try {
        const response = await fetch(`/admin/complaint-assignments/${window.currentAssignmentId}/discussion`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: submitData
        });

        const result = await response.json();

        if (result.success) {
            // Clear form
            if (messageInput) messageInput.value = '';
            clearFileSelection();

            // Reload messages
            loadAssignmentMessages(window.currentAssignmentId);

            showToast('Response sent successfully', 'success');
        } else {
            throw new Error(result.message || 'Failed to send response');
        }
    } catch (error) {
        console.error('Error sending response:', error);
        showToast(error.message || 'Failed to send response', 'error');
    } finally {
        // Reset button state
        if (submitBtn) {
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
        }
    }
}

// Utility functions
function renderFileAttachment(filePath, fileName, discussionId = null) {
    const fileExtension = fileName ? fileName.split('.').pop().toLowerCase() : '';
    const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension);
    const isVideo = ['mp4', 'avi', 'mov', 'webm'].includes(fileExtension);

    // Determine the correct URL based on whether this is a discussion attachment or evidence file
    const fileUrl = discussionId ? `/admin/discussions/${discussionId}/attachment` : `/storage/${filePath}`;

    if (isImage) {
        return `
            <img src="${fileUrl}" alt="${fileName}" class="max-w-full h-auto rounded cursor-pointer"
                 onclick="openMediaPreview('${fileUrl}', 'image', '${fileName}')">
        `;
    } else if (isVideo) {
        return `
            <video controls class="max-w-full h-auto rounded">
                <source src="${fileUrl}" type="video/${fileExtension}">
                Your browser does not support the video tag.
            </video>
        `;
    } else {
        return `
            <a href="${fileUrl}" target="_blank" class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 dark:text-blue-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                </svg>
                <span class="text-sm">${fileName}</span>
            </a>
        `;
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString();
}

function formatDateTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString();
}

function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function getStatusClass(status) {
    const statusClasses = {
        'pending': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'in_progress': 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'resolved': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'escalated': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
    };
    return statusClasses[status] || 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
}// Event Listeners Setup
// removed duplicate DOMContentLoaded handler (canonical one retained later)

// removed duplicate openAssignModal (canonical definition retained earlier)

// removed duplicate closeAssignModal (canonical definition retained earlier)

// Discussion Modal Variables
// reuse existing discussionModalInstance declared earlier
let currentAssignmentId = null;
let currentComplaintId = null;

// removed duplicate openDiscussionModal (canonical definition retained earlier)

function closeDiscussionModal() {
    const modal = document.getElementById('discussionModal');

    if (modal) {
        modal.classList.add('hidden');
    }

    discussionModalInstance = null;
    currentAssignmentId = null;
    currentComplaintId = null;
}

function resetChatArea() {
    // Hide chat elements
    document.getElementById('chatHeader').classList.add('hidden');
    document.getElementById('messagesContainer').classList.add('hidden');
    document.getElementById('messageInputArea').classList.add('hidden');

    // Show default state
    document.getElementById('defaultChatState').classList.remove('hidden');

    // Clear messages
    document.getElementById('messagesContainer').innerHTML = '';

    // Clear input
    document.getElementById('adminMessageInput').value = '';
    clearFileSelection();
}

// function loadComplaintAssignments(complaintId) {
//     const assignmentsList = document.getElementById('assignmentsList');

//     // Show loading state
//     assignmentsList.innerHTML = `
//         <div class="text-center text-gray-600 dark:text-gray-300 py-8">
//             <svg class="w-8 h-8 mx-auto mb-3 text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
//             </svg>
//             <p class="font-medium">Loading assignments...</p>
//         </div>
//     `;

//     fetch(`/complaints/${complaintId}/assignments`, {
//         method: 'GET',
//         headers: {
//             'X-CSRF-TOKEN': csrfToken,
//             'Accept': 'application/json',
//             'Content-Type': 'application/json'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             displayAssignments(data.assignments);
//         } else {
//             throw new Error(data.message || 'Failed to load assignments');
//         }
//     })
//     .catch(error => {
//         console.error('Error loading assignments:', error);
//         assignmentsList.innerHTML = `
//             <div class="text-center text-red-600 dark:text-red-400 py-8">
//                 <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
//                 </svg>
//                 <p class="font-medium">Error loading assignments</p>
//                 <p class="text-sm">${error.message}</p>
//             </div>
//         `;
//     });
// }

function displayAssignments(assignments) {
    const assignmentsList = document.getElementById('assignmentsList');

    if (!assignments || assignments.length === 0) {
        assignmentsList.innerHTML = `
            <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-4.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                </svg>
                <p class="font-medium">No Assignments</p>
                <p class="text-sm">This complaint has not been assigned to any department yet.</p>
            </div>
        `;
        return;
    }

    const assignmentsHtml = assignments.map(assignment => {
        const statusClass = getStatusClass(assignment.status);
        const hasNewMessages = assignment.unread_messages_count > 0;

        return `
            <div class="assignment-item border-b border-gray-200 dark:border-gray-600 p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors ${currentAssignmentId == assignment.id ? 'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-l-blue-500' : ''}"
                 onclick="selectAssignment(${assignment.id}, ${JSON.stringify(assignment.department.name)}, ${JSON.stringify(assignment.status)}, this)">
                <div class="flex items-center justify-between mb-2">
                    <h6 class="font-semibold text-gray-900 dark:text-white text-sm">${assignment.department.name}</h6>
                    ${hasNewMessages ? '<div class="w-2 h-2 bg-red-500 rounded-full"></div>' : ''}
                </div>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${statusClass}">
                        ${assignment.status}
                    </span>
                    ${hasNewMessages ? `<span class="text-xs text-blue-600 dark:text-blue-400 font-medium">${assignment.unread_messages_count} new</span>` : ''}
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                    Assigned ${formatDate(assignment.created_at)}
                </p>
            </div>
        `;
    }).join('');

    assignmentsList.innerHTML = assignmentsHtml;
}

function selectAssignment(assignmentId, departmentName, status, element) {
    currentAssignmentId = assignmentId;

    // Update assignment selection UI
    document.querySelectorAll('.assignment-item').forEach(item => {
        item.classList.remove('bg-blue-50', 'dark:bg-blue-900/20', 'border-l-4', 'border-l-blue-500');
    });

    if (element) {
        element.classList.add('bg-blue-50', 'dark:bg-blue-900/20', 'border-l-4', 'border-l-blue-500');
    }

    // Show chat area
    document.getElementById('defaultChatState').classList.add('hidden');
    document.getElementById('chatHeader').classList.remove('hidden');
    document.getElementById('messagesContainer').classList.remove('hidden');
    document.getElementById('messageInputArea').classList.remove('hidden');

    // Update chat header
    document.getElementById('chatDepartmentName').textContent = departmentName;
    document.getElementById('chatAssignmentInfo').textContent = `Assignment #${assignmentId}`;

    const statusSpan = document.getElementById('chatStatus');
    statusSpan.textContent = status;
    statusSpan.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusClass(status)}`;

    // Load messages
    loadAssignmentMessages(assignmentId);
}

function loadAssignmentMessages(assignmentId) {
    const messagesContainer = document.getElementById('messagesContainer');

    // Show loading state
    messagesContainer.innerHTML = `
        <div class="text-center py-4">
            <svg class="w-6 h-6 mx-auto text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Loading messages...</p>
        </div>
    `;

    fetch(`/admin/complaint-assignments/${assignmentId}/discussions`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayMessages(data.discussions);
        } else {
            throw new Error(data.message || 'Failed to load messages');
        }
    })
    .catch(error => {
        console.error('Error loading messages:', error);
        messagesContainer.innerHTML = `
            <div class="text-center text-red-600 dark:text-red-400 py-4">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm font-medium">Error loading messages</p>
                <p class="text-xs">${error.message}</p>
            </div>
        `;
    });
}

function displayMessages(messages) {
    const messagesContainer = document.getElementById('messagesContainer');

    if (!messages || messages.length === 0) {
        messagesContainer.innerHTML = `
            <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.955 8.955 0 01-3.9-.9L3 21l1.9-5.1A8.955 8.955 0 013 12a8 8 0 1118 0z"></path>
                </svg>
                <p class="font-medium">No messages yet</p>
                <p class="text-sm">Start the conversation with the department</p>
            </div>
        `;
        return;
    }

    const messagesHtml = messages.map(message => {
    const isAdmin = message.sender_type === 'admin';
        const avatarClass = isAdmin ? 'bg-blue-500' : 'bg-green-500';
        const messageClass = isAdmin ? 'ml-auto bg-blue-600 text-white' : 'mr-auto bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white';
        const senderName = isAdmin ? 'Admin' : 'Department Head';

        return `
            <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} items-end space-x-2">
                ${!isAdmin ? `<div class="flex-shrink-0 w-8 h-8 ${avatarClass} rounded-full flex items-center justify-center text-white text-sm font-medium">${senderName.charAt(0)}</div>` : ''}
                <div class="max-w-xs lg:max-w-md">
                    <div class="${messageClass} rounded-lg px-4 py-2">
                        <p class="text-sm">${message.message}</p>
                        ${message.file_path ? `
                            <div class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                ${renderFileAttachment(message.file_path, message.file_name, message.id)}
                            </div>
                        ` : ''}
                    </div>
                    <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} mt-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            ${senderName} • ${formatDateTime(message.created_at)}
                        </span>
                    </div>
                </div>
                ${isAdmin ? `<div class="flex-shrink-0 w-8 h-8 ${avatarClass} rounded-full flex items-center justify-center text-white text-sm font-medium">${senderName.charAt(0)}</div>` : ''}
            </div>
        `;
    }).join('');

    messagesContainer.innerHTML = messagesHtml;

    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// File handling functions
function clearFileSelection() {
    const fileInput = document.getElementById('adminMessageFile');
    const filePreview = document.getElementById('filePreview');

    fileInput.value = '';
    filePreview.classList.add('hidden');
}

function handleFileSelection(event) {
    const file = event.target.files[0];
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const fileIcon = document.getElementById('fileIcon');

    if (!file) {
        filePreview.classList.add('hidden');
        return;
    }

    // Show file preview
    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);

    // Set file icon based on type
    const fileExtension = file.name.split('.').pop().toLowerCase();
    const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension);
    const isVideo = ['mp4', 'avi', 'mov', 'webm'].includes(fileExtension);

    if (isImage) {
        fileIcon.innerHTML = `
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        `;
    } else if (isVideo) {
        fileIcon.innerHTML = `
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
        `;
    } else {
        fileIcon.innerHTML = `
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
            </svg>
        `;
    }

    filePreview.classList.remove('hidden');
}

// Media preview function
function openMediaPreview(src, type, fileName) {
    const modal = document.getElementById('mediaPreviewModal');
    const modalTitle = modal.querySelector('.modal-title');
    const modalBody = modal.querySelector('.modal-body');

    modalTitle.textContent = fileName || 'File Preview';

    // Clear previous content
    modalBody.innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div><p class="mt-2 text-gray-600 dark:text-gray-400">Loading...</p></div>';

    // Show modal first
    modal.classList.remove('hidden');

    // For images, check if it's a proper image type
    if (type === 'image' || (type && type.startsWith('image/')) || isImageFile(fileName)) {
        modalBody.innerHTML = `
            <div class="max-w-full max-h-full flex items-center justify-center">
                <img src="${src}" alt="${fileName}" class="max-w-full max-h-full object-contain rounded"
                     onerror="handlePreviewError(this, '${fileName}')"
                     onload="this.style.opacity='1'" style="opacity:0; transition: opacity 0.3s;"/>
            </div>
        `;
    } else if (type === 'video' || (type && type.startsWith('video/')) || isVideoFile(fileName)) {
        modalBody.innerHTML = `
            <div class="max-w-full max-h-full">
                <video controls class="max-w-full max-h-full rounded"
                       onerror="handlePreviewError(this, '${fileName}')">
                    <source src="${src}" type="${type || getVideoMimeType(fileName)}">
                    Your browser does not support the video tag.
                </video>
            </div>
        `;
    } else {
        // For non-previewable files, show file info and download option
        modalBody.innerHTML = `
            <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">${fileName}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">This file type cannot be previewed</p>
                <a href="${src}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download File
                </a>
            </div>
        `;
    }
}

// Helper functions for file type detection
function isImageFile(fileName) {
    if (!fileName) return false;
    const ext = fileName.split('.').pop().toLowerCase();
    return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(ext);
}

function isVideoFile(fileName) {
    if (!fileName) return false;
    const ext = fileName.split('.').pop().toLowerCase();
    return ['mp4', 'avi', 'mov', 'webm', 'mkv', 'flv', 'wmv'].includes(ext);
}

function getVideoMimeType(fileName) {
    if (!fileName) return 'video/mp4';
    const ext = fileName.split('.').pop().toLowerCase();
    const mimeTypes = {
        'mp4': 'video/mp4',
        'webm': 'video/webm',
        'avi': 'video/avi',
        'mov': 'video/quicktime',
        'mkv': 'video/x-matroska'
    };
    return mimeTypes[ext] || 'video/mp4';
}

// Error handler for preview failures
function handlePreviewError(element, fileName) {
    element.parentElement.innerHTML = `
        <div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto mb-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Preview Error</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Could not load preview for ${fileName}</p>
        </div>
    `;
}

// Close media preview modal
function closeMediaPreview() {
    const modal = document.getElementById('mediaPreviewModal');
    if (modal) {
        modal.classList.add('hidden');
        // Clean up media elements
        const videos = modal.querySelectorAll('video');
        videos.forEach(video => {
            video.pause();
            video.currentTime = 0;
        });
    }
}

// removed duplicate showEvidenceModal (canonical definition retained earlier)

// Admin response form submission
async function handleAdminResponseSubmit(e) {
    e.preventDefault();

    if (!currentAssignmentId) {
        showToast('No assignment selected', 'error');
        return;
    }

    const form = e.target;
    const formData = new FormData(form);
    const messageInput = document.getElementById('adminMessageInput');
    const fileInput = document.getElementById('adminMessageFile');

    const message = messageInput.value.trim();
    const file = fileInput.files[0];

    if (!message && !file) {
        showToast('Please enter a message or attach a file', 'error');
        return;
    }

    // Prepare form data
    const submitData = new FormData();
    submitData.append('message', message);
    if (file) {
        submitData.append('file', file);
    }

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalHTML = submitBtn.innerHTML;
    submitBtn.innerHTML = `
        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
    `;
    submitBtn.disabled = true;

    try {
        const response = await fetch(`/admin/complaint-assignments/${currentAssignmentId}/discussion`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: submitData
        });

        const result = await response.json();

        if (result.success) {
            // Clear form
            messageInput.value = '';
            clearFileSelection();

            // Reload messages
            loadAssignmentMessages(currentAssignmentId);

            showToast('Response sent successfully', 'success');
        } else {
            throw new Error(result.message || 'Failed to send response');
        }
    } catch (error) {
        console.error('Error sending response:', error);
        showToast(error.message || 'Failed to send response', 'error');
    } finally {
        // Reset button state
        submitBtn.innerHTML = originalHTML;
        submitBtn.disabled = false;
    }
}

async function handleAssignSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const complaintId = formData.get('complaint_id');

    // Get selected departments
    const selectedDepartments = [];
    const departmentCheckboxes = form.querySelectorAll('input[name="departments[]"]:checked');

    if (departmentCheckboxes.length === 0) {
        showToast('Please select at least one department', 'error');
        return;
    }

    departmentCheckboxes.forEach(checkbox => {
        selectedDepartments.push(checkbox.value);
    });

    // Prepare data
    const assignmentData = {
        departments: selectedDepartments,
        priority: formData.get('priority'),
        deadline: formData.get('deadline'),
        assignment_notes: formData.get('assignment_notes')
    };



    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const submitText = submitBtn.querySelector('.assign-submit-text');
    const loadingText = submitBtn.querySelector('.assign-loading-text');

    submitText.classList.add('hidden');
    loadingText.classList.remove('hidden');
    submitBtn.disabled = true;

    try {
        const response = await fetch(`/complaints/${complaintId}/assign`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(assignmentData)
        });

        let result;
        const text = await response.text();
        try {
            result = text ? JSON.parse(text) : {};
        } catch (parseErr) {
            console.error('Failed to parse JSON:', parseErr, 'Raw response:', text);
            throw new Error(`HTTP ${response.status} ${response.statusText}`);
        }



        if (!response.ok) {
            const msg = result.message || `HTTP ${response.status}`;
            throw new Error(msg);
        }

        if (result.success) {
            showToast(result.message || 'Assigned successfully', 'success');
            closeAssignModal();
            refreshData();
        } else {
            const msg = result.message || 'Assignment failed';
            showToast(msg, 'error');
            if (result.errors) {

            }
        }
    } catch (error) {
        console.error('Assignment error:', error);
        const likelyCsrf = /419|CSRF|unauthenticated|login/i.test(error.message);
        showToast(likelyCsrf ? 'Session expired. Please refresh and try again.' : (error.message || 'Network error occurred'), 'error');
    } finally {
        // Reset button state
        submitText.classList.remove('hidden');
        loadingText.classList.add('hidden');
        submitBtn.disabled = false;
    }
}

// Evidence Modal Functions
// removed duplicate: let evidenceModalInstance = null; (declared earlier)

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
                <div class="relative group">
                    <img src="/admin/complaints/${complaintId}/evidence/${index}" alt="${file.original_name}"
                         class="w-full h-48 object-cover rounded mb-2 cursor-pointer hover:opacity-90 transition-opacity"
                         onclick="openMediaPreview('/admin/complaints/${complaintId}/evidence/${index}', 'image', '${file.original_name}')">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all rounded mb-2 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
            `;
        } else if (isVideo) {
            evidenceHtml += `
                <div class="relative group cursor-pointer" onclick="openMediaPreview('/admin/complaints/${complaintId}/evidence/${index}', 'video', '${file.original_name}')">
                    <div class="w-full h-48 bg-gray-100 dark:bg-gray-700 rounded mb-2 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M9 10v4a2 2 0 002 2h2a2 2 0 002-2v-4M9 10V8a2 2 0 012-2h2a2 2 0 012 2v2"></path>
                            </svg>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Click to preview video</p>
                        </div>
                    </div>
                </div>
            `;
        } else if (isAudio) {
            evidenceHtml += `
                <div class="flex items-center justify-center h-24 bg-gray-100 dark:bg-gray-700 rounded mb-2">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                </div>
                <audio controls class="w-full mb-2">
                    <source src="/admin/complaints/${complaintId}/evidence/${index}" type="${file.mime_type}">
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
                <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                    Size: ${formatFileSize(file.size)} | Type: ${file.mime_type || 'Unknown'}
                </div>
                <div class="flex gap-2">
                    ${(isImage || isVideo) ? `
                        <button onclick="openMediaPreview('/admin/complaints/${complaintId}/evidence/${index}', '${file.mime_type}', '${file.original_name}')"
                                class="inline-flex items-center px-2 py-1 text-xs bg-blue-600 hover:bg-blue-700 text-white rounded transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Preview
                        </button>
                    ` : ''}
                    <a href="/admin/complaints/${complaintId}/evidence/${index}" download="${file.original_name}"
                       class="inline-flex items-center px-2 py-1 text-xs bg-green-600 hover:bg-green-700 text-white rounded transition-colors">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </a>
                </div>
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
                console.log('Error resetting video:', e);
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

// Reply Modal Functions (centralized)
function openReplyModal(complaintId, clientName, referenceNumber) {
  ;

    const modal = document.getElementById('replyModal');
    if (!modal) {
        console.error('❌ Reply modal not found');
        alert('Reply modal not found!');
        return;
    }

    const complaintInfo = document.getElementById('complaintInfo');
    const complaintIdInput = document.getElementById('complaintId');

    if (complaintInfo) {
        complaintInfo.textContent = `${referenceNumber} - ${clientName}`;
    }
    if (complaintIdInput) {
        complaintIdInput.value = complaintId;
    }

    // Clear previous form data
    const statusSelect = document.getElementById('status');
    const messageInput = document.getElementById('message');
    const adminNotesInput = document.getElementById('admin_notes');

    if (statusSelect) statusSelect.value = '';
    if (messageInput) messageInput.value = '';
    if (adminNotesInput) adminNotesInput.value = '';

    // Clear previous conversation
    const conversationContainer = document.getElementById('conversationMessages');
    if (conversationContainer) {
        conversationContainer.innerHTML = `
            <div class="text-center text-gray-600 dark:text-gray-300 py-8">
                <svg class="w-6 h-6 mx-auto mb-3 text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <p class="font-medium">Loading conversation...</p>
            </div>
        `;
    }

    modal.classList.remove('hidden');
    replyModalInstance = modal;

    // Load complaint details and conversation after a short delay
    setTimeout(() => {

        loadComplaintConversation(complaintId);
    }, 100);


}



// Function to populate complaint details in the modal
function populateComplaintDetails(complaintInfo) {
    // Populate complaint title (show section only if title exists)
    const titleSection = document.getElementById('complaintTitleSection');
    const titleElement = document.getElementById('complaintTitle');
    if (complaintInfo.complaint_title && complaintInfo.complaint_title.trim()) {
        titleElement.textContent = complaintInfo.complaint_title;
        titleSection.classList.remove('hidden');
    } else {
        titleSection.classList.add('hidden');
    }

    // Populate complaint description
    const descriptionElement = document.getElementById('complaintDescription');
    if (descriptionElement) {
        descriptionElement.textContent = complaintInfo.complaint_details || 'No description provided';
    }

    // Populate category
    const categoryElement = document.getElementById('complaintCategory');
    if (categoryElement) {
        categoryElement.textContent = complaintInfo.category_name || 'Uncategorized';
    }

    // Populate submission date
    const dateElement = document.getElementById('complaintDate');
    if (dateElement) {
        const date = new Date(complaintInfo.created_at);
        dateElement.textContent = date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }

    // Populate evidence info
    const evidenceElement = document.getElementById('complaintEvidence');
    if (evidenceElement) {
        const evidenceCount = complaintInfo.evidence_count || 0;
        evidenceElement.textContent = evidenceCount > 0 ? `${evidenceCount} file(s)` : 'No evidence';
    }
}

// Reply Form is handled by setupReplyFormHandler() function called on DOMContentLoaded



// Function to update complaint card status dynamically
function updateComplaintCardStatus(complaintId, statusData) {
    if (!statusData) return;

    // Update status badge in card view
    const cardStatusBadge = document.querySelector(`.status-badge-${complaintId}`);
    if (cardStatusBadge && statusData.status_color) {
        cardStatusBadge.className = `inline-flex items-center px-2 py-1 rounded-full text-xs font-medium status-badge-${complaintId} ${statusData.status_color}`;
        cardStatusBadge.textContent = statusData.status_label || statusData.status;
    }

    // Update status badge in table view
    const tableStatusBadge = document.querySelector(`#complaint-row-${complaintId} .status-badge-${complaintId}`);
    if (tableStatusBadge && statusData.status_color) {
        tableStatusBadge.className = `inline-flex items-center px-2 py-1 rounded-full text-xs font-medium status-badge-${complaintId} ${statusData.status_color}`;
        tableStatusBadge.textContent = statusData.status_label || statusData.status;
    }


}

// Delete complaint function


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
// Note: formatFileSize defined earlier; avoid duplicate definitions here.

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
    const toggleText = toggleBtn ? toggleBtn.querySelector('.filter-toggle-text') : null;
    const toggleArrow = toggleBtn ? toggleBtn.querySelector('.filter-arrow') : null;

    // Load saved view preference
    const savedView = localStorage.getItem('complaintsViewType') || 'cards';
    toggleView(savedView);

    if (toggleBtn && advancedFilters) {
        toggleBtn.addEventListener('click', function() {
            if (advancedFilters.classList.contains('hidden')) {
                advancedFilters.classList.remove('hidden');
                if (toggleText) toggleText.textContent = 'Hide Advanced';
                if (toggleArrow) toggleArrow.style.transform = 'rotate(180deg)';
            } else {
                advancedFilters.classList.add('hidden');
                if (toggleText) toggleText.textContent = 'Show Advanced';
                if (toggleArrow) toggleArrow.style.transform = 'rotate(0deg)';
            }
        });
    }

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
    const mediaPreviewModal = document.getElementById('mediaPreviewModal');
    const mediaPreviewCloseBtn = document.getElementById('mediaPreviewCloseBtn');
    const replyModal = document.getElementById('replyModal');
    const replyCloseBtn = document.getElementById('replyModalCloseBtn');
    const cancelReplyBtn = document.getElementById('cancelReplyBtn');

    // Close evidence modal via close button
    if (evidenceCloseBtn) {
        evidenceCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeEvidenceModal();
        });
    }

    // Close media preview modal via close button
    if (mediaPreviewCloseBtn) {
        mediaPreviewCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMediaPreview();
        });
    }

    // Close reply modal via close button
    if (replyCloseBtn) {
        replyCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeReplyModal();
        });
    }

    // Close reply modal via cancel button
    if (cancelReplyBtn) {
        cancelReplyBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeReplyModal();
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

    if (mediaPreviewModal) {
        mediaPreviewModal.addEventListener('click', function(e) {
            if (e.target === mediaPreviewModal) {
                closeMediaPreview();
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

    // Assignment Modal Event Listeners
    const assignModal = document.getElementById('assignModal');
    const assignModalCloseBtn = document.getElementById('assignModalCloseBtn');
    const cancelAssignBtn = document.getElementById('cancelAssignBtn');
    const assignForm = document.getElementById('assignForm');

    if (assignModalCloseBtn) {
        assignModalCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeAssignModal();
        });
    }

    if (cancelAssignBtn) {
        cancelAssignBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeAssignModal();
        });
    }

    if (assignModal) {
        assignModal.addEventListener('click', function(e) {
            if (e.target === assignModal) {
                closeAssignModal();
            }
        });
    }

    if (assignForm) {
        assignForm.addEventListener('submit', handleAssignSubmit);
    }

    // Discussion Modal Event Listeners
    const discussionModal = document.getElementById('discussionModal');
    const discussionModalCloseBtn = document.getElementById('discussionModalCloseBtn');
    const adminResponseForm = document.getElementById('adminResponseForm');
    const adminMessageFile = document.getElementById('adminMessageFile');

    if (discussionModalCloseBtn) {
        discussionModalCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeDiscussionModal();
        });
    }

    if (discussionModal) {
        discussionModal.addEventListener('click', function(e) {
            if (e.target === discussionModal) {
                closeDiscussionModal();
            }
        });
    }

    if (adminResponseForm) {
        adminResponseForm.addEventListener('submit', handleAdminResponseSubmit);
    }

    if (adminMessageFile) {
        adminMessageFile.addEventListener('change', handleFileSelection);
    }

    // ESC key handling
    // ESC key handling
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (evidenceModalInstance) {
                closeEvidenceModal();
            }
            if (replyModalInstance) {
                closeReplyModal();
            }
            if (assignModalInstance) {
                closeAssignModal();
            }
            if (discussionModalInstance) {
                closeDiscussionModal();
            }
            // Close media preview modal
            const mediaModal = document.getElementById('mediaPreviewModal');
            if (mediaModal && !mediaModal.classList.contains('hidden')) {
                closeMediaPreview();
            }
        }
    });

    // Expose functions for inline onclick handlers
    window.openAssignModal = openAssignModal;
    window.closeAssignModal = closeAssignModal;
    window.openDiscussionModal = openDiscussionModal;
    window.closeDiscussionModal = closeDiscussionModal;
    window.openReplyModal = openReplyModal;
    window.closeReplyModal = closeReplyModal;
    window.showEvidenceModal = showEvidenceModal;
    window.closeEvidenceModal = closeEvidenceModal;
    window.openMediaPreview = openMediaPreview;
    window.closeMediaPreview = closeMediaPreview;
    window.toggleView = toggleView;
    window.loadComplaintAssignments = loadComplaintAssignments;
    window.displayAssignments = displayAssignments;
    window.selectAssignment = selectAssignment;
});

// Test function for modal functionality
function testModalsFunction() {


    // Test Reply modal

    const firstComplaint = document.querySelector('[data-complaint-id]');
    if (firstComplaint) {
        const complaintId = firstComplaint.getAttribute('data-complaint-id');


        // Test opening Reply modal
        try {
            openReplyModal(complaintId, 'Test Client', 'REF-123');


            // Wait for modal to load then test conversation loading
            setTimeout(() => {

                loadComplaintConversation(complaintId);
            }, 1000);

        } catch (error) {
            console.error('❌ Reply modal failed:', error);
        }

        setTimeout(() => {
            closeAllModals();

            // Test Discussion modal
            console.log('🧪 Testing Discussion modal...');
            try {
                openDiscussionModal(complaintId, 'Test Client', 'REF-123');
                console.log('✅ Discussion modal opened successfully');
            } catch (error) {
                console.error('❌ Discussion modal failed:', error);
            }
        }, 3000);
    } else {
        console.error('❌ No complaints found to test');
    }
}

// Quick test function for conversation endpoint
function testConversationEndpoint(complaintId = 1) {
    console.log('🧪 Testing conversation endpoint for complaint:', complaintId);
    fetch(`/admin/complaints/${complaintId}/conversation`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('✅ Conversation endpoint response:', data);
        if (data.success && data.conversation) {
            console.log(`📊 Found ${data.conversation.length} messages`);
            data.conversation.forEach((msg, index) => {
                console.log(`  ${index + 1}. ${msg.sender_type}: ${msg.message.substring(0, 50)}...`);
            });

            // Test the update function directly
            console.log('🧪 Testing updateComplaintDetails with received data...');
            if (data.complaint_info) {
                updateComplaintDetails(data.complaint_info);
                console.log('✅ updateComplaintDetails completed successfully');
            } else {
                console.error('❌ No complaint_info in response');
            }

            // Test conversation display
            console.log('🧪 Testing displayConversation with received data...');
            displayConversation(data.conversation);
            console.log('✅ displayConversation completed successfully');
        }
    })
    .catch(error => {
        console.error('❌ Conversation endpoint failed:', error);
    });
}

// Debug function to test modal opening
function debugReplyModal(complaintId = 1) {
    console.log('🐛 Debug: Opening reply modal for complaint:', complaintId);

    // Test if modal exists
    const modal = document.getElementById('replyModal');
    if (!modal) {
        console.error('❌ Reply modal not found!');
        return;
    }

    console.log('✅ Reply modal found');

    // Test opening the modal
    try {
        openReplyModal(complaintId, 'Test Client', 'TEST-001');
        console.log('✅ Modal opened successfully');

        // Wait a bit then test conversation loading
        setTimeout(() => {
            console.log('🧪 Testing conversation loading...');
            testConversationEndpoint(complaintId);
        }, 1000);

    } catch (error) {
        console.error('❌ Error opening modal:', error);
    }
}

// Reply Form Submission Handler
function setupReplyFormHandler() {
    const replyForm = document.getElementById('replyForm');
    if (replyForm) {
        replyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('📧 Reply form submitted');

            const complaintId = document.getElementById('complaintId').value;
            const status = document.getElementById('status').value;
            const message = document.getElementById('message').value;
            const adminNotes = document.getElementById('admin_notes').value;

            if (!status || !message.trim()) {
                alert('Please select a status and enter a message');
                return;
            }

            const submitBtn = replyForm.querySelector('button[type="submit"]');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingText = submitBtn.querySelector('.loading-text');

            // Show loading state
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            submitBtn.disabled = true;

            const formData = new FormData();
            formData.append('status', status);
            formData.append('message', message);
            formData.append('admin_notes', adminNotes);

            fetch(`/admin/complaints/${complaintId}/reply`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('✅ Reply sent successfully');
                    // Clear the form
                    document.getElementById('message').value = '';
                    document.getElementById('admin_notes').value = '';
                    // Reload conversation
                    loadComplaintConversation(complaintId);
                    // Show success message
                    showNotification('Reply sent successfully!', 'success');
                } else {
                    throw new Error(data.message || 'Failed to send reply');
                }
            })
            .catch(error => {
                console.error('❌ Error sending reply:', error);
                showNotification('Failed to send reply: ' + error.message, 'error');
            })
            .finally(() => {
                // Reset button state
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                submitBtn.disabled = false;
            });
        });
    }
}

// Discussion Message Sending
function sendDiscussionMessage(assignmentId) {
    console.log('💬 Sending discussion message for assignment:', assignmentId);

    const messageInput = document.getElementById('discussionMessageInput');
    const fileInput = document.getElementById('adminMessageFile');
    const message = messageInput.value.trim();

    if (!message) {
        alert('Please enter a message');
        return;
    }

    const formData = new FormData();
    formData.append('message', message);
    formData.append('is_important', document.getElementById('messageImportant')?.checked || false);

    if (fileInput.files[0]) {
        formData.append('file', fileInput.files[0]);
    }

    const sendBtn = document.getElementById('sendDiscussionBtn');
    if (sendBtn) {
        sendBtn.disabled = true;
        sendBtn.textContent = 'Sending...';
    }

    fetch(`/admin/complaint-assignments/${assignmentId}/discussion`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('✅ Discussion message sent successfully');
            messageInput.value = '';
            fileInput.value = '';
            clearFileSelection();
            // Reload assignment discussions
            loadAssignmentDiscussions(assignmentId);
            showNotification('Message sent successfully!', 'success');
        } else {
            throw new Error(data.message || 'Failed to send message');
        }
    })
    .catch(error => {
        console.error('❌ Error sending discussion message:', error);
        showNotification('Failed to send message: ' + error.message, 'error');
    })
    .finally(() => {
        if (sendBtn) {
            sendBtn.disabled = false;
            sendBtn.textContent = 'Send Message';
        }
    });
}

// Load Assignment Discussions
function loadAssignmentDiscussions(assignmentId) {
    console.log('📄 Loading discussions for assignment:', assignmentId);

    const messagesContainer = document.getElementById('messagesContainer');
    if (!messagesContainer) {
        console.error('❌ Messages container not found');
        return;
    }

    messagesContainer.innerHTML = `
        <div class="text-center text-gray-600 dark:text-gray-300 py-8">
            <svg class="w-6 h-6 mx-auto mb-3 text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <p class="font-medium">Loading messages...</p>
        </div>
    `;

    fetch(`/admin/complaint-assignments/${assignmentId}/discussions`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('📄 Assignment discussions data:', data);
        if (data.success) {
            displayMessages(data.discussions);
        } else {
            throw new Error(data.message || 'Failed to load discussions');
        }
    })
    .catch(error => {
        console.error('❌ Error loading assignment discussions:', error);
        messagesContainer.innerHTML = `
            <div class="text-center text-red-600 dark:text-red-400 py-8">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm font-medium">Error loading discussions</p>
                <p class="text-xs">${error.message}</p>
                <button onclick="loadAssignmentDiscussions(${assignmentId})" class="mt-2 text-blue-600 hover:text-blue-700 text-sm underline">
                    Retry
                </button>
            </div>
        `;
    });
}

// Notification System
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
        type === 'success' ? 'bg-green-500 text-white' :
        type === 'error' ? 'bg-red-500 text-white' :
        'bg-blue-500 text-white'
    } transform transition-transform duration-300 translate-x-full`;

    notification.textContent = message;
    document.body.appendChild(notification);

    // Slide in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Slide out and remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}// Auto-test on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Page loaded - modals ready for testing');
    console.log('🎯 Call testModalsFunction() in console to test modal functionality');

    // Initialize form handlers
    setupReplyFormHandler();
    setupDiscussionFormHandler();

    console.log('✅ Form handlers initialized');
});

// Discussion Form Handler
function setupDiscussionFormHandler() {
    const discussionForm = document.getElementById('adminResponseForm');
    if (discussionForm) {
        discussionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('💬 Discussion form submitted');

            const messageInput = document.getElementById('adminMessageInput');
            const fileInput = document.getElementById('adminMessageFile');
            const message = messageInput.value.trim();

            if (!message) {
                alert('Please enter a message');
                return;
            }

            // Get selected assignment ID
            const selectedAssignment = document.querySelector('.assignment-item.selected');
            if (!selectedAssignment) {
                alert('Please select an assignment first');
                return;
            }

            const assignmentId = selectedAssignment.dataset.assignmentId;

            const formData = new FormData();
            formData.append('message', message);

            if (fileInput.files[0]) {
                formData.append('file', fileInput.files[0]);
            }

            const submitBtn = discussionForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            fetch(`/admin/complaint-assignments/${assignmentId}/discussion`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('✅ Discussion message sent successfully');
                    messageInput.value = '';
                    fileInput.value = '';
                    clearFileSelection();
                    // Reload assignment discussions
                    loadAssignmentDiscussions(assignmentId);
                    showNotification('Message sent successfully!', 'success');
                } else {
                    throw new Error(data.message || 'Failed to send message');
                }
            })
            .catch(error => {
                console.error('❌ Error sending discussion message:', error);
                showNotification('Failed to send message: ' + error.message, 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
            });
        });
    }
}

// Debug and test functions
function testModalFunctions() {
    console.log('🧪 Testing modal functions...');

    // Test 1: Check if essential elements exist
    const replyModal = document.getElementById('replyModal');
    const discussionModal = document.getElementById('discussionModal');
    const conversationMessages = document.getElementById('conversationMessages');
    const assignmentDiscussion = document.getElementById('assignmentDiscussion');

    console.log('✅ Elements found:');
    console.log('  - Reply Modal:', !!replyModal);
    console.log('  - Discussion Modal:', !!discussionModal);
    console.log('  - Conversation Messages:', !!conversationMessages);
    console.log('  - Assignment Discussion:', !!assignmentDiscussion);

    // Test 2: Check if CSRF token exists
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    console.log('  - CSRF Token:', !!csrfToken);

    // Test 3: Test a conversation load (use first complaint if available)
    const firstComplaintCard = document.querySelector('[data-complaint-id]');
    if (firstComplaintCard) {
        const testComplaintId = firstComplaintCard.getAttribute('data-complaint-id');
        console.log('  - Test Complaint ID:', testComplaintId);

        // Test the debug endpoint
        fetch('/admin/complaints/conversation/' + testComplaintId)
            .then(response => response.json())
            .then(data => {
                console.log('✅ Test endpoint response:', data);

                if (data.complaint_info) {
                    console.log('  - Complaint Info available:', !!data.complaint_info);
                    console.log('  - Status Label:', data.complaint_info.status_label);
                    console.log('  - Priority Label:', data.complaint_info.priority_label);
                }

                if (data.messages) {
                    console.log('  - Messages count:', data.messages.length);
                }
            })
            .catch(error => {
                console.error('❌ Test endpoint error:', error);
            });
    } else {
        console.log('  - No complaint cards found for testing');
    }

    console.log('🧪 Test completed - check console for results');
}

// Quick debug info function
function debugInfo() {
    console.log('🔍 Current Debug Info:');
    console.log('  - Current view:', currentView);
    console.log('  - Current complaint ID:', currentComplaintId);
    console.log('  - Reply modal instance:', !!replyModalInstance);
    console.log('  - Discussion modal instance:', !!discussionModalInstance);

    const modals = {
        reply: document.getElementById('replyModal'),
        discussion: document.getElementById('discussionModal'),
        assignment: document.getElementById('assignModal'),
        evidence: document.getElementById('evidenceModal')
    };

    console.log('  - Modal elements:', modals);
}

// Test reply modal with real data
function testReplyModal() {
    const firstComplaintCard = document.querySelector('[data-complaint-id]');
    if (firstComplaintCard) {
        const testComplaintId = firstComplaintCard.getAttribute('data-complaint-id');
        console.log('🧪 Testing Reply Modal with complaint:', testComplaintId);

        const clientName = firstComplaintCard.querySelector('.font-semibold')?.textContent || 'Test Client';
        const refNumber = firstComplaintCard.querySelector('.text-sm')?.textContent || 'REF001';

        openReplyModal(testComplaintId, clientName, refNumber);
    } else {
        console.log('❌ No complaint cards found for testing');
    }
}

</script>

 @endsection


