<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = [
        'name', 
        'is_subscription',
        'length_month',
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

    public function getMonthlyPriceLengthAttribute()
    {
        if (is_numeric($this->length_month)) {

        	$monthlyPrice = '';
            $monthlyIndicator = '';
            $mnt = $this->length_month;

            if ($mnt == 1) {
            	$monthlyPrice = $this->amount;
            } else {
            	$monthlyPrice = $this->amount/$this->length_month;
            }
            $withmonthlyIndicator = config('pms.currency.sign').number_format($monthlyPrice, 2).'/month';
	        return $withmonthlyIndicator;
        }
    	
    }
}
