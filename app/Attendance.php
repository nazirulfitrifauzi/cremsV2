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

    protected $dateFormat = 'U';

	public function getDateFormat()
	{
		return 'Y-m-d H:i:s';	
	}

    public function staff_info()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
