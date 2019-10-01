<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeasingPayable extends Model
{
    protected $fillable = [
        'agreement_id', 
        'payment_type_id',
        'amount',
    ];

    public function agreement()
    {
        return $this->belongsTo(LeasingAgreement::class, 'agreement_id');
    }
    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
    public function getAmountPesoAttribute()
    {
        $num_format = "₱".number_format($this->amount, 2);
        return $num_format;
    }
}
