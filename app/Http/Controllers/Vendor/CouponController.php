<?php

namespace App\Http\Controllers\Vendor;

use Datatables;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;

class CouponController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    //*** JSON Request
    public function datatables()
    {    
         $user=Auth::user();
         $datas = Coupon::where('user_id',$user->id)->orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('type', function(Coupon $data) {
                                if($data->type == 0){
                                   $type = "Discount By Percentage";
                                }
                                elseif($data->type == 1){
                                   $type ="Discount By Amount";
                                }
                                else{
                                    $type ="Discount By Free Shipping";
                                }

                                
                                return $type;
                            })
                            ->editColumn('price', function(Coupon $data) {
                                if($data->type == 0){
                                   $price =$data->price.'%' ;
                                }
                                elseif($data->type == 1){
                                   $price =$data->price.'$';
                                }
                                else{
                                    $price="";
                                }

                                
                                return $price;
                            })
                            ->addColumn('status', function(Coupon $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('vendor-coupon-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('vendor-coupon-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            }) 
                            ->addColumn('action', function(Coupon $data) {
                                return '<div class="action-list"><a href="' . route('vendor-coupon-edit',$data->id) . '" class="edit" > <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('vendor-coupon-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('vendor.coupon.index');
    }

    //*** GET Request
    public function create()
    {
        return view('vendor.coupon.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $user=Auth::user();
        $rules = ['code' => 'unique:coupons'];
        $customs = ['code.unique' => 'This code has already been taken.'];

        $validator = Validator::make(Input::all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }   
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Coupon();
        $input = $request->all();
        if($request->t_check==1){
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d H:i:s');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d H:i:s');
        }
        if($request->apply_to==1){
             $rules = ['apply_val1' => 'required'];
             $customs = ['apply_val1.required' => 'Please select atleast 1 Category'];
             $validator = Validator::make(Input::all(), $rules, $customs);
            
            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }  

         $data->apply_val = json_encode($request->apply_val1);   
        }
        else if($request->apply_to==2){
             $rules = ['apply_val2' => 'required'];
             $customs =['apply_val2.required' => 'Please select atleast 1 Product'];
             $validator = Validator::make(Input::all(), $rules, $customs);
            
            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }  
         $data->apply_val = json_encode($request->apply_val2);   
        }
        if($request->type==2){
          $input['price'] =0;
        }
        $input['user_id']=$user->id;
        
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {  
        $user=Auth::user();
        $data = Coupon::where('user_id',$user->id)->where('id',$id)->firstOrFail();
        return view('vendor.coupon.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        $rules = ['code' => 'unique:coupons,code,'.$id];
        $customs = ['code.unique' => 'This code has already been taken.'];
        $validator = Validator::make(Input::all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $data = Coupon::findOrFail($id);
        $input = $request->all();
        if($request->type==2){
            $input['price']=0;
        }

        if($request->t_check==1){
        $input['start_date'] = Carbon::parse($input['start_date'])->format('Y-m-d H:i:s');
        $input['end_date'] = Carbon::parse($input['end_date'])->format('Y-m-d H:i:s');
        }
        else{
           $input['t_check']=0;
           $input['start_date']=null; 
           $input['end_date']=null;
        }



        if($request->apply_to==1){
             $rules = ['apply_val1' => 'required'];
             $customs = ['apply_val1.required' => 'Please select atleast 1 Category'];
             $validator = Validator::make(Input::all(), $rules, $customs);
            
            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }  

         $data->apply_val = json_encode($request->apply_val1);   
        }
        else if($request->apply_to==2){
             $rules = ['apply_val2' => 'required'];
             $customs =['apply_val2.required' => 'Please select atleast 1 Product'];
             $validator = Validator::make(Input::all(), $rules, $customs);
            
            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }  
         $data->apply_val = json_encode($request->apply_val2);   
        }
        else{
           $data->apply_val=null; 
        }
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function status($id1,$id2)
        {   
            $user=Auth::user();
            $data = Coupon::where('user_id',$user->id)->findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $user=Auth::user();
        $data = Coupon::where('user_id',$user->id)->findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
}
