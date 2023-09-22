{{-- <div class="app-content-area"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            @if ($message = session('message'))
                <!-- Success alert -->
                <div id="liveAlert">

                <div id="liveAlert" class="alert alert-success alert-dismissible d-flex align-items-center col-xl-12 col-lg-6 mb-5"
                    role="alert" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            </div>

            @endif
            <!-- Page header -->
            <div class="mb-5">
                <h3 class="mb-0">Products</h3>
            </div>
        </div>
    </div>
    <div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-md-flex border-bottom-0">
                        <div class="flex-grow-1">
                            <a href="{{ route('Product.create') }}" class="btn btn-primary">+ Add Product</a>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                data-template="settingOne">
                                <i class="fa-solid fa-gear"></i>
                                <div id="settingOne" class="d-none">
                                    <span>Setting</span>
                                </div>
                            </a>

                            <a href="#!" class="btn btn-outline-white ms-2">Import</a>
                            <a href="#!" class="btn btn-outline-white ms-2">Export</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example"
                                            class="table text-nowrap table-centered mt-0 dataTable no-footer dtr-inline collapsed"
                                            style="width: 100%;" role="grid" aria-describedby="example_info">
                                            <thead class="table-light text-wrap">
                                                <tr role="row">
                                                    <th class="pe-0 " style="width: 26px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="checkAll">
                                                            <label class="form-check-label" for="checkAll">
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th class="ps-1 " style="width: 291px;">Product</th>
                                                    <th style="width: 131px;">Category</th>
                                                    <th style="width: 101px;">Added Date</th>
                                                    <th style="width: 55px;">Price</th>
                                                    <th style="width: 70px;">Quantity</th>
                                                    <th style="width: 69px;">Status</th>
                                                    <th class="dtr-hidden " style="width: 0px; display: none;">Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($products as $product)
                                                    <tr role="row" class="odd">
                                                        <td class="pe-0 dtr-control _1">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="contactCheckbox2">
                                                                <label class="form-check-label" for="contactCheckbox2">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="ps-0">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ getFile($product->image_url) }}"
                                                                    alt="" class="img-4by3-sm rounded-3">
                                                                <div class="ms-3">
                                                                    <h5 class="mb-0"> <a href="#!"
                                                                            class="text-inherit">{{ $product->name }}
                                                                        </a></h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td> {{ $product->category->name }}</td>
                                                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                                        <td>{{ $product->sale_price }}</td>
                                                        <td>{{ $product->quantity }}</td>
                                                        <td>
                                                            @if ($product->status == 'Published')
                                                                <span class="badge badge-success-soft">Published</span>
                                                            @elseif ($product->status == 'Unpublished')
                                                                <span
                                                                    class="badge badge-warning-soft">Unpublished</span>
                                                            @elseif ($product->status == 'Draft')
                                                                <span class="badge badge-danger-soft">Draft</span>
                                                            @endif
                                                        </td>
                                                        <td class="dtr-hidden" style="display: none;">

                                                            <a href="#!"
                                                                wire:click="showProduct({{ $product->id }})"
                                                                {{-- data-bs-toggle="modal" data-bs-target="#showProduct" --}}
                                                                class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                data-template="eyeOne">
                                                                <i class="fa-regular fa-eye"></i>

                                                                <div id="eyeOne" class="d-none">
                                                                    <span>View</span>
                                                                </div>
                                                            </a>
                                                            <a href="{{ route('Product.edit', $product->id) }}"
                                                                class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                data-template="editOne"> <i
                                                                    class="fa-regular fa-pen-to-square"></i>
                                                                <div id="editOne" class="d-none">
                                                                    <span
                                                                        onclick="window.location='{{ route('Product.edit', $product->id) }}'">
                                                                        Edit
                                                                    </span>

                                                                </div>
                                                            </a>
                                                            <a href="#!" data-bs-toggle="modal"
                                                                data-bs-target="#deleteProdMsg"
                                                                class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                data-template="trashOne"> <i
                                                                    class="fa-solid fa-trash-can"
                                                                    style="color: #df436a;"></i>
                                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-trash-2 icon-xs">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11"
                                                                        x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11"
                                                                        x2="14" y2="17"></line>
                                                                </svg> --}}
                                                                <div wire:click="deleteProduct({{ $product->id }})"
                                                                    id="trashOne" class="d-none">
                                                                    <span>Delete</span>
                                                                </div>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Show Product Details Model  --}}

    <div wire:ignore.self class="modal fade in" id="showProduct" tabindex="-1" aria-labelledby="showProductLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Details of <span
                            class="badge-primary-soft p-2 primary-color rounded text-capitalize text-primary">
                            {{ $product->name ?? '' }}</span> </h4><button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr data-dt-row="32" data-dt-column="2">
                                <td>Code:</td>
                                <td><a
                                        href="app-ecommerce-order-details.html"><span>#{{ $product->product_code ?? '' }}</span></a>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="3">
                                <td>Description:</td>
                                <td><span>{{ $product->description ?? '' }} Description Description Description
                                        DescriptionDescription Description Description </span></td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="4">
                                <td>Date added:</td>
                                <td><span class="text-nowrap">{{ $product->created_at ?? '' }}</span></td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="5">
                                <td>Image:</td>
                                <td>
                                    <div
                                        class="d-flex justify-content-start align-items-center order-name text-nowrap">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2"><img
                                                    src="{{ getFile($product->image_url ?? '') }}" alt="image_url"
                                                    class="rounded-circle"></div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="m-0"><a href="pages-profile-user.html"
                                                    class="text-body">{{ $product->name ?? '' }}</a></h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="6">
                                <td>Status:</td>
                                <td>
                                    <h6 class="mb-0 align-items-center d-flex w-px-100 text-success"><i
                                            class="ti ti-circle-filled fs-tiny me-2"></i>{{ $product->status ?? '' }}
                                    </h6>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="7">
                                <td>Quantity:</td>
                                <td><span>{{ $product->quantity ?? '' }}</span>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="8">
                                <td>Purchase Price:</td>
                                <td><span>{{ $product->purchase_price ?? '' }}</span>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="9">
                                <td>Sale Price:</td>
                                <td><span>{{ $product->sale_price ?? '' }}</span>
                                </td>
                            </tr>

                            <tr data-dt-row="32" data-dt-column="10">
                                <td>Actions:</td>
                                <td>
                                    <div class="d-flex justify-content-sm-center align-items-sm-center"><button
                                            class="btn btn-sm btn-icon hide-arrow" data-bs-toggle="dropdown"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a href="#"
                                                class="dropdown-item">Desactive</a><a href="javascript:0;"
                                                class="dropdown-item delete-record">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- 
    <div wire:ignore.self class="modal fade in" id="deleteProdMsg" tabindex="-1"
        aria-labelledby="deleteProdMsgLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Details of Cristine Easom</h4><button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr data-dt-row="32" data-dt-column="2">
                                <td>order:</td>
                                <td><a href="app-ecommerce-order-details.html"><span>#6979</span></a></td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="3">
                                <td>date:</td>
                                <td><span class="text-nowrap">Apr 15, 2023, 10:21</span></td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="4">
                                <td>customers:</td>
                                <td>
                                    <div
                                        class="d-flex justify-content-start align-items-center order-name text-nowrap">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2"><img
                                                    src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/3.png"
                                                    alt="Avatar" class="rounded-circle"></div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="m-0"><a href="pages-profile-user.html"
                                                    class="text-body">Cristine Easom</a></h6><small
                                                class="text-muted">ceasomw@theguardian.com</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="5">
                                <td>payment:</td>
                                <td>
                                    <h6 class="mb-0 align-items-center d-flex w-px-100 text-warning"><i
                                            class="ti ti-circle-filled fs-tiny me-2"></i>Pending</h6>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="6">
                                <td>status:</td>
                                <td><span class="badge px-2 bg-label-success" text-capitalized="">Delivered</span>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="7">
                                <td>method:</td>
                                <td>
                                    <div class="d-flex align-items-center text-nowrap"><img
                                            src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/icons/payments/mastercard.png"
                                            alt="mastercard" class="me-2" width="16"><span><i
                                                class="ti ti-dots me-1 mt-n1"></i>2356</span></div>
                                </td>
                            </tr>
                            <tr data-dt-row="32" data-dt-column="8">
                                <td>Actions:</td>
                                <td>
                                    <div class="d-flex justify-content-sm-center align-items-sm-center"><button
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                href="app-ecommerce-order-details.html"
                                                class="dropdown-item">View</a><a href="javascript:0;"
                                                class="dropdown-item delete-record">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Delete Model  --}}

    <div wire:ignore.self class="modal fade in" id="deleteProdMsg" tabindex="-1"
        aria-labelledby="deleteProdMsgLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="deleteCatMsgLabel"> {{ __('Delete Product') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure want to delete this product?') }}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Cancel') }} </button>
                    <button wire:click="destroyProduct()" type="button"
                        class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
