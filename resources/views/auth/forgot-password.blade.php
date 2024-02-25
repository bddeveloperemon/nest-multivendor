@extends('frontend.layouts.auth_master')
@section('auth_title')
    Forget-Password
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
                            <h2 class="mb-15 mt-15">Email Password Reset</h2>
                            <p class="mb-30">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                        </div>
                        <div class="col-lg-12 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <form method="post" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" required id="email" name="email" placeholder="Email *">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up">Email Password Reset Link</button>
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