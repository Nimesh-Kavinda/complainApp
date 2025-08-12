@extends('layouts.admin')

@section('content')

<section class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
  <!-- Page Title -->
  {{-- <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Admin Dashboard</h1> --}}

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-blue-500 dark:bg-gray-800 rounded-lg shadow-md p-6">
      <div class="text-gray-100 font-bold dark:text-gray-400">Total Users</div>
      <div class="text-3xl font-bold text-gray-100 dark:text-white">{{ $users->count() }}</div>
    </div>

    <!-- Total Complaints -->
    <div class="bg-yellow-500 dark:bg-gray-800 rounded-lg shadow-md p-6">
      <div class="text-gray-100 font-bold dark:text-gray-400">Total Complaints</div>
      <div class="text-3xl font-bold text-gray-100 dark:text-white">{{ $complaints->count() }}</div>
    </div>

    <!-- Pending Complaints -->
    <div class="bg-red-500 dark:bg-gray-800 rounded-lg shadow-md p-6">
      <div class="text-gray-100 font-bold dark:text-gray-400">Pending Complaints</div>
      <div class="text-3xl font-bold text-gray-100 dark:text-white">{{ $complaints->where('status', 'pending')->count() }}</div>
    </div>
  </div>

  <!-- Recent Users Table -->
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-x-auto">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Users</h2>
    </div>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
      <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Role</th>
        </tr>
      </thead>
      <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
        @foreach ($selectedUser as $user)
          <tr>
            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $user->name }}</td>
            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $user->email }}</td>
            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
          </tr>
        @endforeach
        </tr>
      </tbody>
    </table>
  </div>
</section>



@endsection
