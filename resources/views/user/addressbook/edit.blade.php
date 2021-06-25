<style type="text/css">
  .pac-container{
        z-index: 1111111111;
         }
</style>
<form id="userdashform" action="{{route('user.addressbook.edit',$addressbookdata->id)}}" method="post">
  {{ csrf_field() }}

  @include('includes.admin.form-both')
  


  <div class="row">


    <div class="col-md-12">
      <label  class="col-form-label">Flat Number / building name *</label>
      <input type="text"  required="" placeholder="eg Flat 109, The River building" class="form-control cust-adb-modal" name="flat_no" value="{{$addressbookdata->flat_no}}">
    </div>

    <div class="col-md-12">
      <label  class="col-form-label">Street Address  <span style="font-size: 11px;font-weight: 600;">(Google Suggestions)</span> *</label>
      <input type="text" class="form-control cust-adb-modal" id="google_address" onfocus="initGoogleAddress()" value="{{$addressbookdata->street_address}}" placeholder="Select Address from suggestions" name="street_address" required="">
    </div>

    <div class="col-md-6">
     <label class="col-form-label">Postcode *</label>
     <input type="text" class="form-control cust-adb-modal" id="postcode" placeholder="eg BD5 8LZ" name="zip" required="" value="{{$addressbookdata->zip}}" >
    </div>

    <div class="col-md-6">
     <label  class="col-form-label">Phone *</label>
     <input type="text" name="phone" class="form-control cust-adb-modal" placeholder="Enter Phone no" required="" value="{{$addressbookdata->phone}}" >
    </div>




 
    <input type="hidden" id="latitude" name="latitude" value="{{$addressbookdata->latitude}}">           
    <input type="hidden" id="longitude" name="longitude" value="{{$addressbookdata->longitude}}">             
    
  </div>

  <div class="row btn-submit-adb mt-20 ">
    <div class="col-8"></div>
    <div class="col-4 text-right">
      <button class="ws-btn submit-btn">  Update Address </button>
    </div>
    
  </div>

</form>


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
        postal_code: 'short_name',
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

                 if(addressType=="postal_code")
                {
                    console.log(val);
                    document.getElementById("postcode").value=val;
                    
                } 

            }
        }

        
    }

  $('#userdashform input').on('keyup keypress', function(e) {
      return e.which !== 13;
  });

  </script>
