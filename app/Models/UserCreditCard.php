<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCreditCard extends Model
{
   protected $fillable = ['user_id','card_no','cvv','month','date'];


      public function stat()
    {
        $country_name=$this->country;
        $counttr=Country::where('name',$country_name)->first();

        $states=State::where('country_id',$counttr->id)->get();
        return $states;
    }
}
