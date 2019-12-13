<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherIncomeType extends Model
{
    protected $guarded = ['id'];

    public function getAmountCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->amount, 2);
        return $num_format;
    }
    public function getAmountCurrencyCodeAttribute()
    {
        $num_format = number_format($this->amount, 2)." ".config('pms.currency.code');
        return $num_format;
    }
}
