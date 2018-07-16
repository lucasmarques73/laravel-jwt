<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use JWTAuth;

class AuthController extends Controller
{
    
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

       if (! $token = JWTAuth::attempt($credentials)) {
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
       $token = JWTAuth::getToken();
       JWTAuth::invalidate($token);

       return response()->json(['logout']);
   }
   
   /**
    * Refresh Token of the user.
    *
    * @return JsonResponse
    */
   public function refreshToken() : JsonResponse
   {
       $token = JWTAuth::getToken();
       $token = JWTAuth::refresh($token);

       return response()->json(compact('token'));
   }

   /**
    * Get the autenthicated user.
    *
    * @return JsonResponse
    */
   public function getAuthUser() : JsonResponse
   {
       if (!$user = JWTAuth::parseToken()->authenticate()) {
           return response()->json(['error' => true,'message' => 'user_not_found'], 404);
       }
       return response()->json(compact('user'));
   }
}
