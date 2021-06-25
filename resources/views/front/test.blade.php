@extends('front.layouts.app')
@section('pagelevel_css')
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>

<style>
    .list-group-item {
        display: flex;
        align-items: center;
    }

    .highlight {
        background: #f7e7d3;
        min-height: 30px;
        list-style-type: none;
    }

    .handle {
        min-width: 18px;
        background: #607D8B;
        height: 15px;
        display: inline-block;
        cursor: move;
        margin-right: 10px;
    }
    .ps-footer{
      display: none !important;
    }
    header{
      display: none !important;
    }
</style>

@endsection
@section('page_content')
      <div class="section-product" style="min-height: 350px;">
        <div class="container ls-content-2">



            <div class="row">
                <div class="col-md-12">
                   <h1 class="mt-50 text-center">Welcome to our testing website</h1>
                   <h2 class="mt-20 text-center">You have switched tab <span id="countswitch">0</span> times </h2>
                   <h4 class="malhh"></h4>


                </div>
            </div>




        </div>  
      </div> 




@endsection
@section('pagelevel_scripts')
{{-- <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
 --}}
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $(document).ready(function(){

      function updateToDatabase(idString){
         $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
        
         $.ajax({
              url:'{{url('/menu/update-order')}}',
              method:'POST',
              data:{ids:idString},
              success:function(){
                 alert('Successfully updated')
                 //do whatever after success
              }
           })
      }

        var target = $('.sort_menu');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData.join(','))
            }
        })
        
    })
</script>

{{-- <script type="text/javascript">

var count=0;
document.addEventListener("visibilitychange", event => {
  if (document.visibilityState == "visible") {

    $('#countswitch').text(count+=1);
    console.log("27678");
    
  } else {
    $('#countswitch').text(count+=1);
    console.log("27678");

  }
})
</script>
 --}}
<script type="text/javascript">

  var count=0;
  $(window).focus(function() {
    console.log("27678");
    $('#countswitch').text(count+=1);
});

$(window).blur(function() {
  console.log("27678");
     $('#countswitch').text(count+=1);
});

</script>


@endsection      
