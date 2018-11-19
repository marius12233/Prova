<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','r0le_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

      //Controlla se l'id che gli passo è quello dell'admin!!
    public static function isAdmin($user_id)
    {
        $user = User::find($user_id);
        $role_id = $user->role_id;
        $rule=Rule::find($role_id);

        return $rule->role=="ADMIN"?  true :  false;
    }
}
