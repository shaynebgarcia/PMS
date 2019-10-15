<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAccess extends Model
{
    protected $fillable = [
        'user_id', 'property_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function property()
    {
    	return $this->belongsTo(Property::class, 'property_id');
    }
}
