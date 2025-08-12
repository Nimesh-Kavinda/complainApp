<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComplaintAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_complaint_id',
        'department_id',
        'assigned_by',
        'assigned_to',
        'status',
        'priority',
        'deadline',
        'assignment_notes',
        'resolved_at',
        'resolution_notes'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the client complaint that is assigned
     */
    public function clientComplaint(): BelongsTo
    {
        return $this->belongsTo(ClientComplaint::class);
    }

    /**
     * Get the department this complaint is assigned to
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the user who made the assignment (admin)
     */
    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Get the user this complaint is assigned to (department head)
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all discussions for this assignment
     */
    public function discussions(): HasMany
    {
        return $this->hasMany(ComplaintDiscussion::class);
    }

    /**
     * Get the latest discussion message
     */
    public function latestDiscussion()
    {
        return $this->hasOne(ComplaintDiscussion::class)->latest('sent_at');
    }

    /**
     * Check if assignment is active
     */
    public function isActive(): bool
    {
        return in_array($this->status, ['assigned', 'in_progress', 'pending_feedback']);
    }

    /**
     * Check if assignment is resolved
     */
    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    /**
     * Check if assignment is overdue
     */
    public function isOverdue(): bool
    {
        return $this->deadline && $this->deadline->isPast() && !$this->isResolved();
    }

    /**
     * Scope to get active assignments
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['assigned', 'in_progress', 'pending_feedback']);
    }

    /**
     * Scope to get overdue assignments
     */
    public function scopeOverdue($query)
    {
        return $query->where('deadline', '<', now())
                    ->whereNotIn('status', ['resolved', 'cancelled']);
    }

    /**
     * Scope to get assignments by priority
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
