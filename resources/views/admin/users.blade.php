@extends('layouts.admin')

@section('content')

    <section class="p-6 bg-white dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Page Title -->
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">All Users</h2>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">User Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Registered At</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Dummy User 1 -->
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $loop->index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                            @php
                                $roleColors = [
                                    'client' => 'text-blue-600 dark:text-blue-400',
                                    'staff_member' => 'text-green-600 dark:text-green-400',
                                    'department_head' => 'text-yellow-600 dark:text-yellow-400',
                                    'senior_board' => 'text-purple-600 dark:text-purple-400',
                                    'md' => 'text-red-600 dark:text-red-400',
                                ];
                            @endphp

                            <td class="px-6 py-4 text-sm font-semibold uppercase {{ $roleColors[$user->role] ?? 'text-gray-600 dark:text-gray-400' }}">
                                {{ $user->role }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->created_at->format('Y-m-d') }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>


@endsection
