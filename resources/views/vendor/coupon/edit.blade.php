@extends('layouts.vendor')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/dist/slimselect.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" media="screen">
<style type="text/css">
  label{
    color: black;
  }
</style>
@endsection


@section('content')


            <div class="content-area" >

              <div class="mr-breadcrumb">
                  <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">Edit Coupon <a class="add-btn" href="{{ route('vendor-coupon-index') }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang550 }}</a></h4>
                          <ul class="links">
                              <li>
                                  <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }}</a>
                              </li>
                              <li>
                                  <a href="{{ route('vendor-coupon-index') }}">Coupons  </a>
                              </li>

                              <li>
                                  <a href="javascript:;">Edit Coupon</a>
                              </li>

                          </ul>
                      </div>
                  </div>
              </div>

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area"  >
                        @include('includes.admin.form-error')  
                      <form id="geniusform" action="{{route('vendor-coupon-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('includes.admin.form-both')

                        <div class="form-row">
                          <div class="form-group col-md-6" style="margin-bottom: 0px">
                            <label><b>{{ __('Title') }} </b> <span style="color: red;font-size: 20px">*</span></label><br> 
                            <input type="text" class="form-control" name="title" placeholder="{{ __('Enter title') }}" required="" value="{{$data->title}}">
                          </div>
                          <div class="form-group col-md-6" style="margin-bottom: 0px">
                            <label><b>{{ __('Code To Share') }} </b> <span style="color: red;font-size: 20px">*</span></label><br> 

                            <input type="text" class="form-control" name="code" placeholder="{{ __('Enter Code') }}" required="" value="{{$data->code}}">

                            <p class="sub-heading" style="padding-left: 7px">{{ __('Only A-Z characters,0-9 ,numbers and the dash (-) are allowed.') }}</p>
                          </div>
                          
                        </div>

                        <div class="from-row">
                            <div class="form-group">
                              <h5 class="heading"><b>{{ __('Discount') }}</b> <span style="color: red;font-size: 20px">*</span></h5>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input dis-type" type="radio" name="type" id="inlineRadio1" value="0" {{$data->type == 0 ? "checked":""}}>
                                <label class="form-check-label" for="inlineRadio1">Discount in %</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input dis-type" type="radio" name="type" id="inlineRadio2" value="1" {{$data->type == 1 ? "checked":""}}>
                                <label class="form-check-label" for="inlineRadio2">Discount in $</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input dis-type" type="radio" name="type" id="inlineRadio3" value="2" {{$data->type == 2 ? "checked":""}} >
                                <label class="form-check-label" for="inlineRadio3">Free Shipping</label>
                              </div>
                            </div>
                        </div>

                       
                        <div class="form-row" id="dis-hidden">
                          <div class="form-group col-lg-6" style="margin-bottom: 0px">
                            <input type="number" step="0.01" class="form-control dis-text" name="price" placeholder="Enter Percentage %" required="" value="{{$data->price}}"><span></span>
                          </div>
                          <p class="sub-heading" style="padding-left: 8px">{{ __(' Choose a discount type ( Amount, Percentage or Free shipping ) .Set an Amount or Percentage if your discount type is not free shipping ') }}</p>
                        </div>


                        <hr>
                        <div class="form-row">
                            <div class="form-group" style="padding-left: 5px;margin-bottom:0px">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input t_check" type="checkbox" name="t_check" id="inlineRadio4" value="1" {{$data->t_check == 1 ? "checked":""}}>
                                <label class="form-check-label" for="inlineRadio4">Set limited Period</label>
                              </div>
                            </div>
                        </div>

                        <div class="form-row" id="t_check" style="display:{{$data->t_check == 1 ? "flex":"none"}}">
                          <div class="col-lg-6">
                            <label>{{ __('Start Date') }} *</label>
                            <input type="text" class="input-field datetime" id="from" name="" placeholder="{{ __('Select a date') }}" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy HH:ii p" data-link-field="start_date"  value="{{$data->start_date}}">
                            <input type="hidden" name="start_date" id="start_date" value="{{$data->start_date}}" />
                          </div>
                          <div class="col-lg-6">
                            <label>{{ __('End Date') }} *</label>
                            <input type="text" class="input-field datetime" id="to" name="end_date" placeholder="{{ __('Select a date') }}" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy  HH:ii p" data-link-field="end_date"  value="{{$data->end_date}}">
                            <input type="hidden" id="end_date"  value="{{$data->end_date}}" />

                          </div>

                        </div>
                        <hr>

                        <div class="row">

                          <div class="col-lg-6">
                            <label><b>{{ __('Minimum Order value ') }}</b> <span style="color: red;font-size: 20px">*</span></label>
                            <input type="number" class="form-control" name="min_value" placeholder="{{ __('Enter Value ') }}" value="{{$data->min_value}}" required="">
                          
                          </div>                           
                          <div class="col-lg-6">
                            <label><b>{{ __('Maximum Usage Count') }}</b> <span style="color: red;font-size: 20px">*</span></label>
                            <input type="number" class="form-control" name="times" placeholder="{{ __('Enter Value') }}" value="{{$data->times}}">
                           <p class="sub-heading">{{ __('(Leave empty for an unlimited usage)') }}</p>
                          </div>
                          
                        </div>
                        <hr>

                        <div class="form-row" style="display: none;">
                            <div class="col-lg-8">
                              <label><b>{{ __('Apply To') }} </b> <span style="color: red;font-size: 20px">*</span></label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input apply_to" type="radio" name="apply_to" id="inlineRadio7" value="0" {{$data->apply_to== 0 ? "checked":""}}>
                                <label class="form-check-label" for="inlineRadio7">All</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input apply_to" type="radio" name="apply_to" id="inlineRadio8" value="1" {{$data->apply_to== 1 ? "checked":""}}>
                                <label class="form-check-label" for="inlineRadio8">Selected Categories</label>
                              </div> 
                              <div class="form-check form-check-inline">
                                <input class="form-check-input apply_to" type="radio" name="apply_to" id="inlineRadio9" value="2" {{$data->apply_to== 2 ? "checked":""}}>
                                <label class="form-check-label" for="inlineRadio9">Selected Products</label>
                              </div>                              
                            </div>
                        </div>
                        <div class="form-row" id="apply_to1" style="margin-top: 20px;display:{{$data->apply_to== 1 ? "none":"none"}}">
                            <div class="form-group col-lg-12">
                                <select id="select" multiple="" name="apply_val1[]"  >
                                
                                    <?php $arr=json_decode($data->apply_val);?>
                                    @foreach(App\Models\Category::all() as $category)
                                    <option value="{{$category->id}}" @if(is_array($arr) &&in_array($category->id,$arr)) selected="" @endif>{{$category->name}}</option>
                                    @endforeach
                                 
                                </select>
                                <p class="sub-heading">{{ __('Select Categories or products you wish to apply this coupon to.') }}</p>
                            </div>
                        </div>
                        <div class="form-row" id="apply_to2" style="margin-top: 20px;display:{{$data->apply_to== 2 ? "none":"none"}}">
                            <div class="form-group col-lg-12">
                                <select id="select2" multiple="" name="apply_val2[]"  >
                                  
                                   <?php $arr=json_decode($data->apply_val);?>                                            
                                    @foreach(App\Models\Product::all() as $product)
                                    <option value="{{$product->id}}" @if(is_array($arr) &&in_array($product->id,$arr)) selected="" @endif >{{$product->name}}</option>
                                    @endforeach
                                
                                </select>
                                <p class="sub-heading">{{ __('Select Categories or products you wish to apply this coupon to.') }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-lg-12">
                            <label><b>{{ __('Terms & Conditions') }}</b> <span style="color: red;font-size: 20px">*</span></label>
                            <textarea name="desc" class="nic-edit-p">
                              {!! $data->desc !!}
                            </textarea> 
                          
                          </div>                          
                                                  
                        </div>                        

                        <br>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{asset('assets/admin/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/bootstrap-datetimepicker.uk.js')}}" charset="UTF-8"></script>

