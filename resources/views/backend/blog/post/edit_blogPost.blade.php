@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Update Blog-Post
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Blog-Post</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Blog-Post</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.blog.post') }}" class="btn btn-danger btn-sm">Back</a>
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
                            <form action="{{ route('admin.blog.post.update', $blogPost->id) }}" id="myForm"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Blog Category</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="category_id" class="form-select" id="category_id">
                                            <option></option>
                                            @foreach ($blogCategories as $blogCategory)
                                                <option value="{{ $blogCategory->id }}"
                                                    @if ($blogPost->category_id == $blogCategory->id) selected @endif>
                                                    {{ $blogCategory->blog_category_name }} </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Blog Post</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="post_title" id="post_title"
                                            class="form-control @error('post_title') is-invalid @enderror"
                                            placeholder="Enter Post Tittle" value="{{ $blogPost->post_title }}">
                                        @error('post_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="post_short_description" id="post_short_description"
                                            class="form-control @error('post_short_description') is-invalid @enderror"
                                            placeholder="Enter Post Short Description">{{ $blogPost->post_short_description }}</textarea>
                                        @error('post_short_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Long Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea id="mytextarea" name="post_long_description"
                                            class="form-control @error('post_long_description') is-invalid @enderror"
                                            placeholder="Enter Post Short Description">{{ $blogPost->post_long_description }}</textarea>
                                        @error('post_long_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Blog Post Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control @error('post_image') is-invalid @enderror"
                                            name="post_image" id="post_image">
                                        @error('post_image')
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
                                            src="{{ !empty($blogPost->post_image) ? url('upload/blog/' . $blogPost->post_image) : url('backend/assets/images/No_Image.png') }}"
                                            alt="{{ $blogPost->post_title }}" style="width:120px; height:120px;">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#post_image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
