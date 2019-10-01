<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    protected $fillable = [
        'property_id', 
        'name', 'size',
        'lease_price',
        'create_at', 'updated_at',
    ];

    public function unit()
    {
    	return $this->hasMany(Unit::class);
    }

    public function getLeasePricePesoAttribute()
    {
        $num_format = "₱".number_format($this->lease_price, 2);
        return $num_format;
    }

	// public function getLeasePriceAttribute($lease_price)
	// {
	//     return $this->attributes['lease_price'] = sprintf('₱%s', number_format($lease_price, 2));
	// }
}

