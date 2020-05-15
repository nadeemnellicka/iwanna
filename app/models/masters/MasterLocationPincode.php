<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;

class MasterLocationPincode extends Model
{
    protected $guarded = [];
    public function state()
    {
    	return $this->belongsTo(MasterLocationState::class);
    }
}																								
