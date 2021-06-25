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

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $orders = VendorOrder::where('user_id','=',$user->id)->orderBy('id','desc')->get()->groupBy('order_number');
        return view('vendor.order.index',compact('user','orders'));
    }

    public function show($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.details',compact('user','order','cart'));
    }

    public function license(Request $request, $slug)
    {
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();         
        $msg = 'Successfully Changed The License Key.';
        return response()->json($msg);
    }



    public function invoice($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.invoice',compact('user','order','cart'));
    }

    public function printpage($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.print',compact('user','order','cart'));
    }

    // public function status($slug,$status)
    // {
    //     $mainorder = VendorOrder::where('order_number','=',$slug)->first();
    //     if ($mainorder->status == "completed"){
    //         return redirect()->back()->with('success','This Order is Already Completed');
    //     }else{

    //     $user = Auth::user();
    //     $order = VendorOrder::where('order_number','=',$slug)->where('user_id','=',$user->id)->update(['status' => $status]);
    //     return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully');
    //    }
    // }



    //*** POST Request
    public function status($id, $status)
    {

        //--- Logic Section
        $data = Order::findOrFail($id);

        $input['status'] = $status;
        if ($data->status == "completed"){

        // Then Save Without Changing it.
            $input['status'] = "completed";
            $data->update($input);
            //--- Logic Section Ends
        $order = VendorOrder::where('order_id','=',$id)->update(['status' => $input['status']]);

        //--- Redirect Section          
         return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully');    
        //--- Redirect Section Ends     

    
            }else{

            if($input['status'] == "processing"){

                $gs = Generalsetting::findOrFail(1);
                if($gs->is_smtp == 1)
                {
                        $data11 = [
                            'to' => $data->customer_email,
                            'type' => "new_order",
                            'cname' => $data->customer_name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'wtitle' => "",
                            'onumber' => "",
                        ];

                        $mailer = new GeniusMailer();
                        $mailer->sendAutoOrderMail($data11,$data->id);                
                }
                
            }    
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

                    $uprice->current_balance = $uprice->current_balance + ($data->pay_amount +$extra_charges-$data->service_charges);
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


          $order = VendorOrder::where('order_id','=',$id)->update(['status' => $input['status']]);
          return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully'); 
         //--- Redirect Section Ends    
    
            }



        //--- Redirect Section          
        $msg = 'Status Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends  


    }








    public function sendtoCourier($id)
    {

        $user = Auth::user();
        $combine_key=str_random(5).time();
        $myBody['email'] = $user->localserve_email;
        $myBody['password'] = $user->localserve_password;
       
        $order=Order::findorFail($id);

        $myBody['web_order_id']=$order->id;
        $myBody['api_combine_key']=$combine_key;

        $myBody['d_fname']=$order->customer_name;
        $myBody['d_email']=$order->customer_email;
        $myBody['d_phone']=$order->customer_phone;
        $myBody['d_city']=$order->customer_city;
        $myBody['d_zip']=$order->zip;
        $myBody['d_country']=$order->customer_country;
        $myBody['d_address']=$order->customer_address;
        $myBody['d_add_address']=$order->customer_address_1;
        
        $myBody['d_order_instructions']=$order->instructions;
        $myBody['d_order_info']=$order->order_note;

        $myBody['d_order_id']=str_random(8);
        $myBody['d_package_size']=5;

        $myBody['pay_amount']=$order->shipping_cost;
        $myBody['time_check']=$order->time_check;
        $myBody['time']=$order->time;
        $myBody['date']=$order->date;

        $order->api_combine_key=$combine_key;
        $order->update();



        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $url = "https://localserve.com/api/clients_checkout";
       
        
        $request = $client->post($url,  ['form_params'=>$myBody]);
        // $response = $request->getStatusCode();
      
        $request->getStatusCode();
        if($request->getStatusCode()==200){
            $data['0']=1;
            $data['1']='Data Send Successfully !';
            return response()->json($data);
        }
        else{
            $data['0']=0;
            $data['1']='Something went wrong !';
             return response()->json($data);
        }

    }



}
