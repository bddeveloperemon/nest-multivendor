@extends('backend.vendor.dashboard')
@section('vendor_title')
    Vendor - Review List
@endsection
@section('vendor_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Apporve Reviews</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Apporve Reviews</li>
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
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($reviews as $review)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td><img src="{{ asset('upload/product_images/thambnail/' . $review->product->product_thambnail) }}"
                                                    alt="" srcset="" width="60px" height="60px"></td>
                                            <td>{{ $review->product->product_name }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ Str::limit($review->comment, 20, '...') }}</td>
                                            <td>
                                                @if ($review->rating == null)
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($review->rating == 1)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($review->rating == 2)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($review->rating == 3)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($review->rating == 4)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($review->rating == 5)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                @endif
                                            </td>
                                            <td>

                                                @if ($review->status == 0)
                                                    <span class="badge rouned-pill bg-warning">Pending</span>
                                                @elseif ($review->status == 1)
                                                    <span class="badge rouned-pill bg-success">Approved</span>
                                                @endif

                                            </td>
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
