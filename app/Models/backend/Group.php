<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\Groupuserids;
use App\Models\backend\Groupgroupids;
use App\Models\User;


class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function groupusers(){
    //     return $this->hasMany()
    // }

    public function groupusers(){
        return $this->hasMany(Groupuserids::class, 'groupid', 'id');
    }

    public function groupgroups(){
        return $this->hasMany(Groupgroupids::class, 'groupid', 'id');
    }

    public function groupcreatedby(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function groupupdatedby(){
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
