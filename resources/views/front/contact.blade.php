@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

<div class="ls-content-bg">
  <section class="fourzerofour extra-pg">
    <div class="container">
      <div class="ps-contact-info">
            <div class="container">
                <div class="ps-section__header">
                    <h3 >Contact Us For Any Questions</h3>
                </div>
            </div>
        </div>
      <div class="row" id="cpointed-area">
        
        <div class="col-md-6">
          <div class="ps-contact-form">
            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    <form id="contactform" action="{{route('front.contact.submit')}}" class="ps-form--contact-us" method="POST">
                      {{csrf_field()}}
                          
                  
                      <h3>Get In Touch</h3>
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
                      <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                      <div class="form-group submit">
                          <button class="ws-btn submit-btn">Send message</button>
                      </div>
                  </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-extra-info">
            @if( $ps->email != null )
             <h3>
             <i class="fa fa-envelope"></i>
              <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>
            </h3>
            @endif
            @if($ps->phone != null )
            <h3>
              
             <i class="fa fa-phone"></i>
              <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
            </h3>
            @endif
            @if($ps->street != null)                                                                                             
              <h3>
               <i class="fa fa-location-arrow"></i>
                {!! $ps->street !!}
              </h3>
             @endif
              

          </div>
        </div>
      </div>
    </div>
  </section>
</div>


@endsection