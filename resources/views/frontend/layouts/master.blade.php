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
    <!-- sweetalert  JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
    <script type="text/javascript">
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
            var product_name = $('#pName').text();
            var id = $('#product_id').val();
            var color = $('#color_area option:selected').text();
            var size = $('#size_area option:selected').text();
            var qty = $('#qty').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    product_name: product_name,
                    color: color,
                    size: size,
                    qty: qty,
                },
                url: '/add-to-cart/store/' + id,
                success: function(data) {
                    miniCart();
                    $('#closeModal').click();
                    // console.log(data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        });
                    }
                }
            });
        }
        // add to cart product details
        function addToCartDetails() {
            var product_name = $('#dpName').text();
            var id = $('#dproduct_id').val();
            var color = $('#color_area option:selected').text();
            var size = $('#dsize_area option:selected').text();
            var qty = $('#dqty').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    product_name: product_name,
                    color: color,
                    size: size,
                    qty: qty,
                },
                url: '/add-to-cart/details/store/' + id,
                success: function(data) {
                    miniCart();
                    // console.log(data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        });
                    }
                }
            });
        }

        // show add to cart product in mini cart
        function miniCart() {
            $.ajax({

                type: 'GET',
                dataType: 'json',
                url: '/product/mini-cart',
                success: function(response) {
                    // console.log(response);
                    $('#cartQty').text(response.cartqty);
                    $('span[id="cartSubTotal"]').text(response.cartTotal);

                    var miniCart = "";
                    $.each(response.carts, function(key, value) {
                        miniCart += `<ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="${value.name}"
                                                    src="{{ asset('upload/product_images/thambnail') }}/${value.options.image}" style="width:50px; height:50px;" /></a>
                                            </div>
                                            <div class="shopping-cart-title" style="margin: -73px 74px 14px; width:146px;">
                                                <h4><a href="shop-product-right.html">${value.name}</a></h4>
                                                <h4><span>${value.qty} × </span>ট ${value.price}</h4>
                                            </div>
                                            <div class="shopping-cart-delete" style="margin: -85px 1px 0;">
                                                <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul> <hr><br>`;
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();

        // Mini cart remove
        function miniCartRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/product/mini-cart/remove/' + id,
                success: function(data) {
                    miniCart();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        });
                    }
                }
            })
        }

        // add to wishlist
        function addToWishlist(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/add-to-wishlist/' + product_id,
                success: function(data) {
                    wishList();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: "success",
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: "error",
                            title: data.error,
                        });
                    }
                }
            })
        }
        // Load wishlist product data
        function wishList() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/wishlist-products/',
                success: function(response) {
                    $('#wishQty').text(response.wishQty);
                    var rows = "";
                    $.each(response.wishlist, function(key, value) {
                        rows += `<tr class="pt-30">
                                    <td class="custome-checkbox pl-30"></td>
                                    <td class="image product-thumbnail pt-40"><img alt="${value.product.product_name}"
                                        src="{{ asset('upload/product_images/thambnail') }}/${value.product.product_thambnail}" style="width:100px; height:100px;" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        ${value.product.discount_price == null
                                            ? `<h3 class="text-brand">ট${value.product.selling_price}</h3>`
                                            : `<h3 class="text-brand">ট${value.product.discount_price}</h3>`
                                        }
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        ${value.product.product_qty > 0
                                            ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                            : `<span class="stock-status out-stock mb-0"> Stock Out </span>`
                                        }                                        
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a type="submit" id="${value.id}" onclick="wishlistRemove(this.id)" class="text-body"><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>`;
                    });
                    $('#wishlist').html(rows);
                }
            })
        }
        wishList();



        // wishlist remove function
        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/wishlist-remove/' + id,
                success: function(data) {
                    wishList();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: "success",
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: "error",
                            title: data.error,
                        });
                    }
                }
            })
        }
    </script>
</body>

</html>
