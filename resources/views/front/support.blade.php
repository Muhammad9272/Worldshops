@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

<div class="ls-content-bg">
  <section class="fourzerofour">
    <div class="container">
      <div class="ps-contact-info">
            <div class="container">
                <div class="ps-section__header">
                    <h3 >Customer Support</h3>
                </div>
            </div>
        </div>
      <div class="row" id="cpointed-area">
        <div class="col-md-6">
         <div>
           <img src="{{asset('assets/support.png')}}">
         </div>
        </div>
        <div class="col-md-6">
          <div class="ps-contact-form">
            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    <form id="contactform" action="{{route('front.support.submit')}}" class="ps-form--contact-us" method="POST">
                      {{csrf_field()}}
                          
                  
                      <h3>Contact Us For any Queries</h3>
                       @include('includes.admin.form-both')
                      <div class="row">
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                              <div class="form-group">
                                  <input class="form-control" name="name" required="" type="text" placeholder="Name *">
                              </div>
                          </div>
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                              <div class="form-group">
                                  <input class="form-control" type="text" name="subject" placeholder="Subject *" required="">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                              <div class="form-group">
                                  <input class="form-control" type="email" name="email" placeholder="Email *" required="">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                              <div class="form-group">
                                  <input class="form-control" type="text" name="phone" placeholder="Phone *">
                              </div>
                          </div>
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                              <div class="form-group">
                                  <textarea class="form-control" name="text" rows="5" placeholder="Message" required=""></textarea>
                              </div>
                          </div>
                      </div>
                     
                      <div class="form-group submit">
                          <button class="ls-md-btn submit-btn">Send message</button>
                      </div>
                  </form>
          </div>
        </div>
       
      </div>
    </div>
  </section>
</div>


@endsection