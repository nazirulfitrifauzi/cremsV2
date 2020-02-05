<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client_info';

    protected $guarded = [];

    public $timestamps = false;

    public function client_users()
    {
        return $this->hasMany(ClientUser::class, 'client_id', 'id');
    }
}
