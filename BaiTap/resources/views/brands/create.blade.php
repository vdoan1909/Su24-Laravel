@extends('layout.index')

@section('title')
    Create
@endsection

@section('content')
    <div class="col-md-10 right-side">
        <div class="col-md-12 d-flex align-items-center justify-content-start gap-3">
            <div class="col-md-7 d-flex align-items-start justify-content-center flex-column">
                <div class="title w-100 d-flex justify-content-between mb-3">
                    <h3>Create Brand</h3>
                </div>

                <div class="content w-100">
                    <form class="form-group w-100" action="{{ route('brands.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Brand's name">
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
                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                    </form>
                </div>
            </div>

            <div class="col-md-5 bg-side-right" style="margin-top: 100px; max-width: 100%; height: 100%;">
                <img style="width: 100%; height: 100%;  object-fit: contain"
                    src="https://design-jm.com/wp-content/uploads/2021/02/1111111111-scaled.jpg" alt="">
            </div>
        </div>
    </div>
@endsection
