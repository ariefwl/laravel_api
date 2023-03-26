<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource; 

class AuthController extends Controller
{
    public function index()
    {
        // $user = User::all();
        // return response()->json([
        //     'data' => $user
        // ]);
        $user = User::all();
        return new UserResource(true, 'Daftar User', $user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'username' => 'required',
            'name' => 'required',
            'company_id' => 'required',
            'type' => 'required',
            'avatarImage' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan !',
                'data' => $validator->errors()
            ], 422);
        }

        //upload foto
        $foto = $request->file('avatarImage');
        $foto->storeAs('public/avatar', $foto->hashName());

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Register berhasil !',
        //     'data' => $success
        // ]);
        return new UserResource(true, 'Register berhasil !', $user);
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ]))
        {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;

            return response()->json([
                'success' => true,
                'message' => 'Login sukses !',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Password atau email salah !',
                'data' => null
            ]);
        }
    }
}
