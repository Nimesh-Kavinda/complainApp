<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComplaintDiscussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_assignment_id',
        'sender_id',
        'sender_type',
        'message',
        'message_type',
        'attachments',
        'is_confidential',
        'sent_at',
        'read_at',
        'is_important',
        'reply_to_message_id'
    ];

    protected $casts = [
        'attachments' => 'array',
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
        'is_confidential' => 'boolean',
        'is_important' => 'boolean',
    ];

    /**
     * Get the complaint assignment this discussion belongs to
     */
    public function complaintAssignment(): BelongsTo
    {
        return $this->belongsTo(ComplaintAssignment::class);
    }

    /**
     * Get the user who sent this message
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the message this is replying to
     */
    public function replyTo(): BelongsTo
    {
        return $this->belongsTo(ComplaintDiscussion::class, 'reply_to_message_id');
    }

    /**
     * Get all replies to this message
     */
    public function replies(): HasMany
    {
        return $this->hasMany(ComplaintDiscussion::class, 'reply_to_message_id');
    }

    /**
     * Check if this message has been read
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Mark this message as read
     */
    public function markAsRead(): void
    {
        if (!$this->isRead()) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Check if this message has attachments
     */
    public function hasAttachments(): bool
    {
        return !empty($this->attachments) && is_array($this->attachments);
    }

    /**
     * Get attachment count
     */
    public function getAttachmentCount(): int
    {
        return $this->hasAttachments() ? count($this->attachments) : 0;
    }

    /**
     * Get formatted attachments with proper URLs
     */
    public function getFormattedAttachments(): array
    {
        if (!$this->hasAttachments()) {
            return [];
        }

        return collect($this->attachments)->map(function ($attachment) {
            return [
                'name' => $attachment['name'] ?? 'Unknown',
                'type' => $attachment['type'] ?? 'file',
                'size' => $attachment['size'] ?? 0,
                'url' => $attachment['path'] ? asset('storage/' . $attachment['path']) : null,
                'mime_type' => $attachment['mime_type'] ?? 'application/octet-stream',
            ];
        })->toArray();
    }

    /**
     * Check if message is a reply
     */
    public function isReply(): bool
    {
        return !is_null($this->reply_to_message_id);
    }

    /**
     * Scope to get unread messages
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope to get messages by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('message_type', $type);
    }

    /**
     * Scope to get important messages
     */
    public function scopeImportant($query)
    {
        return $query->where('is_important', true);
    }

    /**
     * Scope to get confidential messages
     */
    public function scopeConfidential($query)
    {
        return $query->where('is_confidential', true);
    }

    /**
     * Scope to get messages for a specific sender
     */
    public function scopeBySender($query, $senderId, $senderType = null)
    {
        $query = $query->where('sender_id', $senderId);

        if ($senderType) {
            $query->where('sender_type', $senderType);
        }

        return $query;
    }

    /**
     * Scope to get messages in chronological order
     */
    public function scopeChronological($query)
    {
        return $query->orderBy('sent_at', 'asc');
    }
}
