<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    protected $guarded = ['id'];

    public function unit()
    {
    	return $this->hasMany(Unit::class);
    }

    public function getLeasePriceCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->lease_price, 2);
        return $num_format;
    }

    public function getLeasePriceCurrencyCodeAttribute()
    {
        $num_format = number_format($this->lease_price, 2)." ".config('pms.currency.code');
        return $num_format;
    }
}

