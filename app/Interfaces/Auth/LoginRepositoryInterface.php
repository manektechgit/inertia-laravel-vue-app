<?php

namespace App\Interfaces\Auth;

interface LoginRepositoryInterface
{    
    /**
     * authenticate
     *
     * @param  mixed $userData
     * @return object
     */
    public function authenticate($userData) : object;
    
    /**
     * logout
     *
     * @return object
     */
    public function logout() : object;
}
