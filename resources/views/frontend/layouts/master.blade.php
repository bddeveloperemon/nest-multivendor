<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.layouts.quick-view')
    <!-- Header  -->
    @include('frontend.layouts.header')
    <!-- End Header  -->
    @include('frontend.layouts.mobile-header')
    <main class="main">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // product view with modal
        function productView(id) {
            // alert(id);
            $.ajax({
                type: "GET",
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#pName').text(data.product.product_name);
                    $('#pCategory').text(data.product.category.category_name);
                    $('#pBrand').text(data.product.brand.brand_name);
                    $('#pPrice').text(data.product.selling_price);
                    $('#pCode').text(data.product.product_code);
                    $('#pImage').attr('src', "{{ asset('upload/product_images/thambnail') }}/" + data.product
                        .product_thambnail);
                    $('#product_id').val(id);
                    $('#qty').val(1);
                    // price
                    if (data.product.discount_price == null) {
                        $('#pPrice').text('');
                        $('#oldPrice').text('');
                        $('#pPrice').text(data.product.selling_price);
                    } else {
                        $('#pPrice').text(data.product.discount_price);
                        $('#oldPrice').text(data.product.selling_price);
                    }
                    if (data.product.product_qty > 0) {
                        $('#available').text('');
                        $('#stockout').text('');
                        $('#available').text('available');
                    } else {
                        $('#available').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    }
                    // size and color
                    $('select[name="product_size"]').empty();
                    $('select[name="product_color"]').empty();
                    $.each(data.size_area, function(key, value) {
                        $('select[name="product_size"]').append('<option value="' + value + '">' +
                            value + '</option>');
                        if (data.size_area == "") {
                            $('#size_area').hide();
                        } else {
                            $('#size_area').show();
                        }
                    })
                    $.each(data.color_area, function(key, value) {
                        $('select[name="product_color"]').append('<option value="' + value + '">' +
                            value + '</option>');
                        if (data.color_area == "") {
                            $('#color_area').hide();
                        } else {
                            $('#color_area').show();
                        }
                    })
                }
            })
        }

        // add to cart product
        function addToCart() {
            let product_name = $('#pName').text();
            let id = $('#product_id').val();
            let color = $('#color_area option:selected').text();
            let size = $('#size_area option:selected').text();
            let qty = $('#qty').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    color: color,
                    product_name: product_name,
                    size: size,
                    qty: qty,
                },
                url: '/add-to-cart/store' + id,
                success: function(data) {
                    console.log(data);
                }
            })
        }
    </script>
</body>

</html>
