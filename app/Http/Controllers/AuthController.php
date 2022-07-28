<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Registers a new account.
     *
     * @param RegisterRequest $request
     * @return User
     */
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $user;
    }

    /**
     * Validates the credentials and authenticates the user.
     *
     * @param LoginRequest $request
     * @return User
     */
    public function login(LoginRequest $request){
        $request->authenticate();

        $request->session()->regenerate();

        return auth()->user();
    }

    /**
     * Clears the user session and logouts the user.
     *
     * @return void
     */
    public function logout(){
        Session::flush();

        auth()->guard('web')->logout();
    }
}
