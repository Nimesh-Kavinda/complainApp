@extends('layouts.app')

@section('content')

    <section id="complaint-form" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-purple-900 transition-all duration-500">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8 space-y-8 border border-gray-200 dark:border-gray-700">
        <div class="text-center">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">Submit a Complaint</h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">We take your concerns seriously. Please fill out the form below.</p>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" id="name" name="name" required class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{ Auth::user()->name ?? '' }}" readonly>
            </div>

            <!-- Type of User -->
                    <div>
                <label for="userType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type of User</label>
                <input type="text" id="userType" name="userType" required
                    class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white
                        focus:outline-none focus:ring-2 focus:ring-purple-500"
                    value="{{ Auth::user()->role ?? '' }}" readonly
                    oninput="toggleFields()">
            </div>

            <!-- NIC (Only for Clients) -->
            <div id="nicField" class="mt-4 hidden">
                <label for="nic" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIC Number</label>
                <input type="text" id="nic" name="nic"
                    class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white
                        focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Staff ID (Only for Staff) -->
            <div id="staffIdField" class="mt-4 hidden">
                <label for="staffId" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Staff ID</label>
                <input type="text" id="staffId" name="staffId"
                    class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white
                        focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Complaint Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Complaint Category</label>
                <select id="category" name="category" required class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Select Category --</option>
                    <option value="service">Service Quality</option>
                    <option value="billing">Billing</option>
                    <option value="communication">Communication</option>
                    <option value="timeline">Timeline</option>
                    <option value="technical">Technical</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Complaint Details -->
            <div>
                <label for="details" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Complaint Details</label>
                <textarea id="details" name="details" rows="5" required class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Evidence Upload -->
            <div>
                <label for="evidence" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Attach Evidence (photos, videos, audio)</label>
                <input type="file" id="evidence" name="evidence[]" multiple accept="image/*,video/*,audio/*" class="mt-2 w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-100 dark:file:bg-purple-900 file:text-purple-700 dark:file:text-purple-300 hover:file:bg-purple-200 dark:hover:file:bg-purple-800 transition">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="inline-block w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold rounded-lg shadow-lg transition duration-300">
                    Submit Complaint
                </button>
            </div>
        </form>
    </div>
</section>



<script>
    document.addEventListener('DOMContentLoaded', toggleFields); // Initial call on page load

    function toggleFields() {
        const userType = document.getElementById('userType').value.toLowerCase().trim();
        const nicField = document.getElementById('nicField');
        const staffIdField = document.getElementById('staffIdField');

        if (userType === 'client') {
            nicField.classList.remove('hidden');
            staffIdField.classList.add('hidden');
        } else if (userType === 'staff') {
            staffIdField.classList.remove('hidden');
            nicField.classList.add('hidden');
        } else {
            // Hide both if userType is unrecognized
            nicField.classList.add('hidden');
            staffIdField.classList.add('hidden');
        }
    }
</script>



@endsection
