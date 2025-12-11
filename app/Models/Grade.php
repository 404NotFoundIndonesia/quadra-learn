<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'specialization',
        'class_code',
        'teacher_id',
        'capacity',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'grade_id')->where('role', 'student');
    }

    public function getStudentCountAttribute(): int
    {
        return $this->students()->count();
    }

    public function getAvailableSlotsAttribute(): int
    {
        return $this->capacity - $this->student_count;
    }

    public function getFullNameAttribute(): string
    {
        $name = $this->level;
        if ($this->specialization) {
            $name .= ' ' . $this->specialization;
        }
        return $name . ' - ' . $this->name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithTeacher($query)
    {
        return $query->whereNotNull('teacher_id');
    }

    public function scopeWithoutTeacher($query)
    {
        return $query->whereNull('teacher_id');
    }
}
