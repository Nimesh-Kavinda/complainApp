<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\ClientComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display the client's dashboard.
     */
    public function index()
    {
        // Get recent complaints for dashboard
        $recentComplaints = ClientComplaint::where('client_email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $complaintStats = [
            'total' => ClientComplaint::where('client_email', Auth::user()->email)->count(),
            'pending' => ClientComplaint::where('client_email', Auth::user()->email)->where('status', 'pending')->count(),
            'in_progress' => ClientComplaint::where('client_email', Auth::user()->email)->where('status', 'in_progress')->count(),
            'resolved' => ClientComplaint::where('client_email', Auth::user()->email)->where('status', 'resolved')->count(),
        ];

        return view('client.index', compact('recentComplaints', 'complaintStats'));
    }

    /**
     * Show the complaint form
     */
    public function complainForm()
    {
        // Fetch all categories to display in the view
        $categories = Category::all();
        return view('client.complainform', compact('categories'));
    }

    /**
     * Show client's complaint history
     */
    public function pastComplaints()
    {
        $complaints = ClientComplaint::where('client_email', Auth::user()->email)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate statistics
        $stats = [
            'total' => $complaints->count(),
            'pending' => $complaints->where('status', 'pending')->count(),
            'in_progress' => $complaints->where('status', 'in_progress')->count(),
            'resolved' => $complaints->where('status', 'resolved')->count(),
            'closed' => $complaints->where('status', 'closed')->count(),
        ];

        return view('client.pastcomplaints', compact('complaints', 'stats'));
    }

    /**
     * Get conversation for a specific complaint
     */
    public function getComplaintConversation($id)
    {
        try {
            $complaint = ClientComplaint::where('id', $id)
                ->where('client_email', Auth::user()->email)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'conversation' => $complaint->getConversation(),
                'complaint_info' => [
                    'id' => $complaint->id,
                    'reference_number' => $complaint->reference_number,
                    'status' => $complaint->status,
                    'status_label' => $complaint->status_label,
                    'created_at' => $complaint->created_at->format('M d, Y h:i A')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load conversation.'
            ], 500);
        }
    }

    /**
     * Add client message to conversation
     */
    public function addMessageToComplaint(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:5000'
        ]);

        try {
            $complaint = ClientComplaint::where('id', $id)
                ->where('client_email', Auth::user()->email)
                ->firstOrFail();

            // Add message to conversation
            $complaint->addConversationMessage(
                $request->message,
                'client',
                Auth::id(),
                Auth::user()->name
            );

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message.'
            ], 500);
        }
    }

    /**
     * Close complaint (client satisfied)
     */
    public function closeComplaint(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'nullable|string|max:1000',
            'satisfaction_rating' => 'required|integer|min:1|max:5'
        ]);

        try {
            $complaint = ClientComplaint::where('id', $id)
                ->where('client_email', Auth::user()->email)
                ->firstOrFail();

            $complaint->update([
                'status' => 'closed',
                'closed_at' => now(),
                'client_feedback' => $request->feedback,
                'satisfaction_rating' => $request->satisfaction_rating
            ]);

            // Add final message to conversation
            $complaint->addConversationMessage(
                "Client has closed this complaint with a {$request->satisfaction_rating}-star rating." .
                ($request->feedback ? " Feedback: {$request->feedback}" : ""),
                'client',
                Auth::id(),
                Auth::user()->name
            );

            return response()->json([
                'success' => true,
                'message' => 'Complaint closed successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to close complaint.'
            ], 500);
        }
    }

    /**
     * Download evidence file
     */
    public function downloadEvidence($id, $fileIndex)
    {
        $complaint = ClientComplaint::where('client_email', Auth::user()->email)->findOrFail($id);

        if (!$complaint->hasEvidence()) {
            abort(404, 'No evidence files found');
        }

        $evidenceFiles = $complaint->evidence_files;

        if (!isset($evidenceFiles[$fileIndex])) {
            abort(404, 'Evidence file not found');
        }

        $file = $evidenceFiles[$fileIndex];
        $filePath = storage_path('app/private/complaints/' . $file['stored_name']);

        if (!file_exists($filePath)) {
            abort(404, 'File not found on server');
        }

        return response()->download($filePath, $file['original_name']);
    }
}
