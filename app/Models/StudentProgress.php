<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'learning_material_id',
        'status',
        'progress_percentage',
        'total_questions',
        'answered_questions',
        'correct_answers',
        'score',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'progress_percentage' => 'decimal:2',
        'score' => 'decimal:2',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningMaterial()
    {
        return $this->belongsTo(LearningMaterial::class);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isNotStarted()
    {
        return $this->status === 'not_started';
    }

    public function getProgressBarColorAttribute()
    {
        if ($this->isCompleted()) {
            return 'success';
        } elseif ($this->progress_percentage >= 75) {
            return 'info';
        } elseif ($this->progress_percentage >= 50) {
            return 'warning';
        }
        return 'secondary';
    }
}
