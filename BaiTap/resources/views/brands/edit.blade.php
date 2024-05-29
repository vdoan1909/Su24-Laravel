@extends('layout.index')

@section('title')
    Edit Brand {{ $brand->name }}
@endsection

@section('content')
    <div class="col-md-10 right-side">
        <div class="col-md-12 d-flex align-items-center justify-content-start gap-3">
            <div class="col-md-7 d-flex align-items-start justify-content-center flex-column">
                <div class="title w-100 d-flex justify-content-between mb-3">
                    <h3>Edit Brand {{ $brand->name }}</h3>
                </div>

                <div class="content w-100">
                    <form class="form-group w-100" action="{{ route('brands.update', $brand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
                            @error('name')
                                <span style="color: red">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <span style="color: red">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                    </form>
                </div>
            </div>

            <div class="col-md-5 bg-side-right" style="margin-top: 100px; max-width: 100%; height: 100%;">
                <img style="width: 516px; height: 600px;  object-fit: contain" src="{{ asset('storage/' . $brand->image) }}"
                    alt="">
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            window.onload = function() {
                FuiToast("{{ session('success') }}", {
                    style: {
                        backgroundColor: '#1DC071',
                        color: '#ffffff',
                        width: 'auto'
                    },
                })
            };
        </script>
    @endif
@endsection
