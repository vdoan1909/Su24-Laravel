@extends('layout.index')

@section('title')
    List
@endsection
{{-- @dd($brands->lastPage()) --}}
{{-- @dd($brands->hasMorePages()) --}}

@section('content')
    <div class="col-md-10 right-side">
        <div class="col-md-12 d-flex align-items-center justify-content-center flex-column">
            <div class="title w-100 d-flex justify-content-between mb-3">
                <h3>Brand List</h3>
                <a href="{{ route('brands.create') }}" class="btn btn-success">ADD NEW</a>
            </div>

            <div class="content w-100">
                @if (count($brands) > 0)
                    <table id="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if ($brand->image)
                                            <img src="{{ asset('storage/' . $brand->image) }}" alt="">
                                        @else
                                            <span>Not image</span>
                                        @endif
                                    </td>
                                    <td>{{ $brand->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $brand->updated_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('brands.show', $brand->id) }}" class="btn btn-success">Show</a>
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-success">Edit</a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yet sure?')" type="submit"
                                                class="btn btn-success">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="background: rgb(234, 230, 230)" colspan="5" scope="col">Not data</th>
                            </tr>
                        </thead>
                    </table>
                @endif

                @if (count($brands) > 0)
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($brands->onFirstPage())
                                <li class="page-item">
                                    <a class="page-link disabled" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $brands->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $brands->lastPage(); $i++)
                                @if ($i == $brands->currentPage())
                                    <li class="page-item active"><a class="page-link"
                                            href="#">{{ $i }}</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $brands->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($brands->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $brands->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link disabled" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            window.onload = function() {
                FuiToast("{{ session('success') }}", {
                    style: {
                            color: '#000000',
                        }
                })
            };
        </script>
    @endif
@endsection
