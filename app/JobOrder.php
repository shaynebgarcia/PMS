<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    protected $guarded = ['id'];

    public function agreement_detail()
    {
        return $this->belongsTo(LeasingAgreementDetail::class, 'leasing_agreement_details_id');
    }
    
    public function type()
    {
    	return $this->belongsTo(OtherIncomeType::class, 'order_type_id');
    }
}
