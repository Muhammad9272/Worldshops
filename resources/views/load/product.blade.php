<div class="lsm-mproduct-s">
    @if(!empty($proddataa->size))
	    <div class="row mb-20">
	    	<div class="col-md-4">
	           <div class="img img-with-border">
	             <img src="{{ empty($proddataa->photo) ? asset('assets/images/noimage.png') : 
	             ( filter_var($proddataa->photo, FILTER_VALIDATE_URL) ?  $proddataa->productt : asset('assets/images/products/'.$proddataa->photo)  )}}">
	           </div>
	    	</div>

	    	<div class="col-md-8">


		      <div class="product-price">
		          <p class="title">{{ $langg->lang87 }} :</p>
		          <p class="price"><span id="msizeprice">{{ $proddataa->showPrice() }}</span>
		            <small><del>{{ $proddataa->showPreviousPrice() }}</del></small></p>
		            
		      </div>

		      @if(!empty($proddataa->size))
		          <div class="mproduct-size">
		              <p class="title">{{ $langg->lang88 }} :</p>
		              <ul class="siz-list">
		                  @php
		                      $is_first = true;
		                  @endphp
		                  @foreach($proddataa->size as $key => $data1)
		                      <li class="{{ $is_first ? 'active' : '' }}">
					              <span class="box">{{ $data1 }}
					                <input type="hidden" class="msize" value="{{ $data1 }}">
							        <input type="hidden" class="msize_qty" value="{{ $proddataa->size_qty[$key] }}">
							        <input type="hidden" class="msize_key" value="{{$key}}">
							        <input type="hidden" class="msize_price" value="{{ round($proddataa->size_price[$key] * $curr->value,2) }}">
					              </span>
		                      </li>
		                      @php
		                          $is_first = false;
		                      @endphp
		                  @endforeach
		                  <li>
		              </ul>
		          </div>
		      @endif


		        <div class="product-quant-var prod-qty-3 mt-20">
			        <p class="title">Quantity :</p>
			        <p class="add_min">
				        <span class="minus spn modal-minus" data-class="minus1">-</span>

			                <input type="number" style="width: 21%"  class="count inp modal-total "  min="1" name="qty" value="1">                                                              
			            <span class="plus spn  modal-plus">+</span>
		            </p>
		        </div>



	              @if($proddataa->stock === 0)
	              <li class="addtocart">
	                <a href="javascript:;" class="cart-out-of-stock">
	                  <i class="icofont-close-circled"></i> 
	                  {{ $langg->lang78 }}</a>
	              </li>                    
	              @else 
	              <li class="addtocart">
	                <a href="javascript:;" id="maddcrt"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
	              </li>

	              
	              @endif




	          <input type="hidden" class="product-stock" id="stock" value="{{ $proddataa->size_qty[0] }}">
			  <input type="hidden" id="mproduct_price" value="{{ round($proddataa->vendorPrice() * $curr->value,2) }}">
		      <input type="hidden" id="mproduct_id" value="{{ $proddataa->id }}">
		      <input type="hidden" id="mcurr_pos" value="{{ $gs->currency_format }}">
		      <input type="hidden" id="mcurr_sign" value="{{ $curr->sign }}">



	    		
	    	</div>

	    </div>
    @endif

	{!! $proddataa->details !!}
	<hr>
	@if($proddataa->policy!=null && $proddataa->policy!="<br>" )
	<h4>Return Policy</h4>
    <hr>
    {!! $proddataa->policy !!}
    @endif
</div>




<script type="text/javascript">




var sizes = "";
var size_qty = "";
var size_price = "";
var size_key = "";
var colors = "";
var mtotal = "";
var mstock = $('.product-stock').val();
var keys = "";
var values = "";
var prices = "";


$(document).ready(function(){
            $('.count').prop('disabled', true);
        });

function mgetSizePrice()
{

	var total = 0;
	if($('.mproduct-size .siz-list li').length > 0)
	{
	total = parseFloat($('.mproduct-size .siz-list li.active').find('.msize_price').val());
	}
	return total;
}


function mgetAmount()
{
	var total = 0;
	var value = parseFloat($('#mproduct_price').val());
	var datas = $(".mproduct-attr:checked").map(function() {
	return $(this).data('price');
	}).get();

	var data;
	for (data in datas) {
	total += parseFloat(datas[data]);
	}
	total += value;
	return total;
}


// Product Details Product Size Active Js Code
$('.mproduct-size .siz-list .box').on('click', function () {

		$('.modal-total').val('1');
		var parent = $(this).parent();
		size_qty = $(this).find('.msize_qty').val();
		size_price = $(this).find('.msize_price').val();
		size_key = $(this).find('.msize_key').val();
		sizes = $(this).find('.msize').val();
		$('.mproduct-size .siz-list li').removeClass('active');
		parent.addClass('active');
		total = mgetAmount()+parseFloat(size_price);
		stock = size_qty;
		total = total.toFixed(2);
		var pos = $('#mcurr_pos').val();
		var sign = $('#mcurr_sign').val();
		if(pos == '0')
		{
		$('#msizeprice').html(sign+total);
		}
		else {
		$('#msizeprice').html(total+sign);
		}

});


$('.modal-minus').on('click', function () {
	var el = $(this);
	var $tselector = el.parent().parent().find('.modal-total');
	total = $($tselector).val();
	if (total > 1) {
	  total--;
	}
	$($tselector).val(total);
});

$('.modal-plus').on('click', function () {
	var el = $(this);
	var $tselector = el.parent().parent().find('.modal-total');
	total = $($tselector).val();
	if(mstock != "")
	{
	  var stk = parseInt(mstock);
	  if(total < stk)
	  {
	      total++;
	      $($tselector).val(total);
	  }
	}
	else {
	  total++;
	}
	$($tselector).val(total);
});



$("#maddcrt").on("click", function(){
var qty = $('.modal-total').val();
var pid = $(this).parent().parent().parent().parent().find("#mproduct_id").val();
var methodofcollect=$('.methodofcollect:checked').val();


	$.ajax({
	  type: "GET",
	  url:mainurl+"/addnumcart",
	  data:{id:pid,qty:qty,size:sizes,color:colors,size_qty:size_qty,size_price:size_price,size_key:size_key,keys:keys,values:values,prices:prices,methodofcollect:methodofcollect},
	  success:function(data){
	      if(data == 'digital') {
	          toastr.error(langg.already_cart);
	      }
	      else if(data == 0) {
	          toastr.error(langg.out_stock);
	      }
	      else {
	          $("#cart-count").html(data[4]);
	          $("#bucket-load").load(mainurl+'/carts/view');
	          toastr.success(langg.add_cart);
	      }

	      $('#product_modal').modal('hide');
	  }
	});
});






</script>