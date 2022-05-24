<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    
    /**
     * __construct
     *
     * @param  mixed $userRepository
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
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
            $data = $this->userRepository->getAllUsers($request);

            return Inertia::render('Back/User/Users', ['data' => $data->getData()->data]);
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
            $data = $this->userRepository->getAllRoles();

            return Inertia::render('Back/User/CreateUser', ['data' => $data->getData()->data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }
    }
    
    /**
     * store
     *
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        try {
            // Retrieve the validated input data
            $data = $request->validated();

            $result = $this->userRepository->saveUser($data);

            return redirect('/admin/users')->with('message', $result->getData()->message);
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
            $result = $this->userRepository->getUserDetail($id);

            return Inertia::render('Back/User/ViewUser', ['data' => $result->getData()->data]);
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
            $result = $this->userRepository->getUserData($id);

            return Inertia::render('Back/User/UpdateUser', ['data' => $result->getData()->data]);
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
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            // Retrieve the validated input data
            $data = $request->validated();

            $result = $this->userRepository->updateUser($id, $data);

            return redirect('/admin/users')->with('message', $result->getData()->message);
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
            $result = $this->userRepository->deleteUser($id);

            return redirect('/admin/users')->with('message', $result->getData()->message);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());            
        }        
    }
}
