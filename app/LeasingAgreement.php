<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\BillingTrait;

class LeasingAgreement extends Model
{
    use LogsActivity;

    protected $guarded = ['id'];

    protected static $logUnguarded = true;

    public function unit()
    {
    	return $this->belongsTo(Unit::class, 'unit_id');
    }
    // public function tenant()
    // {
    //     return $this->belongsTo(Tenant::class, 'tenant_id');
    // }
    public function details()
    {
        return $this->hasMany(LeasingAgreementDetail::class);
    }
    public function tenant_list()
    {
        return $this->hasMany(TenantList::class);
    }
    public function status()
    {
        return $this->belongsTo(LeasingAgreementStatus::class, 'agreement_status_id');
    }

}
