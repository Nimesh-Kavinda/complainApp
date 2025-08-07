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
        box-shadow: 0 0 5px rgba(239, 68, 68, 0.3);
    }
    50% {
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.6), 0 0 30px rgba(239, 68, 68, 0.4);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
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

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.section-card {
    opacity: 0;
    animation: fade-in-up 0.8s ease-out forwards;
}

.section-card:nth-child(1) { animation-delay: 0.2s; }
.section-card:nth-child(2) { animation-delay: 0.4s; }
.section-card:nth-child(3) { animation-delay: 0.6s; }

.category-card {
    opacity: 0;
    animation: fade-in-up 0.6s ease-out forwards;
}

.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }
.category-card:nth-child(5) { animation-delay: 0.5s; }
.category-card:nth-child(6) { animation-delay: 0.6s; }

/* Floating background elements */
.bg-floating {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

.bg-floating:nth-child(1) {
    top: 10%; left: 10%; width: 80px; height: 80px;
    animation-delay: 0s; background: #ef4444;
}
.bg-floating:nth-child(2) {
    top: 20%; right: 15%; width: 120px; height: 120px;
    animation-delay: 3s; background: #000000;
}
.bg-floating:nth-child(3) {
    bottom: 20%; left: 15%; width: 60px; height: 60px;
    animation-delay: 6s; background: #ef4444;
}
.bg-floating:nth-child(4) {
    bottom: 5%; right: 20%; width: 90px; height: 90px;
    animation-delay: 9s; background: #000000;
}

</style>

<div class="min-h-screen bg-gradient-to-br from-white via-gray-50 to-red-50 dark:from-black dark:via-gray-900 dark:to-red-950 relative overflow-hidden">
    <!-- Floating Background Elements -->
    <div class="bg-floating"></div>
    <div class="bg-floating"></div>
    <div class="bg-floating"></div>
    <div class="bg-floating"></div>

    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-600/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 right-1/4 w-60 h-60 bg-red-600/3 rounded-full blur-3xl animate-pulse delay-2000"></div>
    </div>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 animate-fade-in-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-600/20 to-red-700/20 border border-red-500/30 text-red-600 dark:text-red-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <svg class="w-5 h-5 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Report Issues & Concerns
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6 bg-gradient-to-r from-black to-red-600 dark:from-white dark:to-red-400 bg-clip-text text-transparent">
                    Note Your Concerns
                </h1>

                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed">
                    We value your feedback and take every complaint seriously. Help us improve our services by reporting any issues you've experienced with <span class="font-bold text-red-600 dark:text-red-400">VAMPIOR DESIGNS</span>.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-in-right">
                    <a href="{{ route('login') }}" class="group w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 text-white font-bold rounded-xl shadow-lg hover:shadow-red-500/25 transition-all duration-300 hover:scale-105 hover:-translate-y-1 relative overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                        <span class="flex items-center justify-center relative z-10">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            File a Complaint
                        </span>
                    </a>
                    <a href="{{ route('login') }}" class="group w-full sm:w-auto px-8 py-4 bg-white/90 dark:bg-black/90 backdrop-blur-lg text-gray-700 dark:text-gray-300 font-bold rounded-xl border-2 border-red-200/50 dark:border-red-800/50 hover:border-red-500 dark:hover:border-red-400 hover:shadow-lg hover:shadow-red-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-1 relative overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/5 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                        <span class="flex items-center justify-center relative z-10">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            My Complaints History
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="section-card text-center p-8 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300 animate-float">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-3 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-300">24/7</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-medium text-lg">Available Support</p>
                </div>

                <div class="section-card text-center p-8 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300 animate-float" style="animation-delay: 2s;">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-3 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">98%</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-medium text-lg">Resolution Rate</p>
                </div>

                <div class="section-card text-center p-8 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 group">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300 animate-float" style="animation-delay: 4s;">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">&lt;12hrs</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-medium text-lg">Average Response</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Categories -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 relative z-10" id="complaint-categories">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 animate-fade-in-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-600/20 to-red-700/20 border border-red-500/30 text-red-600 dark:text-red-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <svg class="w-4 h-4 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" clip-rule="evenodd"></path>
                    </svg>
                    Categories Available
                </div>
                <h2 class="text-3xl sm:text-4xl font-black mb-4 bg-gradient-to-r from-black to-red-600 dark:from-white dark:to-red-400 bg-clip-text text-transparent">
                    Complaint Categories
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                    Select the category that best describes your concern for faster resolution
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Service Quality -->
                <div class="category-card group p-6 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/10 to-red-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 relative z-10 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-300">Service Quality</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">Issues with design quality, deliverables, or service standards</p>
                </div>

                <!-- Billing -->
                <div class="category-card group p-6 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-yellow-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/0 via-yellow-500/10 to-yellow-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 relative z-10 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors duration-300">Billing Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">Payment disputes, incorrect charges, or billing inquiries</p>
                </div>

                <!-- Communication -->
                <div class="category-card group p-6 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/10 to-blue-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 relative z-10 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Communication</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">Poor communication, delayed responses, or misunderstandings</p>
                </div>

                <!-- Timeline -->
                <div class="category-card group p-6 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-purple-500/10 to-purple-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 relative z-10 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">Timeline Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">Project delays, missed deadlines, or scheduling conflicts</p>
                </div>

                <!-- Technical -->
                <div class="category-card group p-6 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-green-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-500/0 via-green-500/10 to-green-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 relative z-10 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">Technical Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">Website problems, file delivery issues, or technical failures</p>
                </div>

                <!-- Other -->
                <div class="category-card group p-6 rounded-2xl bg-white/90 dark:bg-black/90 backdrop-blur-lg shadow-xl border border-red-200/30 dark:border-red-800/30 hover:shadow-2xl hover:shadow-gray-500/10 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-500/0 via-gray-500/10 to-gray-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-black to-gray-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 relative z-10 group-hover:text-gray-600 dark:group-hover:text-gray-400 transition-colors duration-300">Other Concerns</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">Any other issues or concerns not covered above</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-black via-red-950 to-black dark:from-red-950 dark:via-black dark:to-red-950 relative z-10" id="contact-info">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 animate-fade-in-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-600/20 to-red-700/20 border border-red-500/30 text-red-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <svg class="w-4 h-4 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" clip-rule="evenodd"></path>
                    </svg>
                    Contact Support
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-white mb-4">Get In Touch</h2>
                <p class="text-gray-300 max-w-2xl mx-auto text-lg leading-relaxed">
                    Multiple ways to reach us for urgent matters or additional support
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 rounded-2xl bg-white/10 dark:bg-black/30 backdrop-blur-lg border border-red-500/30 hover:border-red-400 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group shadow-xl hover:shadow-red-500/20">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-3 group-hover:text-red-400 transition-colors duration-300">Email Support</h3>
                    <p class="text-gray-300 text-sm mb-3 font-medium">complaints@vampiordesigns.com</p>
                    <p class="text-gray-400 text-xs">Response within 2 hours</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-white/10 dark:bg-black/30 backdrop-blur-lg border border-red-500/30 hover:border-green-400 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group shadow-xl hover:shadow-green-500/20">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-3 group-hover:text-green-400 transition-colors duration-300">Phone Support</h3>
                    <p class="text-gray-300 text-sm mb-3 font-medium">+1 (555) 123-4567</p>
                    <p class="text-gray-400 text-xs">24/7 Emergency Line</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-white/10 dark:bg-black/30 backdrop-blur-lg border border-red-500/30 hover:border-blue-400 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group shadow-xl hover:shadow-blue-500/20">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">Official Website</h3>
                    <a href="https://vampiordesigns.com" class="text-gray-300 text-sm mb-3 font-medium hover:text-blue-400 transition-colors duration-300">vampiordesigns.com</a>
                    <p class="text-gray-400 text-xs">Mon-Fri, 9AM-6PM EST</p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
