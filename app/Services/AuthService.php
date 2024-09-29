<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'Khách hàng', // Mặc định là Khách hàng
        ]);
    }

    public function login(array $data)
    {
        return Auth::attempt($data);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function resetPassword(array $data)
    {
        return Password::sendResetLink(['email' => $data['email']]);
    }

    public function updatePassword($user, $password)
    {
        $this->userRepository->updatePassword($user, $password);
    }

    public function userExists($email)
    {
        return $this->userRepository->findByEmail($email) !== null;
    }
}
