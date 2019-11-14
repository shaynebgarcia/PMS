<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use DateTime;

class LeasingAgreementDetail extends Model
{
    use LogsActivity;

    protected $fillable = [
    	'leasing_agreement_id',
        'agreement_no',
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

    public function bills()
    {
        return $this->hasMany(Billing::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function MdY($m, $d, $y, $string)
    {
        $mdy = date($m.' '.$d.', '.$y, strtotime($string));
        return $mdy;
    }

    public function FdY($f, $d, $y, $string)
    {
        $fdy = date($f.' '.$d.', '.$y, strtotime($string));
        return $fdy;
    }

    public function FdY_adj($f, $d, $y, $adjust, $string)
    {
        $fdy = date($f.' '.$d.', '.$y, strtotime($adjust, $string));
        return $fdy;
    }

    public function bill_from($my)
    {
        $bill_from_date = $this->FdY('F', $this->monthly_due, 'Y', $my);

        // Checks if date is valid if not will get last day of the month
        $check = checkdate(date('m', strtotime($my)), $this->monthly_due, date('Y', strtotime($my)));
        if ($check == false) {
            $adjusted_date = (new DateTime(($bill_from_date)))->modify('last day of last month');
            return $adjusted_date->format('F d Y');
        } else {
            return $bill_from_date;
        }
    }
    public function bill_to($bill_from_date)
    {
        $exclude_day = strtotime('-1 day', strtotime($bill_from_date));
        $bill_to_date = $this->FdY_adj('F', 'd', 'Y', '+1 month', $exclude_day);
        return $bill_to_date;
    }
    public function bill_due($bill_to_date)
    {
        $bill_due_date = date('F d, Y', strtotime('-7 day', strtotime($bill_to_date)));
        return $bill_due_date;
    }
    public function bill_date($now)
    {
        $bill_date = $this->MdY('M', 'd', 'Y', $now);
        return $bill_date;
    }

    public function rental_price()
    {
        $rental_price = $this->agreed_lease_price;
        return $rental_price;
    }
    public function subtotal_subservices($latest_sub_services)
    {
        $subtotal_subservices = $latest_sub_services->sum('agreed_amount');
        return $subtotal_subservices;
    }
    public function subtotal_utilitybill($utility_bill)
    {
        $subtotal_utilitybill = $utility_bill->sum('amount');
        return $subtotal_utilitybill;
    }
    public function subtotal($array)
    {
        $subtotal = array_sum($array);
        return $subtotal;
    }
    public function oupayment($ou)
    {
        return $ou;
    }
    public function total($subtotal, $ou)
    {
        $total = $subtotal + $ou;
        return $total;
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
