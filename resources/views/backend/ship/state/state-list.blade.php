@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - State List
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All State</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All State</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.state') }}" class="btn btn-primary btn-sm">Add State</a>
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
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>State Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($states as $state)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>{{ $state->division->division_name }}</td>
                                            <td>{{ $state->district->district_name }}</td>
                                            <td>{{ $state->state_name }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit.state', $state->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.delete.state', $state->id) }}"
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
