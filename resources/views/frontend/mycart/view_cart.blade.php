@extends('frontend.layouts.master')
@section('title')
    My Cart
@endsection
@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{ $products }}</span> products in your
                        cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox pl-30">
                                </th>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="cartPage">

                        </tbody>
                    </table>
                </div>

                <div class="row mt-50">

                    <div class="col-lg-5">
                        @if (Session::has('coupon'))
                        @else
                            <div class="p-40" id="coupon_field">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" id="cupon_name"
                                            placeholder="Enter Your Coupon">
                                        <a class="btn btn-success" onclick="applyCoupon()" type="submit"><i
                                                class="fi-rs-lable mr-10">Apply</i></a>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>

                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody id="couponCalField">
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('checkout') }}" class="btn mb-20 w-100">Proceed To CheckOut<i
                                    class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        // Load cart product in view_cart page
        function viewCart() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/my-cart-product',
                success: function(response) {
                    var rows = "";
                    $.each(response.carts, function(key, value) {
                        rows += `<tr class="pt-30">
                                <td class="custome-checkbox pl-30">
                                </td>
                                <td class="image product-thumbnail pt-40"><img src="{{ asset('upload/product_images/thambnail') }}/${value.options.image}"
                                        alt="#"></td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading"
                                            href="shop-product-right.html">${value.name}</a></h6>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">$${value.price} </h4>
                                </td>
                                <td class="price" data-title="Price">
                                    ${value.options.color == null
                                        ?`<span>...</span>`
                                        :`<h6 class="text-body">${value.options.color} </h6>`
                                    }
                                    
                                </td>
                                <td class="price" data-title="Price">
                                    ${value.options.size == null
                                        ?`<span>...</span>`
                                        :`<h6 class="text-body">${value.options.size} </h6>`
                                    }
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="detail-qty border radius">
                                            <a type="submit" class="qty-down" onclick="cartDecrement(this.id)" id="${value.rowId}"><i class="fi-rs-angle-small-down"></i></a>
                                            <input type="text" name="quantity" class="qty-val" value="${value.qty}"
                                                min="1">
                                            <a type="submit" class="qty-up" onclick="cartIncrement(this.id)" id="${value.rowId}"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">$${value.subtotal} </h4>
                                </td>
                                <td class="action text-center" data-title="Remove"><a type="submit" onclick="viewCartRemove(this.id)" id="${value.rowId}" class="text-body"><i
                                            class="fi-rs-trash"></i></a></td>
                            </tr>`;
                    });
                    $('#cartPage').html(rows);
                }
            })
        }
        viewCart();

        // view cart remove function
        function viewCartRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/cart-remove/' + id,
                success: function(data) {
                    viewCart();
                    miniCart();
                    couponCalculation();
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

        // cart decrement
        function cartDecrement(id) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + id,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    viewCart();
                    miniCart();
                }
            })
        }

        // cart increment
        function cartIncrement(id) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + id,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    viewCart();
                    miniCart();
                }
            })
        }

        // apply coupon
        function applyCoupon() {
            let cupon_name = $('#cupon_name').val();
            // console.log(cupon_name);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    cupon_name: cupon_name
                },
                url: '/apply-coupon',
                success: function(data) {
                    couponCalculation();
                    if (data.validity == true) {
                        $('#coupon_field').hide();
                    }
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

        // coupon calculation
        function couponCalculation() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/coupon-calculation',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$ ${data.total}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$ ${data.total}</h4>
                                </td>
                            </tr>`
                        );
                    } else {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$ ${data.subtotal}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h5 class="text-brand text-end">${data.cupon_name} <a onclick="removeCoupon()" type="submit"><i class="fi-rs-trash"></i></a></h5>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Discount Amount</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$ ${data.discount_amount}.00</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$ ${data.total_amount}.00</h4>
                                </td>
                            </tr>`
                        );
                    }
                }
            })
        }
        couponCalculation();

        // Remove Coupon 
        function removeCoupon() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/remove-coupon',
                success: function(data) {
                    couponCalculation();
                    // $('#couponCalField').show();
                    $('#coupon_field').show();
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
@endpush
