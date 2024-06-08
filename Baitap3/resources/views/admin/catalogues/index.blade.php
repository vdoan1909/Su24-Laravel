@extends('layouts.admin.index')

@section('title')
    List Catalogue
@endsection

@section('title_page')
    List Catalogue
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" href="{{ route('admin.catalogues.create') }}" title="Thêm">
                                <i class="fas fa-plus"></i>
                                Create new catalogue
                            </a>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Name</th>
                                <th width="100px">Cover</th>
                                <th>Active</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$catalogues->isEmpty())
                                @foreach ($catalogues as $catalogue)
                                    <tr>
                                        <td width="10px ">
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
                                        <td>
                                            <a href="{{ route('admin.catalogues.show', $catalogue->id) }}"
                                                class="btn btn-secondary btn-sm" title="Show">
                                                <i class="fa fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.catalogues.edit', $catalogue->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.catalogues.destroy', $catalogue->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yet sure?')" class="btn btn-danger btn-sm"
                                                    type="submit" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5">
                                        No data
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
