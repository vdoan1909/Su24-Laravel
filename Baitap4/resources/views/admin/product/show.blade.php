@extends('admin.layout.master')

@section('title')
    {{ $model->name }}
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


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
                <h4 class="mb-sm-0">{{ $model->name }}</h4>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Show {{ $model->name }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 100px;">Cover</th>
                                <th>Is Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $model->id }}</td>
                                <td>{{ $model->name }}</td>
                                <td>
                                    @php
                                        $url = $model->cover;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = \Storage::url($url);
                                        }
                                    @endphp
                                    <img style="width: 100px; object-fit: cover;" src="{{ $url }}" alt="">
                                </td>
                                <td>
                                    {!! $model->is_active
                                        ? '<span class="badge bg-primary">Is active</span>'
                                        : '<span class="badge bg-danger">Not active</span>' !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/datatables.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>
@endsection
