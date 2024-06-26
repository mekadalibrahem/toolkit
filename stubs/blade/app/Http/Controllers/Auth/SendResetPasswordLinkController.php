<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class SendResetPasswordLinkController extends Controller
{
    /**
     * show reset password apge
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * generate reset link
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }
}
