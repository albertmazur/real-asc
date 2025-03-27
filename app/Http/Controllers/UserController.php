<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Update\ChangeEmailRequest;
use App\Http\Requests\Update\SetLanguageRequest;
use App\Http\Requests\Update\DeleteAccountRequest;
use App\Http\Requests\Update\UpdateProfileRequest;
use App\Http\Requests\Update\ChangePasswordRequest;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dashboard()
    {
        return view('dashboard.main');
    }

    public function edit()
    {
        return view('settings.main');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return back()->with('success', __('settings.profile_updated'));
    }

    public function changeEmail(ChangeEmailRequest $request)
    {
        $user = Auth::user();
        $user->email = $request->input('email');
        $user->email_verified_at = null;
        $user->save();

        $user->sendEmailVerificationNotification();

        return back()->with('success', __('settings.email_changed'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Auth::logoutOtherDevices($request->input('password'));

        return back()->with('success', __('settings.password_changed'));
    }

    public function setLanguage(SetLanguageRequest $request)
    {
        $user = Auth::user();
        $user->language = $request->input('language');
        $user->save();

        session()->put('language', $request->input('language'));

        return back()->with('success', __('settings.language_updated'));
    }

    public function deleteAccount(DeleteAccountRequest $request)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', __('settings.account_deleted'));
    }
}
