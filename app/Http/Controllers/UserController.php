<?php

namespace App\Http\Controllers;

use App\Http\Kernel;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm() {
        return view('user.login');
    }

    public function login (Request $request) {
        $request->validate([
            'email' =>'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'Вы успешно авторизованы');
            if (Auth::user()->is_admin == 1) {
                return redirect(route('admin.index'));
            } else {
                return redirect()->home();
            }
        }

        return redirect()->back()->with('error', 'Неудача');

    }

    public function logout() {
        Cache::forget('user-is-online-' . Auth::user()->id);
        Auth::logout();

        return redirect()->route('login.create');
    }

}
