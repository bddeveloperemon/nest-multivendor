@extends('frontend.layouts.auth_master')
@section('auth_title')
    Track Order
@endsection
@section('auth_content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Track Your Order
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        @include('frontend.layouts.dashboard_sidebar_menu')

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Track Your Order</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('order.tracking') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Invoice Code <span class="required">*</span></label>
                                                        <input type="text" name="code" class="form-control"
                                                            placeholder="Your Order Invoice Number" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold">Track
                                                            Order</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('user_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
