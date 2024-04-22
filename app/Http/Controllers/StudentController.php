<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    use \App\Trait\Paginate;
    use \App\Trait\Toast;

    public function index(Request $request): View {
        $data = [
            'items' => User::student()->search($request->query('q'))->render($this->pageSize),
        ];

        return view('pages.students.index', $data);
    }

    public function resetPassword(Request $request, string $nis): RedirectResponse {
        $student = User::student()->where('nis', $nis)->first();
        if (is_null($student)) {
            return back()->with($this->flashMessageKey, $this->errorToast('Siswa tidak ditemukan'));
        }
        $student->update(['password' => User::DEFAULT_PASSWORD]);

        return back()->with($this->flashMessageKey, $this->successToast("NIS. {$student->nis} telah mereset password!"));
    }

    public function destroy(Request $request, string $nis): RedirectResponse {
        $student = User::student()->where('nis', $nis)->first();
        if (is_null($student)) {
            return back()->with($this->flashMessageKey, $this->errorToast('Siswa tidak ditemukan'));
        }

        if ($student->avatar) {
            Storage::delete($student->avatar);
        }

        $student->delete();

        return back()->with($this->flashMessageKey, $this->successToast("NIS. {$student->nis} telah dihapus!"));
    }
}
