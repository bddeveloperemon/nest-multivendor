@extends('backend.vendor.dashboard')
@section('vendor_title')
    Vendor - Update Product
@endsection
@section('vendor_content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('vendor.productList') }}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Update Product</h5>
            <hr>
            <form action="{{ route('vendor.update.product', $product->id) }}" id="myForm" method="post">
                @csrf
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="inputProductTitle"
                                        placeholder="Enter product name" value="{{ $product->product_name }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                                    <input type="text" name="product_tags" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ $product->product_tags }}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Size</label>
                                    <input type="text" name="product_size" class="form-control visually-hidden"
                                        data-role="tagsinput"value="{{ $product->product_size }}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Color</label>
                                    <input type="text" name="product_color" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ $product->product_color }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" id="inputProductDescription" rows="3">{{ $product->short_desc }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Long Description</label>
                                    <textarea id="mytextarea" class="form-control" name="long_desc" rows=3>{!! $product->long_desc !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="form-group col-md-6">
                                        <label for="inputPrice" class="form-label">Product Price</label>
                                        <input type="number" class="form-control" name="selling_price"
                                            value="{{ $product->selling_price }}" id="inputPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                        <input type="number" name="discount_price" value="{{ $product->discount_price }}"
                                            class="form-control" id="inputCompareatprice" placeholder="00.00">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                        <input type="text" name="product_code" value="{{ $product->product_code }}"
                                            class="form-control" id="inputCostPerPrice" placeholder="Enter code">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputStarPoints" class="form-label">Product QTY</label>
                                        <input type="number" name="product_qty" value="{{ $product->product_qty }}"
                                            class="form-control" id="inputStarPoints" placeholder="Enter qty">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select name="brand_id" class="form-select" id="inputProductType">
                                            <option></option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    @if ($product->brand_id == $brand->id) selected @endif>
                                                    {{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="category_id" class="form-label">Product Category</label>
                                        <select name="category_id" class="form-select" id="category_id">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($product->category_id == $category->id) selected @endif>
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputCollection" class="form-label">Product SubCategory</label>
                                        <select name="subcategory_id" class="form-select" id="inputCollection">
                                            <option></option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}"
                                                    @if ($product->subcategory_id == $subcategory->id) selected @endif>
                                                    {{ $subcategory->sub_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="hot_deals" id="flexCheckDefault"
                                                        @if ($product->hot_deals == 1) checked @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">Hot
                                                        Deals</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        @if ($product->featured == 1) checked @endif name="featured"
                                                        id="featured" value="1">
                                                    <label class="form-check-label" for="featured">Featured</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="special_offer" id="special_offer"
                                                        @if ($product->special_offer == 1) checked @endif>
                                                    <label class="form-check-label" for="special_offer">Special
                                                        Offer</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="special_deals" id="special_deals"
                                                        @if ($product->special_deals == 1) checked @endif>
                                                    <label class="form-check-label" for="special_deals">Special
                                                        Deals</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Save Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </form>
        </div>
    </div>
    <h6 class="mb-0 text-uppercase">Update Main Image Thambnail</h6>
    <hr>
    <div class="card">
        <form action="{{ route('vendor.update.thambnail', $product->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Product Thambnail</label>
                    <input class="form-control" name="product_thambnail" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <img src="{{ asset('upload/product_images/thambnail/' . $product->product_thambnail) }}"
                        style="width: 100px; height:100px;" class="mt-2">
                </div>
                <button type="submit" class="btn btn-primary">Save Thambnail</button>
            </div>
        </form>
    </div>

    <h6 class="mb-0 text-uppercase">Update Product Multi Image</h6>
    <hr>
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Image</th>
                        <th scope="col">Change Image</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('vendor.update.multi_img') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($multi_imgs as $image)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td><img src="{{ asset('upload/product_images/multi_imgs/' . $image->image_name) }}"
                                        style="width:70px; height:70px"></td>
                                <td><input type="file" class="form-control" name="multi_img[{{ $image->id }}]">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success btn-sm" title="Update Image"><i
                                            class="fa-solid fa-floppy-disk"></i></button>
                                    <a href="{{ route('vendor.delete.multiimg', $image->id) }}"
                                        class="btn btn-danger btn-sm" title="Delete" id="delete"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('vendor_scripts')
    <script>
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThamb').attr('src', e.target.result).addClass('mt-2').width(80).height(80);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).addClass('mt-2').width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });

        //subcategory dependencis
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                let category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/admin/subcategory-ajax/') }}/" + category_id,
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="subcategory_id"]').html();
                            $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .sub_category_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                    },
                    product_thambnail: {
                        required: true,
                    },
                    multi_img: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_qty: {
                        required: true,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please Enter Product Name',
                    },
                    short_desc: {
                        required: 'Please Enter Short Description',
                    },
                    product_thambnail: {
                        required: 'Please Select Product Thambnail Image',
                    },
                    multi_img: {
                        required: 'Please Select Product Multi Image',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
                    },
                    product_code: {
                        required: 'Please Enter Product Code',
                    },
                    product_qty: {
                        required: 'Please Enter Product Quantity',
                    },
                    brand_id: {
                        required: 'Please select brand',
                    },
                    category_id: {
                        required: 'Please select Category',
                    },
                    subcategory_id: {
                        required: 'Please select Subcategory',
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
