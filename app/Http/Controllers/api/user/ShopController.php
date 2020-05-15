<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\SearchProductCategory;
use App\models\masters\MasterLocationPincode;
use App\models\shops\Shops;
use App\models\shops\RelationShopCategoryBrand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;																									
										 
class ShopController extends Controller
{
   public function save(request $request)
    {
        try{											
            $pincode = MasterLocationPincode::where('pincode', $request->pincode)->first();
            if(!$pincode){
                return response()->json(['status' => 'error']);
            }
            $shop = new Shops;
            $shop->name = $request->name;
            $shop->country_id = $pincode->country_id;
            $shop->state_id = $pincode->state_id;
            $shop->pincode = $pincode->id;
            $shop->state_name=$request->state;
            $shop->region_name=$request->division_name;
            $shop->address_1 = $request->address_1;
            $shop->address_2 = $request->address_2;
            $shop->phone_number = $request->phone;
            $shop->created_by =Auth::id();
            $shop->save(); 
            foreach($request->categories as $cat){
                $relation= new RelationShopCategoryBrand;
                $searchModel=SearchProductCategory::where('id',$cat['id'])->first();
                $relation->shop_id=$shop->id;
                $relation->search_category_id=$cat['id'];
                $relation->category_id=$searchModel->category_master_id;
                $relation->save();
            }
        }
        catch(\Exception $e){
           echo $e->getMessage();  
        }
    }

    public function shops(request $request){
    	$results = Shops::where(['created_by'=>Auth::id()])->get();
        // $result=[];
        // foreach($results as $key=>$cat){
        //     $result[$key]['name']=$cat->name;
        //     $result[$key]['id']=$cat->id;
        // }
    	return response()->json(['shops' => $results]);
    }
}
