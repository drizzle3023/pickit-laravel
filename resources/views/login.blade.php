@extends('layouts.simple')

@section('content')

    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('media/photos/DSC_7808.jpg');">
        <div class="row no-gutters bg-primary-op">
            <!-- Main Section -->
            <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                <div class="p-3 w-100">
                    <!-- Header -->
                    <div class="mb-3 text-center">
                        <a class="link-fx font-w700 font-size-h1" href="{{url('/')}}">
                            <span class="text-dark">Pick</span><span class="text-primary"> it</span>
                        </a>
                        <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                    </div>
                    <!-- END Header -->

                    <!-- Sign In Form -->
                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <div class="row no-gutters justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            <form class="js-validation-signin" action="{{url('/login')}}" method="post">
                                @csrf
                                <div class="py-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg form-control-alt" id="login-username" name="login-username" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg form-control-alt" id="login-password" name="login-password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Sign In Form -->
                </div>
            </div>
            <!-- END Main Section -->

            <!-- Meta Info Section -->
            <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                <div class="p-3">
                    <p class="display-4 font-w700 text-white mb-3">
                        Welcome to Pick it System
                    </p>
                    <p class="font-size-lg font-w600 text-white-75 mb-0">
                        Copyright &copy; <span class="js-year-copy">2019</span>
                    </p>
                </div>
            </div>
            <!-- END Meta Info Section -->
        </div>
    </div>
    <!-- END Page Content -->

@endsection


@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('js/pages/op_auth_signin.min.js')}}"></script>
@endsection
