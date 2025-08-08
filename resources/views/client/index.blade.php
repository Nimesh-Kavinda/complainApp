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

<section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-black via-gray-900 to-red-950 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-600/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-red-600/5 rounded-full blur-3xl animate-ping opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-red-600/20 to-red-700/20 border border-red-500/30 text-red-300 text-sm font-medium mb-8 backdrop-blur-sm animate-fade-in-up">
                    <svg class="w-5 h-5 mr-3 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    VAMPIOR DESIGNS - Internal Complaint Portal
                </div>

                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-8 animate-fade-in-up delay-300">
                    <span class="bg-gradient-to-r from-white via-gray-100 to-red-100 bg-clip-text text-transparent leading-tight">
                        Complaint
                    </span>
                    <br>
                    <span class="bg-gradient-to-r from-red-400 via-red-500 to-red-600 bg-clip-text text-transparent">
                        Management System
                    </span>
                </h1>

                <p class="text-xl text-gray-300 max-w-4xl mx-auto mb-12 leading-relaxed animate-fade-in-up delay-500">
                    Internal portal for <span class="font-semibold text-red-300">Vampior Designs</span> staff and clients to report issues, track complaints,
                    and communicate with our support team. This system ensures all concerns are properly documented and resolved efficiently.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in-up delay-700">
                   <a href="{{ route('client.complain') }}">
                       <button class="group w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-2xl shadow-2xl hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 border border-red-500/50 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                File New Complaint
                            </span>
                        </button>
                   </a>
                    <a href="{{ route('client.past-complaints') }}">
                        <button class="group w-full sm:w-auto px-10 py-5 bg-black/80 backdrop-blur-sm text-gray-100 font-bold rounded-2xl border-2 border-red-500/30 hover:border-red-400 hover:bg-black hover:shadow-xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                My Complaint History
                            </span>
                        </button>
                    </a>

                      <a href="{{ route('client.complain') }}">
                       <button class="group w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-gray-700 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-bold rounded-2xl shadow-2xl hover:shadow-red-500/25 transform hover:-translate-y-3 hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center relative z-10">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 14a4 4 0 10-8 0m8 0a4 4 0 01-8 0m8 0v1a3 3 0 01-3 3H9a3 3 0 01-3-3v-1m13-4v6m3-3h-6" />
                                    </svg>
                               Staff Registration
                            </span>
                        </button>
                   </a>

                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-black">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4 bg-gradient-to-r from-black to-red-700 dark:from-white dark:to-red-300 bg-clip-text text-transparent animate-fade-in-up">
                    Complaint Resolution Performance
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto animate-fade-in-up delay-200">
                    Our commitment to resolving internal issues and maintaining high service standards
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-black dark:text-white mb-2 group-hover:text-red-600 transition-colors duration-300">4hrs</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Average Response</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Initial acknowledgment time</p>
                </div>

                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-400">
                    <div class="w-20 h-20 bg-gradient-to-br from-black to-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-black dark:text-white mb-2 group-hover:text-red-600 transition-colors duration-300">94%</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Resolution Rate</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Successfully closed cases</p>
                </div>

                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-600 to-black rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-black dark:text-white mb-2 group-hover:text-red-600 transition-colors duration-300">2.5</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Days Average</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Complete resolution time</p>
                </div>

                <div class="text-center p-8 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 group hover:-translate-y-2 animate-fade-in-up delay-600">
                    <div class="w-20 h-20 bg-gradient-to-br from-gray-700 to-red-700 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                        <svg class="w-10 h-10 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-black dark:text-white mb-2 group-hover:text-red-600 transition-colors duration-300">150+</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-semibold">Active Users</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Staff & clients using portal</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Categories -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-black via-gray-900 to-red-950 relative overflow-hidden" id="complaint-categories">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 right-20 w-60 h-60 bg-red-600/5 rounded-full blur-3xl animate-pulse delay-500"></div>
            <div class="absolute bottom-20 left-20 w-60 h-60 bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black mb-6 bg-gradient-to-r from-white via-gray-200 to-red-200 bg-clip-text text-transparent animate-fade-in-up">
                    Complaint Categories
                </h2>
                <p class="text-gray-300 max-w-3xl mx-auto text-lg animate-fade-in-up delay-200">
                    Select the appropriate category for your complaint to ensure it reaches the right department for faster resolution
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Quality -->
                <div class="group p-8 rounded-3xl bg-gradient-to-br from-gray-900/80 to-black/80 backdrop-blur-sm border border-red-500/30 hover:border-red-400 hover:shadow-2xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400/0 via-white/20 to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-300 transition-colors duration-300">Service Quality</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Poor service delivery, unmet expectations, quality issues, or dissatisfaction with work provided</p>
                </div>

                <!-- Communication Issues -->
                <div class="group p-8 rounded-3xl bg-gradient-to-br from-gray-900/80 to-black/80 backdrop-blur-sm border border-red-500/30 hover:border-red-400 hover:shadow-2xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-400">
                    <div class="w-16 h-16 bg-gradient-to-br from-black to-gray-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-400/0 via-white/20 to-gray-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-300 transition-colors duration-300">Communication</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Poor communication, lack of updates, unresponsive staff, or miscommunication incidents</p>
                </div>

                <!-- Billing & Payment -->
                <div class="group p-8 rounded-3xl bg-gradient-to-br from-gray-900/80 to-black/80 backdrop-blur-sm border border-red-500/30 hover:border-red-400 hover:shadow-2xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-500">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-600 to-black rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400/0 via-white/20 to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-300 transition-colors duration-300">Billing & Payment</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Billing errors, payment issues, invoice discrepancies, or financial concerns</p>
                </div>

                <!-- Technical Issues -->
                <div class="group p-8 rounded-3xl bg-gradient-to-br from-gray-900/80 to-black/80 backdrop-blur-sm border border-red-500/30 hover:border-red-400 hover:shadow-2xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-600">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-700 to-red-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400/0 via-white/20 to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-300 transition-colors duration-300">Technical Issues</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">System bugs, software problems, performance issues, or technical malfunctions</p>
                </div>

                <!-- Staff Behavior -->
                <div class="group p-8 rounded-3xl bg-gradient-to-br from-gray-900/80 to-black/80 backdrop-blur-sm border border-red-500/30 hover:border-red-400 hover:shadow-2xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-700">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-gray-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400/0 via-white/20 to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-300 transition-colors duration-300">Staff Behavior</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Unprofessional conduct, inappropriate behavior, or staff-related concerns</p>
                </div>

                <!-- General Complaints -->
                <div class="group p-8 rounded-3xl bg-gradient-to-br from-gray-900/80 to-black/80 backdrop-blur-sm border border-red-500/30 hover:border-red-400 hover:shadow-2xl hover:shadow-red-500/20 hover:-translate-y-3 hover:scale-105 transition-all duration-500 cursor-pointer animate-fade-in-up delay-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-black to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-400/0 via-white/20 to-gray-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-8 h-8 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-300 transition-colors duration-300">Other Issues</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Any other concerns, feedback, or issues not covered by the above categories</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-black" id="contact-info">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black mb-6 bg-gradient-to-r from-black to-red-700 dark:from-white dark:to-red-300 bg-clip-text text-transparent animate-fade-in-up">
                    Complaint Support Channels
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-3xl mx-auto text-lg animate-fade-in-up delay-200">
                    Multiple ways to escalate urgent complaints or get assistance with the complaint portal system
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center p-10 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 hover:-translate-y-3 hover:scale-105 transition-all duration-500 animate-fade-in-up delay-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400/0 via-white/20 to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-black dark:text-white mb-4 group-hover:text-red-600 transition-colors duration-300">Email Support</h3>
                    <p class="text-lg font-semibold text-red-600 dark:text-red-400 mb-3">complaints@vampiordesigns.com</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Urgent Complaint Escalation</p>
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 text-xs font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"></circle>
                        </svg>
                        Response within 4 hours
                    </div>
                </div>

                <div class="group text-center p-10 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 hover:-translate-y-3 hover:scale-105 transition-all duration-500 animate-fade-in-up delay-400">
                    <div class="w-20 h-20 bg-gradient-to-br from-black to-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-400/0 via-white/20 to-gray-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-black dark:text-white mb-4 group-hover:text-red-600 transition-colors duration-300">Direct Hotline</h3>
                    <p class="text-lg font-semibold text-red-600 dark:text-red-400 mb-3">+1 (555) COMPLAIN</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Emergency Complaint Line</p>
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-black/10 dark:bg-black/30 text-black dark:text-gray-300 text-xs font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"></circle>
                        </svg>
                        24/7 Critical Issues
                    </div>
                </div>

                <div class="group text-center p-10 rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 hover:-translate-y-3 hover:scale-105 transition-all duration-500 animate-fade-in-up delay-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-600 to-black rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400/0 via-white/20 to-red-400/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-black dark:text-white mb-4 group-hover:text-red-600 transition-colors duration-300">HR Department</h3>
                    <p class="text-lg font-semibold text-red-600 dark:text-red-400 mb-3">hr@vampiordesigns.com</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Staff-Related Complaints</p>
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-900/30 text-gray-800 dark:text-gray-300 text-xs font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"></circle>
                        </svg>
                        Mon-Fri, 9AM-6PM
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="mt-16 text-center">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 border border-red-200 dark:border-red-700 animate-fade-in-up delay-600">
                    <svg class="w-5 h-5 mr-3 text-red-600 dark:text-red-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="text-red-800 dark:text-red-300 font-medium">
                        All complaints are treated confidentially and reviewed by senior management
                    </span>
                </div>
            </div>
        </div>
    </section>

    </section>

@endsection
