@extends('layouts.admin')
@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brands</h3>
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
                        <div class="text-tiny">Brands</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.brand.add') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        @if (session()->has('success'))
                            <p class="alert alert-success">{{ session('success') }}</p>
                        @endif
                        <table class="table table-striped table-bordered table-auto w-full">
                            <thead>
                            <tr class="text-center">
                                <th class="px-4 py-4 text-center" style="width: 5%;">#</th>
                                <th class="px-4 py-4 text-center" style="width: 10%;">Thumbnail</th>
                                <th class="px-4 py-4 text-center" style="width: 20%;">Name</th>
                                <th class="px-4 py-4 text-center" style="width: 30%;">Description</th>
                                <th class="px-4 py-4 text-center" style="width: 15%;">Slug</th>
                                <th class="px-4 py-4 text-center" style="width: 10%;">Products</th>
                                <th class="px-4 py-4 text-center" style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <!-- Brand ID -->
                                    <td class="px-4 py-2 text-center">{{ $brand->id }}</td>
                                    <!-- Thumbnail Name -->
                                    <td class="px-4 py-2">
                                        <div class="frame w-full h-full flex-shrink-0 mr-4 p-2 border-4 border-gold rounded-lg shadow-lg">
                                            <img src="{{ asset('uploads/brands/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-full h-full object-cover rounded">
                                        </div>
                                    </td>

                                    <!-- Brand Name -->
                                    <td class="px-4 py-2">

                                        <!-- Brand Name in Center with 70% width, centered both horizontally and vertically -->
                                        <div class="name flex justify-center items-center text-center h-full">
                                            <a href="#" class="body-title-2 font-semibold">{{ $brand->name }}</a>
                                        </div>

                                    </td>



                                    <!-- Brand Description -->
                                    <td class="px-4 py-2">{{ \Illuminate\Support\Str::words($brand->description, 20, '...') }}</td>

                                    <!-- Brand Slug -->
                                    <td class="px-4 py-2">{{ $brand->slug }}</td>

                                    <!-- Products -->
                                    <td class="px-4 py-2 text-center">
                                        <a href="#" target="_blank">0</a>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-4 py-2">
                                        <div class="flex justify-center items-center w-full h-full">
                                            <!-- Edit Action -->
                                            <a href="{{ route('admin.brand.edit', ['id' => $brand->id]) }}" class="flex justify-center items-center">
                                                <div class="item edit cursor-pointer text-blue-600">
                                                    <i class="icon-edit-3 text-lg leading-none" style="font-size: 24px;"></i> <!-- Custom icon size -->
                                                </div>
                                            </a>
                                            <!-- Separator -->
                                            <span class="text-gray-400 mx-2 flex items-center">|</span> <!-- Separator icon -->


                                            <!-- Delete Action -->
                                            <form action="{{ route('admin.brand.delete', ['id' => $brand->id]) }}" method="POST" style="display: inline-block;" class="delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn text-danger cursor-pointer">
                                                    <i class="icon-trash-2 text-lg leading-none" style="font-size: 24px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $brands->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Attach a click event handler to the delete button inside forms with the 'delete' class
            $('form.delete').on('click', 'button', function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Find the closest form to the clicked button
                var form = $(this).closest('form');

                // Display the confirmation dialog using SweetAlert
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data.",
                    icon: "warning",
                    buttons: {

                        confirm: {
                            text: "Yes",
                            value: true,
                            visible: true,
                            className: "btn-danger",
                        }, cancel: {
                            text: "No",
                            visible: true,
                            className: "btn-secondary",
                        }
                    },

                }).then(function (result) {
                    // If the user confirms, submit the form
                    if (result) {
                        form.submit();
                    }
                });
            });
        });
    </script>

@endpush

