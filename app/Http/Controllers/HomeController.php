<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function home()
    {
        $user = Auth::user();
        return view('user.home', compact('user'));
    }
}
