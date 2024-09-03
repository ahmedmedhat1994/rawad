
<div class="nk-header nk-header-fixed is-light">
    <div class="container">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="{{route('frontend.index')}}" class="logo-link">
                    <img class="logo-light logo-img "  src="{{asset('frontend/logo.png')}}" srcset="{{asset('frontend/logo.png')}}" alt="logo" style="height:50px; max-height:50px !important;">
                    <img class="logo-dark logo-img" src="{{asset('frontend/logo.png')}}" srcset="{{asset('frontend/logo.png')}}" alt="logo-dark" style="height:50px; max-height:50px !important;">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu ms-auto" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="{{route('frontend.index')}}" class="logo-link">
                            <img class="logo-light logo-img" src="{{asset('frontend/logo.png')}}" srcset="{{asset('frontend/logo.png')}}" alt="logo">
                            <img class="logo-dark logo-img" src="{{asset('frontend/logo.png')}}" srcset="{{asset('frontend/logo.png')}}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    @foreach($shop_categories_menu as $cat)
                    <li class="nk-menu-item has-sub">
                        <a href="{{route('frontend.shop',$cat->slug)}}" class="nk-menu-link">
                            <span class="nk-menu-text">{{$cat->name}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @endforeach
                </ul><!-- .nk-menu -->

            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav refresh-cart">

                    @guest
                        <li class="dropdown">
                            <a href="{{route('customer.profile')}}" >
                                <div class="user-toggle">
                                    <div class="user-avatar sm bg-body">
                                        <span><em class="icon ni ni-user-switch fs-1 text-black"></em></span>
                                    </div>
                                </div>
                            </a>
                        </li><!-- .dropdown -->
                    @else
                    <li class="dropdown user-dropdown">
                        <a href="{{route('customer.profile')}}" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm bg-body">
                                    <span><em class="icon ni ni-user-alt fs-1 text-black"></em></span>
                                    <div class="status dot dot-lg dot-success"></div>

                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->fullName  }}</span>
                                        <span class="sub-text">{{ auth()->user()->email  }}</span>
                                    </div>
                                    <div class="user-action">
                                        <a class="btn btn-icon me-n2" href="{{route('frontend.index')}}"><em class="icon ni ni-setting"></em></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{route('customer.notifications')}}"><em class="icon ni ni-bell"></em><span>{{trans('frontend.notifications')}}</span></a></li>
                                    <li><a href="{{route('customer.orders')}}"><em class="icon ni ni-archived"></em><span>{{trans('frontend.orders')}}</span></a></li>
                                    <li><a href="{{route('customer.OrdersWaitPaid')}}"><em class="icon ni ni-cart"></em><span>{{trans('frontend.Orders wait Paid')}}</span></a></li>
                                    <li><a href="{{route('customer.favorite')}}"><em class="icon ni ni-star"></em><span>{{trans('frontend.favorite')}}</span></a></li>
                                    <li><a href="{{route('customer.profile')}}"><em class="icon ni ni-user"></em><span>{{trans('frontend.my profile')}}</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a class="text-danger" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>{{trans('frontend.sign out')}}</span></a></li>
                                </ul>
                                <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    @endguest
                        <li class="dropdown">
                            <a href="{{route('frontend.cart')}}" >
                                <div class="user-toggle">
                                <div class="user-avatar sm bg-body">
                                        <span><em class="icon ni ni-bag fs-1 text-black"></em></span>
                                    @if($cartListCount > 0)
                               <div class="status dot dot-lg dot-danger"></div>
                                    @endif
                                    </div>
                                </div>
                            </a>
                        </li><!-- .dropdown -->

                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
