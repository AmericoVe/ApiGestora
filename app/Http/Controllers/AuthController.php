<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;
    
    public function index()
    {
        $user = User::all()->toArray();
        

        return $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");
        $token = null;

        if (!$token = JWTAuth::attempt($credentials)) {//verificando que sea el mismo token
            return response()->json([
                "status" => false,
                "message" => "Unauthorized"
            ]);
        }

        $user = auth()->user();
 

        return response()->json([
            "status" => true,
            "type" => $user->type,
            "email" => $user->email,
            "name" => $user->name,
            "id" => $user->id,
            "token" => $token
        ]);
    }

    public function register(Request $request)
    {
    
        $this->validate($request, [
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:6|max:10",
            "type" => "required|string",
            "tipo_doc" => "required|string",
            "numero_doc" => "required|string",
            "celular" => "required|string",
            "area_trabajo" => "required|string",
        ]);

        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $user->tipo_doc = $request->tipo_doc;
        $user->numero_doc = $request->numero_doc;
        $user->celular = $request->celular;
        $user->area_trabajo = $request->area_trabajo;
        $user->save();
/*
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
*/
        return response()->json([
            "status" => true,
            "user" => $user
        ]);
        
         
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            "token" => "required"
        ]);
    
        try {
            JWTAuth::invalidate($request->token);
    
            return response()->json([
                "status" => true,
                "message" => "User logged out successfully"
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                "status" => false,
                "message" => "Ops, the user can not be logged out"
            ]);
        }

        
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param   App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(  User $user)
    {
        
        if ($user->delete()) {
            return response()->json([
                "status" => true,
                "User" => $user
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
         
        
    }


    /**
     * Display the specified resource.
     *
     * @param   App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(  User $user)
    {
        
        if ( User::find($user)) {
            return User::find($user)->toArray();
            /*
            return response()->json([
                "status" => true,
                "User" => $user
            ]);
            */
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
         
        
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $this->validate($request, [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "type" => "required",
            "tipo_doc" => "required",
            "numero_doc" => "required",
            "celular" => "required",
            "area_trabajo" => "required",
        ]);
  
 
 

        if ( $user->update([
            //$request->all(),
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "type" => $request->type,
            "tipo_doc" => $request->tipo_doc,
            "numero_doc" => $request->numero_doc,
            "celular" => $request->celular,
            "area_trabajo" => $request->area_trabajo,
            ]
            
            )
        ) {
      // if ( $user->save()) {
            /*
            return response()->json($user);
            */
            
            return response()->json([
                "status" => true,
                "User" => $user
            ]); 

        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be updated."
            ], 500);
        }

        
    }

 

}
