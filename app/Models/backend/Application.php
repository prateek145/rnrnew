<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\backend\Role;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function username1()
    {
        return $this->hasOne(User::class);
    }

    public function rolestable()
    {
        return $this->hasMany(Role::class);
    }
}
