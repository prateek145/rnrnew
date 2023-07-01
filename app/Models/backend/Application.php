<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\backend\Role;
use App\Models\backend\ApplicationField;
use App\Models\backend\Formdata;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function username1()
    {
        return $this->hasOne(User::class);
    }

    public function applicationfields(){
        return $this->HasMany(ApplicationField::class, 'applicationid', 'id');
    }

    public function formdata()
    {
        return $this->hasMany(Formdata::class, 'application_id', 'id');
    }
}
