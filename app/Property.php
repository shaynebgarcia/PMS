<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name', 'address', 'contact',
        'floor_total', 'unit_total',
        'date_finish', 'date_start_leasing',
        'code',
    ];

    public function unit()
    {
    	return $this->hasMany(Unit::class);
    }

}
