<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository extends User {
    /**
     * @var User
     */
    protected $user;
    /**
     * UserRepository constructor
     * 
     * @param User $user
     */
    public function __construct(){
        $this->user = new User();
    }
    public function getAllUser() {
        return User::query()->paginate(10);
    }
}