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

@keyframes slide-in-left {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse-glow {
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

.animate-slide-in-left {
    animation: slide-in-left 0.6s ease-out forwards;
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}

.form-field {
    opacity: 0;
    animation: fade-in-up 0.6s ease-out forwards;
}

.form-field:nth-child(1) { animation-delay: 0.1s; }
.form-field:nth-child(2) { animation-delay: 0.2s; }
.form-field:nth-child(3) { animation-delay: 0.3s; }
.form-field:nth-child(4) { animation-delay: 0.4s; }
.form-field:nth-child(5) { animation-delay: 0.5s; }
.form-field:nth-child(6) { animation-delay: 0.6s; }
.form-field:nth-child(7) { animation-delay: 0.7s; }
.form-field:nth-child(8) { animation-delay: 0.8s; }
.form-field:nth-child(9) { animation-delay: 0.9s; }
.form-field:nth-child(10) { animation-delay: 1.0s; }

.input-focus:focus {
    transform: scale(1.02);
    transition: all 0.3s ease;
}

.file-upload-area {
    transition: all 0.3s ease;
}

.file-upload-area:hover {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.05), rgba(0, 0, 0, 0.05));
    border-color: rgba(239, 68, 68, 0.3);
}

/* Floating background elements */
.bg-floating {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.bg-floating:nth-child(1) {
    top: 10%; left: 10%; width: 60px; height: 60px;
    animation-delay: 0s; background: #ef4444;
}
.bg-floating:nth-child(2) {
    top: 20%; right: 15%; width: 80px; height: 80px;
    animation-delay: 2s; background: #000000;
}
.bg-floating:nth-child(3) {
    bottom: 30%; left: 20%; width: 40px; height: 40px;
    animation-delay: 4s; background: #ef4444;
}
</style>

    <section id="complaint-form" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white via-gray-50 to-red-50 dark:from-black dark:via-gray-900 dark:to-red-950 transition-all duration-500 relative overflow-hidden min-h-screen">
        <!-- Floating Background Elements -->
        <div class="bg-floating"></div>
        <div class="bg-floating"></div>
        <div class="bg-floating"></div>

        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-600/5 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>

    <div class="max-w-3xl mx-auto bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-2xl rounded-3xl p-8 space-y-8 border border-red-200/30 dark:border-red-800/30 relative z-10 hover:shadow-red-500/10 transition-all duration-500">
        <div class="text-center animate-fade-in-up">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-600/20 to-red-700/20 border border-red-500/30 text-red-600 dark:text-red-400 text-sm font-medium mb-6 backdrop-blur-sm">
                <svg class="w-5 h-5 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                File New Complaint
            </div>
            <h2 class="text-4xl font-black mb-4 bg-gradient-to-r from-black to-red-600 dark:from-white dark:to-red-400 bg-clip-text text-transparent">Submit Your Complaint</h2>
            <p class="text-gray-600 dark:text-gray-300 text-lg">We take your concerns seriously. Please provide detailed information below.</p>
        </div>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-900/30 border-l-4 border-red-500 text-red-700 dark:text-red-300 px-6 py-4 rounded-r-lg animate-slide-in-left shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <strong>Please fix the following errors:</strong>
                </div>
                <ul class="mt-3 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-300 px-6 py-4 rounded-r-lg animate-slide-in-left shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 dark:bg-red-900/30 border-l-4 border-red-500 text-red-700 dark:text-red-300 px-6 py-4 rounded-r-lg animate-slide-in-left shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <form action="{{ route('client.complaint.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Name -->
            <div class="form-field group">
                <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Full Name
                </label>
                <input type="text" id="name" name="name" required
                       class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300"
                       value="{{ Auth::user()->name ?? '' }}" readonly>
            </div>

            <!-- Type of User -->
            <div class="form-field group">
                <label for="userType" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    User Type
                </label>
                <input type="text" id="userType" name="userType" required
                    class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300"
                    value="{{ Auth::user()->role ?? '' }}" readonly
                    oninput="toggleFields()">
            </div>

            <!-- NIC (Only for Clients) -->
            <div id="nicField" class="form-field group mt-4 hidden">
                <label for="nic" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                    </svg>
                    NIC Number *
                </label>
                <input type="text" id="nic" name="nic" required
                    class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300"
                    placeholder="Enter your NIC number">
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                    <svg class="w-3 h-3 mr-1 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Your NIC number will be used for identification of your complaints.
                </p>
            </div>

            <!-- Staff ID (Only for Staff) -->
            <div id="staffIdField" class="form-field group mt-4 hidden">
                <label for="staffId" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Staff ID
                </label>
                <input type="text" id="staffId" name="staffId"
                    class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300"
                    placeholder="Enter your Staff ID">
            </div>

            <!-- Contact Phone -->
            <div class="form-field group">
                <label for="contact_phone" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Contact Phone <span class="text-gray-400">(Optional)</span>
                </label>
                <input type="tel" id="contact_phone" name="contact_phone"
                    class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300"
                    placeholder="Enter your phone number">
            </div>

            <!-- Complaint Category -->
            <div class="form-field group">
                <label for="category" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Complaint Category *
                </label>
                <select id="category" name="category" required class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300 cursor-pointer">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Complaint Title -->
            <div class="form-field group">
                <label for="complaint_title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Complaint Title <span class="text-gray-400">(Optional)</span>
                </label>
                <input type="text" id="complaint_title" name="complaint_title"
                    class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300"
                    placeholder="Brief title for your complaint">
            </div>

            <!-- Priority Level -->
            <div class="form-field group">
                <label for="priority" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Priority Level
                </label>
                <select id="priority" name="priority" class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300 cursor-pointer">
                    <option value="low">🟢 Low - General inquiry or minor issue</option>
                    <option value="medium" selected>🟡 Medium - Standard complaint</option>
                    <option value="high">🟠 High - Significant issue affecting service</option>
                    <option value="urgent">🔴 Urgent - Critical issue requiring immediate attention</option>
                </select>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                    <svg class="w-3 h-3 mr-1 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Select the urgency level of your complaint to help us prioritize response.
                </p>
            </div>

            <!-- Complaint Details -->
            <div class="form-field group">
                <label for="details" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Complaint Details *
                </label>
                <textarea id="details" name="details" rows="6" required class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300 resize-none" placeholder="Please provide detailed information about your complaint including:
• What happened?
• When did it occur?
• Who was involved?
• What was the expected outcome?
• How has this affected you?"></textarea>
            </div>

            <!-- Evidence Upload -->
            <div class="form-field group">
                <label for="evidence" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                    Attach Evidence <span class="text-gray-400">(Optional)</span>
                </label>
                <div class="file-upload-area border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-red-400 dark:hover:border-red-500">
                    <input type="file" id="evidence" name="evidence[]" multiple
                           accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.txt"
                           class="hidden"
                           onchange="updateFileDisplay(this)">
                    <label for="evidence" class="cursor-pointer block">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4 group-hover:text-red-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span class="text-lg font-medium text-gray-600 dark:text-gray-400">Click to upload files</span>
                        <br>
                        <span class="text-sm text-gray-500 dark:text-gray-500">or drag and drop</span>
                    </label>
                    <div id="fileList" class="mt-4 text-sm text-gray-600 dark:text-gray-400"></div>
                </div>
                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400 flex items-start">
                    <svg class="w-4 h-4 mr-2 text-red-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span>
                        <strong>Supported formats:</strong> Images (JPG, PNG, GIF), Videos (MP4, AVI, MOV), Audio (MP3, WAV), Documents (PDF, DOC, DOCX, TXT).<br>
                        <strong>Limits:</strong> Maximum 10 files, 10MB each.
                    </span>
                </p>
            </div>

            <!-- Evidence Description -->
            <div class="form-field group">
                <label for="evidence_description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300 group-focus-within:text-red-600 dark:group-focus-within:text-red-400">
                    <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    Evidence Description <span class="text-gray-400">(Optional)</span>
                </label>
                <textarea id="evidence_description" name="evidence_description" rows="3"
                    class="mt-1 w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 input-focus transition-all duration-300 hover:border-red-300 resize-none"
                    placeholder="Briefly describe the attached evidence and how it relates to your complaint"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center form-field">
                <button type="submit" id="com_submit" class="group w-full sm:w-auto px-12 py-4 bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 text-white font-bold rounded-2xl shadow-2xl hover:shadow-red-500/25 transition-all duration-500 hover:scale-105 hover:-translate-y-1 relative overflow-hidden animate-pulse-glow">
                    <span class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                    <span class="flex items-center justify-center relative z-10">
                        <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Submit Complaint
                    </span>
                </button>
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    Your complaint will be submitted securely and confidentially
                </p>
            </div>
        </form>
    </div>
</section>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        toggleFields(); // Initial call on page load

        // Add form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const userType = document.getElementById('userType').value.toLowerCase().trim();
            const nicField = document.getElementById('nic');

            // For clients, NIC is required
            if (userType === 'client' && !nicField.value.trim()) {
                e.preventDefault();
                showNotification('NIC number is required for client complaints.', 'error');
                nicField.focus();
                return false;
            }

            // Validate NIC format (basic validation)
            if (userType === 'client' && nicField.value.trim()) {
                const nicPattern = /^[0-9]{9}[vVxX]$|^[0-9]{12}$/;
                if (!nicPattern.test(nicField.value.trim())) {
                    e.preventDefault();
                    showNotification('Please enter a valid NIC number (9 digits followed by V/X or 12 digits).', 'error');
                    nicField.focus();
                    return false;
                }
            }

            // Show loading state
            const submitBtn = document.getElementById('com_submit');
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 mr-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Submitting...
            `;
            submitBtn.disabled = true;
        });

        // File upload validation and display
        const evidenceInput = document.getElementById('evidence');
        evidenceInput.addEventListener('change', function() {
            const files = this.files;
            const maxFiles = 10;
            const maxSize = 10 * 1024 * 1024; // 10MB

            if (files.length > maxFiles) {
                showNotification(`You can only upload a maximum of ${maxFiles} files.`, 'error');
                this.value = '';
                return;
            }

            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    showNotification(`File "${files[i].name}" is too large. Maximum size is 10MB.`, 'error');
                    this.value = '';
                    return;
                }
            }

            updateFileDisplay(this);
        });

        // Add floating label effect to inputs
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    });

    function updateFileDisplay(input) {
        const fileList = document.getElementById('fileList');
        const files = input.files;

        if (files.length === 0) {
            fileList.innerHTML = '';
            return;
        }

        let html = '<div class="mt-4 space-y-2">';
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            html += `
                <div class="flex items-center justify-between bg-red-50 dark:bg-red-900/20 p-3 rounded-lg border border-red-200 dark:border-red-800">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">${file.name}</span>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">${fileSize} MB</span>
                </div>
            `;
        }
        html += '</div>';
        fileList.innerHTML = html;
    }

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
        }, 3000);
    }

    function toggleFields() {
        const userType = document.getElementById('userType').value.toLowerCase().trim();
        const nicField = document.getElementById('nicField');
        const staffIdField = document.getElementById('staffIdField');
        const nicInput = document.getElementById('nic');

        if (userType === 'client') {
            nicField.classList.remove('hidden');
            staffIdField.classList.add('hidden');
            nicInput.required = true;
            // Add animation
            setTimeout(() => nicField.style.animation = 'fade-in-up 0.5s ease-out', 100);
        } else if (userType === 'staff' || userType === 'staff_member') {
            staffIdField.classList.remove('hidden');
            nicField.classList.add('hidden');
            nicInput.required = false;
            // Add animation
            setTimeout(() => staffIdField.style.animation = 'fade-in-up 0.5s ease-out', 100);
        } else {
            // Hide both if userType is unrecognized
            nicField.classList.add('hidden');
            staffIdField.classList.add('hidden');
            nicInput.required = false;
        }
    }
</script>

@endsection
