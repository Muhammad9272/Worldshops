<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['user_id', 'cart', 'method','shipping', 'pickup_location', 'totalQty', 'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status', 'flat_no', 'street_address', 'zip', 'phone','instructions', 'order_note','coupon_code','coupon_discount', 'status','gov_bag_charges','service_charges','methodofcollect','dp','time_check','time','date','api_combine_key'];

    public function vendororders()
    {
        return $this->hasMany('App\Models\VendorOrder');
    }

    public function tracks()
    {
        return $this->hasMany('App\Models\OrderTrack','order_id');
    }

}
