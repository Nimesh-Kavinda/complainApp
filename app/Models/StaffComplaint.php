<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StaffComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_member_id',
        'staff_id',
        'staff_name',
        'staff_email',
        'department_id',
        'complaint_title',
        'complaint_details',
        'priority',
        'status',
        'admin_notes',
        'solution',
        'evidence_files',
        'evidence_description',
        'assigned_to',
        'assigned_at',
        'resolved_at',
        'closed_at',
        'reference_number',
        'severity_score',
        'staff_feedback',
        'satisfaction_rating',
        'contact_phone',
        'follow_up_notes',
        'reviewed_by',
        'reviewed_at',
        'review_notes',
        'department_responses'
    ];

    protected $casts = [
        'evidence_files' => 'array',
        'department_responses' => 'array',
        'assigned_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (empty($complaint->reference_number)) {
                $complaint->reference_number = 'STAFF-' . strtoupper(Str::random(8)) . '-' . now()->format('Y');
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Accessor for status badge color
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'in_progress' => 'blue',
            'resolved' => 'green',
            'closed' => 'gray',
            'rejected' => 'red',
            default => 'gray'
        };
    }

    // Accessor for priority color
    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'low' => 'green',
            'medium' => 'yellow',
            'high' => 'orange',
            'urgent' => 'red',
            default => 'gray'
        };
    }

    // Scope for department-specific complaints
    public function scopeForDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    // Scope for staff member's own complaints
    public function scopeForStaff($query, $staffMemberId)
    {
        return $query->where('staff_member_id', $staffMemberId);
    }

    // Check if complaint can be edited (feedback can be added)
    public function canBeEdited()
    {
        // Allow feedback when complaint is resolved or closed, but no feedback has been given yet
        return in_array($this->status, ['resolved', 'closed']) &&
               (!$this->staff_feedback || !$this->satisfaction_rating);
    }

    // Check if complaint is resolved
    public function isResolved()
    {
        return in_array($this->status, ['resolved', 'closed']);
    }
}
