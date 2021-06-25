@extends('layouts.vendor') 

@section('content')  
					<input type="hidden" id="headerdata" value="PRODUCT">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">Defective Products</h4>
										<ul class="links d-inline-flex">
											<li>
												<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ $langg->lang444 }} </a>
											</li>
											<li>
												<a href="javascript:;">Defective Products</a>
											</li>
										</ul>
										
										
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.vendor.form-success')  

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ $langg->lang608 }}</th>
									                        
									                        <th>{{ $langg->lang610 }}</th>
									                        <th>Category</th>
									                        <th>SubCategory</th>
									                        <th>ChildCategory</th>
									                        <th>{{ $langg->lang612 }}</th>
														</tr>
													</thead>
			<tbody id="tablecontents">
                @foreach($datas as $data)
                    
                    @if(   ($data->category->subs->count()>0 && is_null($data->subcategory_id) ) ||
                    	   ( ( $data->category->subs->count()>0 && $data->subcategory->childs->count()>0 ) && is_null($data->childcategory_id) )
                         )                    
                    <tr class="row1" data-id="{{ $data->id }}">  
                        <td>{{ Illuminate\Support\Str::limit($data->name, 25) }}</td> 
                        @php
                        $sign = App\Models\Currency::where('is_default','=',1)->first();
                        $price = round($data->price * $sign->value , 2);
                        $price = $sign->sign.$price ;
                        @endphp
    	                <td>{{ $price }}</td>
    	                <td>
    	                	{{$data->category?$data->category->name:""}}
    	                </td>
    	                <td>
    	                	{{$data->subcategory?$data->subcategory->name:""}}
    	                </td>
    	                <td>
    	                	{{$data->childcategory?$data->childcategory->name:""}}
    	                </td>

    	                
    	                <td>    	              
							<div class="action-list">
								<a href="{{route('vendor-prod-edit',$data->id)}}"> <i class="fas fa-edit"></i>Edit</a>
								<a href="javascript:;" data-href="{{route('vendor-prod-delete',$data->id)}}" data-toggle="modal" data-target="#confirm-delete22" class="delete"><i class="fas fa-trash-alt"></i></a>
							</div>
    	                </td>
    	            </tr>
    	            @endif

    	        @endforeach
            </tbody>   
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

{{-- HIGHLIGHT MODAL --}}
										<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">
										
										
										<div class="modal-dialog highlight" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $langg->lang613 }}</button>
											</div>
										</div>
										</div>
</div>

{{-- HIGHLIGHT ENDS --}}
{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete22" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ $langg->lang614 }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ $langg->lang615 }}</p>
            <p class="text-center">{{ $langg->lang616 }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langg->lang617 }}</button>
            <a class="btn btn-danger btn-ok1">{{ $langg->lang618 }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}



@endsection    

@section('scripts')

<script type="text/javascript">
	 $(function () {
        
	        var table=$('#geniustable').DataTable({
			  "ordering": false,
			  "drawCallback": function( settings ) {
			            
			    }
			});

			 $('#confirm-delete22').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok1').attr('href', $(e.relatedTarget).data('href'));
          });


			$('#confirm-delete22 .btn-ok1').on('click', function(e) {
			        if($('#confirm-delete22 .btn-ok1').hasClass("order-btn")){
			          if(admin_loader == 1)
			            {
			            $('.submit-loader').show();
			          }
			        }
		        $.ajax({
		         type:"GET",
		         url:$(this).attr('href'),
			        success:function(data)
			         {
			              $('#confirm-delete22').modal('toggle');
			              location.reload();
			              $('.alert-danger').hide();
			              $('.alert-success').show();
			              $('.alert-success p').html(data);

			            if($('#confirm-delete22 .btn-ok1').hasClass("order-btn")){
					          if(admin_loader == 1)
					          {
					            $('.submit-loader').hide();
					          }
			            }
			        }
		        });
		        return false;
		    });




		});
</script>



</script>


@endsection   