<!DOCTYPE html>
<html lang="en" class="scroll-smooth dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VAMPIOR DESIGNS - Complaint Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 5px rgba(239, 68, 68, 0.2), 0 0 10px rgba(239, 68, 68, 0.2), 0 0 15px rgba(239, 68, 68, 0.2);
            }
            to {
                box-shadow: 0 0 10px rgba(239, 68, 68, 0.4), 0 0 20px rgba(239, 68, 68, 0.4), 0 0 30px rgba(239, 68, 68, 0.4);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-white via-gray-50 to-red-50 dark:from-black dark:via-gray-900 dark:to-red-950 transition-all duration-500">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white/80 dark:bg-black/90 backdrop-blur-lg border-b border-red-200/30 dark:border-red-800/30 shadow-lg shadow-red-500/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-black rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-red-500/20 transition-all duration-300 group-hover:scale-110">
                    <span class="text-white font-bold text-xl group-hover:animate-pulse">VD</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold bg-gradient-to-r from-black to-red-600 dark:from-white dark:to-red-400 bg-clip-text text-transparent">VAMPIOR DESIGNS</h1>
                    <p class="text-xs text-red-600 dark:text-red-400 font-medium">Complaint Portal</p>
                </div>
            </div>

            <!-- Navigation + Login + Dark Mode -->
            <div class="flex items-center space-x-4">
                <!-- Navigation Links -->
                @guest
                     <div class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 hover:scale-105 relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#complaint-categories" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 hover:scale-105 relative group">
                        Categories
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact-info" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 hover:scale-105 relative group">
                        Support
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
                @else
                    <p class="hidden dark:text-white md:flex items-center space-x-6 text-sm font-medium">Logged in as <span class="text-red-600 dark:text-red-400 ms-4 border border-red-300 dark:border-red-400 px-3 py-1 rounded-lg bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-300">{{ Auth::user()->name }}</span></p>
                @endguest


                <!-- Login Button -->
                @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="hidden md:inline-block px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 rounded-lg shadow-lg hover:shadow-red-500/25 transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 relative overflow-hidden group">
                        <span class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                        <span class="relative z-10">Logout</span>
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="hidden md:inline-block px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 rounded-lg shadow-lg hover:shadow-red-500/25 transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 relative overflow-hidden group">
                    <span class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-white/10 to-red-500/0 -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                    <span class="relative z-10">Login</span>
                </a>
                @endif

                <!-- Dark Mode Toggle -->
                {{-- <button id="darkModeToggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-300 hover:scale-110 group border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-600">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 dark:hidden group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                    <svg class="w-5 h-5 text-gray-300 hidden dark:block group-hover:text-red-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button> --}}
            </div>
        </div>
    </div>
</nav>

@yield('content')


<footer class="bg-gradient-to-br from-black via-gray-900 to-red-950 dark:from-black dark:via-gray-900 dark:to-red-950 text-white py-16 relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-600/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-6 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-black rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-red-500/20 transition-all duration-300 group-hover:scale-110 group-hover:rotate-6">
                        <span class="text-white font-bold text-2xl group-hover:animate-pulse">V</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-white to-red-300 bg-clip-text text-transparent">VAMPIOR DESIGNS</h3>
                        <p class="text-red-400 text-sm font-medium">Complaint Resolution Center</p>
                    </div>
                </div>
                <p class="text-gray-300 max-w-md leading-relaxed">
                    We're committed to resolving your concerns promptly and professionally. Your feedback helps us improve our services and maintain the highest standards of quality.
                </p>
                <div class="mt-6 flex space-x-4">
                    <div class="w-10 h-10 bg-red-600/20 rounded-full flex items-center justify-center hover:bg-red-600/30 transition-all duration-300 cursor-pointer group hover:scale-110">
                        <svg class="w-5 h-5 text-red-400 group-hover:text-red-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </div>
                    <div class="w-10 h-10 bg-red-600/20 rounded-full flex items-center justify-center hover:bg-red-600/30 transition-all duration-300 cursor-pointer group hover:scale-110">
                        <svg class="w-5 h-5 text-red-400 group-hover:text-red-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </div>
                    <div class="w-10 h-10 bg-red-600/20 rounded-full flex items-center justify-center hover:bg-red-600/30 transition-all duration-300 cursor-pointer group hover:scale-110">
                        <svg class="w-5 h-5 text-red-400 group-hover:text-red-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group">
                <h4 class="font-bold mb-6 text-lg bg-gradient-to-r from-white to-red-300 bg-clip-text text-transparent">Quick Actions</h4>
                <ul class="space-y-3 text-gray-300">
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        File New Complaint
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Track Status
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        FAQ & Guidelines
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Complaint History
                    </a></li>
                </ul>
            </div>

            <div class="group">
                <h4 class="font-bold mb-6 text-lg bg-gradient-to-r from-white to-red-300 bg-clip-text text-transparent">Support Channels</h4>
                <ul class="space-y-3 text-gray-300">
                    <li><a href="mailto:complaints@vampiordesigns.com" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Support
                    </a></li>
                    <li><a href="tel:+1555COMPLAIN" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Hotline
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        HR Department
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Live Chat
                    </a></li>
                </ul>
            </div>

            <div class="group">
                <h4 class="font-bold mb-6 text-lg bg-gradient-to-r from-white to-red-300 bg-clip-text text-transparent">Company</h4>
                <ul class="space-y-3 text-gray-300">
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        About Us
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Privacy Policy
                    </a></li>
                    <li><a href="#" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Terms of Service
                    </a></li>
                    <li><a href="https://vampiordesigns.com" target="_blank" class="hover:text-red-400 transition-all duration-300 hover:translate-x-2 inline-flex items-center group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9"></path>
                        </svg>
                        Main Website
                    </a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="mt-16 pt-8 border-t border-red-800/30">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-gray-400 text-sm">
                        &copy; 2025 <span class="text-red-400 font-medium">VAMPIOR DESIGNS</span>. All rights reserved.
                    </p>
                    <p class="text-gray-500 text-xs mt-1">
                        Complaint Portal System v2.0 | Confidential & Secure
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-400 text-xs font-medium">System Operational</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    // Dark mode toggle functionality
    const darkModeToggle = document.getElementById('darkModeToggle');
    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    });

    // Load saved theme from localStorage
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>
</body>
</html>
