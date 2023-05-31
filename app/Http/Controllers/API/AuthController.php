<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;



class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    //
    public function register(Request $request){
        Log::info("message");
        $valid = validator($request->only('studentID','name','password'),[
            'studentID'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'password'=>'required|string|min:6',
            'group'=>'string'
        ]);
        //필수 값들에 대한 유효성 검사
        if($valid->fails()){
            return response()->json([
                'error' => $valid->errors()->all()
            ],\Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST);
        }
        //  받을 데이터
        $data = request()->only('studentID','name','password','group');

        // 사용자 생성(디비에 추가)
        $user = User::create([
            'name' =>$data['name'],
            'studentID' =>$data['studentID'],
            'password' =>bcrypt($data['password']),
            'group' =>$data['group']
        ]);

        //passport client 가져오기 //oauth client secret key 가져오기

        return response()->json([
            'user' =>$user,
        ],\Symfony\Component\HttpFoundation\Response::HTTP_CREATED);

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['studentID', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function test()
    {
        return 'te';
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

}
