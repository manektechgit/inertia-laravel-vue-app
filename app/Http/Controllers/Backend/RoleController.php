<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Interfaces\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepository;
    
    /**
     * __construct
     *
     * @param  mixed $roleRepository
     * @return void
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->roleRepository = $roleRepository;
    }

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            $data = $this->roleRepository->getAllRoles($request);

            return Inertia::render('Back/Role/Roles', ['data' => $data->getData()->data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        try {
            $data = $this->roleRepository->getAllPermissions();

            return Inertia::render('Back/Role/CreateRole', ['data' => $data->getData()->data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }
    }
    
    /**
     * store
     *
     * @return void
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            // Retrieve the validated input data
            $data = $request->validated();

            $result = $this->roleRepository->saveRole($data);

            return redirect('/admin/roles')->with('message', $result->getData()->message);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        try {
            $result = $this->roleRepository->getRoleDetail($id);

            return Inertia::render('Back/Role/ViewRole', ['data' => $result->getData()->data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        try {
            $result = $this->roleRepository->getRoleData($id);

            return Inertia::render('Back/Role/UpdateRole', ['data' => $result->getData()->data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            // Retrieve the validated input data
            $data = $request->validated();

            $result = $this->roleRepository->updateRole($id, $data);

            return redirect('/admin/roles')->with('message', $result->getData()->message);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $result = $this->roleRepository->deleteRole($id);

            return redirect('/admin/roles')->with('message', $result->getData()->message);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }        
    }
}
