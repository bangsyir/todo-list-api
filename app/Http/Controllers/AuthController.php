<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }

    public function getRegister() {
        return view('auth.register');
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [   
            'email' => 'required|email', 
            'password' => 'required'
        ]); 
        $user = User::where('email', '=', $request->email)->first();
        $status = "error";
        $message = "";
        $errors = null;
        $data = null;
        $code = 401;
        if($validator->fails()) {
            $errors = $validator->errors();
            // $message = $errors;
        } else {
            if($user) {
                // check if password user input same qith password in database
                if(Hash::check($request->password, $user->password)) {
                    // generate token
                    $user->generateToken($user);
                    // $user->createToken('myAuthApp')->plainTextToken;
                    $status = 'success';
                    $message = 'Login success';
                    $data = $user->toArray();
                    $code = 200;
                }else {
                    $message = 'Login failed, wrong email or password';
                }
            } else {
                $message = 'Login failed, wrong email or password';
            }
        }

        return response()->json([
            'status' => 'login',
            'message' => $message,
            'status_code' => $code,
            'errors' => $errors,
            'data' => $data
        ],$code);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => ' required',
            'password' => 'required|string|min:8'
        ]);

        $status = "error";
        $message = "";
        $errors = null;
        $data = null;
        $code = 400;
        if($validator->fails()) {
            $errors = $validator->errors();
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            if($user) {
                $user->generateToken($user);
                $status = 'success';
                $message = 'Register successfully';
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = 'Register failed';
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request) {
        $user = \Auth::user();
        
        if($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Logout success',
            'data' => null
        ], 200);
    }
}
