<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repository\UserRepository as Repository;

class UserRepository implements Repository{
    private User $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function get(int $id): User
    {
        return $this->userModel->find($id);
    }

    public function delete(int $id)
    {
        $user = $this->get($id);
        Auth::logout();
        return $user->delete();
    }

    public function updateDate(int $id, string $first_name, string $last_name, string $tel, string $language = 'pl', string $role = null)
    {
        $user = $this->userModel->find($id);
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->tel = $tel;
        $user->language = $language;
        if($role) $user->role = $role;
        
        return $user->save();
    }

    public function changePassword(int $id, string $password)
    {
        $user = Auth::user();
        $user->password = bcrypt($password);
        $update = $user->save();

        Auth::logoutOtherDevices($password);
        return $update;
    }

    public function changeEmail(int $id, string $email)
    {
        $user = $this->userModel->find($id);
        $user->email = $email;
        $user->email_verified_at = null;

        $update = $user->save();
        $user->sendEmailVerificationNotification();
        return $update;
    }
}
