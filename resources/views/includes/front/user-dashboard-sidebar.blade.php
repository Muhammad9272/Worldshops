                

                <div class="mobile-panl wsn-u-sidebar">
                  <div class="ws-user-avatar">
                      @php 
                      $user=Auth::user();
                      @endphp
                    @if(Auth::user()->is_provider == 1)
                      <img src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                    @else
                      <img src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}" alt="" class="your_picture_image">
                    @endif

                   <p><strong>{{$user->name}}</strong></p>
                  </div>


                   <ul class="user-dash-li-item" id="ws-ac-side">
                      <li class="">
                        <a class="ws-user-mn" href="{{route('user-orders')}}"><i class="fa fa-opencart"></i>
                        Your Orders</a>
                      </li>

                      <li class="">
                        <a class="ws-user-mn" href="{{route('user.addressbook.index')}}">
                          <i class="fa fa-map-marker"></i> Address Book</a></li>
                      <li class=""><a class="ws-user-mn" href="{{route('user.savedcard.index')}}">
                        <i class="fa fa-credit-card"></i>
                      Saved Cards</a></li>
                      <li class=""><a class="ws-user-mn" href="{{route('user-profile')}}">
                        <i class="icon-user"></i>
                      Account Details</a></li>
                      <li class=""><a class="ws-user-mn" href="{{route('user.marketing.preference')}}">
                        <i class="fa fa-envelope-o"></i>
                      Marketing Preferences</a></li>
                      <li class=""><a class="ws-user-mn" href="{{route('user.refer.friend')}}">
                        <i class="fa fa-handshake-o"></i>Refer a Friend</a></li>       
                      @if(Auth::user()->is_provider != 1)
                      <li class=""><a class="ws-user-mn" href="{{route('user-reset')}}">
                        <i class="fa fa-lock"></i>Change Password</a></li>  
                      @endif             
                   </ul>
                 </div>
                 