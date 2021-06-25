<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\StoreCategory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Session;
use Auth;
use App\Models\Currency;
use App\Models\TestLocation;





class VendorController extends Controller
{

    public function locationset(Request $request)
    {
        $latitude=null;
        $longitude=null;
        $gs=Generalsetting::findOrFail(1);
        $address=$request->ulocation;
        $client = new \GuzzleHttp\Client();
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$gs->location_api_key";
        $result = $client->post($url)->getBody();
        $json =json_decode($result);
        
        if($json->results){
           $latitude=$json->results[0]->geometry->location->lat;
           $longitude=$json->results[0]->geometry->location->lng;
        }

       

        if(Session::has('location')){
          Session::forget('location');
        }

        if(Session::has('latitude')){
          Session::forget('latitude');
        }

        if(Session::has('longitude')){
          Session::forget('longitude');
        }

     
      Session::put('location',$request->ulocation);
      Session::put('latitude',$latitude);
      Session::put('longitude',$longitude);

      return redirect()->route('front.stores',$request->ulocation);

    }


    public function index(Request $request,$location)
    {

      if(!Session::has('location')){
        return redirect('front.index')->with('session_msg', 'Your session has expired !!!');
      }
      
      // Session::put('location',$location);
        

      $location=$location;
       $latitude=Session::get('latitude');
       $longitude=Session::get('longitude');
      

      

      $category = $request->category;
      $opened=$request->opened;
      $sort=$request->sort;
      $time=null;
      $cat = null;
      $store_name=$request->store_name;
      $methodofcollect=$request->str_methodofcollect;
      // if($methodofcollect){
      //   if(Session::has('methodofcollect')){
      //     Session::forget('methodofcollect');
      //   }
      //   Session::put('methodofcollect',$methodofcollect);
      // }
      

      if (!empty($category)) {
        $cat = StoreCategory::where('id', $category)->firstOrFail();
        $data['cat'] = $cat;
      }
      if (!empty($opened)) {
        $time = Carbon::now()->format('H:i:s');
      }


       //*****************************Location wise*****************************//

        if($methodofcollect!=null && $methodofcollect==5){               
            $stores_i=User::where('is_vendor',2)->where('longitude','!=',null)->where('delivery_radius','!=',null);
            $stores = $stores_i->selectRaw("* ,
                         ( 3956 * acos( cos( radians(?) ) *
                           cos( radians( latitude  ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude  ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])

            ->having("distance", "<=",300)
            ->orderBy("distance",'asc');
        }

        else{        
                $stores_i=User::where('is_vendor',2)->where('longitude','!=',null)->where('delivery_radius','!=',null);
                $stores = $stores_i->selectRaw("* ,
                             ( 3956 * acos( cos( radians(?) ) *
                               cos( radians( latitude  ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude  ) ) )
                             ) AS distance", [$latitude, $longitude, $latitude])
                ->havingRaw('distance <= `delivery_radius`')
                ->orderBy("distance",'asc');
        }

        // dd($stores->get());


        //*****************************Location wise ends*****************************//

      $stores = $stores->when($store_name, function ($query, $store_name) {
                                      return $query->where('shop_name','LIKE',"%{$store_name}%");
                                  })
                                  ->when($cat, function ($query, $cat) {
                                      return $query->where('store_cat_id', $cat->id);
                                  })
                                  ->when($methodofcollect, function ($query, $methodofcollect) {
                                    if($methodofcollect==5){

                                      return $query->where('delivery_method','!=',1);
                                    }
                                    elseif($methodofcollect==1){
                                      return $query->where('delivery_method','!=',0);
                                    }
                                  })
                                  ->when(empty($methodofcollect), function ($query, $sort) {
                                      return $query->where('delivery_method','!=',0);
                                  })

                                 
                                  ->when($time, function($query, $time) {
                                    return $query->where('opening_time', '<=', $time)->where('closing_time','>=',$time);
                                  });
                                 
                                 $stores=$stores->get();


      $store_cats=StoreCategory::where('status',1)->get();                            
      return view('front.stores',compact('store_cats','stores','location','store_name','opened','category','methodofcollect'));
    }






    public function store($shop_name)
    {

       
       

        $string = str_replace('-',' ', $shop_name);

        if(Session::has('shop_name')){
          $old_shop=Session::get('shop_name');
          if($old_shop==$string){

          }
          else{
              Session::forget('shop_name');
                 if(Session::has('cart') ){
                    Session::forget('cart');
                  }
                  if (Session::has('coupon')) {
                      Session::forget('coupon');
                      Session::forget('coupon_type');
                      Session::forget('min_value');
                      Session::forget('coupon_total');                    
                      Session::forget('coupon_percentage');
                      Session::forget('already');
                      Session::forget('coupon_total');
                      Session::forget('coupon_total1');
                  }
          }
               
        } 


        Session::put('shop_name',$string);

        $datas=User::where('shop_name',$string)->where('ban','!=',1)->first();
        return view('front.category',compact('datas'));
    }



    public function autosearch($slug)
      {

        $shop_name=Session::get('shop_name');
        $shop_nam = str_replace(' ','-', $shop_name);

        $data=User::where('shop_name',$shop_name)->where('ban','!=',1)->first();

          if(strlen($slug) > 1){
              $search = ' '.$slug;
              $prods = Product::where('user_id',$data->id)->where('name', 'like', '%' . $slug . '%')->where('status','=',1)->take(10)->get();
              return view('load.suggest',compact('prods','slug','shop_nam'));
          }
          return "";
      }



    public function category($shop_name,$category)
    {
        

        $string = str_replace('-',' ', $shop_name);
        $datas=User::where('shop_name',$string)->where('ban','!=',1)->first();

        if(!Session::has('shop_name')){
          Session::put('shop_name',$string);          
        }
        
      $cat = Category::where('slug',$category)
                      ->whereIn('user_id', [0,$datas->id])
                      ->where('status',1)->first();

            if($cat->subs()->count()>0){
                 return view('front.subcategory',compact('cat'));
            }
            else{
                return redirect()->route('front.vendor.childcategory',[$shop_name,$cat->slug]);
            }

       
    }

    public function subcategory($shop_name,$category,$subcategory)
    {   
      // dd(Session::get('cart'));
        $string = str_replace('-',' ', $shop_name);
        $datas=User::where('shop_name',$string)->where('ban','!=',1)->first();
        if(!Session::has('shop_name')){
          Session::put('shop_name',$string);          
        }
        $cat = Category::where('slug',$category)
                       ->whereIn('user_id', [0,$datas->id])
                       ->where('status',1)->first();
                       
        $subcat=Subcategory::where('slug',$subcategory)
                            ->where('category_id',$cat->id)
                            ->whereIn('user_id', [0,$datas->id])
                            ->where('status',1)->first();

        if($subcat->childs()->count()>0){
            return view('front.childcategory',compact('subcat'));
        }  
        else{
             return redirect()->route('front.vendor.childcategory',[$shop_name,$category,$subcategory]);
        }
       
        
    }

    public function childcategory($shop_name, $slug=null, $slug1=null, $slug2=null)
    {
      $string = str_replace('-',' ', $shop_name);
        if(!Session::has('shop_name')){
          Session::put('shop_name',$string);          
        }
      $datas=User::where('shop_name',$string)->where('ban','!=',1)->first();


      $cat = null;
      $subcat = null;
      $childcat = null;

      $sort ='';

      if (!empty($slug)) {
        $cat = Category::where('slug', $slug)->whereIn('user_id', [0,$datas->id])->where('status',1)->firstOrFail();
        $data['cat'] = $cat;
      }
      if (!empty($slug1)) {
        $subcat = Subcategory::where('slug', $slug1)->whereIn('user_id', [0,$datas->id])->where('status',1)->firstOrFail();
        $data['subcat'] = $subcat;
      }
      if (!empty($slug2)) {
        $childcat = Childcategory::where('slug', $slug2)->whereIn('user_id', [0,$datas->id])->where('status',1)->firstOrFail();
        $data['childcat'] = $childcat;
      }

        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }


      $prods = Product::when($cat, function ($query, $cat) {
                                      return $query->where('category_id', $cat->id);
                                  })
                                  ->when($subcat, function ($query, $subcat) {
                                      return $query->where('subcategory_id', $subcat->id);
                                  })
                                  ->when($childcat, function ($query, $childcat) {
                                      return $query->where('childcategory_id', $childcat->id);
                                  });

                                  

                                  $prods = $prods->orderBy('name', 'asc')->where('status', 1)->get();

      return view('front.product', compact('prods','cat','subcat','childcat','curr'));
    }

    public function productload($slug)
    {
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }

      $proddataa=Product::where('slug',$slug)->where('status',1)->first();
      return view('load.product',compact('proddataa','curr'));
    }

    //Send email to user
    public function vendorcontact(Request $request)
    {
        $user = Auth::user();
        $vendor = User::findOrFail($request->strnmid);
        $gs = Generalsetting::findOrFail(1);
            $subject = $request->subject;
            $to = $vendor->email;
            $name = $user->name;
            $from = $user->email;
            $order_no=$request->order_no;
            $msg = "Name: ".$name."<br>Email: ".$from."<br>Order No: ".$order_no."<br><br>Message: ".$request->message;
        if($gs->is_smtp)
        {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else{
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }
        return response()->json('Message Send Successfully!');


        // $conv = Conversation::where('sent_user','=',$user->id)->where('subject','=',$subject)->first();
        // if(isset($conv)){
        //     $msg = new Message();
        //     $msg->conversation_id = $conv->id;
        //     $msg->message = $request->message;
        //     $msg->sent_user = $user->id;
        //     $msg->save();
        // }
        // else{
        //     $message = new Conversation();
        //     $message->subject = $subject;
        //     $message->sent_user= $request->user_id;
        //     $message->recieved_user = $request->vendor_id;
        //     $message->message = $request->message;
        //     $message->save();
        //     $msg = new Message();
        //     $msg->conversation_id = $message->id;
        //     $msg->message = $request->message;
        //     $msg->sent_user = $request->user_id;;
        //     $msg->save();

        // }
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
