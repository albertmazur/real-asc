<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\Store\StoreUserRequest;
use App\Repository\UserRepository;
use Gate;
use Illuminate\Http\Request;
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

    public function index(){
        return view('dashboard.admin.user.main', [
            'users' => $this->userRepository->getClient(5)
        ]);
    }

    public function store(StoreUserRequest $request){
       if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
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
        else abort(403);
    }

    public function edit(Request $request){
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            $data = $request->validate([
                'userId' => ['required', 'exists:App\Models\User,id']
            ]);
            return view('dashboard.admin.user.edit', ['user' => $this->userRepository->get($data['userId'])]);
        }
    }

    public function update(UpdateProfileRequest $request){
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            $data = $request->validated();

            $this->userRepository->update(
                $data['id'],
                $data['first_name'],
                $data['last_name'],
                $data['tel'],
                $data['language'],
                $data['role']
            );

            if($data['password']){
                $this->userRepository->changePassword($data['id'], $data['password']);
            }

            if($data['email'] && Auth::user()->email != $data['email']){
                $this->userRepository->changeEmail($data['id'], $data['email']);
            }
            
            return redirect()->route('user.users')->with('success', __('dashboard.user.update'));
        }
        else abort(403);
    }

    public function delete(Request $request){
        $data = $request->validate([
            'userId' => ['required', 'exists:App\Models\User,id']
        ]);

        $this->userRepository->delete($data['userId']);

        return redirect()->route('user.users')->with('success', __('dashboard.user.update'));
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

    public function editProfile()
    {
        return view('settings.main');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
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
