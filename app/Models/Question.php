<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_material_id',
        'type',
        'question_text',
        'correct_answer',
        'explanation',
        'points',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function learningMaterial()
    {
        return $this->belongsTo(LearningMaterial::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class)->orderBy('option_letter');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeMultipleChoice($query)
    {
        return $query->where('type', 'multiple_choice');
    }

    public function scopeFreeText($query)
    {
        return $query->where('type', 'free_text');
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
