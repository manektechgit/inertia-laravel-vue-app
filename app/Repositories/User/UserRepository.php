<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {
        
    /**
     * getAllUsers
     *
     * @return object
     */
    public function getAllUsers($request) : object
    {
        try {
            $users = User::select('users.id', 'users.name', 'users.email', 'roles.name AS roleName')
                ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('users.name', 'LIKE','%'.$request->keyword.'%')
                ->orWhere('users.email', 'LIKE','%'.$request->keyword.'%')
                ->orWhere('roles.name', 'LIKE','%'.$request->keyword.'%')
                ->orderBy('users.id', 'DESC')
                ->paginate(5);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $users,
                'message' => 'All User Data Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
    
    /**
     * getAllRoles
     *
     * @return object
     */
    public function getAllRoles() : object
    {
        try {
            $roles = Role::select('id', 'name')->orderBy('id', 'ASC')->get();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $roles,
                'message' => 'Role Data Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }    
    }
    
    /**
     * saveUser
     *
     * @param  mixed $userData
     * @return object
     */
    public function saveUser($userData) : object
    {
        try {
            $user = new User();
            $user->name = isset($userData['name']) ? $userData['name'] : '';
            $user->email = isset($userData['email']) ? $userData['email'] : '';
            $user->email_verified_at = Carbon::now();
            $user->password = isset($userData['password']) ? bcrypt($userData['password']) : '';
            $user->remember_token = NULL;
            $user->save();

            $user->assignRole($userData['role']);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $user,
                'message' => 'User Created Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
    
    /**
     * getUserDetail
     *
     * @param  mixed $userId
     * @return object
     */
    public function getUserDetail($userId) : object
    {
        try {
            $user = User::where('id', $userId)->first();
            $userRole = $user->roles->all();

            $data['user'] = $user;
            $data['userRole'] = $userRole;

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
                'message' => 'User Detail Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }          
    }
    
    /**
     * getUserData
     *
     * @param  mixed $userId
     * @return object
     */
    public function getUserData($userId) : object
    {
        try {
            $user = User::where('id', $userId)->first();
            $roles = Role::select('id', 'name')->get();
            $userRole = $user->roles->first();

            $data['user'] = $user;
            $data['roles'] = $roles;
            $data['userRole'] = $userRole;

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
                'message' => 'User Data Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }        
    }
        
    /**
     * updateUser
     *
     * @param  mixed $userId
     * @param  mixed $userData
     * @return object
     */
    public function updateUser($userId, $userData) : object
    {
        try {
            $user = User::where('id', $userId)->first();
            
            if (!empty($user)) {
                $user->name = $userData['user']['name'];
                $user->email = $userData['user']['email'];
                $user->updated_at = Carbon::now();
                $user->save();
            }

            DB::table('model_has_roles')->where('model_id', $userId)->delete();
            $role = Role::select('id', 'name', 'guard_name')->where('name', $userData['userRole']['name'])->first();
            $user->assignRole($role);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $user,
                'message' => 'User Updated Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
    
    /**
     * deleteUser
     *
     * @param  mixed $userId
     * @return object
     */
    public function deleteUser($userId) : object
    {
        try {
            $user = User::where('id', $userId)->delete();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $user,
                'message' => 'User Deleted Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }          
    }
}
