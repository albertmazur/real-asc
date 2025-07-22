<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delete\DeleteAccountRequest;
use App\Http\Requests\SetLanguageRequest;
use App\Http\Requests\Store\StoreUserRequest;
use App\Http\Requests\Update\ChangeEmailRequest;
use App\Http\Requests\Update\ChangePasswordRequest;
use App\Http\Requests\Update\UpdateProfileRequest;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        return view('dashboard.admin.user.main', [
            'users' => $this->userRepository->getClient(5)
        ]);
    }

    public function store(StoreUserRequest $request){
        $data = $request->validated();

        $this->userRepository->add(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['tel'],
            $data['password'],
            $data['change_password'] ?? false,
            $data['language'],
            $data['role']
        );

        return redirect()->route('user.users')->with('success', __('dashboard.user.added'));
    }

    public function edit(Request $request){
        $this->authorize('isAdmin', 'role');
        
        $data = $request->validate([
            'userId' => ['required', 'exists:App\Models\User,id']
        ]);
        return view('dashboard.admin.user.edit', [
            'user' => $this->userRepository->get($data['userId'])
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->authorize('isAdmin', 'role');
        $data = $request->validated();

        $this->userRepository->update(
            $data['id'],
            $data['first_name'],
            $data['last_name'],
            $data['tel'],
            $data['language'],
            $data['role'],
            $data['change_password'] ?? false
        );

        if($data['password']){
            $this->userRepository->changePassword($data['id'], $data['password']);
        }

        if($data['email'] && $this->userRepository->get($data['id'])->email != $data['email']){
            $this->userRepository->changeEmail($data['id'], $data['email']);
        }
        
        return redirect()->route('user.users')->with('success', __('dashboard.user.update'));
    }

    public function delete(Request $request)
    {
        $this->authorize('isAdmin', 'role');
        $data = $request->validate([
            'userId' => ['required', 'exists:App\Models\User,id']
        ]);

        $this->userRepository->delete($data['userId']);

        return redirect()->route('user.users')->with('success', __('dashboard.user.update'));
    }

    public function dashboard()
    {
        return view('dashboard.main');
    }

    public function editProfile()
    {
        return view('settings.main');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->authorize('isUser', 'role');

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $tel = $request->input('tel');
        $language = $request->input('language');

        $this->userRepository->update(Auth::id(), $firstName, $lastName, $tel, $language);
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
        $data = $request->validated();
        $this->userRepository->changePassword(Auth::id(), $data['password']);
        Auth::logoutOtherDevices($data['current_password']);
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
        Auth::logout();
        $this->userRepository->delete(Auth::id());

        return redirect()->route('home')->with('success', __('settings.account_deleted'));
    }
}
