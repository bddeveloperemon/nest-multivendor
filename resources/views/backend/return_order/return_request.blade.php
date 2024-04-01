@extends('backend.admin.dashboard')
@section('admin_title')
    Return Orders
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Return Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Return Orders</li>
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
                                    @foreach ($orders as $order)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->invoice_no }}</td>
                                            <td>${{ $order->amount }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                @if ($order->return_order == 1)
                                                    <span class="badge rounded-pill bg-danger">Pending</span>
                                                @elseif ($order->return_order == 1)
                                                    <span class="badge rounded-pill bg-success">Success</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->return_reason }}</td>
                                            <td>
                                                <a href="{{ route('admin.order.details', $order->id) }}"
                                                    class="btn btn-info" title="details"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.return.approve', $order->id) }}" id="approve"
                                                    class="btn btn-danger" title="Approve"><i
                                                        class="fa-solid fa-person-circle-check"></i></a>
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
@endsection
