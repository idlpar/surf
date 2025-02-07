@extends('layouts.admin')
@push('styles')
    <style>
        td {
            max-width: 200px; /* Set max width for the table cell */
            white-space: nowrap; /* Prevent text from wrapping to the next line */
            overflow: hidden; /* Hide anything that overflows the container */
            text-overflow: ellipsis; /* Show "..." when the text overflows */
        }

    /* Adjust the title size */
    .swal2-popup .swal2-title {
    font-size: 24px;  /* Title font size */
    line-height: 5rem;
    }

    /* Adjust the body text size */
    .swal2-popup .swal2-html-container {
    font-size: 18px;  /* Body font size */
    }

    /* Adjust confirm button font size and overall size */
    .swal2-popup .swal2-confirm {
    font-size: 16px;  /* Button font size */
    padding: 12px 24px;  /* Button padding (increase for larger button) */
    font-weight: bold;  /* Optional: Make text bold */
    border-radius: 15px;
    }

    /* Adjust cancel button font size and overall size */
    .swal2-popup .swal2-cancel {
    font-size: 16px;  /* Button font size */
    padding: 12px 24px;  /* Button padding (increase for larger button) */
    font-weight: bold;  /* Optional: Make text bold */
    border-radius: 15px;
    }
    /* Increase the width of the popup box */
    .swal2-popup {
    width: 400px;  /* Set custom width */
    max-width: 50%;  /* Make sure it is responsive */
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
    </style>
@endpush
@section('content')
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Slides</h3>
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
                            <div class="text-tiny">Slides</div>
                        </li>
                    </ul>
                </div>

                <div class="wg-box">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center fs-5 fw-bold" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center fs-5 fw-bold" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                            <strong>{{ Session::get('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                        <a class="tf-button style-1 w208" href="{{ route('admin.slide.add') }}"><i
                                class="icon-plus"></i>Add new</a>
                    </div>
                    <div class="wg-table table-all-user">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-center" style="width: 5%;">Image</th>
                                <th class="text-center" style="width: 20%;">Tagline</th>
                                <th class="text-center" style="width: 20%;">Title</th>
                                <th class="text-center" style="width: 20%;">Subtitle</th>
                                <th class="text-center" style="width: 10%;">Active</th>
                                <th class="text-center" style="width: 10%;">Link</th>
                                <th class="text-center" style="width: 5%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $slides as $slide )
                            <tr>
                                <td class="text-center">{{ $slide->id }}</td>
                                <td class="pname">
                                    <div class="image">
                                        <img src="{{ asset('uploads/slides/' . $slide->image ) }}" alt="{{ $slide->tagline }}" class="{{ $slide->title }}">
                                    </div>
                                </td>
                                <td>{{ $slide->tagline }}</td>
                                <td>{{ $slide->title }}</td>
                                <td>{{ $slide->subtitle }}</td>
                                <td class="text-center">
                                    @if($slide->status == 1)
                                        <span class="badge bg-success px-2 py-2 fs-4 text-white">Yes</span>
                                    @else
                                        <span class="badge bg-danger px-2 py-2 fs-4 text-white">No</span>
                                    @endif
                                </td>
                                <td>{{ $slide->link }}</td>
                                <td>
                                    <div class="list-icon-function">
                                        <a href="{{ route('admin.slide.edit', [ 'id' => $slide->id ]) }}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <!-- Delete Button -->
                                        <form id="delete-form-{{ $slide->id }}" action="{{ route('admin.slide.delete', ['id' => $slide->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <div class="item text-danger delete" onclick="confirmDelete(event, {{ $slide->id }})">
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
                        {{ $slides->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event, slideId) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + slideId).submit();
                }
            });
        }
    </script>
@endpush
