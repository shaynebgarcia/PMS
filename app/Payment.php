<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_type_id', 'leasing_agreement_id', 'tenant_id',
        'amount_due', 'amount_paid',
        'reference_no',
        'note', 'processed_by_user',
        'slug',
        'file_id'
    ];

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function agreement()
    {
        return $this->belongsTo(LeasingAgreement::class, 'leasing_agreement_id');
    }
    public function getAmountDueCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->amount_due, 2);
        return $num_format;
    }
    public function getAmountPaidCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->amount_paid, 2);
        return $num_format;
    }
    public function getAmountDueCurrencyCodeAttribute()
    {
        $num_format = number_format($this->amount_due, 2)." ".config('pms.currency.code');
        return $num_format;
    }
    public function getAmountPaidCurrencyCodeAttribute()
    {
        $num_format = number_format($this->amount_paid, 2)." ".config('pms.currency.code');
        return $num_format;
    }
}
