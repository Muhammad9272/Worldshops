@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

  <div class="ls-content-bg">
    <div class="section-user-dashboard" style="min-height: 350px;">
      <div class="container ls-content-2">
         <div class="row">
           <div class="col-12">
             
            <div class="user-dashboard">
              <div class="ls-user-d-head">
                 <h4>Good Evening</h4>
                 <h4>Welcome to your account</h4>
              </div>
              <div class="ls-ud-content ">
               
                <div class="ls-ud-list mt-40">
                  <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                      <div class="ls-ud-card">
                        <a href="{{route('user-orders')}}" class="upper-ud-area">
                          <div class="ud-card-img">
                             <img src="{{asset('assets/front/img/order-icon.png')}}">
                          </div>
                          <div class="pad-text">
                           <p><strong>Your Orders</strong></p>
                          </div>
                        </a>
                        <p> <span>Track Your Order or create a return</span> </p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                      <div class="ls-ud-card">
                        <a href="{{route('user.addressbook.index')}}" class="upper-ud-area">
                          <div class="ud-card-img">
                             <img src="{{asset('assets/front/img/home-icon.png')}}">
                          </div>
                          <div class="pad-text">
                           <p><strong>Address Book</strong></p>
                          </div>
                        </a>
                        <p> <span>Manage Your Address</span> </p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                      <div class="ls-ud-card">
                        <a href="{{route('user.savedcard.index')}}" class="upper-ud-area">
                          <div class="ud-card-img">
                             <img src="{{asset('assets/front/img/payment-icon.png')}}">
                          </div>
                          <div class="pad-text">
                           <p><strong>Saved Cards</strong></p>
                          </div>
                        </a>
                        <p> <span>View and delete your payment details</span> </p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                      <div class="ls-ud-card">
                        <a href="{{route('user-profile')}}" class="upper-ud-area">
                          <div class="ud-card-img">
                             <img src="{{asset('assets/front/img/user-icon.png')}}">
                          </div>
                          <div class="pad-text">
                           <p><strong>Account Details</strong></p>
                          </div>
                        </a>
                        <p> <span>Change your sign in information</span> </p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                      <div class="ls-ud-card">
                        <a href="{{route('user.marketing.preference')}}" class="upper-ud-area">
                          <div class="ud-card-img">
                             <img src="{{asset('assets/front/img/msg-icon.png')}}">
                          </div>
                          <div class="pad-text">
                           <p><strong>Marketing Preferences</strong></p>
                          </div>
                        </a>
                        <p> <span>Tailor your email for us</span> </p>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-20 refer-friend-ud ">
                    <div class="col-md-12">
                      <div class="ls-ud-card text-center">
                        <h4>Refer A Friend</h4>
                        <p class="text-dark mt-20 mb-20">Recommend the <a href="#" class="text-red">LOCAL SUPERMARKET</a> to your friends and earn rewards </p>
                        <div class="mt-30">
                          <a href="{{route('user.refer.friend')}}" class="ls-md-btn"> Begin </a>
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
    </div>  
  </div>  
@endsection
@section('pagelevel_scripts')
@endsection
 