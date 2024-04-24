@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Banner List
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Banners</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Banner List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.banner') }}" class="btn btn-primary btn-sm">Add Banner</a>
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
                                        <th>Banner Title</th>
                                        <th>Banner URL</th>
                                        <th>Banner Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($banners as $banner)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>{{ $banner->banner_title }}</td>
                                            <td>{{ $banner->banner_url }}</td>
                                            <td>
                                                @if (!empty($banner->banner_image))
                                                    <img src="{{ asset('upload/banner_images/' . $banner->banner_image) }}"
                                                        alt="banner" width="100">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}"
                                                        class="rounded-circle" alt="banner" width="50">
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->can('banner.edit'))
                                                    <a href="{{ route('admin.edit.banner', $banner->id) }}"
                                                        class="btn btn-info btn-sm">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('banner.delete'))
                                                    <a href="{{ route('admin.delete.banner', $banner->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete">Delete</a>
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
