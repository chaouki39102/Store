@extends('layouts.app')

@section('content')
    <div id="main">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Edit Category</h4>
                <div>
                    <h4>
                        <a class="btn btn-primary" href="{{ route('Category.index') }}">
                            Back</a>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('Category.update', $category) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}"
                                    placeholder="Enter Category Name" >
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ $category->description }}" placeholder="Enter Category description">

                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status"
                                            class="form-check-input form-check-primary form-check-glow"
                                            {{ $category->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">Visibility</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="card-content">
                                    <div class="card-body">
                                        <label for="image">Image</label>
                                        <input class="form-control" name="image" type="file">
                                        <img src="{{ getFile($category->image) }}" width="60px" height="60px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary float-end m-1" type="submit">Update</button>
                    </div>
                </form>
            </div>



            <section class="section">

            </section>
        </div>

@endsection
