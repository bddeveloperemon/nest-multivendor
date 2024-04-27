<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>

                            <li><a href="{{ route('myCart') }}">My Cart</a></li>
                            <li><a href="{{ route('checkout') }}">Checkout</a></li>
                            <li><a href="{{ route('track.your.order') }}">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>

                            <li>
                                <a class="language-dropdown-active" href="#">English <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('frontend/assets/imgs/theme/flag-fr.png') }}"
                                                alt="" />Français</a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('frontend/assets/imgs/theme/flag-dt.png') }}"
                                                alt="" />Deutsch</a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('frontend/assets/imgs/theme/flag-ru.png') }}"
                                                alt="" />Pусский</a>
                                    </li>
                                </ul>
                            </li>

                            <li>Need help? Call Us: <strong class="text-brand"> + 1800 900</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                @php
                    $setting = App\Models\SiteSetting::find(1);
                @endphp
                <div class="logo logo-width-1">
                    <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                @php
                    $categories = App\Models\Category::orderBy('category_name', 'asc')
                        ->select('id', 'category_name')
                        ->get();
                @endphp
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <select class="select-active">
                                <option>All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                id="search" placeholder="Search for items..." />
                            <div id="searchProduct"></div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Location</option>
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Delaware</option>
                                        <option>Florida</option>
                                        <option>Georgia</option>
                                        <option>Hawaii</option>
                                        <option>Indiana</option>
                                        <option>Maryland</option>
                                        <option>Nevada</option>
                                        <option>New Jersey</option>
                                        <option>New Mexico</option>
                                        <option>New York</option>
                                    </select>
                                </form>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg') }}" />
                                    <span class="pro-count blue" id="compareQty">0</span>
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable">Compare</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue" id="wishQty">0</span>
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('myCart') }}">
                                    <img alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>
                                <a href="{{ route('myCart') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    {{-- mini cart with ajax start --}}
                                    <div id="miniCart"></div>
                                    {{-- mini cart with ajax end --}}
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span id="cartSubTotal"></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('myCart') }}" class="outline">View Cart</a>
                                            <a href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="{{ route('dashboard') }}">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                @guest
                                    <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                    <span class="lable" style="margin-left:2px;margin-right:2px;"> | </span>
                                    <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
                                @endguest
                                @auth
                                    <a href="{{ route('dashboard') }}"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My
                                                    Account</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i
                                                        class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-label mr-10"></i>My
                                                    Voucher</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-heart mr-10"></i>My
                                                    Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i
                                                        class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.logout') }}"><i
                                                        class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $categories = App\Models\Category::orderBy('category_name', 'asc')
            ->select('id', 'category_name', 'category_slug', 'category_image')
            ->get();
    @endphp
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}"
                            alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach ($categories as $item)
                                        @if ($loop->index < 5)
                                            <li>
                                                <a href="{{ url('/product/category/' . $item->id) }}"> <img
                                                        src="{{ asset('upload/category_images/' . $item->category_image) }}"
                                                        alt="{{ $item->category_name }}" />{{ $item->category_name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach ($categories as $item)
                                        @if ($loop->index > 4)
                                            <li>
                                                <a href="{{ url('/product/category/' . $item->id) }}"> <img
                                                        src="{{ asset('upload/category_images/' . $item->category_image) }}"
                                                        alt="{{ $item->category_name }}" />{{ $item->category_name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show
                                    more...</span></div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                @php
                                    $categories = App\Models\Category::orderBy('category_name', 'asc')
                                        ->limit(5)
                                        ->select('id', 'category_name')
                                        ->get();
                                @endphp
                                <li>
                                    <a class="active" href="{{ url('/') }}">Home </a>

                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ url('/product/category/' . $category->id) }}">{{ $category->category_name }}
                                            <i class="fi-rs-angle-down"></i></a>
                                        @php
                                            $subcategories = App\Models\SubCategory::orderBy('sub_category_name', 'asc')
                                                ->where('category_id', $category->id)
                                                ->select('id', 'category_id', 'sub_category_name', 'sub_category_slug')
                                                ->get();
                                        @endphp
                                        <ul class="sub-menu">
                                            @foreach ($subcategories as $subcategory)
                                                <li><a
                                                        href="{{ url('/product/subcategory/' . $subcategory->id . '/' . $subcategory->sub_category_slug) }}">{{ $subcategory->sub_category_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('home.blog') }}">Blog</a>
                                </li>
                                <li>
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.sv') }}g" alt="hotline" />
                    <p>{{ $setting->support_phone }}<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img alt="Nest"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest"
                                                    src="{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest"
                                                    src="{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                            <h3><span>1 × </span>$3500.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('myCart') }}">View cart</a>
                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    #searchProduct {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>
<script>
    function search_result_show() {
        $('#searchProduct').slideDown();
    }

    function search_result_hide() {
        $('#searchProduct').slideUp();
    }
</script>
