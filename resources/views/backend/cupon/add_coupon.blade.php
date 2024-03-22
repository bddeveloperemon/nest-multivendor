@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Add Coupon
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Coupon</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.cupon') }}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.coupon.store') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Coupon Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control @error('cupon_name') is-invalid @enderror"
                                            name="cupon_name" id="cupon_name" placeholder="Enter Coupon Name">
                                        @error('cupon_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Coupon Discount(%)</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number"
                                            class="form-control @error('cupon_discount') is-invalid @enderror"
                                            name="cupon_discount" id="cupon_discount" placeholder="Enter Coupon Discount">
                                        @error('cupon_discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Coupon Validity Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date"
                                            class="form-control @error('cupon_validity') is-invalid @enderror"
                                            name="cupon_validity" id="cupon_validity" placeholder="Enter Coupon Validity"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error('cupon_validity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" class="btn btn-success px-4">Save Changes</button>
                                        <button type="reset" class="btn btn-danger px-4">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
