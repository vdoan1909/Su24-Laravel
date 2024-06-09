@extends('admin.layout.master')

@section('title')
    List Catalogue
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
                <h4 class="mb-sm-0">Catalogue</h4>

                <a href="{{ Route('admin.products.create') }}" class="btn btn-primary">Create a new catalogue</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Catalogues</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Img Thumbnail</th>
                                <th>Catalogue Name</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price Regular</th>
                                <th>Price Sale</th>
                                <th>Views</th>
                                <th>Is Active</th>
                                <th>Is Hot Deal</th>
                                <th>Is Good Deal</th>
                                <th>Is New Deal</th>
                                <th>Is Show Home</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="text-start">
                                    <td>{{ $item->id }}</td>
                                    <td class="text-center">
                                        @php
                                            $url = $item->img_thumbnail;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = \Storage::url($url);
                                            }
                                        @endphp
                                        <img style="width: 100px; object-fit: cover;" src="{{ $url }}"
                                            alt="">
                                    </td>
                                    <td>{{ $item->catalogue->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->price_regular }}</td>
                                    <td>{{ $item->price_sale }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>
                                        {!! $item->is_active
                                            ? '<span class="badge bg-primary">Is active</span>'
                                            : '<span class="badge bg-danger">Not active</span>' !!}
                                    </td>
                                    <td>
                                        {!! $item->is_hot_deal
                                            ? '<span class="badge bg-primary">Is hot deal</span>'
                                            : '<span class="badge bg-danger">Not hot deal</span>' !!}
                                    </td>
                                    <td>
                                        {!! $item->is_good_deal
                                            ? '<span class="badge bg-primary">Is good deal</span>'
                                            : '<span class="badge bg-danger">Not good deal</span>' !!}
                                    </td>
                                    <td>
                                        {!! $item->is_new
                                            ? '<span class="badge bg-primary">Is new</span>'
                                            : '<span class="badge bg-danger">Not new</span>' !!}
                                    </td>
                                    <td>
                                        {!! $item->is_show_home
                                            ? '<span class="badge bg-primary">Is show home</span>'
                                            : '<span class="badge bg-danger">Not show home</span>' !!}
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ Route('admin.products.show', $item->id) }}"
                                                        class="dropdown-item">
                                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('admin.products.edit', $item->id) }}"
                                                        class="dropdown-item edit-item-btn">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ Route('admin.products.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Yet sure??')"
                                                            class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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

@section('scrips')
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        })
    </script>
@endsection
