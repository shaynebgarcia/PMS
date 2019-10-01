<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
    	'user_id',
        'contact', 'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lease()
    {
        return $this->hasMany(LeasingAgreement::class);
    }
}
