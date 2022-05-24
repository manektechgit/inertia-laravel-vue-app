<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\LoginRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginRepository implements LoginRepositoryInterface
{
    /**
     * authenticate
     *
     * @param  mixed $userData
     * @return object
     */
    public function authenticate($userData) : object
    {
        try {
            if (Auth::attempt($userData)) {
                $user = User::where('email', $userData['email'])->first()->toArray();

                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $user,
                    'message' => 'Login Successfully!'
                ]);
            }
            
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => 'Invalid credentials. Please check email and password!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }        
    }
    
    /**
     * logout
     *
     * @return object
     */
    public function logout() : object
    {
        try {
            Session::flush();
            Auth::logout();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Logout Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
