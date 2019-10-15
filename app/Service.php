<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'leasing_agreement_details_id', 
        'service_type_id',
        'agreed_amount',
    ];

    public function agreement_detail()
    {
        return $this->belongsTo(LeasingAgreementDetail::class, 'leasing_agreement_details_id');
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function getAgreedAmountCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->agreed_amount, 2);
        return $num_format;
    }

    public function getAgreedAmountCurrencyCodeAttribute()
    {
        $num_format = number_format($this->agreed_amount, 2)." ".config('pms.currency.code');
        return $num_format;
    }

}
