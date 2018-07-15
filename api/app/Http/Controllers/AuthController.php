<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    protected $jwtAuth;

     /**
     * UsersController constructor.
     *
     * @param JWTAuth $jwtAuth
     */
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * Login of the user.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request) : JsonResponse
    {
        $credentials = $request->only('email','password');

        if (! $token = $this->jwtAuth->attempt($credentials)) {
            return response()->json(['error' => true,'message' => 'invalid credentials'], 401);
        }
        
        return response()->json(compact('token'));
    }
    /**
     * Logout of the user.
     *
     * @return JsonResponse
     */
    public function logout() : JsonResponse
    {
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);

        return response()->json(['logout']);
    }
    
    /**
     * Refresh Token of the user.
     *
     * @return JsonResponse
     */
    public function refreshToken() : JsonResponse
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);

        return response()->json(compact('token'));
    }

    /**
     * Get the autenthicated user.
     *
     * @return JsonResponse
     */
    public function getAuthUser() : JsonResponse
    {
        if (!$user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error' => true,'message' => 'user_not_found'], 404);
        }
        return response()->json(compact('user'));
    }
}