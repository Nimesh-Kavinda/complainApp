@extends('layouts.app')

@section('content')
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-purple-900 transition-all duration-500">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8 space-y-8 border border-gray-200 dark:border-gray-700">

        <!-- Success Icon -->
        <div class="text-center">
            <div class="mx-auto w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Complaint Submitted Successfully!</h2>
            <p class="text-gray-600 dark:text-gray-300">Thank you for bringing this matter to our attention. We will review your complaint promptly.</p>
        </div>

        <!-- Complaint Details Card -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Complaint Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Reference Number</label>
                    <p class="text-lg font-mono font-bold text-purple-600 dark:text-purple-400">{{ $complaint->reference_number }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Submitted On</label>
                    <p class="text-gray-900 dark:text-white">{{ $complaint->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Category</label>
                    <p class="text-gray-900 dark:text-white">{{ $complaint->category->category_name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Priority</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $complaint->priority_color }}">
                        {{ $complaint->priority_label }}
                    </span>
                </div>

                @if($complaint->complaint_title)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Title</label>
                    <p class="text-gray-900 dark:text-white">{{ $complaint->complaint_title }}</p>
                </div>
                @endif

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $complaint->status_color }}">
                        {{ $complaint->status_label }}
                    </span>
                </div>

                @if($complaint->hasEvidence())
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Evidence Files</label>
                    <p class="text-gray-900 dark:text-white">{{ $complaint->getEvidenceCount() }} file(s) attached</p>
                </div>
                @endif
            </div>
        </div>

        <!-- What Happens Next -->
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-3">What Happens Next?</h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">1</div>
                    <p class="text-blue-800 dark:text-blue-200">Your complaint will be reviewed by our admin team within 24-48 hours.</p>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2</div>
                    <p class="text-blue-800 dark:text-blue-200">We may contact you for additional information if needed.</p>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">3</div>
                    <p class="text-blue-800 dark:text-blue-200">You will receive updates on the progress and resolution of your complaint.</p>
                </div>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.876c1.473 0 2.726-1.167 2.925-2.639l.25-2.014h0c.161-1.305-.854-2.47-2.17-2.47H5.07c-1.316 0-2.331 1.165-2.17 2.47h0l.25 2.014c.199 1.472 1.452 2.639 2.925 2.639z"></path>
                </svg>
                <div>
                    <h4 class="font-semibold text-yellow-800 dark:text-yellow-200">Important</h4>
                    <p class="text-sm text-yellow-700 dark:text-yellow-300 mt-1">
                        Please save your reference number <strong>{{ $complaint->reference_number }}</strong> for future correspondence.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('client.my-complaints') }}"
               class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                View My Complaints
            </a>

            <a href="{{ route('client.complain') }}"
               class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-lg transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Submit Another Complaint
            </a>
        </div>
    </div>
</section>
@endsection
