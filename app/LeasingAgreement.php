<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeasingAgreement extends Model
{
    protected $fillable = [
        'unit_id', 'tenant_id',
        'agreed_lease_price',
        'date_of_contract',
        'term_start', 'term_end', 'monthly_collection', 'move_in',
        'status',
    ];

    public function unit()
    {
    	return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function payable()
    {
        return $this->hasMany(LeasingPayable::class);
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

    public function getAgreedLeasePricePesoAttribute()
    {
        $num_format = "₱".number_format($this->agreed_lease_price, 2);
        return $num_format;
    }
}
