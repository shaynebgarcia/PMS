<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantList extends Model
{
    protected $guarded = ['id'];

    public function agreement()
    {
        return $this->belongsTo(LeasingAgreement::class, 'leasing_agreement_id');
    }

	public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