<script type="text/javascript">
    $(document).ready(function(){
      @if($data->type==2)
        $('#dis-hidden').hide();
        $('#dis-hidden').find('input').prop("required", false);
      @endif
      })
    </script>

    <!-- select box live search js -->
    <script>
      setTimeout(function() {
        new SlimSelect({
          select: '#select',
          selectByGroup: true,
          placeholder: 'Select Categories'
        })
      }, 300)
    </script>
    <script>
      setTimeout(function() {
        new SlimSelect({
          select: '#select2',
          selectByGroup: true,
          placeholder: 'Select Products'
        })
      }, 300)
    </script>
    <script src="{{asset('assets/admin/dist/slimselect.min.js')}}"></script>

<script type="text/javascript">

{{-- Coupon Type --}}

    $('.dis-type').on('click', function() {
      var val = $(this).val();
      if(val == 2)
      {
        $('#dis-hidden').hide();
        $('#dis-hidden').find('input').prop("required", false);
      }
      else {
        if(val == 0)
        {
          $('#dis-hidden').find('input').attr("placeholder", "{{ __('Enter Percentage %') }}");
          $('#dis-hidden').css('display','flex');
        }
        else if(val == 1){
          $('#dis-hidden').find('input').attr("placeholder", "{{ __('Enter Amount $') }}");
          $('#dis-hidden').css('display','flex');
        }
      }
    });

{{-- Coupon Time --}}
    $('.t_check').on('click', function() {

      if($('.t_check').prop('checked')){
          $('#t_check').find('input').prop("required", true);
          $('#t_check').css({"display": "flex", "margin-top": "1rem"});

      }
      else
      { 
        $('#t_check').hide();
        $('#t_check').find('input').prop("required", false);

      }
    });    


{{-- Coupon Apply to --}}

  $(document).on("click", ".apply_to" , function(){
    var val = $(this).val();

    var selector = $("#apply_to1");
    var selector2 = $("#apply_to2");


    if(val == 0){
    selector.hide();
    selector2.hide();
    }
    else if(val == 1){
    selector.find('input').attr("placeholder", "{{ __('Select Categories') }}");
    selector.css('display','flex');
    selector2.hide();
        
    }
    else if(val == 2){
    selector2.find('input').attr("placeholder", "{{ __('Select Products') }}");
    selector2.css('display','flex');    
    selector.hide();   
    }

  });

</script>

<script type="text/javascript">
    var dateToday = new Date($.now());

    $('.datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
    });
  $('.datetime').datetimepicker('setStartDate',dateToday);
</script>

@endsection

