@extends('layouts.admin')

@section('content')

<section class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen flex flex-col items-center justify-start space-y-8">
  <!-- Add Category Form -->
  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Add New Category</h2>

    <form action="#" method="POST" class="space-y-4">
      <!-- Category Name -->
      <div>
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category Name</label>
        <input type="text" name="category" id="category" required
               class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
      </div>

      <!-- Submit Button -->
      <div class="text-right">
        <button type="submit"
                class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-md transition duration-200">
          Add Category
        </button>
      </div>
    </form>
  </div>

  <!-- Categories List -->
  <div class="w-full max-w-3xl bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Category List</h2>

    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
      <!-- Dummy Categories -->
      <li class="py-3 px-2 text-gray-800 dark:text-gray-200">1. System Issues</li>
      <li class="py-3 px-2 text-gray-800 dark:text-gray-200">2. Staff Behavior</li>
      <li class="py-3 px-2 text-gray-800 dark:text-gray-200">3. Delay in Response</li>
      <li class="py-3 px-2 text-gray-800 dark:text-gray-200">4. Payment Issues</li>
    </ul>
  </div>
</section>



@endsection
