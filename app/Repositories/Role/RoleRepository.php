<?php

namespace App\Repositories\Role;

use App\Interfaces\Role\RoleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface
{

    /**
     * getAllRoles
     *
     * @return object
     */
    public function getAllRoles($request): object
    {
        try {
            $roles = Role::where('name', 'LIKE', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->paginate(5);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $roles,
                'message' => 'All Role Data Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * getAllPermissions
     *
     * @return object
     */
    public function getAllPermissions(): object
    {
        try {
            $permissions = Permission::select('id', 'name')->orderBy('id', 'ASC')->get();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $permissions,
                'message' => 'Permission Data Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * saveRole
     *
     * @param  mixed $roleData
     * @return object
     */
    public function saveRole($roleData): object
    {
        try {
            $role = new Role();
            $role->name = isset($roleData['name']) ? $roleData['name'] : '';
            $role->save();

            $role->syncPermissions($roleData['permissions']);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $role,
                'message' => 'Role Created Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * getRoleDetail
     *
     * @param  mixed $roleId
     * @return object
     */
    public function getRoleDetail($roleId): object
    {
        try {
            $role = Role::where('id', $roleId)->first()->toArray();
            $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                ->where("role_has_permissions.role_id", $roleId)
                ->get();

            $data['role'] = $role;
            $data['rolePermissions'] = $rolePermissions;

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
                'message' => 'Role Detail Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * getRoleData
     *
     * @param  mixed $roleId
     * @return object
     */
    public function getRoleData($roleId): object
    {
        try {
            $role = Role::where('id', $roleId)->first()->toArray();
            $permission = Permission::select('id', 'name')->OrderBy('id', 'ASC')->get();
            $rolePermissions = Permission::select('id', 'name')->join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                ->where("role_has_permissions.role_id", $roleId)
                ->get();

            $data['role'] = $role;
            $data['permission'] = $permission;
            $data['rolePermissions'] = $rolePermissions;

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
                'message' => 'Role Data Fetched Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * updateRole
     *
     * @param  mixed $roleId
     * @param  mixed $roleData
     * @return object
     */
    public function updateRole($roleId, $roleData): object
    {
        try {
            $role = Role::where('id', $roleId)->first();
            $role->name = $roleData['role']['name'];
            $role->updated_at = Carbon::now();
            $role->save();

            $role->syncPermissions($roleData['rolePermissions']);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $role,
                'message' => 'Role Updated Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * deleteRole
     *
     * @param  mixed $roleId
     * @return object
     */
    public function deleteRole($roleId): object
    {
        try {
            $role = Role::where('id', $roleId)->delete();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $role,
                'message' => 'Role Deleted Successfully!'
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
