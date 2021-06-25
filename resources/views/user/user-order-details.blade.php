@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
          <div class="row">
            <div class="col-12"> 

                <div class="user-order-details">
                  <div class="ls-user-order-details-head">
                     <h4>Order Details</h4>
                     <p>Your Order KZ2349000 is on the way and was shipped 20 mins before</p>
                     <hr>
                     <h5 class="mt-20">Order Status</h5>
                     <p>Dispatched</p>
                     <hr>
                     <h5 class="mt-20">Your Orders</h5>
                     <div class="ls-order-details-card ">
                       <div class="ordtls-head">
                         <img src="{{asset('assets/front/img/spar.jpg')}}">
                         <a href="">Spar St George's (Open)</a>
                       </div>
                       <hr>
                       <div class="ordtls-content">
                         <ul class="lst-st">
                           <li class="end-t-end">
                             <div>
                               <span class="test-dark">Alpro Undewerted 1L</span>
                               <p class="mt-10 ">QTY - 1</p>
                             </div>
                             <p>$ 1.72</p>
                           </li>
                           <li class="end-t-end">
                             <div>
                               <span class="test-dark">Skin Tear Undewerted 1L</span>
                               <p class="mt-10 ">QTY - 3</p>
                             </div>
                             <p>$ 4.6</p>
                           </li>
                           <li class="end-t-end">
                             <div>
                               <span class="test-dark">Alpro Undewerted 1L</span>
                               <p class="mt-10 ">QTY - 4</p>
                             </div>
                             <p>$ 1.72</p>
                           </li>
                         </ul>
                       </div>
                     </div>
                    <hr>
                      <div class="ls-order-summary mt-30">
                        <h5>Order Summary</h5>
                        <ul class="ul-style">
                          <li class="end-t-end">                            
                             <p class="mt-10 ">Item Subtotal</p>
                             <p>$ 1.72</p>
                          </li>
                          <li class="end-t-end">                            
                             <p class="mt-10 ">Service Charges</p>
                             <p>$ 1.72</p>
                          </li>
                          <li class="end-t-end">                            
                             <p class="mt-10 ">Govt Bag Charges</p>
                             <p>$ 1.72</p>
                          </li>
                          <hr>
                          <li class="end-t-end">                            
                            <h5>Total</h5>
                            <h5>$ 1.72</h5>
                          </li>                    
                        </ul>
                      </div>

                      <div class="row ls-shipped-orio mt-30">
                        <div class="col-md-2">
                          <h5>Shipped To</h5>
                          <ul class="ul-style">
                            <li><p>Ryan Smith </p> </li>
                            <li><p>92 Red build USA</p></li>
                            <li><p>Flat 876</p></li>
                            <li><p>LONDON</p></li>
                            <li><p>London</p></li>
                            <li><p>ERT 546</p></li>
                            <li><p>United Kingdom</p></li>
                          </ul>                         
                        </div>
                        <div class="col-md-2">
                          <h5>Billed To</h5>
                          <ul class="ul-style">
                            <li><p>Ryan Smith </p> </li>
                            <li><p>92 Red build USA</p></li>
                            <li><p>Flat 876</p></li>
                            <li><p>LONDON</p></li>
                            <li><p>London</p></li>
                            <li><p>ERT 546</p></li>
                            <li><p>United Kingdom</p></li>
                          </ul>
                        </div>
                      </div>
                        <hr>
                        <div class="back-to-user-dash mt-30">
                          <a href="" class="ls-md-btn">Back</a>
                        </div>                      

                  </div>

                  
                </div>

            </div>
          </div>
        </div>  
      </div>    
@endsection
@section('pagelevel_scripts')
@endsection
  