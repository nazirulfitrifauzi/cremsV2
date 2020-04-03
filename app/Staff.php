<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff_info';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'start_date',
    ];

    protected $dateFormat = 'U';

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

    public function user()
    {
        return $this->hasOne(User::class, 'staff_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'staff_id');
    }

    public function leave()
    {
        return $this->hasMany(StaffLeave::class, 'staff_id');
    }

    public function claim()
    {
        return $this->hasMany(StaffClaim::class, 'staff_id');
    }

    //public function issue()
    //{
    //return $this->hasMany(Issues::class, 'id');
    //}
}
