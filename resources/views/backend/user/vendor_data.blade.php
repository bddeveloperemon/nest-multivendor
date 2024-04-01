@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - All Vendor Data
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Vendor Data</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Vendor Data</li>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($vendors as $vendor)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>
                                                @if (!empty($vendor->image))
                                                    <img src="{{ asset('upload/vendor_images/' . $vendor->image) }}"
                                                        alt="{{ $vendor->name }}" class="rounded p-1" width="60px"
                                                        height="60px">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/avatars/avatar-500.png') }}"
                                                        alt="Vendor" class="rounded-circle p-1" width="100">
                                                @endif
                                            </td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->email }}</td>
                                            <td>{{ $vendor->phone }}</td>
                                            <td>
                                                <span class="badge badge-pill bg-success">{{ $vendor->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delete.subcategory', $vendor->id) }}"
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
