@extends('layouts.admin')
@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>All Products</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All Products</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                       tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="table-responsive">
                    @if (session()->has('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 5%; text-align: center">#</th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 10%;">Price</th>
                            <th style="width: 10%;">SalePrice</th>
                            <th style="width: 10%;">SKU</th>
                            <th style="width: 10%;">Category</th>
                            <th style="width: 10%;">Brand</th>
                            <th style="width: 8%;">Featured</th>
                            <th style="width: 7%;">Stock</th>
                            <th style="width: 5%;">Quantity</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="text-center">{{ $product->id }}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ asset('uploads/products/') }}/{{ $product->image }}" alt=" {{ $product->name }}" class="image">
                                </div>
                                <div class="name">
                                    <a href="#" class="body-title-2">{{ $product->name }}</a>
                                    <div class="text-tiny mt-3">{{ $product->slug }}</div>
                                </div>
                            </td>
                            <td>Tk. {{ $product->regular_price }}</td>
                            <td>Tk. {{ $product->sale_price }}</td>
                            <td>{{ $product->SKU }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->is_featured == 0 ? "No": "Yes" }}</td>
                            <td>{{ $product->stock_status }}</td>
                            <td class="text-center">{{ $product->quantity }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('shop.product.details', [ 'product_slug' => $product->slug ]) }}" target="_blank">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.product.edit', [ 'id' => $product->id ]) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.product.delete', [ 'id' => $product->id ] ) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <div class="item text-danger delete" onclick="deleteProduct({{ $product->id }})">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $products->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        /* Adjust the title size */
        .swal2-popup .swal2-title {
            font-size: 24px !important;  /* Title font size */
        }

        /* Adjust the body text size */
        .swal2-popup .swal2-html-container {
            font-size: 18px !important;  /* Body font size */
        }

        /* Adjust confirm button font size and overall size */
        .swal2-popup .swal2-confirm {
            font-size: 16px !important;  /* Button font size */
            padding: 12px 24px !important;  /* Button padding (increase for larger button) */
            font-weight: bold !important;  /* Optional: Make text bold */
        }

        /* Adjust cancel button font size and overall size */
        .swal2-popup .swal2-cancel {
            font-size: 16px !important;  /* Button font size */
            padding: 12px 24px !important;  /* Button padding (increase for larger button) */
            font-weight: bold !important;  /* Optional: Make text bold */
        }
        /* Increase the width of the popup box */
        .swal2-popup {
            width: 400px !important;  /* Set custom width */
            max-width: 50% !important;  /* Make sure it is responsive */
        }
        /* Custom styling for the red circular icon */
        .custom-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%; /* Makes it a circle */
            display: flex;
            padding: 10px;
            align-items: center;
            justify-content: center;
        }

        /* Adjust the icon inside the circle */
        .custom-icon i {
            font-size: 28px; /* Adjust icon size */
            color: white !important; /* White icon */
        }

        /* Ensures SweetAlert2's icon container doesn't override styling */
        .custom-icon-container {

            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        function deleteProduct(productId) {
            Swal.fire({
                title: 'Are you sure?',
                html: 'You won\'t be able to revert this!',
                iconHtml: '<div class="custom-icon"><i class="fas fa-trash"></i></div>',  // Custom icon inside a div
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    icon: 'custom-icon-container',  // Ensures styling applies
                    title: 'swal-title',
                    text: 'swal-text',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                },
                focusCancel: true
        }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form dynamically
                    document.getElementById('delete-form-' + productId).submit();
                }
            });
        }
    </script>
@endpush


