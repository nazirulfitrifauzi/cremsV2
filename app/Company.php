<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company_info';

    protected $guarded = [];

    public $timestamps = false;
}
