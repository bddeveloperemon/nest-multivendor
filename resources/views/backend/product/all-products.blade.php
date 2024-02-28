@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Product List
@endsection
@section('admin_content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All Products</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Products List</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.add.product') }}" class="btn btn-primary btn-sm">Add Product</a>
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
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($products as $product)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $i++ }}</td>
                                        <td>
                                            @if (!empty($product->product_thambnail))
                                                <img src="{{ asset('upload/product_images/thambnail/'.$product->product_thambnail) }}" class="rounded-circle" alt="Brand" width="50">
                                            @else
                                                <img src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}" class="rounded-circle" alt="Brand" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_qty }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>{{ $product->discount_price }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.category',$product->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ route('admin.delete.category',$product->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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