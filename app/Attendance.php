<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'login_at',
    ];

    public function staff_info()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
