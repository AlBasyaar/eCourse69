<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi
    public function mentor(): HasOne
    {
        return $this->hasOne(Mentor::class);
    }

    public function courseAccesses(): HasMany
    {
        return $this->hasMany(CourseAccess::class);
    }

    public function finalAssignments(): HasMany
    {
        return $this->hasMany(FinalAssignment::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function courseChats(): HasMany
    {
        return $this->hasMany(CourseChat::class);
    }

    public function sentMentorChats(): HasMany
    {
        return $this->hasMany(MentorChat::class, 'sender_id');
    }

    public function receivedMentorChats(): HasMany
    {
        return $this->hasMany(MentorChat::class, 'receiver_id');
    }
}