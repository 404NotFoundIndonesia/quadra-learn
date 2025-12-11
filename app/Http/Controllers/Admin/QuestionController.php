<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\LearningMaterial;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with(['learningMaterial', 'options'])
            ->when(request('material_id'), function ($query, $materialId) {
                return $query->where('learning_material_id', $materialId);
            })
            ->when(request('type'), function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when(request('search'), function ($query, $search) {
                return $query->where('question_text', 'like', "%{$search}%");
            })
            ->orderBy('learning_material_id')
            ->orderBy('order')
            ->paginate(10);

        $materials = LearningMaterial::all();

        return view('admin.questions.index', compact('questions', 'materials'));
    }

    public function create()
    {
        $materials = LearningMaterial::ordered()->get();
        return view('admin.questions.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'learning_material_id' => 'required|exists:learning_materials,id',
            'type' => 'required|in:multiple_choice,free_text',
            'question_text' => 'required|string',
            'correct_answer' => 'nullable|string',
            'explanation' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string',
            'correct_option' => 'nullable|string|in:A,B,C,D,E,F'
        ]);

        $question = Question::create($validated);

        // Handle multiple choice options
        if ($validated['type'] === 'multiple_choice' && isset($validated['options'])) {
            foreach ($validated['options'] as $letter => $optionText) {
                if (!empty($optionText)) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_letter' => $letter,
                        'option_text' => $optionText,
                        'is_correct' => $letter === $request->correct_option
                    ]);
                }
            }
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question created successfully.');
    }

    public function show(Question $question)
    {
        $question->load(['learningMaterial', 'options', 'attachments']);
        return view('admin.questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $question->load('options');
        $materials = LearningMaterial::ordered()->get();
        return view('admin.questions.edit', compact('question', 'materials'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'learning_material_id' => 'required|exists:learning_materials,id',
            'type' => 'required|in:multiple_choice,free_text',
            'question_text' => 'required|string',
            'correct_answer' => 'nullable|string',
            'explanation' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'options' => 'nullable|array|min:2|max:6',
            'options.*.text' => 'required_with:options|string',
            'correct_option' => 'nullable|string|in:A,B,C,D,E,F'
        ]);

        $question->update($validated);

        // Update multiple choice options
        if ($validated['type'] === 'multiple_choice' && isset($validated['options'])) {
            // Delete existing options
            $question->options()->delete();
            
            foreach ($validated['options'] as $letter => $optionText) {
                if (!empty($optionText)) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_letter' => $letter,
                        'option_text' => $optionText,
                        'is_correct' => $letter === $request->correct_option
                    ]);
                }
            }
        } elseif ($validated['type'] === 'free_text') {
            // Delete options for free text questions
            $question->options()->delete();
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question deleted successfully.');
    }
}
