<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Update\ChangeEmailRequest;
use App\Http\Requests\Update\SetLanguageRequest;
use App\Http\Requests\Update\DeleteAccountRequest;
use App\Http\Requests\Update\UpdateProfileRequest;
use App\Http\Requests\Update\ChangePasswordRequest;

class UserController extends Controller
{
    private UserRepository $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
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
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $tel = $request->input('tel');
        $language = $request->input('language');

        $this->userRepository->updateDate(Auth::id(), $firstName, $lastName, $tel, $language);
        session()->put('language', $language);

        return back()->with('success', __('settings.profile_updated', [], $language));
    }

    public function changeEmail(ChangeEmailRequest $request)
    {
        $email = $request->input('email');
        $this->userRepository->changeEmail(Auth::id(), $email);
        return back()->with('success', __('settings.email_changed'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $password = $request->input('password');
        $this->userRepository->changePassword(Auth::id(), $password);
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
        $this->userRepository->delete(Auth::id());
        return redirect()->route('home')->with('success', __('settings.account_deleted'));
    }
}
