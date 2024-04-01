@extends('backend.admin.dashboard')
@section('admin_title')
    Report Orders
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Order Report By Year</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Order Report</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <h4>Search By Year: <span class="text-info">{{ $year }}</span></h4>
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
                                                <span class="badge rounded-pill bg-success">{{ $order->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.order.details', $order->id) }}"
                                                    class="btn btn-info btn-sm" title="details"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.invoice.download', $order->id) }}"
                                                    class="btn btn-success btn-sm" title="Invoice PDF"><i
                                                        class="fa fa-download"></i></a>
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
