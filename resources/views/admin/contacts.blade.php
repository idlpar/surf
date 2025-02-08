@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Unread Messages</h3>
            </div>

            <div class="wg-box">
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
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

                        <!-- Multi Delete Form -->
                        <form id="delete-multiple-form" action="{{ route('admin.contacts.deleteMultiple') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger rounded-pill px-4 py-2 mb-2 fs-4" onclick="confirmDeleteMultiple()">Delete Selected</button>

                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th style="width: 5%;">Received At</th>
                                    <th style="width: 10%;">Email</th>
                                    <th style="width: 10%;">Name</th>
                                    <th style="width: 15%;">Subject</th>
                                    <th style="width: 35%;">Message</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="selected_ids[]" value="{{ $contact->id }}" class="select-item">
                                        </td>
                                        <td>{{ $contact->created_at->format('d-M-y h:i A') }}</td>
                                        <td>{{ Str::limit($contact->email, 20) }}</td>
                                        <td>{{ Str::limit($contact->name, 20) }}</td>
                                        <td>{{ Str::limit($contact->subject, 50) }}</td>
                                        <td>{{ Str::limit($contact->message, 200) }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.contact.read', ['id' => $contact->id]) }}">
                                                    <div class="item view">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </a>
                                                <form action="{{ route('admin.contact.delete', ['id' => $contact->id]) }}" method="POST" id="delete-form-{{ $contact->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="item text-danger delete"
                                                         onclick="confirmDelete('delete-form-{{ $contact->id }}')">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('select-all').addEventListener('change', function() {
                document.querySelectorAll('.select-item').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            function confirmDeleteMultiple() {
                let selected = document.querySelectorAll('.select-item:checked');
                if (selected.length === 0) {
                    Swal.fire('No items selected', 'Please select at least one message.', 'warning');
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Selected messages will be deleted permanently!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete them!',
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-multiple-form').submit();
                    }
                });
            }
        </script>
    @endpush
@endsection
