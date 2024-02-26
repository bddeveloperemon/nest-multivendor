@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Edit Brand
@endsection
@section('admin_content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Add Brand</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.all.brands') }}" class="btn btn-danger btn-sm">Back</a>
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
                        <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Brand Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{ $brand->brand_name }}" placeholder="enter brand name">
                                    @error('brand_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Brand Image</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="show_image" src="{{ (!empty($brand->image)) ? url('upload/brand_images/'.$brand->image):url('backend/assets/images/No_Image.png')  }}" alt="Admin" style="width:120px; height:120px;">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('#image').change(function(){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#show_image').attr('src',e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush