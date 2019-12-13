<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOrderProcessing extends Model
{
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}
