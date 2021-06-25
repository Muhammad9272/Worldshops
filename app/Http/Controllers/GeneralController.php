<?php

namespace App\Http\Controllers;

use App\Models\AddressBook;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;

class GeneralController extends Controller
{
     public function getStateList(Request $request)
        { 
        	$country=Country::where('name',$request->country_name)->first();           
            $states = DB::table("states")
            ->where("country_id",$country->id)
            ->pluck("name","id");
            return response()->json($states);
        }
    public function getAddressBook(Request $request)
    {
    	   $addressbook=AddressBook::where('id',$request->address_id)->first();
    	   return response()->json($addressbook);
    }
    public function ValidateLocation($latitude,$longitude)
    {  
      if(Session::get('cart')->methodofcollect==0){
           return response()->json(1);
        }
       if(Session::has('shop_name')){
        $shop=Session::get('shop_name');
        $datas=User::where('shop_name',$shop)->where('ban','!=',1)->first();

            $stores_i=User::where('is_vendor',2)->where('longitude','!=',null)->where('delivery_radius','!=',null);

            $stores = $stores_i->selectRaw("* ,
                         ( 3956 * acos( cos( radians(?) ) *
                           cos( radians( latitude  ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude  ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])

            ->having("distance", "<=",$datas->delivery_radius)
            ->where('id',$datas->id)
            ->first();

            if($stores){
                return response()->json(1);
            }
            else{
                return response()->json(0);
            }

       }
       else{
        return redirect()->route('front.index');
       }

      
        
    }
}
