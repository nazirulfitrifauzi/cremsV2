<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use UsersTableSeeder;

class Role extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class,'role','id');
    }
}
