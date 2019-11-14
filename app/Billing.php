<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{

    protected $fillable = [
    	'leasing_agreement_details_id',
        'invoice_no', 'prepared_by',
        'monthyear',
        'billing_to', 'billing_from', 'billing_date', 'due_date',
        'subtotal_amount', 'ou_amount', 'total_amount_due',
    ];

    public function leasing_agreement_details()
    {
        return $this->belongsTo(LeasingAgreementDetail::class, 'leasing_agreement_details_id');
    }
    public function details()
    {
        return $this->hasMany(BillingDetail::class);
    }
    public function getSubtotalCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->subtotal_amount, 2);
        return $num_format;
    }
    public function getSubtotalCurrencyCodeAttribute()
    {
        $num_format = number_format($this->subtotal_amount, 2)." ".config('pms.currency.code');
        return $num_format;
    }

    public function getOUCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->ou_amount, 2);
        return $num_format;
    }
    public function getOUCurrencyCodeAttribute()
    {
        $num_format = number_format($this->ou_amount, 2)." ".config('pms.currency.code');
        return $num_format;
    }

    public function getTotalCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->total_amount_due, 2);
        return $num_format;
    }
    public function getTotalCurrencyCodeAttribute()
    {
        $num_format = number_format($this->total_amount_due, 2)." ".config('pms.currency.code');
        return $num_format;
    }

}
