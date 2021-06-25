@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
           <div class="row user-orders-pg ">
              <div class="col-xl-4 col-lg-4 col-md-6 pdc-40">
                 @include('includes.front.user-dashboard-sidebar')
              </div>
              <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="mt-10 mb-100">
                   <h4>Marketing Preferenes</h4>
                   <p class="text-dark mb-30">Tailor your email from us</p>



                  <div class="row">
                    <div class="col-12 mark-pref ws-card-white">
                      <form action="{{route('user.marketing.preference.update')}}" id="userdashform" method="post">
                        {{ csrf_field() }}
                        <h4>Address Type </h4>
                        <div class="mt-30">
                          <label class="container-checkbox">News
                              <input type="checkbox" {{Auth::user()->is_m_news==1?'checked':''}} value="1" name="is_m_news" id="newscheck">
                              <span class="checkmark"></span>
                            </label>
                         </div>
                        <div class="">
                          <p>We will send important info aboutt our products and benefits to help you get the most from your</p>                         
                        </div>

                        <div class="mt-20">
                            <label class="container-checkbox">Offers
                              <input type="checkbox" name="is_m_offer"   {{Auth::user()->is_m_offer==1?'checked':''}} value="1" id="offerscheck">
                              <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="">
                          <p>From art works by blue chip to emerging artists and frim wine to wishky, we will send discounts</p>
                          
                        </div>

                        <div class="from-group text-right mt-20">
                          <button class="ws-btn submit-btn ">Update</button>
                        </div>
                      </form>


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
