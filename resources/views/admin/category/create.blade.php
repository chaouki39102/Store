@extends('layouts.app')

@section('content')
    <div id="main">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Add Category</h4>
                <div>
                    <h4>
                        <a class="btn btn-primary" href="{{ route('Category.index') }}">
                            Back</a>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('Category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description"
                                    placeholder="Enter Category description">
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status"
                                            class="form-check-input form-check-primary form-check-glow" checked="">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary float-end m-1" type="submit">Save</button>
                        <button class="btn btn-primary float-end m-1" type="reset">Reset</button>
                    </div>
                </form>
            </div>



            <section class="section">

            </section>
        </div>
    </div>
@endsection
