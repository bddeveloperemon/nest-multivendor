@extends('backend.admin.dashboard')
@section('admin_title')
    Order Details
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin Order Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.pending.order') }}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr>
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Shipping Details</h4>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-striped table-bordered" style="background: #F4F6FA; font-weight:600">
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
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Details
                        <span class="text-info float-end fw-bold">Invoice :
                            {{ $order->invoice_no }}</span>
                    </h4>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-striped table-bordered" style="background: #F4F6FA; font-weight:600">
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
                                    <span class="badge rounded-pill bg-info"
                                        style="font-size: 12px">{{ $order->status }}</span>
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    @if ($order->status == 'pending')
                                        <a href="{{ route('admin.pending.confirm', $order->id) }}" class="btn btn-success"
                                            id="confirm">Confirm
                                            Order</a>
                                    @elseif ($order->status == 'confirm')
                                        <a href="{{ route('admin.confirm.processing', $order->id) }}"
                                            class="btn btn-success" id="processing">Processing Order</a>
                                    @elseif ($order->status == 'processing')
                                        <a href="{{ route('admin.processing.deliverd', $order->id) }}"
                                            class="btn btn-success" id="deliverd">Deliverd Order</a>
                                    @endif
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">
                            <label for="">Image</label>
                        </th>
                        <th class="col-md-2">
                            <label for="">Product Name</label>
                        </th>
                        <th class="col-md-1">
                            <label for="">Vendor Name</label>
                        </th>
                        <th class="col-md-2">
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
                        <th class="col-md-3">
                            <label for="">Price</label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItem as $item)
                        <tr>
                            <td class="col-md-1">
                                <label for=""><img
                                        src="{{ asset('upload/product_images/thambnail/' . $item->product->product_thambnail) }}"
                                        alt="{{ $item->product->product_name }}" style="width:100px; height:100px"></label>
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

                            <td class="col-md-2">
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
                            <td class="col-md-3">
                                <label for="">${{ $item->price }} <br> <span class="fw-bold">Total</span> =
                                    ${{ $item->price * $item->qty }}</label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
