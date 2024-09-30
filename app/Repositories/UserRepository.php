<?php 
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function updatePassword(User $user, string $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }
}
