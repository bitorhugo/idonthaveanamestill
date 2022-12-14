<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="{{ route('home') }}">
                    <img src="{{asset('images/icon/logo-white.png')}}" alt="CoolAdmin"/>
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub">
                        <a href=" {{ route('users.index') }} ">
                            <i class="fas fa-tachometer-alt"></i>Users
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li>
                        <a href=" {{ route('cards.index') }} ">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="bot-line"></span>Cards</a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}">
                            <i class="fas fa-trophy"></i>
                            <span class="bot-line"></span>Category</a>
                    </li>
                </ul>
            </div>
            <div class="header__tool">

                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix">
                        <div class="image">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Show"
                                    onclick="event.preventDefault();
                                document.getElementById('show-logged-user-form').submit();">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    @if(Storage::disk('media')->exists('App/Models/User/' . Auth::user()->id))
                                        <img src="{{asset('storage/media/App/Models/User/' . Auth::user()->id . '/conversion/' . Auth::user()->id .'-thumb.jpg')}}" alt=''>
                                    @else
                                        <img src="{{asset('storage/baseImage.jpg')}}" alt='image'>
                                    @endif
                            </button>
                        </div>
                
                    </div>
                </div>

                <div class="header-button-item js-item-menu p-l-20">
                    <a href="" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <form id="show-logged-user-form" action="{{ route('users.show', ['user' => Auth::user()->id]) }}" method="GET" class="d-none"></form>
</header>
<!-- END HEADER DESKTOP-->
