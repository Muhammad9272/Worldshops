<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCreditCard;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Input;
use Redirect;
use Stripe\Error\Card;
use URL;
use Validator;




class StripeController extends Controller
{



  public function __construct()
    {
        //Set Spripe Keys
        $stripe = Generalsetting::findOrFail(1);
        Config::set('services.stripe.key', $stripe->stripe_key);
        Config::set('services.stripe.secret', $stripe->stripe_secret);
    }


    public function store(Request $request){

        $gs=Generalsetting::findOrFail(1);
        $user=Auth::user();
        if (!Session::has('cart')) {
            $data[0]=1;
            $data[5]="You don't have any product to checkout";
             $data[6]=route('front.index');
            return response()->json($data);
        }
        if(!Session::has('shop_name')){

            $data[0]=1;
            $data[5]="Session Destroyed!";
            $data[6]=route('front.index');
            return response()->json($data);
        }
     
        // Get latitude & longitude from street address
        $address=$request->street_address;
        $client = new \GuzzleHttp\Client();
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$gs->location_api_key";
        $result = $client->post($url)->getBody();
        $json =json_decode($result);
        
        if($json->results){
           $latitude=$json->results[0]->geometry->location->lat;
           $longitude=$json->results[0]->geometry->location->lng;
        }
        else{
            $data[0]=0;
            $data[5]="Street Address is not valid!";
            return response()->json($data);
        }
        // Get latitude & longitude from street address ends

       // If delivery Posible in that Area
       if(Session::get('cart')->methodofcollect!=0){
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

            if(!$stores){
                $data[0]=0;
                $data[5]="Delivery is not possible in that area!";
                return response()->json($data);             
            }
        }

        //If delivery Possible in that Area ends



         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);


