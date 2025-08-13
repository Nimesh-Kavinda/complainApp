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

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.delay-200 {
    animation-delay: 200ms;
}

.delay-300 {
    animation-delay: 300ms;
}

.delay-400 {
    animation-delay: 400ms;
}

.delay-500 {
    animation-delay: 500ms;
}

.delay-600 {
    animation-delay: 600ms;
}

.delay-700 {
    animation-delay: 700ms;
}

.delay-800 {
    animation-delay: 800ms;
}

.delay-1000 {
    animation-delay: 1000ms;
}

/* Floating animation for background elements */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

/* Shimmer effect */
@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

.shimmer::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    animation: shimmer 2s infinite;
}
</style>

<section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-100 via-blue-100 to-purple-100 dark:from-black dark:via-gray-900 dark:to-red-950 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/8 dark:bg-red-600/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/8 dark:bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-green-500/8 dark:bg-red-600/5 rounded-full blur-3xl animate-ping opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-blue-200/50 via-purple-200/50 to-green-200/50 dark:from-red-600/20 dark:to-red-700/20 border border-blue-300/50 dark:border-red-500/30 text-blue-700 dark:text-red-300 text-sm font-medium mb-8 backdrop-blur-sm animate-fade-in-up">
                    <svg class="w-5 h-5 mr-3 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    VAMPIOR DESIGNS - Internal Complaint Portal
                </div>

                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-8 animate-fade-in-up delay-300">
                    <span class="bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-white dark:via-gray-100 dark:to-red-100 bg-clip-text text-transparent leading-tight">
                        Staff
                    </span>
                    <span class="bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-white dark:via-gray-100 dark:to-red-100 bg-clip-text text-transparent leading-tight">
                        Complaint
                    </span>
                    <br>
                    <span class="bg-gradient-to-r from-purple-600 via-blue-600 to-green-600 dark:from-red-400 dark:via-red-500 dark:to-red-600 bg-clip-text text-transparent">
                        Management System
                    </span>
                </h1>

                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto mb-12 leading-relaxed animate-fade-in-up delay-500">
                    Internal portal for <span class="font-semibold text-blue-600 dark:text-red-300">Vampior Designs</span> staff and clients to report issues, track complaints,
                    and communicate with our support team. This system ensures all concerns are properly documented and resolved efficiently.
                </p>

                @if (!$staffId)
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in-up delay-700">
                      <a href="#" onclick="openStaffRegistrationModal()">
                       <button class="group w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-gray-700 dark:to-red-500 hover:from-indigo-700 hover:to-purple-700 dark:hover:from-red-500 dark:hover:to-red-600 text-white font-bold rounded-2xl shadow-2xl hover:shadow-indigo-500/25 dark:hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/0 via-white/10 to-purple-500/0 dark:from-red-500/0 dark:via-white/10 dark:to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                               Staff Registration
                            </span>
                        </button>
                   </a>

                </div>


                @elseif($isPending)

                    <div class="flex flex-col items-center justify-center animate-fade-in-up delay-700">
                        <p class="group w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 dark:from-red-600 dark:to-red-700 dark:hover:from-red-700 dark:hover:to-red-800 text-white font-bold rounded-2xl shadow-2xl hover:shadow-blue-500/25 dark:hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 border border-blue-500/50 dark:border-red-500/50 relative overflow-hidden">Your complaint is currently pending review. You will be notified once there is an update.</p>
                    </div>

                @elseif($isRejected)
                    <div class="flex flex-col items-center justify-center animate-fade-in-up delay-700">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-red-600 dark:text-red-400 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="group w-full sm:w-auto px-10 py-5 mt-8 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-2xl shadow-2xl hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 border border-red-500/50 relative overflow-hidden">
                            Your Registration Request has been rejected. Please contact HR for further assistance.</p>
                    </div>

                 @elseif($isApproved)
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in-up delay-700">
                   <a href="{{ route('staff.complaint.form') }}">
                       <button class="group w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 dark:from-red-600 dark:to-red-700 dark:hover:from-red-700 dark:hover:to-red-800 text-white font-bold rounded-2xl shadow-2xl hover:shadow-blue-500/25 dark:hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 border border-blue-500/50 dark:border-red-500/50 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-white/10 to-purple-500/0 dark:from-red-500/0 dark:via-white/10 dark:to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                File New Complaint
                            </span>
                        </button>
                   </a>
                    <a href="{{ route('staff.pastcomplaints') }}">
                        <button class="group w-full sm:w-auto px-10 py-5 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-gray-800 dark:text-gray-100 font-bold rounded-2xl border-2 border-purple-300/50 dark:border-red-500/30 hover:border-purple-500 dark:hover:border-red-400 hover:bg-white dark:hover:bg-black hover:shadow-xl hover:shadow-purple-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-purple-500/10 to-purple-500/0 dark:from-red-500/0 dark:via-red-500/10 dark:to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                My Complaint History
                            </span>
                        </button>
                    </a>
                </div>
                @endif

                {{-- <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in-up delay-700">
                   <a href="{{ route('staff.complaint.form') }}">
                       <button class="group w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 dark:from-red-600 dark:to-red-700 dark:hover:from-red-700 dark:hover:to-red-800 text-white font-bold rounded-2xl shadow-2xl hover:shadow-blue-500/25 dark:hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 border border-blue-500/50 dark:border-red-500/50 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-white/10 to-purple-500/0 dark:from-red-500/0 dark:via-white/10 dark:to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                File New Complaint
                            </span>
                        </button>
                   </a>
                    <a href="{{ route('staff.pastcomplaints') }}">
                        <button class="group w-full sm:w-auto px-10 py-5 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-gray-800 dark:text-gray-100 font-bold rounded-2xl border-2 border-purple-300/50 dark:border-red-500/30 hover:border-purple-500 dark:hover:border-red-400 hover:bg-white dark:hover:bg-black hover:shadow-xl hover:shadow-purple-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-purple-500/10 to-purple-500/0 dark:from-red-500/0 dark:via-red-500/10 dark:to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                My Complaint History
                            </span>
                        </button>
                    </a>
                </div> --}}

            </div>
        </div>
    </section>

    <!-- Statistics Section -->
     <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 to-blue-50 dark:from-gray-900 dark:to-black">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4 bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-white dark:to-red-300 bg-clip-text text-transparent animate-fade-in-up">
                    Complaint Resolution Performance
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto animate-fade-in-up delay-200">
                    Our commitment to resolving internal issues and maintaining high service standards
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-blue-200/30 dark:border-gray-700 hover:border-blue-400 dark:hover:border-red-300 dark:dark:hover:border-red-500 hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 dark:from-red-500 dark:to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-red-600 transition-colors duration-300">4hrs</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Average Response</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Initial acknowledgment time</p>
                </div>

                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-green-200/30 dark:border-gray-700 hover:border-green-400 dark:hover:border-red-300 dark:dark:hover:border-red-500 hover:shadow-2xl hover:shadow-green-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-400">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 dark:from-black dark:to-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-2 group-hover:text-green-600 dark:group-hover:text-red-600 transition-colors duration-300">94%</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Resolution Rate</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Successfully closed cases</p>
                </div>

                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-purple-200/30 dark:border-gray-700 hover:border-purple-400 dark:hover:border-red-300 dark:dark:hover:border-red-500 hover:shadow-2xl hover:shadow-purple-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-600 dark:from-red-600 dark:to-black rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-red-600 transition-colors duration-300">2.5</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Days Average</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Complete resolution time</p>
                </div>

                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-indigo-200/30 dark:border-gray-700 hover:border-indigo-400 dark:hover:border-red-300 dark:dark:hover:border-red-500 hover:shadow-2xl hover:shadow-indigo-500/10 dark:hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-600">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-blue-600 dark:from-gray-700 dark:to-red-700 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-red-600 transition-colors duration-300">150+</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Active Users</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Staff & clients using portal</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Categories -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-100 via-blue-100 to-purple-100 dark:from-black dark:via-gray-900 dark:to-red-950 relative overflow-hidden" id="complaint-categories">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 right-20 w-60 h-60 bg-blue-500/8 dark:bg-red-600/5 rounded-full blur-3xl animate-pulse delay-500"></div>
            <div class="absolute bottom-20 left-20 w-60 h-60 bg-purple-500/8 dark:bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black mb-6 bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-white dark:via-gray-200 dark:to-red-200 bg-clip-text text-transparent animate-fade-in-up">
                    Complaint Categories
                </h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-3xl mx-auto text-lg animate-fade-in-up delay-200">
                    Select the appropriate category for your complaint to ensure it reaches the right department for faster resolution
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Quality -->
                <div class="group p-8 rounded-3xl bg-white/90 dark:bg-gradient-to-br dark:from-gray-900/80 dark:to-black/80 backdrop-blur-sm border border-blue-300/50 dark:border-red-500/30 hover:border-blue-500 dark:hover:border-red-400 hover:shadow-2xl hover:shadow-blue-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 dark:from-red-500 dark:to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/0 via-white/20 to-blue-400/0 dark:from-red-400/0 dark:via-white/20 dark:to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-red-300 transition-colors duration-300">Service Quality</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Poor service delivery, unmet expectations, quality issues, or dissatisfaction with work provided</p>
                </div>

                <!-- Communication Issues -->
                <div class="group p-8 rounded-3xl bg-white/90 dark:bg-gradient-to-br dark:from-gray-900/80 dark:to-black/80 backdrop-blur-sm border border-purple-300/50 dark:border-red-500/30 hover:border-purple-500 dark:hover:border-red-400 hover:shadow-2xl hover:shadow-purple-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-400">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 dark:from-black dark:to-gray-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-400/0 via-white/20 to-purple-400/0 dark:from-gray-400/0 dark:via-white/20 dark:to-gray-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-purple-600 dark:group-hover:text-red-300 transition-colors duration-300">Communication</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Poor communication, lack of updates, unresponsive staff, or miscommunication incidents</p>
                </div>

                <!-- Billing & Payment -->
                <div class="group p-8 rounded-3xl bg-white/90 dark:bg-gradient-to-br dark:from-gray-900/80 dark:to-black/80 backdrop-blur-sm border border-green-300/50 dark:border-red-500/30 hover:border-green-500 dark:hover:border-red-400 hover:shadow-2xl hover:shadow-green-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-500">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 dark:from-red-600 dark:to-black rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-400/0 via-white/20 to-green-400/0 dark:from-red-400/0 dark:via-white/20 dark:to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-green-600 dark:group-hover:text-red-300 transition-colors duration-300">Billing & Payment</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Billing errors, payment issues, invoice discrepancies, or financial concerns</p>
                </div>

                <!-- Technical Issues -->
                <div class="group p-8 rounded-3xl bg-white/90 dark:bg-gradient-to-br dark:from-gray-900/80 dark:to-black/80 backdrop-blur-sm border border-indigo-300/50 dark:border-red-500/30 hover:border-indigo-500 dark:hover:border-red-400 hover:shadow-2xl hover:shadow-indigo-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-600">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 dark:from-gray-700 dark:to-red-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/0 via-white/20 to-indigo-400/0 dark:from-red-400/0 dark:via-white/20 dark:to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-red-300 transition-colors duration-300">Technical Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">System bugs, software problems, performance issues, or technical malfunctions</p>
                </div>

                <!-- Staff Behavior -->
                <div class="group p-8 rounded-3xl bg-white/90 dark:bg-gradient-to-br dark:from-gray-900/80 dark:to-black/80 backdrop-blur-sm border border-cyan-300/50 dark:border-red-500/30 hover:border-cyan-500 dark:hover:border-red-400 hover:shadow-2xl hover:shadow-cyan-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-700">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-600 dark:from-red-500 dark:to-gray-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/0 via-white/20 to-cyan-400/0 dark:from-red-400/0 dark:via-white/20 dark:to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-cyan-600 dark:group-hover:text-red-300 transition-colors duration-300">Staff Behavior</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Unprofessional conduct, inappropriate behavior, or staff-related concerns</p>
                </div>

                <!-- General Complaints -->
                <div class="group p-8 rounded-3xl bg-white/90 dark:bg-gradient-to-br dark:from-gray-900/80 dark:to-black/80 backdrop-blur-sm border border-teal-300/50 dark:border-red-500/30 hover:border-teal-500 dark:hover:border-red-400 hover:shadow-2xl hover:shadow-teal-500/20 dark:hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-blue-600 dark:from-black dark:to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-teal-400/0 via-white/20 to-teal-400/0 dark:from-gray-400/0 dark:via-white/20 dark:to-gray-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-teal-600 dark:group-hover:text-red-300 transition-colors duration-300">Other Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">Any other concerns, feedback, or issues not covered by the above categories</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-100 via-blue-100 to-purple-100 dark:from-gray-900 dark:to-black" id="contact-info">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black mb-6 bg-gradient-to-r from-blue-700 via-purple-600 to-green-600 dark:from-white dark:to-red-300 bg-clip-text text-transparent animate-fade-in-up">
                    Complaint Support Channels
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-3xl mx-auto text-lg animate-fade-in-up delay-200">
                    Multiple ways to escalate urgent complaints or get assistance with the complaint portal system
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center p-10 rounded-3xl bg-white/90 dark:bg-gray-800 backdrop-blur-sm border border-blue-300/50 dark:border-gray-700 hover:border-blue-500 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-blue-500/20 dark:hover:shadow-red-500/10 hover:-translate-y-3 hover:scale-105 transition-all duration-500 animate-fade-in-up delay-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 dark:from-red-500 dark:to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/0 via-white/20 to-blue-400/0 dark:from-red-400/0 dark:via-white/20 dark:to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-blue-600 dark:group-hover:text-red-600 transition-colors duration-300">Email Support</h3>
                    <p class="text-lg font-semibold text-blue-600 dark:text-red-400 mb-3">complaints@vampiordesigns.com</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Urgent Complaint Escalation</p>
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 dark:bg-red-900/30 text-blue-800 dark:text-red-300 text-xs font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"></circle>
                        </svg>
                        Response within 4 hours
                    </div>
                </div>

                <div class="group text-center p-10 rounded-3xl bg-white/90 dark:bg-gray-800 backdrop-blur-sm border border-purple-300/50 dark:border-gray-700 hover:border-purple-500 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-purple-500/20 dark:hover:shadow-red-500/10 hover:-translate-y-3 hover:scale-105 transition-all duration-500 animate-fade-in-up delay-400">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 dark:from-black dark:to-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-400/0 via-white/20 to-purple-400/0 dark:from-gray-400/0 dark:via-white/20 dark:to-gray-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-purple-600 dark:group-hover:text-red-600 transition-colors duration-300">Direct Hotline</h3>
                    <p class="text-lg font-semibold text-purple-600 dark:text-red-400 mb-3">+1 (555) COMPLAIN</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Emergency Complaint Line</p>
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 dark:bg-black/30 text-purple-800 dark:text-gray-300 text-xs font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"></circle>
                        </svg>
                        24/7 Critical Issues
                    </div>
                </div>

                <div class="group text-center p-10 rounded-3xl bg-white/90 dark:bg-gray-800 backdrop-blur-sm border border-green-300/50 dark:border-gray-700 hover:border-green-500 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-green-500/20 dark:hover:shadow-red-500/10 hover:-translate-y-3 hover:scale-105 transition-all duration-500 animate-fade-in-up delay-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 dark:from-red-600 dark:to-black rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-400/0 via-white/20 to-green-400/0 dark:from-red-400/0 dark:via-white/20 dark:to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-green-600 dark:group-hover:text-red-600 transition-colors duration-300">HR Department</h3>
                    <p class="text-lg font-semibold text-green-600 dark:text-red-400 mb-3">hr@vampiordesigns.com</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Staff-Related Complaints</p>
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 dark:bg-gray-900/30 text-green-800 dark:text-gray-300 text-xs font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"></circle>
                        </svg>
                        Mon-Fri, 9AM-6PM
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="mt-16 text-center">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-red-900/30 dark:to-red-800/30 border border-blue-200 dark:border-red-700 animate-fade-in-up delay-600">
                    <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-red-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="text-blue-800 dark:text-red-300 font-medium">
                        All complaints are treated confidentially and reviewed by senior management
                    </span>
                </div>
            </div>
        </div>
    </section>

    </section>

    </section>

    <!-- Staff Registration Modal -->
