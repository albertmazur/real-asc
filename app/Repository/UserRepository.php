<?php

namespace App\Repository;

use App\Models\User;

interface UserRepository{
    public function get(int $id): User;
    public function updateDate(int $id, string $first_name, string $last_name, string $tel, string $language = 'pl', string $role = null);
    public function changePassword(int $id, string $password);
    public function changeEmail(int $id, string $email);
    public function delete(int $id);
}
