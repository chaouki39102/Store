<div id="main">
    <section class="section">
        @if ($message = session('message'))
            <!-- Success alert -->
            <div class="alert alert-success alert-dismissible d-flex align-items-center col-xl-12 col-lg-6 mb-5"
                role="alert" id="liveAlert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="d-flex justify-content-between mb-5 align-items-center">
            <h3 class="mb-0 ">Category</h3>
            <a href="{{ route('Category.create') }}" class="btn btn-primary">+ Add Category</a>
        </div>

        <div class="col-xl-12 col-lg-6 mb-5">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center ">

                    <h4 class="mb-0">List of categories</h4>
                    <div class="d-flex align-items-center">
                        <div class="col">
                            <span>Sort By:</span>
                        </div>
                        <div class="col-auto ms-2">
                            <select class="form-select form-select-sm">
                                <option selected="">Asc</option>
                                <option value="Yesterday">Dec</option>
                                <option value="Last 7 Days">Alphabetic</option>>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table text-nowrap mb-0 table-centered">
                            <thead class="table-light">
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>VISIBILITY</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <img class="img-4by3-xs rounded" style=" width: 75px; height: 75px;"
                                                src="{{ getFile($category->image) }}" alt="{{ $category->name }}">
                                        </td>
                                        <td class="text-bold-500">{{ $category->name }}</td>
                                        <td class="text-bold-500">{{ $category->description }}</td>
                                        <td>
                                            {{ $category->status == 1 ? ' Visible' : 'Hidden' }}</td>
                                        <td>
                                            <a href="{{ route('Category.edit', $category->id) }}">
                                                <i class="fa-solid fa-pencil m-2"></i>
                                            </a>
                                            <a role="button">
                                                <i wire:click="deleteCategory({{ $category->id }})"
                                                    class="fa-solid fa-trash-can m-2" style="color: #fb3c46;"
                                                    data-bs-toggle="modal" data-bs-target="#deleteCatMsg">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $categories->links() }}


            {{-- Delete Model  --}}

            <div wire:ignore.self class="modal fade in" id="deleteCatMsg" tabindex="-1"
                aria-labelledby="deleteCatMsgLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="deleteCatMsgLabel">
                                {{ __('Delete Category') }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        {{-- <form wire:submit="destroyCategory()"> --}}
                        <div class="modal-body">
                            {{ __('Are you sure want to delete this category?') }}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }} </button>
                            <button wire:click="destroyCategory()" type="button"
                                class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
    </section>
</div>






@push('scripts')
    <script>
        window.addEventListener("close-modal", function(e) {
            $('#deleteCatMsg').modal('hide');
        });
    </script>
@endpush