</div>
@push('head')
    <style>
        .modal .btn-close {
            background-color: #fff;
            border-radius: .375rem;
            background-image: url("data:image/svg+xml,%3Csvg width='19' height='18' viewBox='0 0 19 18' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M14 4.5L5 13.5' stroke='%23a5a3ae' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M14 4.5L5 13.5' stroke='white' stroke-opacity='0.2' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 4.5L14 13.5' stroke='%23a5a3ae' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 4.5L14 13.5' stroke='white' stroke-opacity='0.2' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A");
            opacity: 1;
            padding: .44rem;
            box-shadow: 0 .125rem .25rem rgba(165, 163, 174, .3);
            transition: all .23s ease .1s
        }

        html:not([dir=rtl]) .modal .btn-close {
            transform: translate(23px, -25px)
        }

        [dir=rtl] .modal .btn-close {
            transform: translate(-31px, -25px)
        }

        .modal .btn-close:hover,
        .modal .btn-close:focus,
        .modal .btn-close:active {
            opacity: 1;
            outline: none
        }

        html:not([dir=rtl]) .modal .btn-close:hover,
        html:not([dir=rtl]) .modal .btn-close:focus,
        html:not([dir=rtl]) .modal .btn-close:active {
            transform: translate(20px, -20px)
        }

        [dir=rtl] .modal .btn-close:hover,
        [dir=rtl] .modal .btn-close:focus,
        [dir=rtl] .modal .btn-close:active {
            transform: translate(-26px, -20px)
        }

        .modal .modal-header {
            position: relative
        }

        .modal .modal-header .btn-close {
            position: absolute;
            top: 1.56rem
        }

        html:not([dir=rtl]) .modal .modal-header .btn-close {
            right: 1rem
        }

        [dir=rtl] .modal .modal-header .btn-close {
            left: 1.3rem
        }

        .modal-footer {
            padding: .25rem 1.5rem 1.25rem
        }

        .modal-content {
            box-shadow: 0 .31rem 1.25rem 0 rgba(75, 70, 92, .4)
        }

        .modal-dialog-scrollable .btn-close,
        .modal-fullscreen .btn-close,
        .modal-top .btn-close {
            box-shadow: none
        }

        html:not([dir=rtl]) .modal-dialog-scrollable .btn-close,
        html:not([dir=rtl]) .modal-fullscreen .btn-close,
        html:not([dir=rtl]) .modal-top .btn-close {
            transform: translate(0, 0) !important
        }

        [dir=rtl] .modal-dialog-scrollable .btn-close,
        [dir=rtl] .modal-fullscreen .btn-close,
        [dir=rtl] .modal-top .btn-close {
            transform: translate(0, 0) !important
        }

        html:not([dir=rtl]) .modal-dialog-scrollable .btn-close:hover,
        html:not([dir=rtl]) .modal-fullscreen .btn-close:hover,
        html:not([dir=rtl]) .modal-top .btn-close:hover {
            transform: translate(0, 0) !important
        }

        [dir=rtl] .modal-dialog-scrollable .btn-close:hover,
        [dir=rtl] .modal-fullscreen .btn-close:hover,
        [dir=rtl] .modal-top .btn-close:hover {
            transform: translate(0, 0) !important
        }

        .modal-onboarding .close-label {
            font-size: .8rem;
            position: absolute;
            top: .85rem;
            opacity: .5
        }

        .modal-onboarding .close-label:hover {
            opacity: .75
        }

        [dir=rtl] .modal-onboarding .modal-header .btn-close {
            margin-left: 0;
            margin-right: auto
        }

        .modal-onboarding .onboarding-media {
            margin-bottom: 1rem
        }

        .modal-onboarding .onboarding-media img {
            margin: 0 auto
        }

        .modal-onboarding .onboarding-content {
            margin: 2rem
        }

        .modal-onboarding form {
            margin-top: 2rem;
            text-align: left
        }

        .modal-onboarding .carousel-indicators {
            bottom: -10px
        }

        .modal-onboarding .carousel-control-prev,
        .modal-onboarding .carousel-control-next {
            top: auto;
            bottom: .75rem;
            opacity: 1
        }

        [dir=rtl] .modal-onboarding .carousel-control-prev,
        [dir=rtl] .modal-onboarding .carousel-control-next {
            flex-direction: row-reverse
        }

        .modal-onboarding .carousel-control-prev {
            left: 1rem
        }

        .modal-onboarding .onboarding-horizontal {
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .modal-onboarding .onboarding-horizontal .onboarding-media {
            margin: 2rem;
            margin-top: 0
        }

        .modal-onboarding .onboarding-horizontal .carousel-control-prev {
            left: 0
        }

        .modal-onboarding.animated .onboarding-media {
            transform: translateY(10px) scale(0.8);
            transition: all .5s cubic-bezier(0.25, 1.1, 0.5, 1.35);
            transition-delay: .3s;
            opacity: 0
        }

        .modal-onboarding.animated .onboarding-content {
            transform: translateY(40px);
            transition-delay: .1s;
            transition: all .4s ease;
            opacity: 0
        }

        .modal-onboarding.animated .onboarding-title {
            opacity: 0;
            transition-delay: .5s;
            transition: all .5s cubic-bezier(0.25, 1.1, 0.5, 1.35);
            transform: translateY(40px)
        }

        .modal-onboarding.animated .onboarding-info {
            opacity: 0;
            transition-delay: .6s;
            transition: all .5s cubic-bezier(0.25, 1.1, 0.5, 1.35);
            transform: translateY(40px)
        }

        .modal-onboarding.animated form {
            opacity: 0;
            transition-delay: .7s;
            transition: all .5s ease;
            transform: translateY(40px)
        }

        .modal-onboarding.animated.show .onboarding-media {
            transform: translateY(0) scale(1);
            opacity: 1
        }

        .modal-onboarding.animated.show .onboarding-content {
            transform: translateY(0);
            opacity: 1
        }

        .modal-onboarding.animated.show .onboarding-title {
            transform: translateY(0);
            opacity: 1
        }

        .modal-onboarding.animated.show .onboarding-info {
            opacity: 1;
            transform: translateY(0px)
        }

        .modal-onboarding.animated.show form {
            opacity: 1;
            transform: translateY(0px)
        }

        .modal-top .modal-dialog {
            margin-top: 0
        }

        .modal-top .modal-content {
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .modal-transparent .modal-dialog {
            display: flex;
            margin: 0 auto;
            min-height: 100vh
        }

        .modal-transparent .modal-content {
            margin: auto;
            width: 100%;
            border: 0;
            background: rgba(0, 0, 0, 0);
            box-shadow: none
        }

        .modal-transparent .btn-close {
            position: absolute;
            top: 0;
            right: .25rem;
            opacity: 1;
            padding: .25em .25em;
            background-image: url("data:image/svg+xml,%3Csvg width='19' height='18' viewBox='0 0 19 18' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M14 4.5L5 13.5' stroke='%23fff' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M14 4.5L5 13.5' stroke='white' stroke-opacity='0.2' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 4.5L14 13.5' stroke='%23fff' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 4.5L14 13.5' stroke='white' stroke-opacity='0.2' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A");
            background-color: rgba(0, 0, 0, 0) !important
        }

        [dir=rtl] .modal-transparent .btn-close {
            right: auto;
            left: .25rem
        }

        .modal-simple .modal-content {
            padding: 3rem
        }

        .modal-simple .btn-close {
            position: absolute;
            top: -2rem
        }

        [dir=rtl] .modal-simple .btn-close {
            left: -2rem
        }

        html:not([dir=rtl]) .modal-simple .btn-close {
            right: -2rem
        }

        @media(max-width: 767.98px) {
            .modal-simple .btn-close {
                top: 0
            }

            [dir=rtl] .modal-simple .btn-close {
                left: 0
            }

            html:not([dir=rtl]) .modal-simple .btn-close {
                right: 0
            }
        }

        .modal-refer-and-earn .modal-refer-and-earn-step {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: .375rem
        }

        .modal-refer-and-earn .modal-refer-and-earn-step i {
            font-size: 2.5rem
        }

        .modal-top.fade .modal-dialog,
        .modal-top .modal.fade .modal-dialog {
            transform: translateY(-100%)
        }

        .modal-top.show .modal-dialog,
        .modal-top .modal.show .modal-dialog {
            transform: translateY(0)
        }

        .modal-transparent.fade .modal-dialog,
        .modal-transparent .modal.fade .modal-dialog {
            transform: scale(0.5, 0.5)
        }

        .modal-transparent.show .modal-dialog,
        .modal-transparent .modal.show .modal-dialog {
            transform: scale(1, 1)
        }

        @media(max-width: 991.98px) {
            .modal-onboarding .onboarding-horizontal {
                flex-direction: column
            }
        }

        @media(max-width: 767.98px) {
            .modal .modal-dialog:not(.modal-fullscreen) {
                padding: 0 .75rem;
                padding-left: .75rem !important
            }

            .modal .carousel-control-prev,
            .modal .carousel-control-next {
                display: none
            }
        }

        @media(min-width: 576px) {
            .modal-content {
                box-shadow: 0 .31rem 1.25rem 0 rgba(75, 70, 92, .4)
            }

            .modal-sm .modal-dialog {
                max-width: 22.5rem
            }
        }

        @media(min-width: 1200px) {
            .modal-xl .modal-dialog {
                max-width: 1140px
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        window.addEventListener('show-show-product-modal', event => {
            $('#showProduct').modal('show');
        });
    </script>

    <script>
        // Function to hide the success message after a delay
        function hideSuccessMessage() {
            setTimeout(function() {
                var successMessage = document.getElementById('liveAlert');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 2000); // Change 5000 to the desired delay in milliseconds (e.g., 3000 for 3 seconds)
        }

        // Call the function to hide the message when the page loads
        window.addEventListener('load', hideSuccessMessage);
    </script>
@endpush
