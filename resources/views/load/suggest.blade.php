@foreach($prods as $prod)
	<div class="docname " style="padding: 15px;">




@if(!empty($productt->childcategory))

 <a class="prod-search-1" data-id="{{$prod->id}}" href="{{route('front.vendor.childcategory', [$shop_nam,$prod->category->slug,$prod->subcategory->slug,$prod->childcategory->slug])}}">
 @elseif(!empty($productt->subcategory))

  <a class="prod-search-1" data-id="{{$prod->id}}" href="{{route('front.vendor.childcategory', [$shop_nam,$prod->category->slug,$prod->subcategory->slug])}}">
 @else
 <a class="prod-search-1" data-id="{{$prod->id}}"  href="{{route('front.vendor.childcategory', [$shop_nam,$prod->category->slug])}}">
 
 @endif
			<img style="width: 30px;display: inline-flex;" src="{{ empty($prod->thumbnail)?asset('assets/images/noimage.png'):
			( file_exists(public_path().'/assets/images/thumbnails/'.$prod->thumbnail)?asset('assets/images/thumbnails/'.$prod->thumbnail) :asset('assets/images/noimage.png') ) 
           		}}" alt="">
			<div class="search-content d-inline-flex">
				<p>{!! strlen($prod->name) > 66 ? str_replace($slug,'<b>'.$slug.'</b>',substr($prod->name,0,66)).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name)  !!} </p>
				<span style="font-size: 14px; font-weight:600; display:block;margin-left: 30px;">{{ $prod->showPrice() }}</span>
			</div>
			
		</a>
	</div> 
@endforeach

<script type="text/javascript">
	    $('.prod-search-1').on('click',function (e) {
	    	e.preventDefault();
	    	var id=$(this).attr('data-id');
	    	var url=$(this).attr('href');

	    	url=url+'?sprod_id='+id;

	     window.location = url;

        })
</script>