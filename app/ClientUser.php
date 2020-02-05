<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientUser extends Model
{
    protected $table = 'client_users_info';

    protected $guarded = [];

    public $timestamps = false;

    public function users()
    {
        return $this->hasOne(User::class, 'client_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
