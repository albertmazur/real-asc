<?php

namespace App\Repository\Eloquent;

use App\Enums\UserRole;
use App\Models\User;
use App\Notifications\AccountCreatedNotification;
use Carbon\Carbon;
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
        return $this->userModel->findOrFail($id);
    }

    public function getClient(int $pagination)
    {
        return $this->userModel->paginate($pagination);
    }

    public function delete(int $id)
    {
        $user = $this->userModel->get($id);
        return $user->delete();
    }

    public function add(string $first_name, string $last_name, string $email, string $tel, string $password, bool $change_password, string $language = 'pl', string $role = UserRole::USER->value)
    {
        $user = $this->userModel->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'tel' => $tel,
            'force_password_change' => $change_password,
            'password' => bcrypt($password),
            'language' => $language,
            'role' => $role
        ]);

        $user->sendEmailVerificationNotification();
        $user->notify(new AccountCreatedNotification($password, $language));
    }

    public function update(int $id, string $first_name, string $last_name, string $tel, string $language = 'pl', string $role = UserRole::USER->value)
    {
        $user = $this->userModel->findOrFail($id);
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->tel = $tel;
        $user->language = $language;
        $user->role = $role;

        return $user->save();
    }

    public function changePassword(int $id, string $password)
    {
        $user = $this->userModel->findOrFail($id);
        $user->password = bcrypt($password);
        $update = $user->save();

        Auth::logoutOtherDevices($password);
        return $update;
    }

    public function changeEmail(int $id, string $email)
    {
        $user = $this->userModel->findOrFail($id);
        $user->email = $email;
        $user->email_verified_at = null;

        $update = $user->save();
        $user->sendEmailVerificationNotification();
        return $update;
    }
}
