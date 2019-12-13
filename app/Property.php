<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = ['id'];

    public function unit()
    {
    	return $this->hasMany(Unit::class);
    }

}
