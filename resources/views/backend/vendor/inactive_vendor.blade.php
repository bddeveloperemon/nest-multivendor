@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Inactive Vendors
@endsection
@section('admin_content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All Inactive Vendor</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Inactive Vendor</li>
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
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th>SL</th>
                                    <th>Shop Name</th>
                                    <th>Vendor UserName</th>
                                    <th>Vendor Email</th>
                                    <th>Join Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($inactive_vendors as $inactive_vendor)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $i++ }}</td>
                                        <td>{{ $inactive_vendor->name }}</td>
                                        <td>{{ $inactive_vendor->username }}</td>
                                        <td>{{ $inactive_vendor->email }}</td>
                                        <td>{{ $inactive_vendor->vendor_join }}</td>
                                        <td>
                                            @if ($inactive_vendor->status === 'active')
                                                <span class="btn btn-success btn-sm">{{ $inactive_vendor->status }}</span>
                                            @elseif($inactive_vendor->status === 'inactive')
                                                <span class="btn btn-danger btn-sm">{{ $inactive_vendor->status }}</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.inactive.vendorDetails',$inactive_vendor->id) }}" class="btn btn-info btn-sm">Vendor Details</a>
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