          foreach($cart->items as $product)
            {
               if($product['item']['discount_check']==1 && $product['qty']>=$product['item']['buy_quantity'])  {                  
                 $free_quant=(int)($product['qty']/$product['item']['buy_quantity']);
                 $free_quant=$free_quant*$product['item']['get_quantity'];
                 $pid=$product['item']['id'];
                 $cart->items[$pid]['free_prod']= $free_quant;
                }
            }
         $cart->totalPrice=$cart->totalPrice+(Product::servicecharges()); 
         Session::put('cart',$cart);
         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);  

            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }

        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $settings->title." Order";
        
        $item_amount = Session::has('cart') ? Session::get('cart')->totalPrice : '0' ;

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'cardDate' => 'required',
                        
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            
            $datesplit = preg_split("#/#", $request->cardDate);
            $month=$datesplit[0];
            $year=$datesplit[1];
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $month,
                            'exp_year' => $year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    $data[0]=0;
                    $data[5]="Token Problem With Your Token.";
                    return response()->json($data);
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $curr->name,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
        foreach($cart->items as $key => $prod)
        {
        if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
        {
                foreach($prod['item']['license_qty']as $ttl => $dtl)
                {
                    if($dtl != 0)
                    {
                        $dtl--;
                        $produc = Product::findOrFail($prod['item']['id']);
                        $temp = $produc->license_qty;
                        $temp[$ttl] = $dtl;
                        $final = implode(',', $temp);
                        $produc->license_qty = $final;
                        $produc->update();
                        $temp =  $produc->license;
                        $license = $temp[$ttl];
                         $oldCart = Session::has('cart') ? Session::get('cart') : null;
                         $cart = new Cart($oldCart);
                         $cart->updateLicense($prod['item']['id'],$license);  
                         Session::put('cart',$cart);
                        break;
                    }                    
                }
        }
        }
                    $order['user_id'] = $request->user_id;
                    $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
                    $order['totalQty'] = $request->totalQty;
                    $order['pay_amount'] = round($item_amount / $curr->value, 2);
                    $order['method'] = "Stripe";

                    

                    // $order['order_number'] = $item_number;
                    $order['shipping'] = $request->shipping;
                    $order['pickup_location'] = $request->pickup_location;

                    
                    $order['customer_email'] = $user->email;
                    $order['customer_name'] = $user->name .' '.$request->lname;
                    $order['customer_phone'] = $request->phone;
                    $order['customer_address'] = $request->flat_no;
                    $order['customer_address_1'] = $request->street_address;
                    // $order['customer_country'] = $request->country;
                    // $order['customer_city'] = $request->city;
                    $order['customer_zip'] = $request->zip;


                    
                    // $order['shipping_email'] = $request->bemail;
                    // $order['shipping_name'] = $request->bfname .' ' .$request->blname;
                    // $order['shipping_phone'] = $request->bphone;
                    // $order['shipping_address'] = $request->baddress1;
                    // $order['shipping_address_1'] = $request->baddress2;
                    // $order['shipping_country'] = $request->shipping_country;
                    // $order['shipping_city'] = $request->shipping_city;
                    // $order['shipping_zip'] = $request->shipping_zip;
                    $order['instructions'] = $request->instructions;
                    $order['order_note'] = Session::has('checkout_note')?Session::get('checkout_note'):'';
                    $order['coupon_code'] = Session::has('coupon_code') ? Session::get('coupon_code') : '' ;
                    $order['coupon_discount'] = Session::has('coupon') ? Session::get('coupon') : '';

                    $order['payment_status'] = "Completed";
                    $order['txnid'] = $charge['balance_transaction'];
                    $order['charge_id'] = $charge['id'];
                    $order['currency_sign'] = $curr->sign;
                    $order['currency_value'] = $curr->value;
                    $order['shipping_cost'] = $request->shipping_cost;
                    $order['packing_cost'] = $request->packing_cost;
                    $order['tax'] = $gs->tax;
                    $order['dp'] = $request->dp;

       

        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;
        $order['gov_bag_charges'] = $request->gov_bag_charges;
        $order['service_charges'] = Product::servicecharges();        
        $order['methodofcollect']=$cart->methodofcollect;

        $order['time_check'] = $request->time_check;
        if($request->time_check==1){
            $order['time'] = $request->time;
            $order['date'] = $request->date;
        }
        
                    
                    if($order['dp'] == 1)
                    {
                        $order['status'] = 'completed';
                    }
            if (Session::has('affilate')) 
            {
                $val = $request->total / 100;
                $sub = $val * $settings->affilate_charge;
                $user = User::findOrFail(Session::get('affilate'));
                $user->affilate_income += $sub;
                $user->update();
                $order['affilate_user'] = $user->name;
                $order['affilate_charge'] = $sub;
            }
            $order->save();

            $item_number = str_random(2).rand(1128,9850).$order->id;

            $order->order_number=$item_number;
            $order->update();

        if($order->dp == 1){
            $track = new OrderTrack;
            $track->title = 'Completed';
            $track->text = 'Your order has completed successfully.';
            $track->order_id = $order->id;
            $track->save();
        }
        else {
            $track = new OrderTrack;
            $track->title = 'Pending';
            $track->text = 'You have successfully placed your order.';
            $track->order_id = $order->id;
            $track->save();
        }

                    
                    $notification = new Notification;
                    $notification->order_id = $order->id;
                    $notification->save();
                    if($request->coupon_id != "")
                    {
                       $coupon = Coupon::findOrFail($request->coupon_id);
                       $coupon->used++;
                       if($coupon->times != null)
                       {
                            $i = (int)$coupon->times;
                            $i--;
                            $coupon->times = (string)$i;
                       }
                        $coupon->update();

                    }
        foreach($cart->items as $prod)
        {
            $x = (string)$prod['size_qty'];
            if(!empty($x))
            {
                $product = Product::findOrFail($prod['item']['id']);
                $x = (int)$x;
                $x = $x - $prod['qty'];
                $temp = $product->size_qty;
                $temp[$prod['size_key']] = $x;
                $temp1 = implode(',', $temp);
                $product->size_qty =  $temp1;
                $product->update();               
            }
        }


        foreach($cart->items as $prod)
        {
            $x = (string)$prod['stock'];
            if($x != null)
            {

                $product = Product::findOrFail($prod['item']['id']);
                $product->stock =  $prod['stock'];
                $product->update();  
                if($product->stock <= 5)
                {
                    $notification = new Notification;
                    $notification->product_id = $product->id;
                    $notification->save();                    
                }              
            }
        }

        $notf = null;





        foreach($cart->items as $prod)
        {
            if($prod['item']['user_id'] != 0)
            {
                $vorder =  new VendorOrder;
                $vorder->order_id = $order->id;
                $vorder->user_id = $prod['item']['user_id'];
                $notf[] = $prod['item']['user_id'];
                $vorder->qty = $prod['qty'];
                $vorder->price = $prod['price'];
                $vorder->order_number = $order->order_number;             
                $vorder->save();
            }
            $user_idd=$prod['item']['user_id'];

        }
        $ven_data=User::where('id',$user_idd)->first();
        

        if(!empty($notf))
        {
            $users = array_unique($notf);
            foreach ($users as $user) {
                $notification = new UserNotification;
                $notification->user_id = $user;
                $notification->order_number = $order->order_number;
                $notification->save();    
            }
        }

        if($request->address_book_id==0){
            $addressbook=new AddressBook;
            $addressbook->user_id=Auth::user()->id;
            $addressbook->flat_no=$request->flat_no;
            $addressbook->street_address=$request->street_address;
            $addressbook->zip=$request->zip;
            $addressbook->phone=$request->phone;
            $addressbook->save();
        }
        else{

            $addressbook=AddressBook::findOrFail($request->address_book_id);
            $addressbook->flat_no=$request->flat_no;
            $addressbook->street_address=$request->street_address;
            $addressbook->zip=$request->zip;
            $addressbook->phone=$request->phone;
            $addressbook->update();

        }

       
        $usercreditcards=UserCreditCard::where([ 
                                        ['card_no',$request->cardNumber],
                                        ['user_id',Auth::id()] 
                                       ])->first();
        if(!$usercreditcards){
            $usercreditcards=new UserCreditCard;
            $usercreditcards->user_id=Auth::user()->id;
            $usercreditcards->card_no=$request->cardNumber;
            $usercreditcards->cvv=$request->cardCVC;
            // $usercreditcards->month=$request->month;
            $usercreditcards->date=$request->cardDate;
            $usercreditcards->save();

            $usercreditcards11=UserCreditCard::where('user_id',Auth::id())->get();
            if($usercreditcards11->count()<=1){
              $usercreditcards->primary=1;
              $usercreditcards->update();
            }

        }




        $gs = Generalsetting::find(1);

        //Sending Email To Buyer
        // $buyer=Auth::user();
        // if($gs->is_smtp == 1)
        // {
        // $data = [
        //     'to' => $buyer->email,
        //     'type' => "new_order",
        //     'cname' => $buyer->name,
        //     'oamount' => "",
        //     'aname' => "",
        //     'aemail' => "",
        //     'wtitle' => "",
        //     'onumber' => $order->order_number,
        // ];

        // $mailer = new GeniusMailer();
        // $mailer->sendAutoOrderMail($data,$order->id);            
        // }
        // else
        // {
        //    $to = $buyer->email;
        //    $subject = "Your Order Placed!!";
        //    $msg = "Hello ".$buyer->name."!\nYou have placed a new order.\nYour order number is ".$order->order_number.".Please wait for your delivery. \nThank you.";
        //     $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        //    mail($to,$subject,$msg,$headers);            
        // }
        //Sending Email To Admin
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $ven_data->email,
                'subject' => "New Order Recieved!!",
                'body' => "Hello ".$ven_data->name."!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);            
        }
        else
        {
           $to = $ven_data->email;
           $subject = "New Order Recieved!!";
           $msg = "Hello  ".$ven_data->name."!\nYour store has recieved a new order.\nOrder Number is ".$order->order_number.".Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }



        //********************************Send Order To Printer****************************//

            //Make Receipt For Printer
                $rest_id='#13';
                $order_type=$cart->methodofcollect==0?'2':'1';
                $order_no=$order->order_number;

                $productsp='';
                $subtotal=0;
                foreach(Session::get('cart')->items as $product){
                 $productsp.=
                 $product['qty'].";". $product['item']['name'] .''. ($product['size']?" Size".$product['item']['measure'].':'.$product['size']:'') .";".number_format($product['price']).";";

                 $subtotal += number_format($product['price']);
                }
                
                $products=$productsp;

                $sub_total=number_format($subtotal,2);
                $delivery_charges=number_format($order->shipping_cost,2);
                $service_charges=number_format($order->service_charges,2);
                $discount=Session::has('coupon') ? Session::get('coupon') : 0;

                $total=number_format($order->pay_amount,2);

                $customer_type=4;
                $customer_name=$order->customer_name;
                $customer_address=$order->customer_address_1;
                $requested_for=($request->time_check==1)?$order->time.''.$order->date:'Urgent';
                $previous_order='';
                $payment_status=6;
                $payment_card_no=$order->method;
                $customer_phone=$order->customer_phone;
                $comments=$order->instructions;


                $finalorder=$rest_id.'*'.$order_type.'*'.$order_no.'*'.$products.'*'.$sub_total.';'.$delivery_charges.';'.$service_charges.';*'. $discount.';'.$total.';'.$customer_type.';'. $customer_name.';'.$customer_address.';'.$requested_for.';'. $previous_order.';'. $payment_status.';'.$payment_card_no.';'. $customer_phone.';*'.$comments.'#';

            //Make Receipt For Printer Ends
            
            //Create File
                $filename='3719'.$ven_data->id.'_worldshops.txt';
                $filename="assets/orderfiles/".$filename;

                $myfile = fopen($filename, "a") or die("Unable to open file!");

                $finalorder = $finalorder."\n";
                fwrite($myfile, $finalorder);
                fclose($myfile);
            //Create File Ends
        //*****************************Send Order To Printer Ends**********************//    

        Session::put('temporder',$order);
        Session::put('tempcart',$cart);

        Session::forget('cart');

        Session::forget('already');
        Session::forget('coupon');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('coupon_percentage');




            $data[0]=2;
            $data[6]=$success_url;
            return response()->json($data);


                }
                
            }catch (Exception $e){

                    $data[0]=0;
                    $data[5]=$e->getMessage();
                    return response()->json($data);
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                    $data[0]=0;
                    $data[5]=$e->getMessage();
                    return response()->json($data);
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                    $data[0]=0;
                    $data[5]=$e->getMessage();
                    return response()->json($data);
            }
        }
            $data[0]=0;
            $data[5]="Please Enter Valid Credit Card Informations.";
            return response()->json($data);
    }




    public function OrderCallback(Request $request)
    {
        if($request->all()){
            $data = Order::where('order_number',$request->o)->first();
            $gs = Generalsetting::findOrFail(1);
            $status=$request->ak;
            if($data){
                if($status=="Accepted"){
                    $dstatus="processing";  
                    
                    //Send to local serve
                        $vorder=$data->vendororders->first();
                        $user = User::findOrFail($vorder->user_id);

                        if(!empty($user->localserve_email) && !empty($user->localserve_password) && $user->localserve_email!=null && $user->localserve_password!=null){

                            $combine_key=str_random(5).time();
                            $myBody['email'] = $user->localserve_email;
                            $myBody['password'] = $user->localserve_password;
                           
                            $order=Order::findorFail($data->id);

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
                            
                        }
                    //Send to local serve ends


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


                        $maildata = [
                            'to' => $data->customer_email,
                            'subject' => 'Your order '.$data->order_number.' is in Processing!',
                            'body' => "Hello ".$data->customer_name.","."\n Your Order is in Processing. Please wait for your delivery.",
                        ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($maildata);
                    }
                    else
                    {
                       $to = $data->customer_email;
                       $subject = 'Your order '.$data->order_number.' is Processing!';
                       $msg = "Hello ".$data->customer_name.","."\n Your Order is in Processing. Please wait for your delivery.";
                       $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                       mail($to,$subject,$msg,$headers);
                    }

                  
                   
                }


                else if($status=="Rejected"){
                    $dstatus="declined";
                    

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


                $order = VendorOrder::where('order_id','=',$data->id)->update(['status' => $dstatus]);

                $data->status=$dstatus;
                $data->update();
            }
        }
        else{
            return "Invalid Request";
        }
    }




    // Capcha Code Image
    private function  code_image()
    {
        // $actual_path = str_replace('project','',base_path());
        // $image = imagecreatetruecolor(200, 50);
        // $background_color = imagecolorallocate($image, 255, 255, 255);
        // imagefilledrectangle($image,0,0,200,50,$background_color);

        // $pixel = imagecolorallocate($image, 0,0,255);
        // for($i=0;$i<500;$i++)
        // {
        //     imagesetpixel($image,rand()%200,rand()%50,$pixel);
        // }

        // $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        // $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        // $length = strlen($allowed_letters);
        // $letter = $allowed_letters[rand(0, $length-1)];
        // $word='';
        // //$text_color = imagecolorallocate($image, 8, 186, 239);
        // $text_color = imagecolorallocate($image, 0, 0, 0);
        // $cap_length=6;// No. of character in image
        // for ($i = 0; $i< $cap_length;$i++)
        // {
        //     $letter = $allowed_letters[rand(0, $length-1)];
        //     imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
        //     $word.=$letter;
        // }
        // $pixels = imagecolorallocate($image, 8, 186, 239);
        // for($i=0;$i<500;$i++)
        // {
        //     imagesetpixel($image,rand()%200,rand()%50,$pixels);
        // }
        // session(['captcha_string' => $word]);
        // imagepng($image, $actual_path."assets/images/capcha_code.png");
    }

}
