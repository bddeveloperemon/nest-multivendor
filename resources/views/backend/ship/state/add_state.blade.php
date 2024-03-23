@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Add State
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add State</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add State</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.state') }}" class="btn btn-danger btn-sm">Back</a>
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
                            <form action="{{ route('admin.store.state') }}" id="myForm" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Division</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="division_id" id="division_id"
                                            class="form-control @error('division_id') is-invalid @enderror">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">District</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="district_id" id="district_id"
                                            class="form-control @error('district_id') is-invalid @enderror">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">State Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control @error('state_name') is-invalid @enderror"
                                            name="state_name" id="state_name" placeholder="Enter State Name">
                                        @error('state_name')
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
@push('admin_scripts')
    <script>
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    division_id: {
                        required: true,
                    },
                    district_id: {
                        required: true,
                    },
                    state_name: {
                        required: true,
                    },
                },
                messages: {
                    division_id: {
                        required: 'Please Select Division',
                    },
                    district_id: {
                        required: 'Please Select District',
                    },
                    state_name: {
                        required: 'Please Enter State Name',
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

        // district dependencis
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                let division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/admin/district-ajax') }}/" + division_id,
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="district_id"]').html();
                            $('select[name="district_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .district_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endpush
