@extends('layouts.admin.index')

@section('title')
    Create New Catalogue
@endsection

@section('title_page')
    Create New Catalogue
@endsection

@section('content')
    <div class="row">
        <form class="col-md-12" action="{{ route('admin.catalogues.store') }}" 
        method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tile">
                <h3 class="tile-title">
                    Create New Catalogue
                </h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Cover</label>
                            <input class="form-control" type="file" name="cover">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Active</label> <br>
                            <input style="width: 45px; height: 45px;"type="checkbox" name="is_active" checked>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-save" type="submit">Save</button>
            <button class="btn btn-cancel" type="reset">Reset</button>
        </form>
    </div>
@endsection
