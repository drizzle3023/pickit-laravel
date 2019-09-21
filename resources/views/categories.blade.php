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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Categories</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
                <h3 class="block-title">Category List</h3>
            </div>
            <div class="block-content block-content-full">
                <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                    <a class="btn btn-primary" href="{{url('/categories').'/'.$customer_id.'/add'}}"><i
                            class="si si-plus"></i> Add Category</a>
                    <div>
                        <a class="btn btn-success" href="{{url('/categories/show-all')}}"><i
                                class="far fa-eye"></i> Show all</a>
                        <a class="btn btn-warning" href="{{url('/categories/hide-all')}}"><i
                                class="far fa-eye-slash"></i> Hide all</a>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="d-none d-sm-table-cell">Category Name</th>
                        <th class="d-none d-sm-table-cell">Tags</th>
                        <th class="d-none d-sm-table-cell" style="width: 120px;">Order</th>
                        <th class="d-none d-sm-table-cell" style="width: 120px;">Show</th>
                        <th class="d-none d-sm-table-cell" style="width: 120px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="d-none d-sm-table-cell">
                                <a href="{{url('/categories/edit').'/'.$category->id}}">{{$category->name}}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-primary">{{$category->tags}}</span>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$category->show_order}}
                            </td>
                            <td class="text-center">
                                <div class="custom-control custom-switch custom-control custom-control-inline mb-2"
                                     align="center">
                                    <input type="checkbox" class="custom-control-input"
                                           id="show-toggle-{{$category->id}}" name="show-toggle-{{$category->id}}"
                                           @if($category->show_flag == 1) checked @endif >
                                    <label class="custom-control-label" for="show-toggle-{{$category->id}}"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{url('/categories/edit').'/'.$category->id}}"
                                       class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a href="javascript:delCategory({{$category->id}})" class="btn btn-sm btn-primary"
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
        function delCategory(id) {
            if (confirm("Do you want delete this category?\nThe data related to this category (Products) will be also deleted.")) {
                $.ajax({
                    url: '{{url('/categories/del')}}',
                    type: "POST",
                    data: {
                        "_token": Laravel.csrfToken,
                        "id": id,
                    },
                    error: function () {
                    },
                    success: function (data) {
                        if (data.message.length == 0) {
                            window.location.reload();
                        }
                    }
                });
            }
        }

        $(document).ready(function () {
            $(document).on('change', "[name^='show-toggle-']", function () {
                var id = this.name.split("show-toggle-")[1];
                $.ajax({
                    url: '{{url('/categories/toggle-visible')}}',
                    type: "POST",
                    data: {
                        "_token": Laravel.csrfToken,
                        "id": id,
                    },
                    error: function () {
                    },
                    success: function (data) {
                        if (data.message.length == 0) {
                            //window.location.reload();
                        }
                    }
                });
            });

            $("#sel-client").on("change", () => {
                window.location.href = $("#sel-client").val();
            });
        });
    </script>
@endsection
