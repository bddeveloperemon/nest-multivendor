@extends('frontend.layouts.auth_master')
@section('auth_title')
    Reset-Password
@endsection
@section('auth_content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                    <div class="row">
                        <div class="heading_s1">
                            <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/reset_password.svg') }}" alt="">
                            <h2 class="mb-15 mt-15">Set new password</h2>
                            <p class="mb-30">Please create a new password that you don’t use on any other site.</p>
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <form method="post" action="{{ route('password.store') }}">
                                        @csrf
                                            <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                        <div class="form-group">
                                            <input type="email" class="@error('email') is-invalid @enderror" required="" name="email" placeholder="Email *">
                                            @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="@error('password') is-invalid @enderror" required="" name="password" placeholder="Password *">
                                            @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" required="" name="password_confirmation" class="" placeholder="Confirm you password *">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up">Reset password</button>
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
@endsection