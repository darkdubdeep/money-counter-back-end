<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/** 
 * Class User
 * @package App
 * @property int id
 * @property string name 
 * @property string email
 * @property string password
 * @property string remember_token
 * @property string created_at
 * @property string updated_at
*/

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function expences(){
        return $this->hasMany(Expence::class, 'author_id', 'id');
    }
};
