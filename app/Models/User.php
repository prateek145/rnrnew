<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\backend\Userrole;
use App\Models\backend\Groupuserids;
use App\Models\backend\Usergroup;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [];

    public function userroles(){
        return $this->hasMany(Userrole::class, 'userid', 'id');
    }

    public function usergroups(){
        return $this->hasMany(Usergroup::class, 'userid', 'id');
    }

    public function selectedthroughgroup(){
        return $this->hasMany(Groupuserids::class, 'userids', 'id');
    }
}
