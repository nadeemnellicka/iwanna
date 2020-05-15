<?php

namespace App\Http\Controllers\api\masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\SearchProductCategory;
use App\models\masters\MasterProductCategory;
use App\models\masters\MasterLocationPincode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    
    public function productCategory(){
    	$model = SearchProductCategory::all();
        foreach($model as $key=>$cat){
            $result[$key]['name']=$cat->category;
            $result[$key]['id']=$cat->id;
        }
        return response()->json(['data'=>$result]); 
    }  

    public function region(){
        $region=DB::table('master_location_pincodes')
        ->select(DB::raw('DISTINCT division_name as division_name, id'))
        ->get();
        $result=array();
        $resultFinal=array();
        foreach($region as $key=>$reg){
            $result[$reg->division_name]['name']=$reg->division_name;
            $result[$reg->division_name]['id']=$reg->id;
        }
        $i=0;
        foreach($result as $key=>$reg){
            $resultFinal[$i]['name']=$reg['name'];
            $resultFinal[$i]['id']=$reg['id'];
            $i++;
        }
        return response()->json(['data' => $resultFinal, 'status' => 'sucess']);  
    }

    public function pincodeDetail($masterLocationPincode)
    {
        $model = MasterLocationPincode::where('pincode', '=', $masterLocationPincode)->firstOrFail();
        return response()->json(['pincode' => $model,'state'=>$model->state,'country'=>$model->state->country,'status' => 'CA']);
    }


}
