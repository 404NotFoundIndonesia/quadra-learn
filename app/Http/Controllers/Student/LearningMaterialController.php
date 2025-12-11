<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\StudentProgress;
use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningMaterialController extends Controller
{
    public function show(LearningMaterial $learningMaterial)
    {
        if (!$learningMaterial->is_published) {
            abort(404);
        }

        $user = Auth::user();

        // Get or create progress record
        $progress = StudentProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'learning_material_id' => $learningMaterial->id
            ],
            [
                'status' => 'not_started',
                'total_questions' => $learningMaterial->questions()->active()->count()
            ]
        );

        // Update status to in_progress if not started
        if ($progress->isNotStarted()) {
            $progress->update([
                'status' => 'in_progress',
                'started_at' => now()
            ]);
        }

        // Get questions with user answers
        $questions = $learningMaterial->questions()
            ->active()
            ->orderBy('order')
            ->with(['options' => function($query) {
                $query->orderBy('option_letter');
            }])
            ->get()
            ->map(function($question) use ($user) {
                $answer = StudentAnswer::where('user_id', $user->id)
                    ->where('question_id', $question->id)
                    ->first();

                $question->user_answer = $answer;
                return $question;
            });
        if ($learningMaterial->references) {
            $learningMaterial->references = json_decode($learningMaterial->references, true);
        }

        return view('student.learning-materials.show', compact(
            'learningMaterial',
            'progress',
            'questions'
        ));
    }

    public function submitAnswer(Request $request, LearningMaterial $learningMaterial, Question $question)
    {
        if (!$learningMaterial->is_published || !$question->is_active) {
            abort(404);
        }

        // Validate that question belongs to material
        if ($question->learning_material_id !== $learningMaterial->id) {
            abort(404);
        }

        $user = Auth::user();

        $validated = $request->validate([
            'answer' => 'required|string',
            'selected_option' => 'nullable|string|size:1'
        ]);

        // Check if already answered
        $existingAnswer = StudentAnswer::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->first();

        if ($existingAnswer) {
            return redirect()->back()->with('error', 'Anda sudah menjawab pertanyaan ini.');
        }

        // Determine correctness and points
        $isCorrect = false;
        $pointsEarned = 0;

        if ($question->type === 'multiple_choice') {
            $selectedOption = $question->options()
                ->where('option_letter', $validated['selected_option'])
                ->first();

            if ($selectedOption && $selectedOption->is_correct) {
                $isCorrect = true;
                $pointsEarned = $question->points;
            }
        } else {
            // For free text, consider it correct for now (manual grading needed)
            $isCorrect = true;
            $pointsEarned = $question->points;
        }

        // Save answer
        StudentAnswer::create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => $validated['answer'],
            'selected_option_letter' => $validated['selected_option'] ?? null,
            'is_correct' => $isCorrect,
            'points_earned' => $pointsEarned,
            'answered_at' => now()
        ]);

        // Update progress
        $this->updateProgress($user->id, $learningMaterial->id);

        return redirect()->back()->with('success', 'Jawaban berhasil disimpan!');
    }

    private function updateProgress($userId, $learningMaterialId)
    {
        $progress = StudentProgress::where('user_id', $userId)
            ->where('learning_material_id', $learningMaterialId)
            ->first();

        if (!$progress) {
            return;
        }

        $totalQuestions = Question::where('learning_material_id', $learningMaterialId)
            ->active()
            ->count();

        $answeredQuestions = StudentAnswer::where('user_id', $userId)
            ->whereHas('question', function($query) use ($learningMaterialId) {
                $query->where('learning_material_id', $learningMaterialId)
                      ->active();
            })
            ->count();

        $correctAnswers = StudentAnswer::where('user_id', $userId)
            ->where('is_correct', true)
            ->whereHas('question', function($query) use ($learningMaterialId) {
                $query->where('learning_material_id', $learningMaterialId)
                      ->active();
            })
            ->count();

        $score = StudentAnswer::where('user_id', $userId)
            ->whereHas('question', function($query) use ($learningMaterialId) {
                $query->where('learning_material_id', $learningMaterialId)
                      ->active();
            })
            ->sum('points_earned');

        $progressPercentage = $totalQuestions > 0 ? ($answeredQuestions / $totalQuestions) * 100 : 0;
        $status = $answeredQuestions >= $totalQuestions ? 'completed' : 'in_progress';

        $progress->update([
            'total_questions' => $totalQuestions,
            'answered_questions' => $answeredQuestions,
            'correct_answers' => $correctAnswers,
            'progress_percentage' => $progressPercentage,
            'score' => $score,
            'status' => $status,
            'completed_at' => $status === 'completed' ? now() : null
        ]);
    }
}
