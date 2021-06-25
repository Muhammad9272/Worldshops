      <footer class="ps-footer ps-footer--photo">
        <div class="container-fluid">
          <div class="ps-footer__wrapper">
            <div class="ps-footer__content">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                  <div class="row">

                    <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12 ">
                      <aside class="widget widget_footer widget-footer-one">
                        <div class="widget-logo">
                          <a href="{{ route('front.index') }}" class="logo-link">
                          <img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt=""></a>
                        </div>
                        <div class="content mt-10">
                          <p>{!! $gs->footer !!}</p>
                          <p class="mt-40 mb-0">Stay up to date on the latest news and promotions and follow us on:</p>
                                  <ul class="ps-list--social mt-0">
                                    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fa fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                      </li>
                                      @endif
                            </ul>
                        </div>
                      </aside>
                    </div>


                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                      <aside class="widget widget_footer">
                        <h4 class="widget-title">Quick links</h4>
                        <ul class="ps-list--link">
                         {{--  <li><a href="" data-toggle="modal" data-target="#ShopNowModal">Shop Now</a></li> --}}
                          <li><a href="{{route('front.index')}}" >Shop Now</a></li>
                          @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
                            <li>
                              <a href="{{ route('front.page',$data->slug) }}">
                                {{ $data->title }}
                              </a>
                            </li>
                          @endforeach
                          @if($gs->is_contact == 1)
                          <li><a href="{{route('front.contact')}}">Contact</a></li>
                          @endif
                        </ul>
                      </aside>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                      <aside class="widget widget_footer">
                        <h4 class="widget-title">Opening Hours</h4>
                        <ul class="ps-list--link">
                          <li><a href="{{route('front.support')}}">Customer Services</a></li>
                          <li class="text-white">Monday - Friday: 09:00 - 20:20</li>
                          <li  class="text-white">Saturday - Sunday: 09:00 - 20:20</li>
                          <li><a href="{{route('front.index')}}">Stores</a></li>
                          <li><a href="{{route('front.coming-soon')}}">Various Opening Times</a></li>
                        </ul>
                      </aside>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="ps-footer__copyright">
            <p>{!! $gs->copyright !!}</p>
            <p><span>We Using Safe Payment For:</span>
              <a href="#"><img src="{{asset('assets/front/img/Mastercard.png')}}" alt=""></a>
              <a href="#"><img src="{{asset('assets/front/img/visa-logo.png')}}" alt=""></a>
              <a href="#"><img src="{{asset('assets/front/img/American_Express.png')}}" alt=""></a>
             </p>
          </div>
        </div>
      </footer>