<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Billing extends Model
{
    use LogsActivity;

    protected static $logAttributes = true;
    
    protected $guarded = ['id'];

    public function leasing_agreement_details()
    {
        return $this->belongsTo(LeasingAgreementDetail::class, 'leasing_agreement_details_id');
    }
    public function details()
    {
        return $this->hasMany(BillingDetail::class);
    }

}
