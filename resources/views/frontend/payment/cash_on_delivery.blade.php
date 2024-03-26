@extends('frontend.layouts.master')
@section('title')
    Case On Delivery
@endsection
@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Case On Delivery
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Case On Delivery Payment</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order Details</h4>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @if (Session::has('coupon'))
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupn Name</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">{{ session()->get('coupon')['cupon_name'] }}
                                                ({{ session()->get('coupon')['cupon_discount'] }}%)</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Discount Amount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                ${{ session()->get('coupon')['discount_amount'] }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{ session()->get('coupon')['total_amount'] }}
                                            </h4>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Make Cash Payment</h4>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <form action="{{ route('cash.order') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <label for="card-element">
                                    <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                    <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                    <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                                    <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                    <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                    <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                    <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                </label>
                            </div>
                            <br>
                            <button class="btn btn-primary">Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
