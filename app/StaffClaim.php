<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffClaim extends Model
{
    protected $table = 'staff_claim';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'date'
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
