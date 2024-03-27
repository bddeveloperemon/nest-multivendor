@extends('frontend.layouts.auth_master')
@section('auth_title')
    User Account Details
@endsection
@section('auth_content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Account Details
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
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.profile.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>User Name <span class="required">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            value="{{ $userData->username }}" name="username">
                                                        @error('username')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input required
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ $userData->name }}" type="text">
                                                        @error('name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required value="{{ $userData->email }}"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" type="email">
                                                        @error('email')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Mobile <span class="required">*</span></label>
                                                        <input class="form-control @error('phone') is-invalid @enderror"
                                                            value="{{ $userData->phone }}" name="phone" type="number">
                                                        @error('phone')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input class="form-control @error('address') is-invalid @enderror"
                                                            value="{{ $userData->address }}" name="address" type="text">
                                                        @error('address')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>User Image</label>
                                                        <input class="form-control @error('image') is-invalid @enderror"
                                                            name="image" type="file" id="image">
                                                        @error('image')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <img id="show_image"
                                                            src="{{ !empty($userData->image) ? url('upload/user_images/' . $userData->image) : url('backend/assets/images/avatars/avatar-500.png') }}"
                                                            alt="User" class="rounded-circle p-1 bg-info" height="90px"
                                                            width="100px">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold">Save
                                                            Change</button>
                                                    </div>
                                                </div>
                                            </form>
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
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
