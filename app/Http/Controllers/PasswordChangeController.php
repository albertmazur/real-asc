<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Update\ChangePasswordRequest;

class PasswordChangeController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showForm()
    {
        return view('auth.password-change');
    }

    public function update(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        $this->userRepository->changePassword(Auth::user()->id, $data['password']);

        return redirect()->route('dashboard')->with('success', __('passwords.changed'));
    }
}
