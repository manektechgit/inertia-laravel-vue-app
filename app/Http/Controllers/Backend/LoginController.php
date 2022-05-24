<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Http\Requests\Auth\LoginUserRequest;
use Illuminate\Support\Facades\Log;
use App\Interfaces\Auth\LoginRepositoryInterface;

class LoginController extends Controller
{
    private LoginRepositoryInterface $loginRepository;

    /**
     * __construct
     *
     * @param  mixed $loginRepository
     * @return void
     */
    public function __construct(LoginRepositoryInterface $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            return Inertia::render('Back/Auth/Login');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * login
     *
     * @param  mixed $request
     * @return object
     */
    public function login(LoginUserRequest $request)
    {
        try {
            // Retrieve the validated input data
            $data = $request->validated();

            $result = $this->loginRepository->authenticate($data);

            if ($result->getData()->status !== false) {
                return redirect('/admin')->with('message', $result->getData()->message);
            } else {
                return redirect('/admin/login')->with('message', $result->getData()->message);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        try {
            $result = $this->loginRepository->logout();

            return redirect('/admin')->with('message', $result->getData()->message);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
