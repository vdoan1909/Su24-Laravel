@extends('admin.layout.master')

@section('title')
    Edit product {{ $product->name }}
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
                <h4 class="mb-sm-0">Edit product {{ $product->name }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form class="form-group" action="{{ route('admin.products.update', $product->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Information --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Detail</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $product->name }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ $product->sku }}" readonly>
                                    </div>

                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" class="form-control" id="price_regular" name="price_regular"
                                            value="{{ $product->price_regular }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" class="form-control" id="price_sale" name="price_sale"
                                            value="{{ $product->price_sale }}">
                                    </div>

                                    <div class="mt-3">
                                        <label for="catalogue_id" class="form-label">Catalogues</label>
                                        <select class="form-select" id="catalogue_id" name="catalogue_id">
                                            <option value="{{ $product->catalogue->id }}">{{ $product->catalogue->name }}
                                            </option>
                                            @foreach ($catalogues as $id => $name)
                                                <option value="{{ $id }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Img Thumbnail</label>
                                        <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                                    </div>

                                    <img class="mt-3" style="width: 100px; object-fit: cover;"
                                        src="{{ \Storage::url($product->img_thumbnail) }}" alt="">
                                </div>

                                <div class="col-md-8">
                                    @php
                                        $is = [
                                            'is_active' => 'primary',
                                            'is_hot_deal' => 'danger',
                                            'is_good_deal' => 'warning',
                                            'is_new' => 'success',
                                            'is_show_home' => 'info',
                                        ];
                                    @endphp

                                    <div class="row">
                                        @foreach ($is as $key => $value)
                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-{{ $value }}">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="{{ $key }}" name="{{ $key }}"
                                                        @if ($product->$key) checked @endif>
                                                    <label class="form-check-label" for="{{ $key }}">
                                                        {{ \Str::convertCase($key, MB_CASE_TITLE) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mt-3">
                                                <label for="description" class="form-label">
                                                    Description
                                                </label>
                                                <textarea class="form-control" id="description" rows="3" name="description">
                                                    {{ $product->description }}
                                                </textarea>
                                            </div>

                                            <div class="mt-3">
                                                <label for="material" class="form-label">
                                                    Material
                                                </label>
                                                <textarea class="form-control" id="material" rows="3" name="material">
                                                    {{ $product->material }}
                                                </textarea>
                                            </div>

                                            <div class="mt-3">
                                                <label for="user_manual" class="form-label">
                                                    User Manual
                                                </label>
                                                <textarea class="form-control" id="user_manual" rows="3" name="user_manual">
                                                    {{ $product->user_manual }}
                                                </textarea>
                                            </div>

                                            <div class="mt-3">
                                                <label for="content" class="form-label">
                                                    Content
                                                </label>
                                                <textarea class="form-control" id="content" name="content">
                                                    {{ $product->content }}
                                                </textarea>
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

        {{-- Variant --}}
        <div class="row overflow-auto" style="height: 300px;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Variant</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Coler</th>
                                                <th>Quantity</th>
                                                <th>Image</th>
                                                <th class="col-md-6"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizes as $sizeID => $sizeName)
                                                @php($flagRowspan = true)

                                                @foreach ($colors as $colorID => $colorName)
                                                    <tr>
                                                        @if ($flagRowspan)
                                                            <td style="vertical-align: middle;"
                                                                rowspan="{{ count($colors) }}"><b>{{ $sizeName }}</b>
                                                            </td>
                                                        @endif
                                                        @php($flagRowspan = false)

                                                        <td>
                                                            <div class="color"
                                                                style="width: 50px; height: 50px; border-radius: 50%; background: {{ $colorName }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                                @foreach ($product->variants as $variant)
                                                            @if ($variant->product_size_id == $sizeID && $variant->product_color_id == $colorID)
                                                                value="{{ $variant->quantity }}"
                                                            @endif @endforeach>
                                                        </td>
                                                        <td>
                                                            <input type="file" class="form-control"
                                                                name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                        </td>
                                                        <td>
                                                            <img style="width: 50px; object-fit: cover;"
                                                                @foreach ($product->variants as $variant)
                                                            @if ($variant->product_size_id == $sizeID && $variant->product_color_id == $colorID)
                                                           src="{{ \Storage::url($variant->image) }}"
                                                           @endif @endforeach
                                                                alt="">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gallery --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                <div class="col-md-4" id="gallery_default_item">
                                    <label for="gallery_default" class="form-label">Image</label>
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="product_galleries[]"
                                            id="gallery_default">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @foreach ($product->galleries as $gallery)
                    <img class="ms-2" style="width: 100px; object-fit: cover;"
                        src="{{ \Storage::url($gallery->image) }}" alt="">
                @endforeach
            </div>
        </div>

        {{-- Tags --}}
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="tags" class="form-label">Tags</label>
                                        <select class="form-select" multiple aria-label="multiple select example"
                                            id="tags" name="tags[]">
                                            @foreach ($tags as $key => $tag)
                                                <option value="{{ $key }}"
                                                    @if (in_array($key, $selectedTags)) style="background-color: #1967D2;"  @endif>
                                                    {{ $tag }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- prismjs plugin -->
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });


        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
