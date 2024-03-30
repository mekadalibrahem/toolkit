<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth ;

class Info extends Component
{

    public  $user ;
    public  string $info_status   = '' ;

    public  $name  ;
    public  $email ;
    protected $id ;


    public  function  edit()
    {



        $this->validate([
            'name'=>'required|max:255|string',
            'email' =>['required' , 'max:255' , 'email' , 'unique:users,email,'. $this->user->id]
        ]);
        $this->user->name = $this->name ;
        $this->user->email = $this->email ;

        if($this->user->isDirty()){
            if($this->user->isDirty('email')){
                $this->user->email_verified_at = null ;
                 event(new VerifyEmail());
            }
            $this->user->save();
            $this->info_status =  'profile-updated';
        }
        $this->render();
    }

    public function render()
    {
        $this->user =User::find($this->id = Auth::user()->id);
        // dd($this->user);
        $this->name = $this->user->name ;
        $this->email = $this->user->email ;


        return view('livewire.profile.info'  );
    }
}
