@extends('layouts.admin')

@section('content')

     @if (session('success'))
         <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
             {{ session('success') }}
             <button class="float-right" onclick="this.parentElement.style.display='none'">X</button>
         </div>
     @endif

<section class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen flex flex-col items-center justify-start space-y-8">
  <!-- Add Category Form -->
  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Add New Complaint Category</h2>

    <form action="{{ route('admin.category.store') }}" method="POST" class="space-y-4">
        @csrf
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
      @foreach ($categories as $category)
          <li class="py-3 px-2 text-gray-800 dark:text-gray-200">{{ $loop->index + 1 }}. {{ $category->category_name }}</li>
      @endforeach
    </ul>
  </div>
</section>



@endsection
