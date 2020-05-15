<?php

namespace App\models\shops;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
     public function country()
    {
    	return $this->belongsTo(MasterLocationCountry::class);
    } 
    public function state()
    {
    	return $this->belongsTo(MasterLocationState::class);
    } 
    public function created_by()
    {
    	return $this->belongsTo(User::class);
    }
}
