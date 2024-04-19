@extends('backend.admin.dashboard')
@section('admin_title')
    Admin - Pending Reviews
@endsection
@section('admin_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pending Reviews</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Pending Reviews</li>
                </ol>
            </nav>
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
                                        <th>Comment</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($penReviews as $penReview)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td><img src="{{ asset('upload/product_images/thambnail/' . $penReviews->product->product_thambnail) }}"
                                                    alt="" srcset="" width="60px" height="60px"></td>
                                            <td>{{ Str::limit($penReview->comment, 20, '...') }}</td>
                                            <td>{{ $penReview->user->name }}</td>
                                            <td>{{ $penReview->product->product_name }}</td>
                                            <td>
                                                @if ($penReview->rating == null)
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($penReview->rating == 1)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($penReview->rating == 2)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($penReview->rating == 3)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($penReview->rating == 4)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($penReview->rating == 5)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                @endif
                                            </td>
                                            <td>

                                                @if ($penReview->status == 0)
                                                    <span class="badge rouned-pill bg-warning">Pending</span>
                                                @elseif ($penReview->status == 1)
                                                    <span class="badge rouned-pill bg-success">Approved</span>
                                                @endif

                                            </td>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.approve.review', $penReview->id) }}"
                                                    class="btn btn-success btn-sm">Approve</a>
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
