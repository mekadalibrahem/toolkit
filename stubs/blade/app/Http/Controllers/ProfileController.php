<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    /**
     * show profile page
     */
    public function create(Request $request)
    {
        $user = $request->user();
        return view('user.profile' , [
            'user' => $user
        ]);
    }

    /**
     * update user ( name , email)
     */
    public function update(Request $request)
    {

        $request->user()->fill($request->validate([
            'name' =>'required|max:255|string',
            'email' =>['required' , 'max:255' , 'email' , Rule::unique(User::class , 'email')->ignore($request->user()->id)]

        ]));


        if($request->user()->isDirty()){
            if($request->user()->isDirty('email')){
                $request->user()->email_verified_at = null ;
                // event(new VerifyEmail());
            }
            $request->user()->save();
            return Redirect::route('profile.create')->with('status' , 'profile-updated');
        }
        else{
            return redirect()->back();
        }




    }
    /**
     * change password
     */
    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|string',
            'new_password' =>'required|min:8|string|same:confirm_password'
        ]);

        if(Hash::check($request->password, $request->user()->password)){
            $request->user()->password = Hash::make($request->new_password) ;
            $request->user()->save();
            return redirect()->route('profile.create')->with('status' , 'password-updated');
        }
        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        $request->validate([
            'delete_password' => 'required|min:8|string'
        ]);
        if( Hash::check($request->delete_password , $request->user()->password)) {
            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');

        }else{
            return redirect()->route('profile.create')->with('status' , 'error-password');
        }
    }
}
