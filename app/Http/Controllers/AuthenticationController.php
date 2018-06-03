<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'logout']);
        $this->middleware('dashboardAccess')->only('index');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.welcome');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('admin.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request, User $user)
    {

        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->with(['fail' => 'Enter valid Email Or Password']);

        }
        return redirect()->back()->with(['fail' => 'Enter valid Email Or Password']);

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
