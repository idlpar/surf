@extends('layouts.admin')

@section('title', 'View Message')

@push('styles')
    <style>
        /* Card Styling */
        .message-card {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        /* Header */
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        .message-header h4 {
            font-size: 22px;
            color: #333;
            font-weight: bold;
            margin: 0;
        }

        .message-date {
            font-size: 16px;
            font-weight: bold;
            color: #079573;
            background: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Content */
        .message-content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .message-content p {
            font-size: 16px;
            color: #444;
            line-height: 1.6;
        }

        /* Footer Buttons */
        .message-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
        }

        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border-radius: 10px;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border-radius: 10px;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .btn-custom i {
            margin-right: 8px;
        }

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
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="message-card">

                    <!-- Message Header -->
                    <div class="message-header">
                        <h4>Message from: <span style="color:#0b5ed7;">{{ $contact->name }}</span> </h4>
                        <span class="message-date">{{ $contact->created_at->format('d M, Y h:i A') }}</span>
                    </div>

                    <!-- Message Content -->
                    <div class="message-content">
                        <p><strong>Email:</strong> <span style="color: #007aff;">{{ $contact->email }}</span></p>
                        <p><strong>Subject:</strong> <span style="color: #11853a;"> {{ $contact->subject }}</span></p>
                        <hr>
                        <p>{!! nl2br(e($contact->message)) !!}</p>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="message-footer">

                        <form action="{{ route('admin.contact.delete', [ 'id' => $contact->id]) }}" method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-custom btn-delete" onclick="confirmDelete('delete-form')">
                                <span style="margin-right: 6px;"><i class="fas fa-trash-alt"></i></span> Delete
                            </button>
                        </form>

                        <a href="{{ route('admin.contacts') }}" class="btn-custom btn-back">
                            <span style="margin-right: 6px;"><i class="fas fa-arrow-left"></i></span> Back
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>--}}

    <script>
        function confirmDelete(formId) {
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
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endpush
