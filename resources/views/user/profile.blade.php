@extends('front.layouts.app')
@section('pagelevel_css')
<link href="{{ asset('assets/admin/img_upload/imgUpload.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
  .inputfile + label figure img{
    width: 70px;
    border: 2px solid #c61010;
    border-radius: 50%;
  }
</style>
@endsection
@section('page_content')
    
    <div class="ls-content-bg">
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
           <div class="row user-orders-pg ">
              <div class="col-xl-4 col-lg-4 col-md-6 pdc-40">
                @include('includes.front.user-dashboard-sidebar')
              </div>
              <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="mt-10 mb-100">
                   <h4>Account Details</h4>
                   <p class="text-dark mb-30">Change your sign in information</p>
                  <div class="row">
                    <div class="col-12 ws-card-white">
                       <div class="gocover"
                          style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                      </div>
                      <form id="userform" action="{{route('user-profile-update')}}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('includes.admin.form-both')
                        <h5 class="mt-20 mb-20">Personal Information</h5>
                          <!-- <p>Riya Talor</p> -->

                          <div class="row">


                              <div class="col-md-6">
                                <input type="text" name="name" class="usad-read fm-cir form-control"  readonly="" value="{{ $user->name }}">
                                <a href="" class="text-underline redrm ml-10">Edit</a> 
                              </div> 
                            
                                <div class="col-md-6 text-center">
                                    <div class="form-file">
                                        @if($user->is_provider == 1)
                                          <div  class="img"><img style="border-radius: 50%"
                                                  src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                                          </div>
                                        @else

                                          <input type="file" class="inputfile" name="photo" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected"  />
                                          <label for="your_picture">
                                              <figure>
                                                  <img src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}" alt="" class="your_picture_image">
                                              </figure>
                                              <span class="file-button text-center">Change picture</span>
                                          </label>
                                        @endif



                                    </div> 
                                </div>


                          </div>      

                      
                        <hr>
                        @if($user->is_provider != 1)
                          {{-- <h5 class="mt-20 mb-20">Email Address</h5>
                            <div class="col-md-6 pl-0">
                            <input type="text" name="" class="usad-read fm-cir form-control" readonly="" value="{{ $user->email }}">
                            <a href="" class="text-underline redrm ml-10">Edit</a>
                            </div>                        
                          <hr> --}}

                          <h5 class="mt-20 mb-20">Phone No</h5>
                            <div class="col-md-6 pl-0">
                            <input type="text" name="phone" class="usad-read fm-cir form-control" readonly="" value="{{ $user->phone }}">
                            <a href="" class="text-underline redrm ml-10">Edit</a>
                            </div>                        
                          <hr>


                        @endif
                        <div class="from-group text-right mt-20">
                          <button class="ws-btn submit-btn ">Update</button>
                        </div>

                      </form>


                    </div>  
                    
                  </div>
                   




                </div>
              </div>
           </div>
        </div>  
      </div>
    </div>    
@endsection
@section('pagelevel_scripts')

<script type="text/javascript">
  $(document).on('click','.redrm',function(e){
    e.preventDefault();
    $(this).siblings('.usad-read').attr('readonly',false);
    $(this).siblings('.usad-read').focus();

  });

</script>
<script src="{{ asset('assets/admin/img_upload/imgUpload.js') }}" type="text/javascript"></script>
@endsection
