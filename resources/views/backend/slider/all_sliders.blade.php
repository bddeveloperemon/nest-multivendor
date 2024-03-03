@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Slider List
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Sliders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Slider List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.slider') }}" class="btn btn-primary btn-sm">Add Slider</a>
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
                                        <th>Slider Title</th>
                                        <th>Short Title</th>
                                        <th>Slider Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($sliders as $slider)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>{{ $slider->slider_title }}</td>
                                            <td>{{ $slider->short_title }}</td>
                                            <td>
                                                @if (!empty($slider->slider_image))
                                                    <img src="{{ asset('upload/slider_images/' . $slider->slider_image) }}"
                                                        alt="Slider" width="100">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}"
                                                        class="rounded-circle" alt="Slider" width="50">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.slider', $slider->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.delete.slider', $slider->id) }}"
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
