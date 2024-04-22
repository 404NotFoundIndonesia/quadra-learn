<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use \App\Trait\Toast;

    public function account(Request $request): View {
        return view('pages.profile.account', [
            'account' => auth()->user(),
        ]);
    }

    public function accountUpdate(UpdateAccountRequest $request): RedirectResponse {
        try {
            $account = auth()->user();

            $validated = $request->validated();
            if ($request->hasFile('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('public');
            }

            $account->update($validated);

            return redirect()->route('profile.account')->with($this->flashMessageKey, $this->successToast('Berhasil mengedit akun!'));
        } catch (\Throwable $th) {
            return redirect()->route('profile.account')->with($this->flashMessageKey, $this->errorToast('Gagal mengedit akun!'));
        }
    }

    public function accountDestroy(Request $request): RedirectResponse {
        try {
            if (!$request->input('deleteAccountConfirmation')) {
                return redirect()->route('profile.account')->with($this->flashMessageKey, $this->errorToast('Anda harus mencentang konfirmasi penghapusan akun!'));
            }

            $account = auth()->user();
            Auth::logout();

            if ($account->avatar) {
                Storage::delete($account->avatar);
            }

            $account->delete();

            return redirect()->route('welcome');
        } catch (\Throwable $th) {
            return redirect()->route('profile.account')->with($this->flashMessageKey, $this->errorToast('Gagal menghapus akun!'));
        }
    }

    public function changePassword(Request $request): View {
        return view('pages.profile.change-password');
    }

    public function changePasswordUpdate(ChangePasswordRequest $request): RedirectResponse {
        try {
            $account = auth()->user();
            if (!Hash::check($request->get('old_password'), $account->password)) {
                return redirect()->route('profile.change-password')->with($this->flashMessageKey, $this->errorToast('Password lama salah!'));
            }

            $account->update(['password' => $request->get('password')]);

            return redirect()->route('profile.change-password')->with($this->flashMessageKey, $this->successToast('Berhasil mengganti password!'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('profile.change-password')->with($this->flashMessageKey, $this->errorToast('Gagal mengganti password!'));
        }
    }
}
