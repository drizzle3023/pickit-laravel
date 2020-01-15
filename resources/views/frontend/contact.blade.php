@extends('layouts.frontend2')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/css/perfect-scrollbar.min.css">
@endsection


@section('content')
    <!-- Hero -->

    <div class="content">
        <div style="height: 200px; display: flex; align-items: center; justify-content: center; font-size: 3em; color: #eee; text-transform: uppercase;">
            Contact Us
        </div>
        <div class="row no-gutters justify-content-center" data-aos="fade-down">
            <div class="col-sm-12 col-xl-8">
                <div class="offset-md-1 col-sm-10 col-xl-10">
                    <div class="form-header-text text-center">
                        <span class="text-uppercase font-size-h6">Contact with us</span>
                        <p class="text-uppercase">Write Us a Message</p>
                        <p class="font-w700 font-size-h5 text-muted">We are committed to providing our customers with exceptional service while offering our employees the best training.</p>
                    </div>
                    <form class="js-validation-signup" action="be_pages_auth_all.html" method="post">
                        <div class="py-3">
                            <div class="form-group row">
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-lg form-control-alt" placeholder="First Name">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-lg form-control-alt" placeholder="Last Name">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <input type="email" class="form-control form-control-lg form-control-alt" placeholder="Email">
                                </div>
                                <div class="col-6">
                                    <input type="ext" class="form-control form-control-lg form-control-alt" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control form-control-lg form-control-alt" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-hero-lg btn-hero-info btn-pickit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.8.1/js/perfect-scrollbar.jquery.min.js"></script>
    <!-- Page JS Code -->

    <!-- Page JS Helpers (Select2 plugin) -->
    <script>jQuery(function(){ Dashmix.helpers('select2'); });</script>

@endsection
