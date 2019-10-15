<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LeasingAgreementDetail extends Model
{
    use LogsActivity;

    protected $fillable = [
    	'leasing_agreement_id',
    	'description',
        'agreed_lease_price',
        'term_start', 'term_end', 'monthly_due', 'first_day',
        'status',
    ];

    protected static $logAttributes = true;

    public function agreement()
    {
    	return $this->belongsTo(LeasingAgreement::class, 'leasing_agreement_id');
    }

    public function getAgreedLeasePriceCurrencySignAttribute()
    {
        $num_format = config('pms.currency.sign').number_format($this->agreed_lease_price, 2);
        return $num_format;
    }
    public function getAgreedLeasePriceCurrencyCodeAttribute()
    {
        $num_format = number_format($this->agreed_lease_price, 2)." ".config('pms.currency.code');
        return $num_format;
    }
    public function getMonthlyCollectionOrdinalAttribute()
    {
        if (is_numeric($this->monthly_collection)) {

            if ($this->monthly_collection >= 10) {
                $mnt = substr($this->monthly_collection, -1);
            } else {
                $mnt = $this->monthly_collection;
            }
        
            $ordinal_indicator = '';
            
            if ($mnt == 1) {
                $ordinal_indicator = 'st';
            } elseif ($mnt == 2) {
                $ordinal_indicator = 'nd';
            } elseif ($mnt == 3) {
                $ordinal_indicator = 'rd';
            } else {
                $ordinal_indicator = 'th';
            }
            $withordinal = $this->monthly_collection.$ordinal_indicator.' of the month';
            return $withordinal;
        }
    }
}
