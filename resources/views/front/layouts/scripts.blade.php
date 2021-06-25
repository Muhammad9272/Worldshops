    <script type="text/javascript">
      var mainurl = "{{url('/')}}";
      var gs      = {!! json_encode($gs) !!};
      var langg    = {!! json_encode($langg) !!};

    </script>

    <script src="{{asset('assets/front/plugins/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/bootstrap4/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/slick/slick/slick.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/slick-animation.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/sticky-sidebar/dist/sticky-sidebar.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/front/js/toastr.js')}}"></script>

    <script src="{{asset('assets/front/js/jquerysession.js')}}"></script>
    {{-- <script src="{{asset('assets/front/js/url-tld.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/front/plugins/gmap3.min.js')}}"></script> --}}

   

    <!-- custom scripts-->
    @section('pagelevel_scripts')
    @show
    <script src="{{asset('assets/front/js/main.js')}}"></script>
    <script src="{{asset('assets/front/js/custom.js')}}"></script>
   
    <script type="text/javascript">
      $(document).ready(function () {
        $('.ls-modal-close').on('click',function(e) {
           e.preventDefault();
           $('.ls-modal').modal('hide');
        });
        


      });     


    
    </script>

      <script src='https://www.google.com/recaptcha/api.js'></script>
      <script>

      function get_action(form) 
      {
          var v = grecaptcha.getResponse();
          if(v.length == 0)
          {
              document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
              return false;
          }
          else
          {
               document.getElementById('captcha').innerHTML="Captcha completed";
              return true; 
          }
      }

      </script>



<script>
    var autocomplete_origin;
    const componentForm = {
        street_number: "short_name",
        route: "long_name",
        postal_town: "short_name",
        locality:"long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: 'short_name',
    };

    function initUGoogleAddress()
    {
        autocomplete_origin = new google.maps.places.Autocomplete(
            document.getElementById("location_name"),
            {              
                types: ["geocode"],
                componentRestrictions:
                {
                    country: "UK"
                } 
            }
        );
        autocomplete_origin.addListener("place_changed", ufillInAddress_origin);
    }

    function ufillInAddress_origin()
    {    
        // Get the place details from the autocomplete object.
        const place = autocomplete_origin.getPlace();
        
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        $('#ulongitude').val(lng);
        $('#ulatitude').val(lat);


        for (const component of place.address_components)
        {
            const addressType = component.types[0];

            if(componentForm[addressType])
            {
                const val = component[componentForm[addressType]];    

            }
        }
        
    }

    // $(function () {
        
    //     $("#search-store").on('submit',function (event) {
    //         var chk=$('#ulongitude').val();
    //         if (!chk) {
    //             event.preventDefault();
    //             $("#location_name").val('');
    //             alert("Please Select location from suggestions");

    //         }
    //         else {
    //             // alert($("#TextBox1").val());
    //             return;
    //         }
    //     });
    // });


  </script>


      {{-- <script type="text/javascript">
              $(document).on('submit','#search-store',function(e){
                e.preventDefault();
                var location = $(this).find("#location_name").val();

                var url = '{{ route("front.stores", ":location_3") }}';
                 url = url.replace(':location_3', location);
                window.location = url;
              });
      </script> --}}



<script type="text/javascript">
  function initMap() {
  // your code
}
</script>

 <script src="https://maps.googleapis.com/maps/api/js?key={{$gs->location_api_key}}&callback=initMap&libraries=places&v=weekly" async></script>