@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container ls-content-2">
          <div class="row mb-50">
            <div class="col-12">
              <div class="text-center">
                  <img class="mb-30" src="{{asset('assets/front/img/payment-failed.png')}}">
                  <h4>Oops! Bank denied the payment</h4>
                  
                 {{--  <div class="d-inline-flex mt-20">
                    <img class="ls-img-width" src="{{asset('assets/front/img/spar.jpg')}}">
                    <p class="text-dark mt-10">Spar St George's (Open)</p>
                  </div> --}}

                  <div class="mb-20 mt-40">
                    <a href="{{route('front.index')}}" class="ls-md-btn ">Retry</a>
                  </div>
                  <a href="{{route('user.savedcard.index')}}" class="text-underline mt-20" > Change Card Details</a>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>    
@endsection
@section('pagelevel_scripts')
@endsection