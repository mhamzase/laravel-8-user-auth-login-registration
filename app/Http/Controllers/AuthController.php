<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registration()
    {
        return view('auth.registration');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'username' => 'required|regex:/^\S*$/u|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return redirect("login")->withSuccess('Your account created successfully!');
    }

    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function index()
    {
        return view('auth.login');
    }
}