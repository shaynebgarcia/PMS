<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_type_id', 'agreement_id', 'tenant_id',
        'amount',
        'reference_no',
        'note', 'processed_by_user',
        'slug',
        'file_id'
    ];

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
