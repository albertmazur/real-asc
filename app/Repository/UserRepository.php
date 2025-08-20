<?php

namespace App\Repository;

use App\Enums\UserRole;
use App\Models\User;

interface UserRepository{
    public function get(int $id): User;
    public function getClient(int $pagination);
    public function add(string $first_name, string $last_name, string $email, string $tel, string $password, bool $change_password, string $language = 'pl', string $role = UserRole::USER->value);
    public function update(int $id, string $first_name, string $last_name, string $tel, string $language = 'pl', string $role = UserRole::USER->value, bool $change_password);
    public function changePassword(int $id, string $password);
    public function changeEmail(int $id, string $email);
    public function delete(int $id);
}
