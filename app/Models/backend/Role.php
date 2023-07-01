<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Application;
use App\Models\User;
use App\Models\backend\Rolegroup;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function role_applicationname()
    {
        return $this->hasOne(Application::class, 'id', 'application_id');
    }

    public function rolegroup()
    {
        return $this->hasMany(Rolegroup::class, 'roleid', 'id');
    }

    public function rolecreatedby()
    {
        return $this->hasOne(User::class,'id', 'created_by');
    }

    public function roleupdatedby()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
