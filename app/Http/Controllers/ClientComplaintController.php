<?php

namespace App\Http\Controllers;

use App\Models\ClientComplaint;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ClientComplaintController extends Controller
{
    /**
     * Show the complaint form
     */
    public function showForm()
    {
        $categories = Category::all();
        return view('client.complainform', compact('categories'));
    }

    /**
     * Store a new client complaint
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'userType' => 'required|string',
            'nic' => 'required|string|max:20|unique:client_complaints,nic',
            'category' => 'required|exists:categories,id',
            'complaint_title' => 'nullable|string|max:255',
            'details' => 'required|string|min:10',
            'evidence' => 'nullable|array|max:10',
            'evidence.*' => 'file|max:10240|mimes:jpg,jpeg,png,gif,bmp,pdf,doc,docx,txt,mp4,avi,mov,mp3,wav,ogg',
            'contact_phone' => 'nullable|string|max:20',
            'is_anonymous' => 'boolean',
            'priority' => 'nullable|in:low,medium,high,urgent'
        ]);

        try {
            // Handle file uploads
            $evidenceFiles = [];
            if ($request->hasFile('evidence')) {
                foreach ($request->file('evidence') as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('complaints/evidence', $filename, 'public');

                    $evidenceFiles[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'filename' => $filename,
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType()
                    ];
                }
            }

            // Create the complaint
            $complaint = ClientComplaint::create([
                'client_name' => $request->name,
                'client_email' => Auth::user()->email,
                'nic' => $request->nic,
                'category_id' => $request->category,
                'complaint_title' => $request->complaint_title,
                'complaint_details' => $request->details,
                'priority' => $request->priority ?? 'medium',
                'evidence_files' => !empty($evidenceFiles) ? $evidenceFiles : null,
                'evidence_description' => $request->evidence_description,
                'contact_phone' => $request->contact_phone,
                'is_anonymous' => $request->has('is_anonymous'),
                'status' => 'pending'
            ]);

            // Log the complaint creation
            Log::info('New client complaint created', [
                'complaint_id' => $complaint->id,
                'reference_number' => $complaint->reference_number,
                'client_name' => $complaint->client_name,
                'nic' => $complaint->nic,
                'category_id' => $complaint->category_id
            ]);

            return redirect()->route('client.complaint.success', $complaint->id)
                ->with('success', 'Your complaint has been submitted successfully! Reference number: ' . $complaint->reference_number);

        } catch (\Exception $e) {
            Log::error('Failed to create client complaint', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->except(['evidence'])
            ]);

            return back()->withInput()
                ->with('error', 'Failed to submit your complaint. Please try again.');
        }
    }

    /**
     * Show complaint success page
     */
    public function showSuccess($id)
    {
        $complaint = ClientComplaint::with('category')->findOrFail($id);

        // Ensure the complaint belongs to the current user (based on email or NIC)
        if ($complaint->client_email !== Auth::user()->email) {
            abort(403, 'Unauthorized access to complaint.');
        }

        return view('client.complaint-success', compact('complaint'));
    }

    /**
     * Show client's complaints history
     */
    public function myComplaints()
    {
        $complaints = ClientComplaint::with('category', 'assignedTo')
            ->where('client_email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.my-complaints', compact('complaints'));
    }

    /**
     * Show specific complaint details
     */
    public function show($id)
    {
        $complaint = ClientComplaint::with('category', 'assignedTo')->findOrFail($id);

        // Ensure the complaint belongs to the current user
        if ($complaint->client_email !== Auth::user()->email) {
            abort(403, 'Unauthorized access to complaint.');
        }

        return view('client.complaint-details', compact('complaint'));
    }

    /**
     * Download evidence file
     */
    public function downloadEvidence($id, $fileIndex)
    {
        $complaint = ClientComplaint::findOrFail($id);

        // Ensure the complaint belongs to the current user
        if ($complaint->client_email !== Auth::user()->email) {
            abort(403, 'Unauthorized access to complaint evidence.');
        }

        if (!$complaint->evidence_files || !isset($complaint->evidence_files[$fileIndex])) {
            abort(404, 'Evidence file not found.');
        }

        $file = $complaint->evidence_files[$fileIndex];
        $filePath = storage_path('app/public/' . $file['path']);

        if (!file_exists($filePath)) {
            abort(404, 'Evidence file not found on server.');
        }

        return response()->download($filePath, $file['original_name']);
    }

    /**
     * Submit feedback on resolved complaint
     */
    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'client_feedback' => 'required|string|max:1000',
            'satisfaction_rating' => 'required|integer|min:1|max:5'
        ]);

        $complaint = ClientComplaint::findOrFail($id);

        // Ensure the complaint belongs to the current user and is resolved
        if ($complaint->client_email !== Auth::user()->email || $complaint->status !== 'resolved') {
            abort(403, 'Unauthorized action.');
        }

        $complaint->update([
            'client_feedback' => $request->client_feedback,
            'satisfaction_rating' => $request->satisfaction_rating
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }
}
