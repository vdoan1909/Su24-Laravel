@extends('admin.layout.master')

@section('title')
    List Catalogue
@endsection

@section('style-libs')
    <!-- Layout config Js -->
    <script src="{{ asset('theme/admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('theme/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create catalogue</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Details</h4>
                </div>

                <div class="card-body">
                    <div class="live-preview">
                        <form class="row g-3" action="{{ Route('admin.catalogues.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name">
                            </div>
                            <div class="col-md-6">
                                <label for="cover" class="form-label">Cover</label>
                                <input type="file" class="form-control" id="cover" name="cover">
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                                    <label class="form-check-label" for="is_active">
                                        Is active
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    <!-- prismjs plugin -->
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>
@endsection
