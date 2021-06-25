<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\VendorOrder;
use App\Models\OrderTrack;
use App\Models\User;
use App\Classes\GeniusMailer;

class OrderApiController extends Controller
{
        //*** POST Request
    public function status(Request $request)
    {


        //--- Logic Section
        $id=$request->id;
        $input['status']=$request->status;
        $combine_key=$request->api_combine_key;


        $data = Order::where('id',$id)->where('api_combine_key',$combine_key)->first();
        if(!$data){
        	 return response()->json('Order Not Found !');  
        }

        if ($data->status == "completed"){

        // Then Save Without Changing it.
            $input['status'] = "completed";
            $data->update($input);
            //--- Logic Section Ends
        $order = VendorOrder::where('order_id','=',$id)->update(['status' => $input['status']]);

        //--- Redirect Section          
         return response()->json('Order Status Updated Successfully');    
        //--- Redirect Section Ends     

    
            }else{
            if ($input['status'] == "completed"){
    
                $coupon_price=0;
                if($code=$data->coupon_code){
                    $fnd = Coupon::where('code','=',$code)->where('user_id',0)->first();
                    if($fnd){
                        $coupon_price=Session::has('coupon') ? Session::get('coupon') : 0;
                    }
                    else{
                        $coupon_price=0;
                    }
                }
                
                // $extra_charges=($data->gov_bag_charges+$data->shipping_cost)+$coupon_price;
                $extra_charges=$coupon_price;
                
                $vorder=$data->vendororders->first();
                // foreach($data->vendororders as $key=>$vorder)
                // {

                    $uprice = User::findOrFail($vorder->user_id);

                    $uprice->current_balance = $uprice->current_balance + ($data->pay_amount +$extra_charges-$data->service_charges-$data->gov_bag_charges-$data->shipping_cost);
                    $uprice->update();
                    // if($key==0){
                    //     $uprice = User::findOrFail($vorder->user_id);
                    //     $uprice->current_balance=$uprice->current_balance+$extra_charges;
                    //     $uprice->update();
                    // }
                // }
                 // dd($uprice->current_balance);
                

    
                $gs = Generalsetting::findOrFail(1);
                if($gs->is_smtp == 1)
                {
                    $maildata = [
                        'to' => $data->customer_email,
                        'subject' => 'Your order '.$data->order_number.' is Confirmed!',
                        'body' => "Hello ".$data->customer_name.","."\n Thank you for shopping with us. We are looking forward to your next visit.",
                    ];
    
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($maildata);                
                }
                else
                {
                   $to = $data->customer_email;
                   $subject = 'Your order '.$data->order_number.' is Confirmed!';
                   $msg = "Hello ".$data->customer_name.","."\n Thank you for shopping with us. We are looking forward to your next visit.";
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                   mail($to,$subject,$msg,$headers);                
                }
            }
            if ($input['status'] == "declined"){
                $gs = Generalsetting::findOrFail(1);
                if($gs->is_smtp == 1)
                {
                    $maildata = [
                        'to' => $data->customer_email,
                        'subject' => 'Your order '.$data->order_number.' is Declined!',
                        'body' => "Hello ".$data->customer_name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                    ];
                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($maildata);
                }
                else
                {
                   $to = $data->customer_email;
                   $subject = 'Your order '.$data->order_number.' is Declined!';
                   $msg = "Hello ".$data->customer_name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.";
                   $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                   mail($to,$subject,$msg,$headers);
                }
    
            }

            $data->update($input);

            // if($request->track_text)
            // {
            //         $title = ucwords($request->status);
            //         $ck = OrderTrack::where('order_id','=',$id)->where('title','=',$title)->first();
            //         if($ck){
            //             $ck->order_id = $id;
            //             $ck->title = $title;
            //             $ck->text = $request->track_text;
            //             $ck->update();  
            //         }
            //         else {
            //             $data = new OrderTrack;
            //             $data->order_id = $id;
            //             $data->title = $title;
            //             $data->text = $request->track_text;
            //             $data->save();            
            //         }
    
    
            // } 


        $order = VendorOrder::where('order_id','=',$id)->update(['status' => $input['status']]);

        return response()->json('Order Status Updated Successfully');  
         //--- Redirect Section Ends    
    
            }



        //--- Redirect Section          
        $msg = 'Status Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends  


    }
}
