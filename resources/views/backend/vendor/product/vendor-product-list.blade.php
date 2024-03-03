@extends('backend.vendor.dashboard')
@section('vendor_title')
    Vendor - Product List
@endsection
@section('vendor_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Products List:
                        @if (empty($products))
                            <span class="badge rounded-pill bg-danger">0</span>
                        @else
                            <span class="badge rounded-pill bg-success">{{ count($products) }}</span>
                        @endif
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('vendor.add.product') }}" class="btn btn-primary btn-sm">Add Product</a>
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
                                    @foreach ($products as $key => $product)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>
                                                @if (!empty($product->product_thambnail))
                                                    <img src="{{ asset('upload/product_images/thambnail/' . $product->product_thambnail) }}"
                                                        class="rounded-circle" alt="Brand" width="50">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}"
                                                        class="rounded-circle" alt="Brand" width="50">
                                                @endif
                                            </td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->selling_price }}</td>
                                            <td>{{ $product->product_qty }}</td>
                                            <td>
                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount / $product->selling_price) * 100;
                                                @endphp
                                                @if ($product->discount_price == null)
                                                    <span class="badge rounded-pill bg-info">No Discount</span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill bg-danger">{{ round($discount) }}%</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('vendor.edit.product', $product->id) }}"
                                                    class="btn btn-info btn-sm" title="Edit"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <a href="{{ route('admin.product.delete', $product->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete" title="Delete"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                                <a href="{{ route('admin.delete.category', $product->id) }}"
                                                    class="btn btn-warning btn-sm" title="Details Page"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                @if ($product->status == 1)
                                                    <a href="{{ route('admin.product.inactive', $product->id) }}"
                                                        class="btn btn-danger btn-sm" title="Inactive"><i
                                                            class="fa-solid fa-thumbs-down"></i></a>
                                                @else
                                                    <a href="{{ route('admin.product.active', $product->id) }}"
                                                        class="btn btn-success btn-sm" title="Active"><i
                                                            class="fa-solid fa-thumbs-up"></i></a>
                                                @endif
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
