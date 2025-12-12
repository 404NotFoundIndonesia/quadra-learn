<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function welcome(): View {
        return view('welcome');
    }

    public function dashboard(): RedirectResponse {
        $user = Auth::user();
        
        // Redirect based on user role
        switch ($user->role) {
            case Role::ADMIN->value:
                return redirect()->route('admin.dashboard');
            case Role::TEACHER->value:
                return redirect()->route('teacher.dashboard');
            case Role::STUDENT->value:
                return redirect()->route('student.dashboard');
            default:
                return redirect()->route('welcome');
        }
    }
}
