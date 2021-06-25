<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
      protected $fillable = ['user_id','flat_no','street_address','zip','phone','latitude','longitude'];


      public function stat()
    {
        $country_name=$this->country;
        $counttr=Country::where('name',$country_name)->first();

        $states=State::where('country_id',$counttr->id)->get();
        return $states;
    }
}
