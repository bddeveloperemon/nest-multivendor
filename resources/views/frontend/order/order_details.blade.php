@extends('frontend.layouts.auth_master')
@section('auth_title')
    User Order Details
@endsection
@section('auth_content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Order Details
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        @include('frontend.layouts.dashboard_sidebar_menu')

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Shipping Details</h4>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered"
                                                style="background: #F4F6FA; font-weight:600">
                                                <thead>
                                                    <tr>
                                                        <th>Shipping Name:</th>
                                                        <th>{{ $order->name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping Phone:</th>
                                                        <th>{{ $order->phone }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping Email:</th>
                                                        <th>{{ $order->email }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping Address:</th>
                                                        <th>{{ $order->address }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Division:</th>
                                                        <th>{{ $order->division->division_name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>District:</th>
                                                        <th>{{ $order->district->district_name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>State:</th>
                                                        <th>{{ $order->state->state_name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Post Code:</th>
                                                        <th>{{ $order->post_code }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Date:</th>
                                                        <th>{{ $order->order_date }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Order Details
                                                <span class="text-info float-end fw-bold">Invoice :
                                                    {{ $order->invoice_no }}</span>
                                            </h4>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered"
                                                style="background: #F4F6FA; font-weight:600">
                                                <thead>
                                                    <tr>
                                                        <th>Name:</th>
                                                        <th>{{ $order->user->name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone:</th>
                                                        <th>{{ $order->user->phone }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Type:</th>
                                                        <th>{{ $order->payment_method }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Transx Id:</th>
                                                        <th>{{ $order->transaction_id }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Invoice:</th>
                                                        <th class="text-info">{{ $order->invoice_no }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Amount:</th>
                                                        <th>${{ $order->amount }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Status:</th>
                                                        <th>
                                                            <span
                                                                class="badge rounded-pill bg-warning">{{ $order->status }}</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-2">
                                <label for="">Image</label>
                            </th>
                            <th class="col-md-2">
                                <label for="">Product Name</label>
                            </th>
                            <th class="col-md-2">
                                <label for="">Vendor Name</label>
                            </th>
                            <th class="col-md-1">
                                <label for="">Product Code</label>
                            </th>
                            <th class="col-md-1">
                                <label for="">Color</label>
                            </th>
                            <th class="col-md-1">
                                <label for="">Size</label>
                            </th>
                            <th class="col-md-1">
                                <label for="">Quantity</label>
                            </th>
                            <th class="col-md-2">
                                <label for="">Price</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItem as $item)
                            <tr>
                                <td class="col-md-2">
                                    <label for=""><img
                                            src="{{ asset('upload/product_images/thambnail/' . $item->product->product_thambnail) }}"
                                            alt="{{ $item->product->product_name }}"
                                            style="width:100px; height:100px"></label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{ $item->product->product_name }}</label>
                                </td>
                                @if ($item->vendor_id == null)
                                    <td class="col-md-2">
                                        <label for="">Owner</label>
                                    </td>
                                @else
                                    <td class="col-md-2">
                                        <label for="">{{ $item->product->vendor->name }}</label>
                                    </td>
                                @endif

                                <td class="col-md-1">
                                    <label for="">{{ $item->product->product_code }}</label>
                                </td>
                                @if ($item->color == null)
                                    <td class="col-md-1">
                                        <label for="">.....</label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label for="">{{ $item->color }}</label>
                                    </td>
                                @endif
                                @if ($item->size == null)
                                    <td class="col-md-1">
                                        <label for="">.....</label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label for="">{{ $item->size }}</label>
                                    </td>
                                @endif


                                <td class="col-md-1">
                                    <label for="">{{ $item->qty }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">${{ $item->price }} <br> <span class="fw-bold">Total</span> =
                                        ${{ $item->price * $item->qty }}</label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Return Order Option --}}
            @if ($order->status !== 'deliverd')
            @else
                @php
                    $order = App\Models\Order::where('id', $order->id)
                        ->where('return_reason', '=', null)
                        ->first();
                @endphp
                @if ($order)
                    <form action="{{ route('return.order', $order->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label id="return_reason" class="form-label fw-bold text-dark">Order Return Reason</label>
                            <textarea name="return_reason" id="return_reason" class="form-control" style="width: 40%;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm mb-2">Order Return</button>
                    </form>
                @else
                    <h5><span class="badge badge-pill bg-danger">You have already send return request for this
                            product!</span> <br><br>
                    </h5>
                @endif
            @endif

        </div>
    </div>
@endsection
