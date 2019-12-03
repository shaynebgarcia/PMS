<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    protected $fillable = [
        'leasing_agreement_details_id',
        'other_income_type_id',
        'to_bill',
        'total_amount',
        'note',
    ];

    public function income_type()
    {
        return $this->belongsTo(OtherIncomeType::class, 'other_income_type_id');
    }

    public function getTotalAmountCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->total_amount, 2);
        return $num_format;
    }

    public function getTotalAmountCurrencyCodeAttribute()
    {
        $num_format = number_format($this->total_amount, 2)." ".config('pms.currency.code');
        return $num_format;
    }
}
