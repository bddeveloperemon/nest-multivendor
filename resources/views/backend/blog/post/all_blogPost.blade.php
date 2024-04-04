@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Blog Post List
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Categories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Blog Post</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.blog.post') }}" class="btn btn-primary btn-sm">Add Blog Post</a>
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
                                        <th>Post Category</th>
                                        <th>Post Image</th>
                                        <th>Post Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($blogPosts as $blogPost)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td class="sorting_1">{{ $blogPost->category->blog_category_name }}</td>
                                            <td>
                                                @if (!empty($blogPost->post_image))
                                                    <img src="{{ asset('upload/blog/' . $blogPost->post_image) }}"
                                                        class="rounded-circle" alt="Brand" width="50">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/websiteplanet-dummy-250X250.png') }}"
                                                        class="rounded-circle" alt="Brand" width="50">
                                                @endif
                                            </td>
                                            <td>{{ $blogPost->post_title }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit.blog.post', $blogPost->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.delete.blog.post', $blogPost->id) }}"
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
