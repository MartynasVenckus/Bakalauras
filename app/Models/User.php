<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    public $timestamps = false;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function add(Request $request){

        $user = new User;

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->type = $request->input('type');
        $user->password = Hash::make($request->input('password'));

        if($request->input('password') == $request->input('repeatpassword')){

            $user->save();
        }

            return $user;
    }

    public static function updateMy(Request $request, $id){

        $user = User::find($id);
        
        $user->name = $request->input('name1');
        $user->surname = $request->input('surname1');
        $user->email = $request->input('email1');
        $user->phone = $request->input('phone1');
        $user->type = $request->input('type1');
        
        
        if(($request->input('password1') == $request->input('repeatpassword1')) && !is_null($request->input('password1') )){

            $user->password = Hash::make($request->input('password1'));
        }

        $user->save();
        
    }

    public static function updateMyProfile(Request $request, $id){

        $user = User::find($id);
        
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->type = $request->input('type');
        
        
        if(($request->input('password') == $request->input('repeatpassword')) && !is_null($request->input('password') )){

            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        
    }
}
