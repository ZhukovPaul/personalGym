 
   
    
    <div class="account-wrap">
        <div class="account-item account-item--style2 clearfix js-item-menu">
            <div class="image">
                <img src="{{$user->imageSmall}}" alt="{{$user->name}}" />
            </div>
            <div class="content">
                <a class="js-acc-btn" href="{{route('personalindex')}}">{{$user->name}}</a>
            </div>
            <div class="account-dropdown js-dropdown">
                <div class="info clearfix">
                    <div class="image">
                        <a href="{{route('personalindex')}}">
                            <img src="{{$user->imageMiddle}}" alt="{{$user->name}}" />
                        </a>
                    </div>
                    <div class="content">
                        <h5 class="name">
                            <a href="{{route('personalindex')}}">{{$user->name}} {{$user->lastname}}</a>
                        </h5>
                        <span class="email">{{$user->email}}</span>
                    </div>
                </div>
                <div class="account-dropdown__body">
                    <div class="account-dropdown__item">
                        <a href="{{route('personalindex')}}">
                            <i class="zmdi zmdi-account"></i>{{__("componentAccountMenu.account")}}</a>
                    </div>
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-settings"></i>{{__("componentAccountMenu.settings")}}</a>
                    </div>
                    <!--div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                    </div-->
                </div>
                <div class="account-dropdown__footer">
                    <a   href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" >
                        <i class="zmdi zmdi-power"></i>{{__("componentAccountMenu.logout")}}</a>
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
 