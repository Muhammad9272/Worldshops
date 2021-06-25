@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
  <div class="ls-content-bg">
    <section class="fourzerofour extra-pg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-50">
              <h3 class="title">
                {{ $page->title }}
              </h3>
            <div class="content text-center">
             
              
             
              <p>
                {!! $page->details !!}
              </p>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


@endsection