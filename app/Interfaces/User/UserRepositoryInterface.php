<?php

namespace App\Interfaces\User;

interface UserRepositoryInterface {
        
    /**
     * getAllUsers
     *
     * @param  mixed $request
     * @return object
     */
    public function getAllUsers($request) : object;
    
    /**
     * getAllRoles
     *
     * @return object
     */
    public function getAllRoles() : object;
        
    /**
     * saveUser
     *
     * @param  mixed $data
     * @return object
     */
    public function saveUser($data) : object;
    
    /**
     * getUserDetail
     *
     * @param  mixed $userId
     * @return object
     */
    public function getUserDetail($userId) : object;
    
    /**
     * getUserData
     *
     * @param  mixed $userId
     * @return object
     */
    public function getUserData($userId) : object;
        
    /**
     * updateUser
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return object
     */
    public function updateUser($id, $data) : object;
    
    /**
     * deleteUser
     *
     * @param  mixed $id
     * @return object
     */
    public function deleteUser($id) : object;
}
