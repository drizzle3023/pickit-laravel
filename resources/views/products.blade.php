@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Products</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        @if(Session::get('user-type')!=3)
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6" style="display: flex;">
                    <div style="display: flex; align-items: center; margin-right: 10px;">
                        <span>Client:</span>
                    </div>

{{--                    <select class="custom-select" id="sel-client">--}}
                    <select class="js-select2 form-control" id="sel-client" name="val-select2" style="width: 100%;" data-placeholder="Choose one..">
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}" @if($customer->id == $customer_id) selected @endif>
                                {{$customer->company}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Product List</h3>
            </div>
            <div class="block-content block-content-full">
                <div style="margin-bottom: 10px;">
                    <a class="btn btn-primary" href="{{url('/products/').'/'.$customer_id.'/add'}}"><i
                            class="si si-plus"></i> Add
                        Product</a>
                </div>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="d-none d-sm-table-cell" style="width: 100px;">Picture</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Product Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 100px;">Category</th>
                        <th class="d-none d-sm-table-cell">Description</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Price</th>
                        <th class="d-none d-sm-table-cell" style="width: 80px;">Video</th>
                        <th class="d-none d-sm-table-cell" style="width: 80px;">Show</th>
                        <th class="d-none d-sm-table-cell" style="width: 80px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="font-w600">
                                <div align="center">
                                    <img src="{{asset('/media/images/products/thumbnail/').'/'.$product->picture}}"
                                         style="width: 80px;">
                                </div>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="{{url('/products/edit/').'/'.$product->id}}">{{$product->name}}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="{{url('categories/detail/').'/'.$product->category->id}}">{{$product->category->name}}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$product->description}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-success">{{$product->price.' '.$product->currency->name}}</span>
                            </td>
                            <td class="text-center">
                                <a href="javascript:openVideoDialog('{{$product->video_id}}', '{{$product->name}}');"><i class="far fa-play-circle"></i> </a>
                            </td>
                            <td class="text-center">
                                <div class="custom-control custom-switch custom-control custom-control-inline mb-2"
                                     align="center">
                                    <input type="checkbox" class="custom-control-input"
                                           id="show-toggle-{{$product->id}}" name="show-toggle-{{$product->id}}"
                                           @if($product->show_flag == 1) checked @endif >
                                    <label class="custom-control-label" for="show-toggle-{{$product->id}}"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{url('/products/edit').'/'.$product->id}}"
                                       class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a href="javascript:delProduct({{$product->id}})" class="btn btn-sm btn-primary"
                                       data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-block-fadein" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0" >
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Modal Title</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content" style="padding: 8px 8px 0px 8px;">
                        <iframe src="" frameborder="0" allowfullscreen class="iframe-video" width="100%" height="300" ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('js/pages/be_tables_datatables.min.js')}}"></script>

    <!-- Page JS Helpers (Select2 plugin) -->
    <script>jQuery(function(){ Dashmix.helpers('select2'); });</script>

    <script>
        function delProduct(id) {
            if (confirm("Do you want delete this product?")) {
                $.ajax({
                    url: '{{url('/products/del')}}',
                    type: "POST",
                    data: {
                        "_token": Laravel.csrfToken,
                        "id": id,
                    },
                    error: function () {
                    },
                    success: function (data) {
                        if (data.status == true) {
                            window.location.reload();
                        }
                    }
                });
            }
        }

        $(document).ready(function () {

            $("[name^='show-toggle-']").on('change', function () {
                var id = this.name.split("show-toggle-")[1];
                $.ajax({
                    url: '{{url('/products/toggle-visible')}}',
                    type: "POST",
                    data: {
                        "_token": Laravel.csrfToken,
                        "id": id,
                    },
                    error: function () {
                    },
                    success: function (data) {
                        if (data.status == true) {
                            //window.location.reload();
                        }
                    }
                });
            });

            $("#sel-client").on("change", () => {
                window.location.href = $("#sel-client").val();
            });
        });

        function openVideoDialog(videoId, productName) {
            $("#modal-block-fadein .block-title").html(productName);
            $("#modal-block-fadein iframe").attr("src", "https://www.youtube.com/embed/" + videoId);
            $("#modal-block-fadein").modal('show');
        }
    </script>
@endsection
