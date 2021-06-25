<?php

namespace App\Http\Controllers;

use App\Models\TestLocation;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function index(Request $request){
        $data = TestLocation::orderBy('sort_id','asc')->get();
        return view('front.test',compact('data'));
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            
            foreach($arr as $sortOrder => $id){
                $menu = TestLocation::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }
}