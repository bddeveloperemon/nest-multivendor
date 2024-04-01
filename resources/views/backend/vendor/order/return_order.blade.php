@extends('backend.vendor.dashboard')
@section('vendor_title')
    Vendor Return Orders
@endsection
@section('vendor_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Vendor Return Order</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Return Order</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;"
                                role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($orderItems as $order)
                                        @if ($order->order->return_order == 1)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i++ }}</td>
                                                <td>{{ $order->order->order_date }}</td>
                                                <td>{{ $order->order->invoice_no }}</td>
                                                <td>${{ $order->order->amount }}</td>
                                                <td>{{ $order->order->payment_method }}</td>
                                                <td>
                                                    @if ($order->order->return_order == 1)
                                                        <span class="badge rounded-pill bg-danger">Return</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-success">Done</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->order->return_reason }}</td>
                                                <td>
                                                    <a href="{{ route('vendor.order.details', $order->order->id) }}"
                                                        class="btn btn-info btn-sm" title="details"><i
                                                            class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @else
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
