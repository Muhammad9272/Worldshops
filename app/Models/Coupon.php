<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
     protected $fillable = ['user_id','title','code', 'type', 'price', 'times','apply_to','apply_val','multi_check','t_check', 'start_date','end_date','min_value','desc'];
    public $timestamps = false;

     public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    } 
}
