@extends('layouts.admin')
@section('styles')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/img_upload/imgUpload.css') }}" rel="stylesheet" type="text/css" />

<style type="text/css">
	.control-label{
		font-weight: 600;
        font-size: 15px;
	}
</style>
@endsection
@section('content')

	<div class="content-area">
		<div class="mr-breadcrumb">
			<div class="row">
				<div class="col-lg-12">
						<h4 class="heading"> {{ __('Edit Vendor') }}<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
						<ul class="links">
							<li>
								<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
							</li>
							<li>
								<a href="{{ route('admin-vendor-index') }}">{{ __('Vendor') }} </a>
							</li>
							
							<li>
								<a href="javascript:;">{{ __('Edit') }}</a>
							</li>
						</ul>
				</div>
			</div>
		</div>
		<div class="add-product-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="product-description">

				        <div class="body-area">
				            <!-- BEGIN FORM-->
				            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
				            <form id="geniusform" action="{{route('admin-vendor-update',$data->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
				            {{csrf_field()}}
				                
				               @include('includes.admin.form-both')

				                <div class="form-body bold-label">

				                    
				                    <h4>Seller Info</h4>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >First Name</label>                           
				                            <input type="text" class="form-control"  name="name" value="{{$data->name}}" >
				                        </div>
				                         <div class="col-md-6">
				                            <label class="control-label" >Last Name</label>                           
				                            <input type="text" class="form-control" value="{{$data->lname}}"  name="lname" >
				                        </div>                       
				                    </div>
				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >Email</label>                           
				                            <input type="email" class="form-control" value="{{$data->email}}" name="email" >
				                        </div>
				                         <div class="col-md-6">
				                            <label class="control-label" >Seller Phone No</label>                           
				                            <input type="text" class="form-control" value="{{$data->phone}}"  name="phone" >
				                        </div>                       
				                    </div>

				                      <h4>Store Info</h4>
				                      <hr>
				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >Store Name</label>                           
				                            <input type="text" class="form-control" value="{{$data->shop_name}}"  name="shop_name" >
				                        </div> 
				                        <div class="col-md-6">
				                            <label class="control-label" >Store Category</label>
				                            <select  required="" class="form-control" name="store_cat_id" type="text" >
				                                   <option selected="" disabled="">Select Category</option>
				                                   @foreach($store_cats as $store_cat)   
				                                   <option value="{{$store_cat->id}}" {{ $store_cat->id == $data->store_cat_id ? "selected":"" }}>{{$store_cat->name}}</option>
				                                   @endforeach 
				                            </select> 
				                        </div>                                    
				                    </div>

				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >Owner Name</label>                           
				                            <input type="text" class="form-control" value="{{$data->owner_name}}"  name="owner_name" >
				                        </div>
				                         <div class="col-md-6">
				                            <label class="control-label" >Store Contact no.</label>                           
				                            <input type="text" class="form-control" value="{{$data->shop_number}}" name="shop_number" >
				                        </div>                       
				                    </div>

				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >Select Country</label>                           
				                            <select  id="country" class="form-control" name="country" type="text" >
				                                   <option selected="" disabled="">Country</option>
				                                   @foreach($countries as $country)   
				                                   <option value="{{$country->name}}" {{ $country->name == $data->country ? "selected":"" }}>{{$country->name}}</option>
				                                   @endforeach 
				                            </select> 
				                        </div>
				                         <div class="col-md-6">
				                            <label class="control-label" >Select State</label>                         <select class="form-control" id="state" name="state" type= "text"  value="{{old('lname')}}">
				                               <option selected="" disabled="">State</option>

				                               @foreach($data->stat() as $state)
				                                <option value="{{$state->name}}" {{ $state->name == $data->state ? "selected":"" }}>{{$state->name}}</option>
				                               @endforeach
				                            </select> 
				                        </div>                       
				                    </div>
				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >City</label>                           
				                            <input type="text" class="form-control"  value="{{$data->city}}"  name="city" >
				                        </div>
				                         <div class="col-md-6">
				                            <label class="control-label" >Postal Code</label>                           
				                            <input type="text" class="form-control"  name="zip"  value="{{$data->zip}}" required="">
				                        </div>                       
				                    </div>

				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label" >Address Line 1 (Pick from Google Suggestions) *</label>                    
				                            <input type="text" class="form-control" value="{{$data->shop_address}}"  id="google_address" onfocus="initGoogleAddress()" name="shop_address" required="">
				                        </div>
				                         <div class="col-md-2">
				                            <label class="control-label" >Radius(In miles)</label>      
				                            <input type="number" step="0.001" class="form-control"   name="delivery_radius" value="{{$data->delivery_radius}}" required="" >  
				                        </div> 

				                        <div class="col-md-4">
				                            <label class="control-label" >Address Line 2(optional)</label>      
				                            <input type="text" class="form-control" value="{{$data->shop_address2}}"  name="shop_address2" >  
				                        </div>   
				                        <input type="hidden" id="latitude" name="latitude" value="{{$data->latitude}}">           
                                        <input type="hidden" id="longitude" name="longitude" value="{{$data->longitude}}">                    
				                    </div>
				                    
				                    <div class="row">
				                        <div class="col-md-6">
				                            <label class="control-label">Delivery Method</label>
				                            <div class="mt-radio-inline">
				                                <label class="mt-radio">
				                                    <input type="radio" class="delivery_method" name="delivery_method" id="delivery_method0" value="0" {{$data->delivery_method==0?'checked':''}} > Pickup
				                                    <span></span>
				                                </label>
				                                <label class="mt-radio">
				                                    <input type="radio" class="delivery_method" name="delivery_method" id="delivery_method1" value="1" {{$data->delivery_method==1?'checked':''}}> Delivery
				                                    <span></span>
				                                </label>
				                                <label class="mt-radio ">
				                                    <input type="radio" class="delivery_method" name="delivery_method" id="delivery_method2" value="2"  {{$data->delivery_method==2?'checked':''}} > Both
				                                    <span></span>
				                                </label>
				                            </div>
				                        </div>  
				                        <div class="col-md-3 display-status {{$data->delivery_method==0?'display-none':''}}">
				                            <label class="control-label" >Delivery Charges($)</label>      
				                            <input type="number" step="0.01" value="{{$data->shipping_cost}}" class="form-control shipping_cost" required=""  name="shipping_cost"  >  
				                        </div>  
				                        <div class="col-md-3 ">
				                            <label class="control-label" >Percentage Commission (%)</label>      
				                            <input type="number" value="{{$data->percentage_commission}}" step="0.01" class="form-control"  name="percentage_commission" required="" >  
				                        </div>  

				                    </div>
				                    <div class="row">
				                        <div class="col-md-6">
				                             <h6><strong>Opening Hours</strong> </h6> 
				                            <div class="row d-inline-flex">                                
				                                <div class="col-6 ml-10 ml-20 mr-20">
				                                    <input type="time" class="form-control" value="{{$data->opening_time}}"  name="opening_time" required="">
				                                </div>                  
				                                 <div class="col-6">
				                                    <input type="time" class="form-control" value="{{$data->closing_time}}"  name="closing_time" required="">
				                                </div>   
				                            </div>
				                             
				                        </div>
				                         <div class="col-md-3">				                             
				                             <label class="control-label" >Minimum Delivery cost</label>      
				                            <input type="number" class="form-control" placeholder="e.g 2" required="" name="min_delivery" value="{{$data->min_delivery}}" >  
				                        </div>  
				                        <div class="col-md-3">				                             
				                             <label class="control-label" >Earliest Delivery</label>      
				                            <input type="text" class="form-control" placeholder="e.g 11:50 - 12:05" required="" name="earliest_delivery" value="{{$data->earliest_delivery}}" >  
				                        </div>                                            
				                    </div>

                                     <div class="row">
				                        <div class="col-md-12">
				                            <label class="control-label" >Store Lead time</label>   
				                            <input type="text" class="form-control" 
				                            name="lead_time" value="{{$data->lead_time}}">
				                        </div>
				                    </div>

				                    <div class="row">
				                        <div class="col-md-12">
				                            <label class="control-label" >Store Description</label>   
				                            <textarea name="shop_message"  class="form-control nic-edit">
				                                {!! $data->shop_message !!}
				                            </textarea> 
				                        </div>
				                    </div>



				                    <h4>Media</h4>
				                    <hr> 
				                    <div class="row">
				                        <div class="col-md-4">
				                            <label class="control-label">Store Logo/Image</label>                           
				                            <div class="form-file">
				                                <input type="file" class="inputfile" name="shop_image" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected"  />
				                                <label for="your_picture">
				                                    <figure>
				                                        <img src="{{asset('assets/images/vendor/'.$data->shop_image)}}" alt="" class="your_picture_image">
				                                    </figure>
				                                    <span class="file-button">Choose picture</span>
				                                </label>
				                            </div> 
				                        </div>
				                        <div class="col-md-4">
				                            <label class="control-label">Upload Certificate</label>
				                            <div class="fileinput {{$data->doc_2?'fileinput-exists':'fileinput-new'}} mt-20" style="display: block;" data-provides="fileinput">
				                                    <span class="btn file-btn-green green btn-file">
				                                        <span class="fileinput-new"> Select file </span>
				                                        <span class="fileinput-exists"> Change </span>
				                                        <input type="hidden" value="" name="doc_1"><input type="file" name="doc_1"> </span>
				                                    <span class="fileinput-filename"><a href="{{asset('assets/doc/vendor/'.$data->doc_1)}}">{{$data->doc_1}}</a></span> &nbsp;
				                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput">  </a>
				                                </div>
				                        </div> 
				                        <div class="col-md-4">
				                            <label class="control-label">Upload Document 2</label>
				                            <div class="fileinput {{$data->doc_2?'fileinput-exists':'fileinput-new'}} mt-20" style="display: block;" data-provides="fileinput">
				                                    <span class="btn file-btn-green green btn-file">
				                                        <span class="fileinput-new"> Select file </span>
				                                        <span class="fileinput-exists"> Change </span>
				                                        <input type="hidden" value="" name="doc_2"><input type="file" name="doc_2"> </span>
				                                    <span class="fileinput-filename"><a href="{{asset('assets/doc/vendor/'.$data->doc_2)}}">{{$data->doc_2}}</a></span> &nbsp;
				                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
				                                </div>
				                        </div>                                                                       

				                    </div>                  




				                </div>
				                <div class="row">
									<div class="col-lg-4">
										<div class="left-area">

										</div>
									</div>
									<div class="col-lg-7 text-center">
										<button class="addProductSubmit-btn" type="submit">{{ __('Update') }}</button>
									</div>
								</div>
				            </form>
				            <!-- END FORM-->
				        </div>

					</div>
				</div>
			</div>



			

		</div>
	</div>
@endsection

@section('scripts')

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
 
$('.delivery_method').change(function() {
    if (this.value == 0) {
        $('.shipping_cost').prop("required", false);
        $('.display-status').hide();
    }
    else {
        $('.display-status').show();
        $('.shipping_cost').prop("required", true);
    }
});


  
 
});
</script>
<script src="{{ asset('assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/img_upload/imgUpload.js') }}" type="text/javascript"></script>




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
<script type="text/javascript">
  function initMap() {
  // your code
}
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key={{$gs->location_api_key}}&callback=initMap&libraries=places&v=weekly" async></script>
@endsection