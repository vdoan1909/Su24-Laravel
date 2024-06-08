@extends('layouts.admin.index')

@section('title')
    Show Catalogue {{ $catalogue->name }}
@endsection

@section('title_page')
    Show Catalogue {{ $catalogue->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">
                    Show Catalogue {{ $catalogue->name }}
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Name</th>
                                <th width="100px">Cover</th>
                                <th width="30px">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($catalogue)
                                <tr>
                                    <td>
                                        {{ $catalogue->id }}
                                    </td>
                                    <td>
                                        {{ $catalogue->name }}
                                    </td>
                                    <td>
                                        <img src="{{ Storage::url($catalogue->cover) }}" alt=""
                                            width="100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td>
                                        @if ($catalogue->is_active == 1)
                                            <span class="badge bg-success">
                                                Is active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Not active
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <img src="" alt="">
        </div>
    </div>
@endsection
