<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user\CustomerSearchQueryLocations;
use App\models\user\CustomerSearchQueries;
use App\models\user\CustomerSearchQueryDetails;
use App\models\masters\MasterLocationPincode;
use Illuminate\Support\Facades\Auth;        

class SearchProductController extends Controller
{
   public function save(request $request)
    {
        try{ 
            $customerQuery = new CustomerSearchQueries;
            $customerQuery->user_id=Auth::id();
            $customerQuery->description=$request->description;
            $customerQuery->save(); 
            foreach($request->categories as $cat){
                $details= new CustomerSearchQueryDetails;
                $details->category_id=$cat['id'];
                $details->query_id=$customerQuery->id;
                $details->save();
            }
             foreach($request->region as $reg){
                $region= new CustomerSearchQueryLocations;
                $pincode = MasterLocationPincode::where('id', $reg['id'])->first();
                $region->pincode=$pincode->pincode;
                $region->query_id=$customerQuery->id;
                $region->save();																					
            }
        }
        catch(\Exception $e){
           echo $e->getMessage();  
        }
    }
}