<div id="staffRegistrationModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-4xl w-full max-h-[95vh] overflow-y-auto border border-gray-200 dark:border-gray-600 relative">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-red-500 to-gray-800 rounded-t-3xl">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Staff Registration</h3>
                        <p class="text-red-100 text-sm">Apply to become a staff member at Vampior Designs</p>
                    </div>
                </div>
                <button onclick="closeStaffRegistrationModal()" type="button" class="text-white/80 hover:text-white transition-colors p-2 hover:bg-white/10 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8">
                <!-- Registration Status Alert (will be populated by JavaScript) -->
                <div id="registrationStatusAlert" class="hidden mb-6"></div>

                <!-- Registration Form -->
                <form id="staffRegistrationForm" class="space-y-6">
                    @csrf

                    <!-- Staff ID -->
                    <div class="form-group">
                        <label for="staff_id" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                            </svg>
                            Staff ID *
                        </label>
                        <input type="text" id="staff_id" name="staff_id" required
                               class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                               placeholder="Enter your unique staff ID (e.g., EMP001, ST2023001)">
                        <p class="text-xs text-gray-500 mt-1">Your official staff identification number</p>
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Department *
                        </label>
                        <select id="department" name="department" required
                                class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300">
                            <option value="">Select your department...</option>
                            <!-- Options will be populated by JavaScript -->
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Choose the department you'll be working in</p>
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group">
                        <label for="date_of_birth" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Date of Birth *
                        </label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required
                               class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                               max="{{ date('Y-m-d', strtotime('-16 years')) }}">
                        <p class="text-xs text-gray-500 mt-1">You must be at least 16 years old</p>
                    </div>

                    <!-- NIC Number -->
                    <div class="form-group">
                        <label for="nic_number" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            NIC Number *
                        </label>
                        <input type="text" id="nic_number" name="nic_number" required
                               class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300"
                               placeholder="Enter your NIC number (e.g., 199712345678 or 971234567V)"
                               pattern="[0-9]{9}[vVxX]|[0-9]{12}">
                        <p class="text-xs text-gray-500 mt-1">Your National Identity Card number</p>
                    </div>

                    <!-- Staff ID Image Upload -->
                    <div class="form-group">
                        <label for="staff_id_image" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Staff ID Image *
                        </label>
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-red-400 transition-colors duration-300">
                            <input type="file" id="staff_id_image" name="staff_id_image" accept="image/*" required
                                   class="hidden" onchange="handleImageUpload(this)">
                            <label for="staff_id_image" class="cursor-pointer block">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <span class="text-lg font-medium text-gray-600 dark:text-gray-400">Click to upload Staff ID image</span>
                                <br>
                                <span class="text-sm text-gray-500">JPG, PNG, GIF up to 5MB</span>
                            </label>
                            <div id="imagePreview" class="mt-4 hidden"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Upload a clear photo of your staff ID card or official employment document</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" onclick="closeStaffRegistrationModal()"
                                class="px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            Cancel
                        </button>
                        <button type="submit" id="submitRegistrationBtn"
                                class="px-8 py-3 bg-gradient-to-r from-red-600 to-gray-800 hover:from-red-700 hover:to-gray-900 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2 hidden" id="submitSpinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Submit Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script>

        function openStaffRegistrationModal() {
    // Check registration status first
    checkRegistrationStatus();
    loadDepartments();
    document.getElementById('staffRegistrationModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeStaffRegistrationModal() {
    document.getElementById('staffRegistrationModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    resetRegistrationForm();
}

function resetRegistrationForm() {
    document.getElementById('staffRegistrationForm').reset();
    document.getElementById('imagePreview').innerHTML = '';
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('registrationStatusAlert').classList.add('hidden');
}

// Check if user already has a registration
async function checkRegistrationStatus() {
    try {
        const response = await fetch('/staff-registration/status');
        const data = await response.json();

        if (data.success && data.has_registration) {
            const registration = data.registration;
            showRegistrationStatus(registration);
        }
    } catch (error) {
        console.error('Error checking registration status:', error);
    }
}

function showRegistrationStatus(registration) {
    const alertDiv = document.getElementById('registrationStatusAlert');
    let statusClass = '';
    let statusText = '';
    let message = '';

    switch (registration.status) {
        case 'pending':
            statusClass = 'bg-yellow-100 border-yellow-500 text-yellow-800';
            statusText = 'Pending Review';
            message = 'Your staff registration is currently under review by the department head.';
            break;
        case 'approved':
            statusClass = 'bg-green-100 border-green-500 text-green-800';
            statusText = 'Approved';
            message = 'Congratulations! Your staff registration has been approved.';
            break;
        case 'rejected':
            statusClass = 'bg-red-100 border-red-500 text-red-800';
            statusText = 'Rejected';
            message = `Your registration was rejected. ${registration.rejection_reason ? 'Reason: ' + registration.rejection_reason : ''}`;
            break;
    }

    alertDiv.innerHTML = `
        <div class="border-l-4 p-4 rounded ${statusClass}">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium">Registration Status: ${statusText}</h3>
                    <p class="mt-1 text-sm">${message}</p>
                    <p class="mt-1 text-xs">Submitted: ${new Date(registration.created_at).toLocaleDateString()}</p>
                </div>
            </div>
        </div>
    `;
    alertDiv.classList.remove('hidden');

    // Disable form if already has pending or approved registration
    if (registration.status === 'pending' || registration.status === 'approved') {
        const form = document.getElementById('staffRegistrationForm');
        const inputs = form.querySelectorAll('input, select, button[type="submit"]');
        inputs.forEach(input => input.disabled = true);
    }
}

// Load departments
async function loadDepartments() {
    try {
        const response = await fetch('/staff-registration/departments');
        const data = await response.json();

        if (data.success) {
            const departmentSelect = document.getElementById('department');
            departmentSelect.innerHTML = '<option value="">Select your department...</option>';

            data.departments.forEach(department => {
                const option = document.createElement('option');
                option.value = department.name;
                option.textContent = department.name;
                departmentSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading departments:', error);
        showNotification('Failed to load departments', 'error');
    }
}

// Handle image upload preview
function handleImageUpload(input) {
    const file = input.files[0];
    const preview = document.getElementById('imagePreview');

    if (file) {
        // Validate file size (5MB = 5 * 1024 * 1024 bytes)
        if (file.size > 5 * 1024 * 1024) {
            showNotification('Image size must be less than 5MB', 'error');
            input.value = '';
            return;
        }

        // Validate file type
        if (!file.type.startsWith('image/')) {
            showNotification('Please select a valid image file', 'error');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="flex items-center space-x-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                    <img src="${e.target.result}" alt="Preview" class="w-16 h-16 object-cover rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-green-800">${file.name}</p>
                        <p class="text-xs text-green-600">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                    <button type="button" onclick="removeImage()" class="text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            `;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('staff_id_image').value = '';
    document.getElementById('imagePreview').innerHTML = '';
    document.getElementById('imagePreview').classList.add('hidden');
}

// Submit registration form
document.getElementById('staffRegistrationForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitRegistrationBtn');
    const spinner = document.getElementById('submitSpinner');

    // Show loading state
    submitBtn.disabled = true;
    spinner.classList.remove('hidden');
    submitBtn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Submitting...';

    try {
        const formData = new FormData(this);

        const response = await fetch('/staff-registration/submit', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (data.success) {
            showNotification(data.message, 'success');
            closeStaffRegistrationModal();
        } else {
            showNotification(data.message || 'Registration failed', 'error');
        }
    } catch (error) {
        console.error('Error submitting registration:', error);
        showNotification('Failed to submit registration. Please try again.', 'error');
    } finally {
        // Reset loading state
        submitBtn.disabled = false;
        spinner.classList.add('hidden');
        submitBtn.innerHTML = 'Submit Registration';
    }
});

// Close modal when clicking outside
document.getElementById('staffRegistrationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStaffRegistrationModal();
    }
});

// Notification function (if not already defined)
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

    </script>

@endsection
