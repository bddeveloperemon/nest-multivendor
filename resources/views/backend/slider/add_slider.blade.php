@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Add Slider
@endsection
@section('admin_content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Slider</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.slider') }}" class="btn btn-danger btn-sm">Back</a>
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
                            <form action="{{ route('admin.slider.store') }}" id="myForm" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Slider Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary form-group">
                                        <input type="text" name="slider_title"
                                            class="form-control @error('slider_title') is-invalid @enderror"
                                            placeholder="Enter Slider Title">
                                        @error('slider_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short Title</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary form-group">
                                        <input type="text" name="short_title"
                                            class="form-control @error('short_title') is-invalid @enderror"
                                            placeholder="Enter Short Title">
                                        @error('short_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Slider Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary form-group">
                                        <input type="file"
                                            class="form-control @error('slider_image') is-invalid @enderror"
                                            name="slider_image" id="slider_image">
                                        @error('slider_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="show_image"
                                            src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}"
                                            alt="Admin" class="rounded-circle" style="width:120px; height:120px;">
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
@push('admin_scripts')
    <script>
        $(document).ready(function() {
            $('#slider_image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    slider_title: {
                        required: true,
                    },
                    short_title: {
                        required: true,
                    },
                    slider_image: {
                        required: true,
                    },
                },
                messages: {
                    slider_title: {
                        required: 'Please Enter Slider Title',
                    },
                    short_title: {
                        required: 'Please Enter Short Title',
                    },
                    slider_image: {
                        required: 'Please Select Slider Image',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endpush
