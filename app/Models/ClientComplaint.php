<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ClientComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_email',
        'nic',
        'staff_id',
        'category_id',
        'complaint_title',
        'complaint_details',
        'priority',
        'status',
        'admin_notes',
        'solution',
        'conversation',
        'evidence_files',
        'evidence_description',
        'assigned_to',
        'assigned_at',
        'resolved_at',
        'closed_at',
        'reference_number',
        'severity_score',
        'client_feedback',
        'satisfaction_rating',
        'is_anonymous',
        'contact_phone',
        'department',
        'follow_up_notes'
    ];

    protected $casts = [
        'evidence_files' => 'array',
        'conversation' => 'array',
        'assigned_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
        'is_anonymous' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'assigned_at',
        'resolved_at',
        'closed_at'
    ];

    // Automatically generate reference number on creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (empty($complaint->reference_number)) {
                $complaint->reference_number = 'CC-' . date('Y') . '-' . str_pad(static::count() + 1, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user that owns this complaint.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'client_email', 'email');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all assignments for this complaint
     */
    public function assignments()
    {
        return $this->hasMany(ComplaintAssignment::class);
    }

    /**
     * Get active assignments for this complaint
     */
    public function activeAssignments()
    {
        return $this->hasMany(ComplaintAssignment::class)->active();
    }

    /**
     * Get discussions for this complaint through assignments
     */
    public function discussions()
    {
        return $this->hasManyThrough(
            ComplaintDiscussion::class,
            ComplaintAssignment::class,
            'client_complaint_id', // Foreign key on the assignments table (pointing to this model)
            'complaint_assignment_id', // Foreign key on the discussions table (pointing to assignments)
            'id', // Local key on this model (complaints)
            'id' // Local key on the intermediate model (assignments)
        );
    }

    /**
     * Get unread discussion count for this complaint
     */
    public function getUnreadDiscussionCount()
    {
        return ComplaintDiscussion::whereHas('complaintAssignment', function($q) {
            $q->where('client_complaint_id', $this->id);
        })
        ->where('sender_type', '!=', 'admin')
        ->whereNull('read_at')
        ->count();
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Accessors
    public function getPriorityLabelAttribute()
    {
        $labels = [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'urgent' => 'Urgent'
        ];

        return $labels[$this->priority] ?? 'Medium';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
            'closed' => 'Closed',
            'rejected' => 'Rejected'
        ];

        return $labels[$this->status] ?? 'Pending';
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            'in_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            'resolved' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            'closed' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
            'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
    }

    public function getPriorityColorAttribute()
    {
        $colors = [
            'low' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            'medium' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            'high' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
            'urgent' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
        ];

        return $colors[$this->priority] ?? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
    }

    // Helper methods
    public function hasEvidence()
    {
        return !empty($this->evidence_files) && count($this->evidence_files) > 0;
    }

    public function getEvidenceCount()
    {
        return $this->evidence_files ? count($this->evidence_files) : 0;
    }

    public function isOverdue()
    {
        // Consider a complaint overdue if it's been pending for more than 7 days
        return $this->status === 'pending' && $this->created_at->diffInDays(now()) > 7;
    }

    public function markAsResolved($solution = null, $userId = null)
    {
        $this->update([
            'status' => 'resolved',
            'solution' => $solution,
            'resolved_at' => now(),
            'assigned_to' => $userId
        ]);
    }

    public function markAsClosed($notes = null)
    {
        $this->update([
            'status' => 'closed',
            'closed_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    /**
     * Add a new message to the conversation thread
     */
    public function addConversationMessage($message, $senderType, $senderId, $senderName)
    {
        $conversation = $this->conversation ?? [];

        $newMessage = [
            'id' => count($conversation) + 1,
            'message' => $message,
            'sender_type' => $senderType, // 'admin' or 'client'
            'sender_id' => $senderId,
            'sender_name' => $senderName,
            'timestamp' => now()->toISOString(),
            'created_at' => now()->format('Y-m-d H:i:s')
        ];

        $conversation[] = $newMessage;

        $this->update(['conversation' => $conversation]);

        return $newMessage;
    }

    /**
     * Get the conversation thread in chronological order
     */
    public function getConversation()
    {
        return $this->conversation ?? [];
    }

    /**
     * Get the last message from the conversation
     */
    public function getLastMessage()
    {
        $conversation = $this->getConversation();
        return !empty($conversation) ? end($conversation) : null;
    }

    /**
     * Count total messages in conversation
     */
    public function getConversationCount()
    {
        return count($this->getConversation());
    }
}
