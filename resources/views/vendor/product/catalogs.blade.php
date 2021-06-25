@extends('layouts.vendor') 

@section('content')  
					<input type="hidden" id="headerdata" value="PRODUCT">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ $langg->lang444 }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ $langg->lang444 }} </a>
											</li>

											
											
										</ul>

										<div class="">
											
												<form id="bulk-edit-form" action="{{route('vendor-prodbulk-delete')}}" method="post" >
													 {{csrf_field()}}
												  <input type="hidden" id="data-idt" name="data_ids" value="">
												  <div class="btn-group">
	                                                  <button class="btn default disabled" id="c-rp-ttl" style="margin-right: 10px;    background: #bd2130;color: white;" href="" >Bulk Delete <span class="ed-rc-ttl">0</span></button>
	                                              </div>
												</form>
												
											
										</div>
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
														    <th style="padding-left: 10px;">
		                                                      <label style="margin-bottom: 0px;" class="mt-checkbox mt-checkbox-outline">
		                                                          <input type="checkbox" id="master_select"  > 
		                                                          <span></span>
		                                                      </label>
		                                                    </th>
									                        <th>{{ $langg->lang608 }}</th>
									                        {{-- <th>{{ $langg->lang609 }}</th> --}}
									                        <th>{{ $langg->lang610 }}</th>
									                        <th>{{ $langg->lang611 }}</th>
									                        <th>{{ $langg->lang612 }}</th>
														</tr>
													</thead>



              <tbody id="tablecontents">
                @foreach($datas as $data)
    	            <tr class="row1" data-id="{{ $data->id }}">
    	           
    	                <td>
    	                	<label class="mt-checkbox mt-checkbox-outline">
	                            <input type="checkbox" class="sub_select" data-id="{{$data->id}}" > 
	                            <span></span>
                           </label>
    	                </td>
                        

    	                <td>{{ Illuminate\Support\Str::limit($data->name, 25) }}</td>
    	                @php
                        $sign = App\Models\Currency::where('is_default','=',1)->first();
                        $price = round($data->price * $sign->value , 2);
                        $price = $sign->sign.$price ;
                        @endphp
    	                <td>{{ $price }}</td>
    	                <td>
    	              	        @php
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                @endphp

                                <div class="action-list">
	                                <select class="process select droplinks {{$class}}">
	                                	<option data-val="1" value="{{ route('vendor-prod-status',['id1' => $data->id, 'id2' => 1])}}" {{$s}}>
	                                		Activated
	                                	</option>
	                                	<option data-val="0" value="{{route('vendor-prod-status',['id1' => $data->id, 'id2' => 0])}}" {{$ns}}>
	                                		Deactivated
	                                	</option>
	                                	
	                                </select>
                                </div>
    	                </td>
    	                <td>    	              
							<div class="action-list">
								<a href="{{route('vendor-prod-edit',$data->id)}}"> <i class="fas fa-edit"></i>Edit</a>
								<a href="javascript:;" data-href="{{route('vendor-prod-delete',$data->id)}}" data-toggle="modal" data-target="#confirm-delete22" class="delete"><i class="fas fa-trash-alt"></i></a>
							</div>
    	                </td>
    	             
    	            </tr>
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

{{-- GALLERY MODAL --}}

		<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">{{ $langg->lang619 }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="top-area">
						<div class="row">
							<div class="col-sm-6 text-right">
								<div class="upload-img-btn">
									<form  method="POST" enctype="multipart/form-data" id="form-gallery">
										{{ csrf_field() }}
									<input type="hidden" id="pid" name="product_id" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
											<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ $langg->lang620 }}</label>
									</form>
								</div>
							</div>
							<div class="col-sm-6">
								<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ $langg->lang621 }}</a>
							</div>
							<div class="col-sm-12 text-center">( <small>{{ $langg->lang622 }}</small> )</div>
						</div>
					</div>
					<div class="gallery-images">
						<div class="selected-image">
							<div class="row">


							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>


{{-- GALLERY MODAL ENDS --}}

@endsection    

@section('scripts')


{{-- DATA TABLE --}}

    											
									


{{-- DATA TABLE ENDS--}}



