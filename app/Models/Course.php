<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail_url', // Menambahkan 'thumbnail_url'
        'mentor_id'
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(CourseVideo::class);
    }

    public function courseAccesses(): HasMany
    {
        return $this->hasMany(CourseAccess::class);
    }

    public function finalAssignments(): HasMany
    {
        return $this->hasMany(FinalAssignment::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(CourseChat::class);
    }
}
