<!DOCTYPE html>
<html lang="en">
  <head>
      @include('front.layouts.head')
  </head>
  <body>
    

    @include('front.layouts.header')



    @if($gs->is_loader == 1)
      <div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
    @endif

    <div id="homepage-2" class="">
      @section('page_content')
      @show       

      @include('front.layouts.footer')  
    </div>

    

    @include('includes.front.modals')


{{--     <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div> --}}

   <div id='toTop'>
     <i class="fa fa-angle-double-up"></i>
    {{-- <i class="icon-arrow-up"></i> --}}
   </div>


    @include('front.layouts.scripts')

  </body>
</html>