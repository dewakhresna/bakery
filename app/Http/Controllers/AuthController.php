<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function signup()
    {
        return view('user.home');
    }

    public function signup_process(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:15',
            'address' => 'required',
            'detailed_address' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->detailed_address = $request->detailed_address;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('home')->with('success');
    }

    public function signin_process(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $userId = Auth::user()->id;
            $role = User::where('id', $userId)->value('role');

            if($role == 2){
                return redirect()->route('admin.admin_home');
            } else {
                return redirect()->route('user.user_home');
            }
        } else {
            Auth::logout();
            return redirect()->route('home')->with('error', 'Email atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }


}
