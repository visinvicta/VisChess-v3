<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterNewUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function create(): View {
        return view('register/create');
    }

    public function store(RegisterNewUserRequest $request): RedirectResponse {
        $user = User::create($request->validated());
        Auth::login($user);
        Session::flash('success', 'Your account has been created.');
        return redirect('/');
    }
}
