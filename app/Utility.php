<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $fillable = [
        'unit_id', 
        'type',
        'no',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

}
