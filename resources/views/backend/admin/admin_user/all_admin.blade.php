@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Admin User List
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Admin User</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.admin') }}" class="btn btn-primary btn-sm">Add Admin User</a>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($allAdminUsers as $user)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>
                                                <img id="show_image"
                                                    src="{{ !empty($user->image) ? url('upload/admin_images/' . $user->image) : url('backend/assets/images/avatars/avatar-500.png') }}"
                                                    alt="{{ $user->name }}" style="width:50px; height:50px;">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge rounded-pill bg-success">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.admin.role', $user->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.delete.admin.role', $user->id) }}"
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
