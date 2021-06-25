<?php

namespace App\Models;

use App\Models\Country;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\State;
use App\Models\Generalsetting;
use App\Models\Currency;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = ['name','lname', 'photo', 'zip', 'residency', 'city','state','country', 'address', 'phone', 'fax', 'email','password','affilate_code','verification_code','verification_link','verification_link_expire','authentication_link','authentication_code','authentication_expire','is_authentication','vendor_new_password_link','shop_name','owner_name','shop_number','shop_address','shop_address2','reg_number','shop_message','is_vendor','shop_details','shop_image','store_cat_id','delivery_method','opening_time','closing_time','f_url','g_url','t_url','l_url','f_check','g_check','t_check','l_check','shipping_cost','date','mail_sent','earliest_delivery','min_delivery','latitude','longitude','delivery_radius','percentage_commission','localserve_email','localserve_password','lead_time'];


    protected $hidden = [
        'password', 'remember_token'
    ];

    public function IsVendor(){
        if ($this->is_vendor == 2) {
           return true;
        }
        return false;
    }
    

    public function IsStoreOpen(){
           
            $time = Carbon::now()->format('H:i:s');
            $store_id=$this->id;
            $user=User::where('id',$store_id)->where('opening_time', '<=', $time)->where('closing_time','>=',$time);
            if($user->count()>0){
                 return true;
            }
            else{
                return false;
            }

          

        
    }


    public  function setCurrency() {
        $gs = Generalsetting::findOrFail(1);
        $price = $this->shipping_cost;
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $price = number_format($price * $curr->value,2);
        if($gs->currency_format == 0){
            return $curr->sign.$price;
        }
        else{
            return $price.$curr->sign;
        }
    }



     public function stat()
    {
        $country_name=$this->country;
        $counttr=Country::where('name',$country_name)->first();

        $states=State::where('country_id',$counttr->id)->get();
        return $states;
    }

     public function storecategory()
    {

        return $this->belongsTo('App\Models\StoreCategory','store_cat_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }


    public function category()
    {
        return $this->hasMany('App\Models\Category');
    }
    public function subcategory()
    {
        return $this->hasMany('App\Models\Subcategory');
    }
    public function childcategory()
    {
        return $this->hasMany('App\Models\Childcategory');
    }

    public function allcategory()
    {
        $cats=Category::whereIn('user_id', [0,$this->id])->where('status',1)->orderBy('position', 'asc')->get();
        return $cats;
    }






    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }

    public function withdraws()
    {
        return $this->hasMany('App\Models\Withdraw');
    }

    public function conversations()
    {
        return $this->hasMany('App\Models\AdminUserConversation');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    // Multi Vendor

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    public function senders()
    {
        return $this->hasMany('App\Models\Conversation','sent_user');
    }

    public function recievers()
    {
        return $this->hasMany('App\Models\Conversation','recieved_user');
    }

    public function notivications()
    {
        return $this->hasMany('App\Models\UserNotification','user_id');
    }

    public function subscribes()
    {
        return $this->hasMany('App\Models\UserSubscription');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\FavoriteSeller');
    }

    public function vendororders()
    {
        return $this->hasMany('App\Models\VendorOrder','user_id');
    }

    public function shippings()
    {
        return $this->hasMany('App\Models\Shipping','user_id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package','user_id');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report','user_id');
    }

    public function verifies()
    {
        return $this->hasMany('App\Models\Verification','user_id');
    }

    public function checkVerification()
    {
        return count($this->verifies) > 0 ? 
        (empty($this->verifies()->where('admin_warning','=','0')->orderBy('id','desc')->first()->status) ? false : ($this->verifies()->orderBy('id','desc')->first()->status == 'Pending' ? true : false)) : false;
    }

    public function checkStatus()
    {
        return count($this->verifies) > 0 ? ($this->verifies()->orderBy('id','desc')->first()->status == 'Verified' ? true : false) :false;
    }

    public function checkWarning()
    {
        return count($this->verifies) > 0 ? ( empty( $this->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first() ) ? false : (empty($this->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->status) ? true : false) ) : false;
    }

    public function displayWarning()
    {
        return $this->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->warning_reason;
    }

}
