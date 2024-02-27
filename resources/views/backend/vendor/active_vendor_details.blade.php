@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Active Vendor
@endsection
@section('admin_content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Active Vendor Details</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Active Vendor</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        
    </div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.active.vendor.approve',$activeVendorDetails->id) }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">User Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $activeVendorDetails->username }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Shop Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" value="{{ $activeVendorDetails->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" value="{{ $activeVendorDetails->email }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{ $activeVendorDetails->phone }}" readonly>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" value="{{ $activeVendorDetails->address }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Join Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" value="{{ $activeVendorDetails->vendor_join }}"readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Info</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea class="form-control" readonly>{{ $activeVendorDetails->vendor_short_info }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Image</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="show_image" src="{{ (!empty($activeVendorDetails->image)) ? url('upload/vendor_images/'.$activeVendorDetails->image):url('backend/assets/images/avatars/avatar-500.png')  }}" alt="Admin" style="width:120px; height:120px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <button type="submit" class="btn btn-danger px-4">Inctive Vendor</button>
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