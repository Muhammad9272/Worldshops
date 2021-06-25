@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

<section class="fourzerofour extra-pg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content text-center">
            <img src="{{ $gs->error_banner ? asset('assets/images/'.$gs->error_banner):asset('assets/images/noimage.png') }}" alt="">
            <div style="margin: 20px 0px">
                <h3 class="heading">
                {{ $langg->lang428 }}
              </h3>
              <p class="text">
                {{ $langg->lang429 }}
              </p>
              <a class="mybtn1" href="{{ route('front.index') }}">{{ $langg->lang430 }}</a>
            </div>
            

          </div>
        </div>
      </div>
    </div>
  </section>


@endsection