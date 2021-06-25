@extends('layouts.vendor')

@section('content')

<div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">Product Categories</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }}</a>
                      </li>
                      <li>
                        <a href="javascript:;">Product Category </a>
                      </li>
                     
                    </ul>
                </div>
              </div>
            </div>
            <div class="add-product-content">
              <div class="row">
                <div class="col-lg-12">
                  <div class="product-description">
                    <div class="heading-area">
                      <h2 class="title">
                           {{$data->name}}
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ap-product-categories">
                <div class="row sortable-posts">
                  @foreach($data->subs()->orderBy('position', 'ASC')->get() as $data)
                  <div id="{{ $data->id }}" class="col-lg-4 inid" style="margin-bottom: 20px;">
                    <a href="{{ route('vendor-prodchildcatwise-index', [Request::route('category'),$data->slug]) }}">
                    <div class="cat-box box1" style="background: white; box-shadow: 0 0 8px #95979d;">
                      <img style="height: 200px;width: 200px" src="{{ $data->photo ? asset('assets/images/categories/'.$data->photo):asset('assets/images/noimage.png') }}">
                      <h5 class="title" style="color: black">{{$data->name}} </h5>
                    </div>
                    </a>
                  </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>

@endsection
@section('scripts')

  <script type="text/javascript">
  $(function() {
      $(".sortable-posts").sortable({
          stop: function() {
              $.map($(this).find('.inid'), function(el) {
                  var id = el.id;
                  var sorting = $(el).index();
                  $.ajax({
                      url:"{{route('vendor-subcat-sort')}}",
                      type: 'GET',
                      data: {
                          id: id,
                          sorting: sorting
                      },
                  });
              });
          }
      });
  });
  </script>
@endsection