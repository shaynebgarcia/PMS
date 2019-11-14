<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\BillingTrait;

class LeasingAgreement extends Model
{
    use LogsActivity;

    protected static $logAttributes = true;

    protected $fillable = [
        'property_id', 'unit_id', 'tenant_id',
        'link_id',
        'agreement_status_id',
    ];

    public function unit()
    {
    	return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function status()
    {
        return $this->belongsTo(LeasingAgreementStatus::class, 'agreement_status_id');
    }
    public function details()
    {
        return $this->hasMany(LeasingAgreementDetail::class);
    }
}
