@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    
    <div class="section-user-dashboard" style="min-height: 350px;">
      <div class="container ls-content-2">
         <div class="row user-orders-pg">
            <div class="col-xl-4 col-lg-4 col-md-6 pdc-40 ">
               @include('includes.front.user-dashboard-sidebar')
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12">
               <div class="mt-10">
                 <h4>Address Book</h4>
                 <p class="text-dark mb-20">Manage Your Address</p>
                 <hr>
                 
                 <div class="row mt-30">
                   <div class="{{count($addressbooks)>0?"col-lg-6 col-md-6":"col-lg-12 col-md-12"}}  pd-bottom">
                     <div class="ls-user-address-book-card"> 
                     <a data-name="Add New AddressBook" data-href="{{route('user.addressbook.create')}}" class="addressbookModaledit" href="" data-toggle="modal" data-target="#UserAddressModal" >                         
                        <div class="content-adb-card fr-ad-card">
                          <div class="icon-dev"><i class="fa fa-plus"></i></div>
                          <h4> Add an Address</h4>                                                                 
                        </div>
                         </a>
                     </div>
                   </div>
                   @foreach($addressbooks as $addressbook)
                   <div class="col-lg-6 col-md-6 pd-bottom">
                     <div class="ls-user-address-book-card">                          
                        <div class="content-adb-card">

                          <ul>
                            <li class="end-t-end">
                              <span>
                                <h4>{{$addressbook->fname}} {{$addressbook->lname}}</h4>
                                <h5 class="text-red">{{$addressbook->address_type==0?'Shipping Address':'Billing Address'}} </h5>
                              </span>

                                <p class="wsu-up-action">
                                  <a href="" data-href="{{route('user.addressbook.edit',$addressbook->id)}}" data-name="Edit AddressBook" class="addressbookModal " href="" data-toggle="modal" data-target="#UserAddressModal" ><i class="fa fa-pencil"></i></a> 
                                   <a  href="javascript:;" data-href="{{route('user.addressbook.delete',$addressbook->id)}}" data-toggle="modal" data-target="#confirm-delete" class="delete" ><i class="fa fa-times"></i></a>
                                </p> 
                            </li>

                           {{--  <li>{{$addressbook->address1}}</li>
                            <li>{{$addressbook->country}}</li>   
                            <li>{{$addressbook->state}}</li>
                            <li>{{$addressbook->city}}</li>
                            <li>{{$addressbook->zip}}</li> --}}

                            <li class="mt-20">{{$addressbook->address1}}, {{$addressbook->zip}}, {{$addressbook->state}}, {{$addressbook->country}} </li>
                            
                          </ul>
                          {{-- <p class="ad-bok-link mt-30">
                          </p> --}}
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

 
    <!--------------------- User AddressBook  Modals  --------------------->
    <div class="modal ls-modal" id="UserAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header adb-address-header">
            <h4 class="modal-title" id="exampleModalLabel">Add a New Address</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body adb-address-body" id="addressbook">



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
@endsection


