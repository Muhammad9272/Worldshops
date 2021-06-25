@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
  
  <div class="ls-content-bg">
    <div class="section-user-dashboard" style="min-height: 350px;">
      <div class="container ls-content-2">
         <div class="row user-orders-pg">
            <div class="col-xl-4 col-lg-4 col-md-6 pdc-40">
                @include('includes.front.user-dashboard-sidebar')
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12">
               <div class="mt-10">
                 <h4>Saved Cards</h4>
                 <p class="text-dark mb-20">View and Delete Your Payment Details</p>
                 <hr>
                 
                 <div class="row mt-30">
                   {{-- <div class="{{count($usercreditcards)>0?"col-lg-6 col-md-6":"col-lg-12 col-md-12"}} pd-bottom">
                     <div class="ls-user-address-book-card"> 
                     <a data-name="Payment Method" data-href="{{route('user.savedcard.create')}}" class="UserAddCardModal" href="" data-toggle="modal" data-target="#UserAddCardModal" >                         
                        <div class="content-adb-card fr-ad-card" style="padding:44px">
                          <div class="icon-dev"><i class="fa fa-plus"></i></div>
                          <h4> Add New Card</h4>                                                                 
                        </div>
                         </a>
                     </div>
                   </div> --}}
                    @foreach($usercreditcards as $usercreditcard)
                   <div class="col-lg-6 col-md-6 pd-bottom">
                     <div class="ls-user-address-book-card">                          
                        <div class="content-adb-card">
                          <div class="end-t-end">
                            
                            <div class="">
                              <img src="{{asset('assets/front/img/visa-logo.png')}}">
                              @if($usercreditcard->primary!=1)
                              <h4 class="text-underline text-red mt-10"><a href="{{route('user.savedcard.primary',$usercreditcard->id)}}">Make Primary Method</a></h4>
                              @endif
                            </div>
                            
                            <div class="wsu-up-action">
                              <a href="javascript:;" data-href="{{route('user.savedcard.edit',$usercreditcard->id)}}" data-toggle="modal" data-target="#UserAddCardModal"  class="text-underline UserAddCardModal mt-20"> <i class="fa fa-pencil"></i></a>
                           
                              <a href="javascript:;" data-href="{{route('user.savedcard.delete',$usercreditcard->id)}}" data-toggle="modal" data-target="#confirm-delete"  class="text-underline delete mt-20"> <i class="fa fa-times"></i></a>
                            </div>
                          </div>
                          

                          <div>
                            <h4 class="{{$usercreditcard->primary==1?' mt-40':" mt-20"}} text-center text-dark"> 
                              XXXX-XXXX-XXXX  {{substr ($usercreditcard->card_no, -4)}} </h4>
                          </div>
                          <div class="end-t-end mt-20">
                            <p class="">
                              <span class="block">Expiry Date</span> 
                              <span class="text-dark">{{$usercreditcard->date}}</span>
                              {{--  <span class="block">Card Owner Name</span> 
                              <span class="text-dark">{{$usercreditcard->name}}</span>  --}}
                            </p>
                            <p class="">
                              
                            </p>
                          </div>
                          
                        </div>
                     </div>
                   </div>
                   @endforeach

                   
                 </div>

               </div>
            </div>
         </div>
      </div>  
    </div>
  </div>    


    <!--------------------- Modals --------------------->
    <!-- Add Payment cards -->
    <div class="modal ls-modal" id="UserAddCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header adb-address-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Payment Method</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body adb-address-body">

          </div>
          
        </div>
      </div>
    </div>

    <!--------------------- Confirm Delete AddressBook  Modals  --------------------->

    <div class="modal" tabindex="-1" id="confirm-delete" role="dialog">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header" style="padding: 20px">
            <h4 class="modal-title">Confirm Delete</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p class="text-center">{{ __('You are about to delete this Data.') }}</p>
              <p class="text-center">{{ __('Do you want to proceed?') }}</p>
          </div>
          <div class="modal-footer">
             <button type="button" style="font-size: 14px;" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok" style="font-size: 14px;">{{ __('Delete') }}</a>

          </div>
        </div>
      </div>
    </div>





@endsection
@section('pagelevel_scripts')
<script type="text/javascript">
  @if (Session::has('message'))
    toastr.success("{{ Session::get('message') }}");                  
  @endif
</script>
@endsection
