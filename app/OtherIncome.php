<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    protected $fillable = [
        'leasing_agreement_details_id',
        'other_income_type_id',
        'to_bill',
        'amount',
        'note',
    ];

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
