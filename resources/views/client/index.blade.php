@extends('layouts.app')

@section('content')

<section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-100 to-orange-100 dark:from-red-900/30 dark:to-orange-900/30 text-red-700 dark:text-red-300 text-sm font-medium mb-6 animate-pulse-slow">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Report Issues & Concerns
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-gray-900 via-purple-800 to-blue-800 dark:from-gray-100 dark:via-purple-300 dark:to-blue-300 bg-clip-text text-transparent">
                        Note Your Concerns
                    </span>
                </h1>

                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed">
                    We value your feedback and take every complaint seriously. Help us improve our services by reporting any issues you've experienced with VAMPIOR DESIGNS.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                   <a href="{{ route('client.complain') }}"><button class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        File a Complaint
                    </button></a>
                    <a href="{{ route('client.past-complaints') }}"><button class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-purple-300 dark:hover:border-purple-500 hover:shadow-lg transition-all duration-300">
                        My Complaints
                    </button></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 border border-gray-200/50 dark:border-gray-700/50">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 animate-float">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">24/7</h3>
                    <p class="text-gray-600 dark:text-gray-400">Available Support</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-gray-200/50 dark:border-gray-700/50">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 animate-float" style="animation-delay: 2s;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">98%</h3>
                    <p class="text-gray-600 dark:text-gray-400">Resolution Rate</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-gray-200/50 dark:border-gray-700/50">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4 animate-float" style="animation-delay: 4s;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">&lt;12hrs</h3>
                    <p class="text-gray-600 dark:text-gray-400">Average Response</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Categories -->
    <section class="py-16 px-4 sm:px-6 lg:px-8" id="complaint-categories">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4 bg-gradient-to-r from-gray-900 to-purple-800 dark:from-gray-100 dark:to-purple-300 bg-clip-text text-transparent">
                    Complaint Categories
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Select the category that best describes your concern for faster resolution
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Service Quality -->
                <div class="group p-6 rounded-2xl bg-gradient-to-br from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Service Quality</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Issues with design quality, deliverables, or service standards</p>
                </div>

                <!-- Billing -->
                <div class="group p-6 rounded-2xl bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Billing Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Payment disputes, incorrect charges, or billing inquiries</p>
                </div>

                <!-- Communication -->
                <div class="group p-6 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Communication</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Poor communication, delayed responses, or misunderstandings</p>
                </div>

                <!-- Timeline -->
                <div class="group p-6 rounded-2xl bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Timeline Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Project delays, missed deadlines, or scheduling conflicts</p>
                </div>

                <!-- Technical -->
                <div class="group p-6 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Technical Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Website problems, file delivery issues, or technical failures</p>
                </div>

                <!-- Other -->
                <div class="group p-6 rounded-2xl bg-gradient-to-br from-gray-50 to-slate-50 dark:from-gray-800/50 dark:to-slate-800/50 border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-slate-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Other Concerns</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Any other issues or concerns not covered above</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-purple-900 via-blue-900 to-indigo-900 dark:from-purple-800 dark:via-blue-800 dark:to-indigo-800" id="contact-info">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Get In Touch</h2>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    Multiple ways to reach us for urgent matters or additional support
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Email Support</h3>
                    <p class="text-gray-300 text-sm mb-3">complaints@vampiordesigns.com</p>
                    <p class="text-gray-400 text-xs">Response within 2 hours</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Phone Support</h3>
                    <p class="text-gray-300 text-sm mb-3">+1 (555) 123-4567</p>
                    <p class="text-gray-400 text-xs">24/7 Emergency Line</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Official Website</h3>
                    <a href="https://vampiordesigns.com" class="text-gray-300 text-sm mb-3">Available on website</a>
                    <p class="text-gray-400 text-xs">Mon-Fri, 9AM-6PM EST</p>
                </div>
            </div>
        </div>
    </section>

    </section>

@endsection
