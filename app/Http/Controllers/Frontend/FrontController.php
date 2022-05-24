<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Interfaces\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
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

            return Inertia::render('Front/User/Users', ['data' => $data->getData()->data]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
