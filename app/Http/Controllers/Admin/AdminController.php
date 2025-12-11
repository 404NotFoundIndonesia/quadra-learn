<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_materials' => LearningMaterial::count(),
            'published_materials' => LearningMaterial::published()->count(),
            'total_questions' => Question::count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
        ];

        $recent_materials = LearningMaterial::latest()->take(5)->get();
        $recent_questions = Question::with('learningMaterial')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_materials', 'recent_questions'));
    }
}
