<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'property_id', 'unit_type_id',
        'number', 'floor_no',
        'leasing_agreement_id',
        'slug'
    ];

    // Relationships
    public function property()
    {
    	return $this->belongsTo(Property::class, 'property_id');
    }

    public function unit_type()
    {
    	return $this->belongsTo(UnitType::class, 'unit_type_id');
    }

    public function utilities()
    {
    	return $this->hasMany(Utility::class);
    }

    public function leasing_agreement()
    {
    	return $this->belongsTo(LeasingAgreement::class, 'leasing_agreement_id');
    }

	public function getFloorNoAttribute($floor_no)
	{
		if (is_numeric($floor_no)) {

			if ($floor_no >= 10) {
				$flr = substr($floor_no, -1);
			} else {
				$flr = $floor_no;
			}
		
			$ordinal_indicator = '';
			
			if ($flr == 1) {
				$ordinal_indicator = 'st';
			} elseif ($flr == 2) {
				$ordinal_indicator = 'nd';
			} elseif ($flr == 3) {
				$ordinal_indicator = 'rd';
			} else {
				$ordinal_indicator = 'th';
			}
			return $this->attributes['floor_no'] = $floor_no.$ordinal_indicator;
		}
	}

}
