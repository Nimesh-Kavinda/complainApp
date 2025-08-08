<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the complaints for the user.
     */
    public function complaints()
    {
        return $this->hasMany(ClientComplaint::class, 'client_email', 'email');
    }

    /**
     * Get the department the user heads.
     */
    public function departmentAsHead()
    {
        return $this->hasOne(Department::class, 'head_of_department');
    }

    /**
     * Get the staff member record for this user.
     */
    public function staffMember()
    {
        return $this->hasOne(StaffMember::class);
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is department head.
     */
    public function isDepartmentHead()
    {
        return $this->role === 'department_head';
    }

    /**
     * Check if user is staff.
     */
    public function isStaff()
    {
        return $this->role === 'staff_member';
    }



}
