    <!-- Header -->

    <style type="text/css">
    .notificationaa{ border-radius: 30px;
        position: absolute;
        top: -11.2px;
        top: -0.8rem;
        right: 0;
        background-color: #4aa36b;
        color: #fff;
        font-weight: 600;
        font-size: 9.799px;
        font-size: 0.7rem;
        display: inline-block;
        padding: 0.15rem 0.3rem 0.2rem 0.35rem;
        line-height: 1; }</style>
    <header id="header" class="light">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!-- Logo -->
                    <div class="module module-logo dark">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('image/setting/'.$setting->logo) }}" alt="Logo" >
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- Navigation -->
                    <nav class="module module-navigation left mr-4">
                        <ul id="" class="nav nav-main">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about-us') }}">About</a></li>
                            <li><a href="{{ URL::to('category/menu') }}">Menu</a></li>
                            
                            <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                           
                    
                        </ul>
                    </nav>
                    <div class="module left">
                        <a href="#odder" data-toggle="modal" class="btn btn-outline-secondary"><span>Book A Table</span></a>
                    </div>
                </div>

                <div class="col-md-2">

                        @if (Auth::guest())
                            <a class="module module-cart"  href="{{ route('login') }}" title="login"><span class="cart-icon"><i class="ti ti-power-off"></i></span></a>

                           <a class="module module-cart"  href="{{ route('register') }}" title="register"><span class="cart-icon"><span class="cart-value"><i class="ti ti-user"></i></span></span></a>
                        @else
                        <nav class="module module-navigation left mr-4">
                            <ul id="nav-main" class="nav nav-main">
                            <li class="has-dropdown">
                                <a href="#"><i class="ti ti-user"></i>({{ Auth::user()->username }})</a>
                                <div class="dropdown-container">
                                    <ul class="dropdown-mega">
                                        <li><a href="<?php echo URL::to('/').'/dashboard'; ?>">Dashboard</a></li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                        @endif
                </div>

                <div class="col-md-2">

                        
                    @if (Auth::guest())
                        <a href="{{ route('login') }}" class="module module-cart right">
                            <span class="cart-icon">
                                <i class="ti ti-shopping-cart"></i>
                                <span class="notificationaa">0</span>
                            </span>
                            <span class="cart-value">{{getSiteCurrencyType()}}<span class="notification_amountrrt">
                            0</span></span>
                        </a>                    
                    @else
                    <a href="#" class="module module-cart right productfrontcartdetail" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notificationaa"><?php echo (Session::has('cart_count'))?Session::get('cart_count'):$cart_count;?></span>
                        </span>
                        <span class="cart-value">{{getSiteCurrencyType()}}<span class="notification_amount">
                        {{$cart_amount}}</span></span>
                    </a>
                    @endif
                </div>
                
            </div>
        </div>

    </header>
    <!-- Header / End -->

    <!-- Header -->
    <header id="header-mobile" class="light">

        <div class="module module-nav-toggle">
            <a href="#" id="nav-toggle" data-toggle="panel-mobile"><span></span><span></span><span></span><span></span></a>
        </div>

        <div class="module module-logo">
            <a href="index.html">
                <img src="assets/img/logo-horizontal-dark.svg" alt="">
            </a>
        </div>

        <a href="#" class="module module-cart" data-toggle="panel-cart">
            <i class="ti ti-shopping-cart"></i>
            <span class="notificationaa">0</span>
        </a>

    </header>
    <!-- Header / End -->