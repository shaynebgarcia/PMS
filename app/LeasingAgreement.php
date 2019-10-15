<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LeasingAgreement extends Model
{
    use LogsActivity;

    protected $fillable = [
        'unit_id', 'tenant_id',
        'agreement_status_id',
    ];

    protected static $logAttributes = true;

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
        return $this->belongsTo(LeasingAgreementDetail::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
