<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserControlelr extends Controller
{
    /**
     * show register view
     */
    public function create():View
    {
        return view('auth.register');
    }

    /**
     * handle request to register new user
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required' , 'string' , 'max:255']  ,
            'email' => ['required' , 'string' , 'email' , 'max:255' , 'unique:users,email'],
            'password' => ['required' , 'min:8' , 'same:confirm_password']
        ]);

        $user = User::create([
            'name'=> $request->name ,
            'email'=> $request->email ,
            'password'=> Hash::make($request->password)
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(route('dashboard' ));
    }
}
