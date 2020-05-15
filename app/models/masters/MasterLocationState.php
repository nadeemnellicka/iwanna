<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;

class MasterLocationState extends Model
{
    protected $guarded=[];

    public function pincodes(){
    	return $this->hasMany(MasterLocationPincode::class);
    }
     public function country()
    {
    	return $this->belongsTo(MasterLocationCountry::class);
    }
}
