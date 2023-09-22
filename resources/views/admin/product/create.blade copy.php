@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="mb-5">
                <h3 class="mb-0 ">Add Product</h3>
            </div>
        </div>
    </div>
    <!-- row -->
    <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <div>
                            <!-- input -->
                            <div class="mb-3">
                                <label class="form-label">Product Title</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter Product Title" required>
                                @error('name')
                                    <span class=" text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <!-- input -->
                            <div>
                                <label class="form-label">Product Description</label>
                                <textarea class="form-control" value="{{ old('description') }}" name="description" id="" cols="30"
                                    rows="10" placeholder="Enter Product Description"></textarea>
                                @error('description')
                                    <span class=" text-danger"> {{ $message }} </span>
                                @enderror
                                {{-- <div class="pb-8" id="editor"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <div>
                            <div class="mb-4">
                                <!-- heading -->
                                {{-- <h4 class="mb-4">Product Gallery</h4> --}}
                                <h5 class="mb-1">Product Image</h5>
                                <p>Add Product main Image.</p>
                                <!-- input -->
                                <input name="image_url" type="file" class="form-control">
                                @error('image_url')
                                    <span class=" text-danger"> {{ $message }} </span>
                                @enderror

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" name="images[]" id="images" placeholder="Choose images"
                                            multiple>
                                    </div>
                                    @error('images')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror

                                    <div data-image-uploader data-image-uploader-file-type-regex="(\.jpg|\.jpeg|\.png)$"
                                        data-image-uploader-max-file-size="8" class="form__field form__load-img">
                                        <p class="form__title">Upload your images (Maximum 3 images)</p>
                                        <div class="load__img-wrap">
                                            <div class="load__img-content" data-image-uploader-drop-area>
                                                <div class="content__wrapper" data-image-uploader-content>
                                                    <button type="button" class="blue--btn">Upload File</button>
                                                    <span>/</span>
                                                    <svg viewBox="0 0 17 17" width="17" height="17" fill="none">
                                                        <path
                                                            d="M14.917 7.611H11.25v5.333h-5.5V7.611H2.083L8.5.5l6.417 7.111Zm-13.75 7.111h14.666V16.5H1.167v-1.778Z"
                                                            fill="#767676" />
                                                    </svg>
                                                    <p>Drag your files here</p>
                                                    <div class="upload__TipIcon">
                                                        <span>
                                                            <svg viewBox="0 0 17 17" width="17" height="17"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#a)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M8.5 1.955a6.545 6.545 0 1 0 0 13.09 6.545 6.545 0 0 0 0-13.09ZM.5 8.5a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm8-3.636c.402 0 .727.325.727.727V8.5a.727.727 0 0 1-1.454 0V5.59c0-.4.325-.726.727-.726Zm0 5.818a.727.727 0 0 0 0 1.454h.007a.727.727 0 0 0 0-1.454H8.5Z"
                                                                        fill="#767676" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="a">
                                                                        <path fill="#fff" transform="translate(.5 .5)"
                                                                            d="M0 0h16v16H0z" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                        <div class="upload__Tooltip">
                                                            <ul>
                                                                <li>- Images must be in JPG, JPEG and PNG format.</li>
                                                                <li>- File size must be 10 MB or less.</li>
                                                                <li>- Maximum 3 images.</li>
                                                                <li>- Image must be at least 100 pixels tall.</li>
                                                                <li>- Image must be at least 100 pixels wide.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" enctype="multipart/form-data"
                                                    accept=".png, .jpg, .jpeg" multiple style="display: none;">
                                            </div>
                                        </div>
                                        <ul class="validation-summary-errors error__msg margin--top-16 hidden"
                                            id="errorMessage" data-image-uploader-errors>
                                            <li>* Images must be in JPG, JPEG and PNG format.</li>
                                            <li>* File size must be 10 MB or less.</li>
                                            <li>* Maximum 3 images.</li>
                                            <li>* Image must be at least 100 pixels tall.</li>
                                            <li>* Image must be at least 100 pixels wide.</li>
                                        </ul>
                                        <div class="upload__thumbnails hidden" data-thumbnails-container>
                                            <div>
                                                <div>
                                                    <span>Uploaded files</span>
                                                    <div class="imgs__wrapper">
                                                        <div class="item__imgs" data-image-preview-container>
                                                            <template data-image-preview>
                                                                <div class="item__wrapper" data-image-preview-element>
                                                                    <div class="remove__img">
                                                                        <button class="remove__icon" data-removal-button>
                                                                            <svg viewBox="0 0 12 12" width="12"
                                                                                height="12" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12 1.2 10.8 0 6 4.8 1.2 0 0 1.2 4.8 6 0 10.8 1.2 12 6 7.2l4.8 4.8 1.2-1.2L7.2 6 12 1.2Z"
                                                                                    fill="#4B4B4B" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="review__img">
                                                                        <picture>
                                                                            <img
                                                                                style="max-width: 200px; min-width: 200px; min-width: 200px; max-width: 200px" />
                                                                        </picture>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mt-1 text-center">
                                        <div class="images-preview-div "> </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Product Code</label>
                            <input name="product_code" type="text" value="{{ old('product_code') }}"
                                class="form-control" placeholder="Enter Product Code">
                            @error('product_code')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Category</label>
                                <a href="{{ route('Category.create') }}" class="btn-link fw-semi-bold">Add New</a>
                            </div>
                            <!-- select menu -->
                            <select name="category_id" class="form-select" aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- select -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" aria-label="Default select example">
                                <option value="Published" selected>Published</option>
                                <option value="Unpublished">Unpublished</option>
                                <option value="Draft">Draft</option>
                            </select>
                            @error('status')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Purchase Price</label>
                            <input name="purchase_price" value="{{ old('purchase_price') }}" type="number"
                                class="form-control" placeholder="$ 0.00" required>
                            @error('purchase_price')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Sale Price</label>
                            <input name="sale_price" value="{{ old('sale_price') }}" type="number"
                                class="form-control" placeholder="$ 0.00" required>
                            @error('sale_price')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input name="quantity" value="{{ old('quantity') }}" type="number" class="form-control"
                                placeholder="0.00" required>
                            @error('quantity')
                                <span class=" text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Create Product</button>
                </div>
            </div>
        </div>
    </form>

    @push('head')
        {{-- <link href="https://dashui.codescandy.com/dashuipro/assets/libs/dropzone/dist/dropzone.css" rel="stylesheet" > --}}
        <link href="https://dashui.codescandy.com/dashuipro/assets/libs/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets\css\custom.css')}}">
    @endpush
    @push('scripts')
        {{-- <script src="{{asset('/assets/js/custom.js')}}"></script> --}}
        <script>
            $(function() {
                // Multiple images preview with JavaScript
                var previewImages = function(input, imgPreviewPlaceholder) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                    imgPreviewPlaceholder);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#images').on('change', function() {
                    previewImages(this, 'div.images-preview-div');
                });
            });
        </script>
        <!-- dropzone -->
        {{-- <script src="{{ asset('/assets/js/dropzone.min.js') }}"></script> --}}
        <!-- flatpickr -->
        <script src="https://dashui.codescandy.com/dashuipro/assets/libs/flatpickr/dist/flatpickr.min.js"></script>

        <!-- quill js -->
        <script src="https://dashui.codescandy.com/dashuipro/assets/libs/quill/dist/quill.min.js"></script>
        <script src="https://dashui.codescandy.com/dashuipro/assets/libs/@yaireo/tagify/dist/tagify.min.js"></script>
    @endpush
@endsection
