<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewSessionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionsController extends Controller
{
    public function destroy(): RedirectResponse {
        auth()->logout();

        return redirect('/');
    }

    public function store(StoreNewSessionRequest $request) {
        $credentials = $request->validated();
        
        if (auth()->attempt($credentials)) {
            return redirect('/')->with('success', 'Welcome back.');
        }
    
        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified.']);
    } 

    public function create(): View {
        return view('/sessions/create');
    }
}
