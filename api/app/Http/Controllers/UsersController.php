<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Http\Controllers\Controller;


/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers\User;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserValidator
     */
    protected $userValidator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $userRepository
     * @param UserValidator $userValidator
     */
    public function __construct(UserRepository $userRepository, UserValidator $userValidator)
    {
        $this->userRepository = $userRepository;
        $this->userValidator  = $userValidator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $users = $this->userRepository->all();

        return response()->json([
                'data' => $users,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $this->userValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

        $user = $this->userRepository->create($request->all());

        $response = [
            'message' => 'User created.',
            'data'    => $user,
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $user = $this->userRepository->find($id);

        if(!$user){
            return response()->json([
                'data' => 'user not found',
            ],204);    
        }
        return response()->json([
                'data' => $user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function update(Request $request,int $id) : JsonResponse
    {
        $this->userValidator->setId($id);
        $this->userValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $user = $this->userRepository->update($request->all(), $id);

        $response = [
            'message' => 'User updated.',
            'data'    => $user,
        ];

        return response()->json($response);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function delete(int $id) : JsonResponse
    {
        $deleted = $this->userRepository->delete($id);

        return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
    }
}