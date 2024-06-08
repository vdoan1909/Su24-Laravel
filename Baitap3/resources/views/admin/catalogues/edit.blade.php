@extends('layouts.admin.index')

@section('title')
    Edit Catalogue {{ $catalogue->name }}
@endsection

@section('title_page')
    Edit Catalogue {{ $catalogue->name }}
@endsection

@section('content')
    <div class="row">
        <form class="col-md-12" action="{{ route('admin.catalogues.update', $catalogue->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="tile">
                <h3 class="tile-title">
                    Edit Catalogue {{ $catalogue->name }}
                </h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ $catalogue->name }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Cover</label>
                            <input class="form-control" type="file" name="cover">
                        </div>
                        <div class="form-group col-md-3">
                            <img src="{{ Storage::url($catalogue->cover) }}" alt=""
                                width="100px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Active</label> <br>
                            <input style="width: 45px; height: 45px;" type="checkbox" name="is_active"
                                @if ($catalogue->is_active == 1) checked @endif>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-save" type="submit">Save</button>
            <button class="btn btn-cancel" type="reset">Reset</button>
        </form>
    </div>

    @if (Session::has('success'))
        <script>
            swal({
                title: "Success",
                text: "{{ Session::get('success') }}",
                icon: "success",
                buttons: ["Cancel", "Ok"]
            });
        </script>
    @endif
@endsection
