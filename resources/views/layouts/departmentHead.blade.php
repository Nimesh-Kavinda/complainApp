<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VAMPIOR DESIGNS - Department Head Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-purple-600 to-blue-600">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-purple-600 font-bold text-lg">V</span>
                </div>
                <div>
                    <h1 class="text-white font-bold text-sm">VAMPIOR DESIGNS</h1>
                    <p class="text-purple-100 text-xs">Department Head Panel</p>
                </div>
            </div>
            <button id="closeSidebar" class="lg:hidden text-white hover:bg-white/20 p-1 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <nav class="mt-6 px-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('department.head.index') }}" class="nav-link active flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('department.head.staff.complaints') }}" class="nav-link flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Staff Complaints
                        @php
                            $user = auth()->user();
                            $department = $user->departmentAsHead ?? null;
                            $complaintsCount = $department ? $department->staffComplaints()->count() : 0;
                        @endphp
                        <span class="ml-auto bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-xs px-2 py-1 rounded-full">{{ $complaintsCount }}</span>
                    </a>
                </li>
                 <li>
                    <a href="{{ route('department.head.admin.assigned.complaints') }}" class="nav-link flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Admin Assigned Complaints
                        @php
                            $user = auth()->user();
                            $department = $user->departmentAsHead ?? null;
                            $complaintsCount = $department ? $department->staffComplaints()->count() : 0;
                        @endphp
                        <span class="ml-auto bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-xs px-2 py-1 rounded-full">{{ $complaintsCount }}</span>
                    </a>
                </li>

            </ul>
        </nav>

        <div class="absolute bottom-4 left-4 right-4">
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/30 dark:to-blue-900/30 p-4 rounded-lg border border-purple-200 dark:border-purple-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">AD</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:pl-64">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-4 py-4">
                <div class="flex items-center space-x-4">
                    <button id="openSidebar" class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Department Head Dashboard</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="hidden md:block relative">
                    <div class="relative ">
                        <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hidden md:inline-block px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow hover:from-purple-700 hover:to-blue-700 transition">Log Out</button>
                        </form>
                     </div>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5 5-5H15v5H8v5h7z"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-gray-300 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->

        @yield('content')

    </div>

    <footer>
        <div class="bg-gray-100 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-4 sticky bottom-0">
            <div class="container mx-auto text-center text-sm text-gray-600 dark:text-gray-400">
                &copy; 2023 VAMPIOR DESIGNS. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Overlay for mobile sidebar -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

    <script>
        // Sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;

        // Check for saved dark mode preference or default to light mode
        const isDarkMode = localStorage.getItem('darkMode') === 'true' ||
                          (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isDarkMode) {
            html.classList.add('dark');
        }

        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });

        // Section navigation
        function showSection(sectionName) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.add('hidden');
            });

            // Show selected section
            const targetSection = document.getElementById(sectionName + '-section');
            if (targetSection) {
                targetSection.classList.remove('hidden');
            }

            // Update navigation active state
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active', 'bg-purple-100', 'text-purple-700', 'dark:bg-purple-900', 'dark:text-purple-300');
            });

            // Add active state to clicked nav item
            event.target.closest('.nav-link').classList.add('active', 'bg-purple-100', 'text-purple-700', 'dark:bg-purple-900', 'dark:text-purple-300');

            // Close mobile sidebar after navigation
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Initialize active navigation state
        document.addEventListener('DOMContentLoaded', () => {
            const dashboardLink = document.querySelector('a[onclick="showSection(\'dashboard\')"]');
            if (dashboardLink) {
                dashboardLink.classList.add('active', 'bg-purple-100', 'text-purple-700', 'dark:bg-purple-900', 'dark:text-purple-300');
            }
        });

        // Add smooth transitions
        document.addEventListener('DOMContentLoaded', () => {
            const contentSections = document.querySelectorAll('.content-section');
            contentSections.forEach(section => {
                section.style.transition = 'opacity 0.3s ease-in-out';
            });
        });

        // Complaint management functions
        function viewComplaint(id) {
            alert('Viewing complaint #' + id);
        }

        function resolveComplaint(id) {
            if (confirm('Are you sure you want to resolve complaint #' + id + '?')) {
                alert('Complaint #' + id + ' has been resolved');
            }
        }

        function deleteComplaint(id) {
            if (confirm('Are you sure you want to delete complaint #' + id + '? This action cannot be undone.')) {
                alert('Complaint #' + id + ' has been deleted');
            }
        }

        // User management functions
        function editUser(id) {
            alert('Editing user #' + id);
        }

        function suspendUser(id) {
            if (confirm('Are you sure you want to suspend this user?')) {
                alert('User has been suspended');
            }
        }

        // Initialize tooltips and other interactive elements
        document.addEventListener('DOMContentLoaded', () => {
            // Add hover effects to buttons
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                if (!button.classList.contains('transition-colors')) {
                    button.classList.add('transition-colors', 'duration-200');
                }
            });

            // Add loading states for async operations
            const actionButtons = document.querySelectorAll('[onclick]');
            actionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const originalText = this.textContent;
                    this.textContent = 'Loading...';
                    this.disabled = true;

                    setTimeout(() => {
                        this.textContent = originalText;
                        this.disabled = false;
                    }, 1000);
                });
            });
        });
    </script>
</body>
</html>