<script type="text/javascript">


      $(function () {
        
	        var table=$('#geniustable').DataTable({
			  "ordering": false,
			  "drawCallback": function( settings ) {
			            $("#master_select").prop('checked', false);
			            $(".sub_select").prop('checked', false);
			             
                        $('#c-rp-ttl').addClass('disabled');
                        $('.ed-rc-ttl').text('0');
			    }
			});


	        // $( "#tablecontents" ).sortable({
	        //   items: "tr",
	        //   cursor: 'move',
	        //   opacity: 0.6,
	        //   update: function() {
	        //       sendOrderToServer();
	        //   }
	        // });

	        function sendOrderToServer() {
	          var order = [];
	          var token = $('meta[name="csrf-token"]').attr('content');
	          $('tr.row1').each(function(index,element) {
	            order.push({
	              id: $(this).attr('data-id'),
	              position: index+1
	            });
	          });

	          $.ajax({
	            type: "POST", 
	            dataType: "json", 
	            url: "{{ route('vendor-prod-reorder') }}",
	                data: {
	              order: order,
	              _token: token
	            },
	            success: function(response) {
	                if (response.status == "success") {
	                  console.log(response);
	                } else {
	                  console.log(response);
	                }
	            }
	          });
	        }


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

            $('.sub_select').on('click', function(e) {
              var numberOfChecked = $('.sub_select:checked').length;
              var totalCheckboxes = $('.sub_select:checkbox').length;
              $('.ed-rc-ttl').text(numberOfChecked);
              if(numberOfChecked>0){
                $('#c-rp-ttl').removeClass('disabled');
              }
              else{
                $('#c-rp-ttl').addClass('disabled');
              }




              if(numberOfChecked==totalCheckboxes){
                $("#master_select").prop('checked', true); 
              }
              else{
                $("#master_select").prop('checked', false); 
              }

            });



			$(document).on('submit','#bulk-edit-form',function(e){
			    e.preventDefault();
			    var allVals = [];  
			    $(".sub_select:checked").each(function() {  
			        allVals.push($(this).attr('data-id'));
			    });

			    if(allVals.length <=0)  
			    {  
			        alert("Please select row.");  
			    }

			      else {  

			            var join_selected_values = allVals.join(","); 
			             $('#data-idt').val(join_selected_values);
			              if(admin_loader == 1)
			                {
			                $('.submit-loader').show();
			              }

			              $.ajax({
			               method:"POST",
			               url:$(this).prop('action'),
			               data:new FormData(this),
			               contentType: false,
			               cache: false,
			               processData: false,
			                 success:function(data)
			                 {
			                      location.reload();

			                      if(admin_loader == 1)
			                      {
			                        $('.submit-loader').hide();
			                      }

			                    if ((data.errors)) {
			                      $('.alert-success').hide();
			                      $('.alert-info').hide();
			                      $('.alert-danger').show();
			                      $('.alert-danger ul').html('');
			                        
			                          $('.alert-danger ul').html(data.errors);
			                        
			                       
			                    }
			                    else{
			                      $('.alert-danger').hide();
			                      $('.alert-success').show();
			                      $('.alert-success p').html(data);
			                      
			                    }



			                 }
			                });
			    }

			 });




      });

</script>


<script type="text/javascript">
      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" href="{{route('vendor-prod-physical-create')}}">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ $langg->lang623 }}<span>'+
          '</a>'+
          '</div>');
      });

$('#master_select').on('click', function(e) {
          
         if($(this).is(':checked',true))  
         {
            $(".sub_select").prop('checked', true);
            var numberOfChecked = $('.sub_select:checked').length;
            $('.ed-rc-ttl').text(numberOfChecked);
            if(numberOfChecked>0){
              $('#c-rp-ttl').removeClass('disabled');
            }
            else{
              $('#c-rp-ttl').addClass('disabled');
            }

         } else {  
            $(".sub_select").prop('checked',false);  
            var numberOfChecked = $('.sub_select:checked').length;
            $('.ed-rc-ttl').text(numberOfChecked);
            if(numberOfChecked>0){
              $('#c-rp-ttl').removeClass('disabled');
            }
            else{
              $('#c-rp-ttl').addClass('disabled');
            }
         }  
        });




</script>
@endsection   