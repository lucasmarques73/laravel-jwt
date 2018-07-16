<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
    			'name' => 'required|string|max:255',
            	'email' => 'required|string|email|max:255|unique:users',
            	'password' => 'required|min:6',
            ]);
            
    	if ($validator->fails()) {
    		return response()->json($validator->errors(),400);
    	}

        $user = new User();
        $user->fill($data);
        $user->save();

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
    public function show(int $id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'data' => 'user not found',
            ],204);    
        }

        return response()->json(['data' => $user]);
    }

   /**
    * Update the specified resource in storage.
    *
    * @param  Request $request
    * @param  int  $id
    *
    * @return JsonResponse
    */
    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        
        if(!$user){
            return response()->json([
                'data' => 'user not found',
            ],204);    
        }

        $validator = Validator::make($data,[
    			'name' => 'required|string|max:255',
            	'email' => 'required|string|email|max:255|unique:users',
            	'password' => 'required|min:6',
            ]);
            
    	if ($validator->fails()) {
    		return response()->json($validator->errors(),400);
    	}

        $data = $request->all();

        $user->fill($data);
        $user->save();
        
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
    public function delete(int $id)
    {
        $user = User::find($id);
        
        if(!$user){
            return response()->json([
                'data' => 'user not found',
            ],204);    
        }

        $deleted = $user->delete();

        return response()->json([
            'message' => 'User deleted.',
            'deleted' => $deleted,
        ]);
    }
}
