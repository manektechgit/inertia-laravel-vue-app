<?php

namespace App\Interfaces\Role;

interface RoleRepositoryInterface {
        
    /**
     * getAllRoles
     *
     * @param  mixed $request
     * @return object
     */
    public function getAllRoles($request) : object;
    
    /**
     * getAllPermissions
     *
     * @return object
     */
    public function getAllPermissions() : object;
        
    /**
     * saveRole
     *
     * @param  mixed $data
     * @return object
     */
    public function saveRole($data) : object;
    
    /**
     * getRoleDetail
     *
     * @param  mixed $roleId
     * @return object
     */
    public function getRoleDetail($roleId) : object;
    
    /**
     * getRoleData
     *
     * @param  mixed $roleId
     * @return object
     */
    public function getRoleData($roleId) : object;
        
    /**
     * updateRole
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return object
     */
    public function updateRole($id, $data) : object;
    
    /**
     * deleteRole
     *
     * @param  mixed $id
     * @return object
     */
    public function deleteRole($id) : object;
}
