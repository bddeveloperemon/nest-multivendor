@extends('frontend.layouts.auth_master')
@section('auth_title')
    Return Orders
@endsection
@section('auth_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> User Return Orders
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
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Return Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead class="fw-bold">
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Date</th>
                                                            <th>Total</th>
                                                            <th>Payment</th>
                                                            <th>Invoice</th>
                                                            <th>Return Reason</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($return_orders as $order)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $order->order_date }}</td>
                                                                <td>${{ $order->amount }}</td>
                                                                <td>{{ $order->payment_method }}</td>
                                                                <td>{{ $order->invoice_no }}</td>
                                                                <td>{{ $order->return_reason }}</td>
                                                                <td>
                                                                    @if ($order->return_order == 0)
                                                                        <span class="badge rounded-pill bg-info">No
                                                                            Return Request
                                                                        </span>
                                                                    @elseif ($order->return_order == 1)
                                                                        <span class="badge rounded-pill bg-warning">Pending
                                                                        </span>
                                                                    @elseif ($order->return_order == 2)
                                                                        <span class="badge rounded-pill bg-success">Success
                                                                        </span>
                                                                    @endif

                                                                </td>
                                                                <td><a href="{{ route('user.order.details', $order->id) }}"
                                                                        class="btn-sm btn-success fs-sm-2"><i
                                                                            class="fa fa-eye"></i> View</a>
                                                                    <a href="{{ route('user.invoice.download', $order->id) }}"
                                                                        class="btn-sm btn-info fs-sm-2"><i
                                                                            class="fa fa-download"></i> Invoice</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
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
    </div>
@endsection
@push('user_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--fontawesome js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
        integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
