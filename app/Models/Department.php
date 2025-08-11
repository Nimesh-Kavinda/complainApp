<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'head_of_department',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function headOfDepartment()
    {
        return $this->belongsTo(User::class, 'head_of_department');
    }

    public function staffMembers()
    {
        return $this->hasMany(StaffMember::class, 'department_id');
    }

    public function staffComplaints()
    {
        return $this->hasMany(StaffComplaint::class, 'department_id');
    }

    /**
     * Get complaint assignments for this department
     */
    public function complaintAssignments()
    {
        return $this->hasMany(ComplaintAssignment::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}
