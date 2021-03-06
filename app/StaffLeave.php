<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffLeave extends Model
{
    protected $table = 'staff_leave';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'start',
        'end',
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
