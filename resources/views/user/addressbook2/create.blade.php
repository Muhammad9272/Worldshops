<style type="text/css">
  .pac-container{
        z-index: 1111111111;
         }
</style>

<form id="userdashform" action="{{route('user.addressbook.store')}}" method="post">
  {{ csrf_field() }}

 
  
  <div class="mb-20">
    <div class="form-check  form-check-inline">
      <label class="container-radio">Shipping Address
        <input type="radio" name="address_type" checked="true" value="0">
        <span class="checkmark"></span>
      </label>
    </div>
    <div class="form-check ml-30 form-check-inline">
      <label class="container-radio">Billing Address
        <input type="radio"   name="address_type" value="1">
        <span class="checkmark"></span>
      </label>
    </div>



  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="recipient-name" class="col-form-label">First Name:</label>
      <input type="text"  required="" placeholder="Enter First Name" class="form-control cust-adb-modal" name="fname" id="recipient-name">
    </div>
    <div class="col-md-6">
     <label  class="col-form-label">Last Name:</label>
     <input type="text" required="" class="form-control cust-adb-modal" placeholder="Enter Last Name" name="lname">
    </div>

    <div class="col-md-6">
     <label  class="col-form-label">Phone</label>
     <input type="text" name="phone" class="form-control cust-adb-modal" placeholder="Enter Phone no" required="" >
    </div>


    <div class="col-md-6">
     <label class="col-form-label">Email</label>
     <input type="email" class="form-control cust-adb-modal" placeholder="Enter Eamil" name="email" required="" >
    </div>

    <div class="col-md-6">
     <label class="col-form-label">Country/Region *</label>
      <select class="form-control cust-adb-modal" id="country" name="country" required="">
         <option selected="" disabled="">Country</option>
         @foreach($countries as $country)   
         <option value="{{$country->name}}">{{$country->name}}</option>
         @endforeach 
      </select>
    </div>

    <div class="col-md-6">
     <label  class="col-form-label">State/Province *</label>
      <select class="form-control cust-adb-modal" id="state" name="state" type= "text"  value="" required="">
         <option selected="" disabled="">State</option>
      </select> 
    </div>

    <div class="col-md-6">
     <label  class="col-form-label">City</label>
     <input type="text" class="form-control cust-adb-modal" placeholder="Enter Country" name="city" required="">
    </div>


    <div class="col-md-6">
     <label class="col-form-label">Zip/Postal Code</label>
     <input type="text" class="form-control cust-adb-modal" name="zip" required="" >
    </div>


    <div class="col-md-6">
      <label  class="col-form-label">Address line 1 <span style="font-size: 11px;font-weight: 600;">(Google Suggestions)</span> *</label>
      <input type="text" class="form-control cust-adb-modal" id="google_address" onfocus="initGoogleAddress()" name="address1" placeholder="Select Address from suggestions" required="">
    </div>
    <div class="col-md-6">
     <label  class="col-form-label">Address line 2 (optional)</label>
     <input type="text" class="form-control cust-adb-modal" name="address2">
    </div> 
    <input type="hidden" id="latitude" name="latitude">           
    <input type="hidden" id="longitude" name="longitude">   

  </div>

  <div class="row btn-submit-adb mt-20 ">
    <div class="col-8"></div>
    <div class="col-4 text-right">
      <button class="ws-btn submit-btn">  Add Address </button>
    </div>
    
  </div>
</form>

<script type="text/javascript">

$(function(){

  $('#country').change(function(){

    var country_name = $(this).val();  
    if(country_name){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_name="+country_name,
           success:function(res){               
            if(res){
                $("#state").empty();
                 $("#state").html(res);
                $("#state").append('<option selected disabled>Select State</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+value+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
    }      
   });  
}); 
</script>



<script>

    var autocomplete_origin;
    var autocomplete_destination;


    const componentForm = {
        street_number: "short_name",
        route: "long_name",
        postal_town: "short_name",
        locality:"long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
    };

    function initGoogleAddress()
    {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete_origin = new google.maps.places.Autocomplete(
            document.getElementById("google_address"),
            {              
                types: ["geocode"],
                componentRestrictions:
                {
                    country: "UK"
                } 
            }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.

        // autocomplete_origin.setFields(["address_component"]);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete_origin.addListener("place_changed", fillInAddress_origin);
    }

    function fillInAddress_origin()
    {
        // Get the place details from the autocomplete object.
        const place = autocomplete_origin.getPlace();
        
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        

        $('#longitude').val(lng);
        $('#latitude').val(lat);


        for (const component of place.address_components)
        {
            const addressType = component.types[0];

            if(componentForm[addressType])
            {
                const val = component[componentForm[addressType]];    

            }
        }
        
    }


  </script>