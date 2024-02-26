@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - SubCategory List
@endsection
@section('admin_content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All SubCategories</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All SubCategories</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.add.subcategory') }}" class="btn btn-primary btn-sm">Add Sub-Category</a>
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
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 10%">SL</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 30%;">Category Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 30%">Sub-Category Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($sub_categories as $subcategory)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $i++ }}</td>
                                        <td>{{ $subcategory->category->category_name }}</td>
                                        <td>{{ $subcategory->sub_category_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.subcategory',$subcategory->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ route('admin.delete.subcategory',$subcategory->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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