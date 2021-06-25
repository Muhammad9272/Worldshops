<form id="userdashform" action="{{route('user.savedcard.update',$usercreditcard->id)}}" method="post">
  {{ csrf_field() }}

    <div class="row">


      <div class="col-md-12">
       <label  class="col-form-label">Card Number *</label>
       <input type="text" class="form-control cust-adb-modal" placeholder="Enter Card Number" name="card_no" required="" value="{{$usercreditcard->card_no}}" >
      </div>

    <div class="col-md-6">
     <label class="col-form-label">Expiry Date *</label>
     <input type="text" class="form-control cust-adb-modal" placeholder="MM/YY" value="{{$usercreditcard->date}}" name="date" required="" >
    </div>

    <div class="col-md-6">
     <label  class="col-form-label">Cvv Code *</label>
     <input type="text" class="form-control cust-adb-modal" placeholder="Enter Cvv Code" name="cvv" value="{{$usercreditcard->cvv}}" required="">
    </div>
    {{-- <div class="col-md-6">
     <label class="col-form-label">Expiry Month *</label>
     <input type="text" class="form-control cust-adb-modal" placeholder="Enter Expiry Month" value="{{$usercreditcard->month}}" name="month" required="" >
    </div> --}}
 

    
  </div>

  <div class="row btn-submit-adb mt-20 ">
    <div class="col-8"></div>
    <div class="col-4 text-right">
      <button class="ws-btn submit-btn">  Update Card </button>
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

