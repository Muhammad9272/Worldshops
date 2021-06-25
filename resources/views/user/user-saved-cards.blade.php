@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

    <div class="section-user-dashboard" style="min-height: 350px;">
      <div class="container ls-content-2">
         <div class="row user-orders-pg">
            <div class="col-md-2 ">
                @include('includes.front.user-dashboard-sidebar')
            </div>
            <div class="col-md-10">
               <div class="mt-10">
                 <h4>Saved Cards</h4>
                 <p class="text-dark mb-20">View and Delete Your Payment Details</p>
                 <hr>
                 
                 <div class="row mt-30">
                   <div class="col-lg-6 col-md-6 pd-bottom">
                     <div class="ls-user-address-book-card"> 
                     <a href="" data-toggle="modal" data-target="#UserAddCardModal" >                         
                        <div class="content-adb-card fr-ad-card">
                          <div class="icon-dev"><i class="fa fa-plus"></i></div>
                          <p class="ad-bok-link " > Add New Card</p>                                                                 
                        </div>
                         </a>
                     </div>
                   </div>
                   <div class="col-lg-6 col-md-6 pd-bottom">
                     <div class="ls-user-address-book-card">                          
                        <div class="content-adb-card">
                          <div class="text-right">
                            <img src="{{asset('assets/front/img/Mastercard.png')}}">
                            <p class="text-dark">mastercard</p>
                          </div>
                          <div>
                            <p class="mt-40 text-center text-dark"> 
                              <span class="mr-10">• • • •</span> <span class="mr-10">• • • •</span> <span class="mr-10">• • • •</span>    5678 </p>
                          </div>
                          <div class="end-t-end mt-40">
                            <p class="">
                              <span class="block">Expiry Date</span> 
                              <span class="text-dark">10/2025</span> 
                            </p>
                            <a href="" class="text-underline mt-20"> Delete</a>
                          </div>
                          
                        </div>
                     </div>
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
            <h4 class="modal-title" id="exampleModalLabel">Add a New Card</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body adb-address-body">
            <form>


              <div class="row">
                <div class="col-md-12">
                  <label for="recipient-name" class="col-form-label">Credit Card:</label>
                  <input type="text" class="form-control cust-adb-modal" placeholder="Enter Card Number" id="recipient-name">
                </div>

                <div class="col-md-12">
                 <label  class="col-form-label">Name on Card *</label>
                 <input type="text" class="form-control cust-adb-modal" >
                </div>

                <div class="col-md-6">
                 <label class="col-form-label">Country/Region *</label>
                  <select class="form-control cust-adb-modal">
                    <option>United States</option>
                    <option>Pakistan</option>
                    <option>Afghanistan</option>
                    <option>India</option>
                  </select>
                </div>

                <div class="col-md-6">
                 <label  class="col-form-label">State/Province *</label>
                  <select class="form-control cust-adb-modal" >
                    <option>United States</option>
                    <option>Pakistan</option>
                    <option>Afghanistan</option>
                    <option>India</option>
                  </select>
                </div>

                <div class="col-md-6">
                 <label  class="col-form-label">City</label>
                 <input type="text" class="form-control cust-adb-modal" >
                </div>


                <div class="col-md-6">
                 <label class="col-form-label">Zip/Postal Code</label>
                 <input type="text" class="form-control cust-adb-modal" >
                </div>


                <div class="col-md-6">
                  <label  class="col-form-label">Address line 1 *</label>
                  <input type="text" class="form-control cust-adb-modal" >
                </div>
                <div class="col-md-6">
                 <label  class="col-form-label">Address line 2 (optional)</label>
                 <input type="text" class="form-control cust-adb-modal">
                </div>            
                
              </div>

              <div class="form-group btn-submit-adb mt-20 ">
                <button class="ls-md-btn"> Add Now </button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

@endsection
@section('pagelevel_scripts')
@endsection
