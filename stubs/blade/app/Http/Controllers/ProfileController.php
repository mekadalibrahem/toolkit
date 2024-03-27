<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{

    /**
     * show profile page
     */
    public function create(Request $request)
    {
        $user = $request->user();


        return view('user.profile' , [
            'user' => $user ,
            'sessions' => $this->sessions( $request)
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

    /**
     * log out form other devices
     */
    public function logOutFromOtherDevice(Request $request){
        // $user = $request->user()->logoutOtherDevices();
        Auth::logoutOtherDevices($request->password_logout);


        return redirect()->route('profile.create');
    }


    /**
     * Get the current sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                    ->where('user_id', $request->user()->getAuthIdentifier())
                    ->orderBy('last_activity', 'desc')
                    ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);

            return (object) [
                'agent' => $agent ,
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Laravel\Jetstream\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent(), fn ($agent) => $agent->setUserAgent($session->user_agent));
    }
}
