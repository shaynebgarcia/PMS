<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = ['id'];

    public function getPriceCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->price, 2);
        return $num_format;
    }
    public function getPriceCurrencyCodeAttribute()
    {
        $num_format = number_format($this->price, 2)." ".config('pms.currency.code');
        return $num_format;
    }
}
