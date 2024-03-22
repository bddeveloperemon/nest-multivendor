@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Coupon List
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Cupons</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Cupons</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.cupon') }}" class="btn btn-primary btn-sm">Add Cupon</a>
            </div>
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
                                        <th>Cupon Name</th>
                                        <th>Cupon Discount(%)</th>
                                        <th>Cupon Validity</th>
                                        <th>Cupon Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($cupons as $Cupon)
                                        <tr role="row" class="odd">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $Cupon->cupon_name }}</td>
                                            <td>{{ $Cupon->cupon_discount }}%</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($Cupon->cupon_validity)->format('D, d M Y') }}
                                            </td>
                                            <td>
                                                @if ($Cupon->cupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                    <span class="badge rounded-pill bg-success">Valid</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">Invalid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.coupon', $Cupon->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.delete.coupon', $Cupon->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete">Delete</a>
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
