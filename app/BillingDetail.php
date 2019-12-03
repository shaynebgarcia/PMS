<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BillingDetail extends Model
{
    use LogsActivity;

    protected static $logAttributes = true;
    
    protected $fillable = [
        'billing_id',
        'description',
        'amount',
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
