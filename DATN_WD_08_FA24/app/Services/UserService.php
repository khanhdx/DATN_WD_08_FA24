<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Validated;
use InvalidArgumentException;

class UserService extends UserRepository
{
    /**
     * @var $userRepository
     */
    protected $userRepository;
    
    /**
     * UserService constructor
     * 
     * @param UserRepository $userRepository
     */
    public function __construct() {
        $this->userRepository = UserRepository::class;
    }
    /**
     * Get all user
     * @return string
     * 
     */
    public function getAll() {
        return $this->getAllUser();
    }
}