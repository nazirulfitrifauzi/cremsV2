<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $table = 'issues';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'date',
    ];
}
