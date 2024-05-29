@extends('layout.index')

@section('title')
    Show Brand {{ $brand->name }}
@endsection
{{-- @dd($brands->lastPage()) --}}
{{-- @dd($brands->hasMorePages()) --}}

@if (session('success'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
@endif

@section('content')
    <div class="col-md-10 right-side">
        <div class="col-md-12 d-flex align-items-center justify-content-center flex-column">
            <div class="title w-100 d-flex justify-content-between mb-3">
                <h3>Brand <b>{{ $brand->name }}</b></h3>
            </div>

            <div class="content w-100 d-flex justify-content-start">
                <div class="col-md-5 d-flex justify-content-start">
                    @if ($brand->image)
                        <img style="
                        width: 450px;
                        height: 600px;
                        object-fit: contain;"
                            src="{{ asset('storage/' . $brand->image) }}" alt="">
                    @else
                        <img style="
                        width: 450px;
                        height: 600px;
                        object-fit: contain;"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGfODhv7HIB9-Bkei2xPUeY19djdYXqDQlzg&s"
                            alt="">
                    @endif
                </div>

                <div class="col-md-6">
                    <ul>
                        <li>
                            <h4>
                                Name:
                                <a href="#" class="text-decoration-none text-white">
                                    {{ $brand->name }}
                                </a>
                            </h4>
                        </li>
                        <li class="text-white">
                                Created At: {{ $brand->created_at->format('d/m/Y') }}
                        </li>
                        <li class="text-white">
                                Updated At: {{ $brand->updated_at->format('d/m/Y') }}
                        </li>
                    </ul>

                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-success mt-3">Edit</a>

                    <a href="{{ url()->previous() }}" class="btn btn-warning mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
