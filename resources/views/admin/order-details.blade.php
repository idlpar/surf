@extends('layouts.admin')
@push('styles')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
         .btn-gradient-main {
             background: linear-gradient(45deg, #007bff 0%, #0056b3 100%);
             color: white;
             border: none;
             text-transform: uppercase;
         }

        .btn-gradient-main:hover {
            background: linear-gradient(45deg, #0056b3 0%, #004085 100%);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
        }

        .form-control {
            border: 4px solid #f0f0f0;
            padding: 18px 20px;
            border-radius: 12px;
            background: #dfecff;
            font-size: 16px;
            transition: border 0.4s ease, background-color 0.4s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            background-color: #ffffff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
        }

        .wg-box {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        h5 {
            font-family: 'Roboto', sans-serif;
            font-size: 22px;
            letter-spacing: 1px;
            color: #333;
        }

        .btn-lg {
            padding: 15px 30px;
            font-size: 18px;
            letter-spacing: 1px;
        }

        /* Icon styling */
        .btn-gradient-main i {
            margin-right: 10px;
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
                <h3>Order Details #{{ $order->order_number }}</h3>
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
                        <div class="text-tiny">Order Details</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Ordered Products</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.orders') }}">Back</a>
                </div>
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

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td class="pname">
                                    <div class="image" style="display: flex; justify-content: center; align-items: center; height: 50px;">
                                        <img src="{{ asset('uploads/products/' . $item->product->image ) }}" alt="{{ $item->product->name }}" class="image" style="max-width: 50px; max-height: 50px;">
                                    </div>
                                    <div class="name" style="display: flex; justify-content: center; align-items: center; height: 50px;">
                                        <a href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}" target="_blank" class="body-title-2 mouse-pointer items-center">
                                            {{ $item->product->name ?? 'N/A' }}
                                        </a>
                                    </div>
                                </td>

                                <td style="text-align: right; padding-right: 5px;">{{ format_currency($item->price) }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">{{ $item->sku }}</td>
                                <td class="text-center">{{$item->product->category->name ?? 'N/A'}}</td>
                                <td style="text-align: right; padding-right: 5px;">{{ format_currency($item->price * $item->quantity) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Separate Form (Hidden) -->
            <form action="{{ route('admin.order.status.update') }}" method="POST" id="update_status">
                @csrf
                @method('PUT')
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="status" id="status_input"> <!-- Hidden input for status -->
            </form>

            <!-- Separate DIV with Elegant Design -->
            <div class="wg-box p-5 rounded-4 shadow-lg" style="background: rgba(255,255,255,0.04); border-radius: 15px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
                <h5 class="text-center mb-4 text-uppercase fw-bold text-dark" style="font-family: 'Roboto', sans-serif;">Update Order Status</h5>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 col-lg-3">
                        <select id="status_select" class="form-control fw-semibold" style="padding: 18px 20px; border-radius: 12px; border: 4px solid #c6ede7; background: #e7eef4; transition: all 0.4s ease; font-family: 'Roboto', sans-serif;" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <button type="button" class="btn btn-lg btn-gradient-main fs-2 px-5 py-8 fw-bold w-100"
                                onclick="confirmUpdateStatus()"
                                style="padding: 18px 20px; transition: all 0.4s ease; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 123, 255, 0.25); font-family: 'Roboto', sans-serif;">
                            <i class="fas fa-sync-alt"></i> Update Status
                        </button>
                    </div>
                </div>
            </div>

            <div class="wg-box mt-5">
                <div class="row">
                    <!-- Left Side - Shipping Address -->
                    <div class="col-md-5">
                        <div class="card shadow-lg p-4 rounded h-100">
                            @php
                                $shippingAddress = json_decode($order->shipping_address, true) ?? [];
                            @endphp

                            @if(!empty($shippingAddress))
                                <h5 class="font-weight-bold mb-3" style="font-size: 2.5rem; line-height: 5rem;">Shipping Address</h5>
                                <div class="address-detail">
                                    <p style="font-size: 16px; line-height: 2.5rem;"><strong>Name:</strong> {{ $shippingAddress['name'] ?? 'N/A' }}</p>
                                    <p style="font-size: 16px; line-height: 2.5rem;"><strong>Address:</strong> {{ $shippingAddress['address'] ?? 'N/A' }}</p>
                                    <p style="font-size: 16px; line-height: 2.5rem;"><strong>Locality:</strong> {{ $shippingAddress['locality'] ?? 'N/A' }}</p>
                                    <p style="font-size: 16px; line-height: 2.5rem;"><strong>City, State:</strong> {{ $shippingAddress['city'] ?? 'N/A' }}, {{ $shippingAddress['state'] ?? 'N/A' }}</p>
                                    <p style="font-size: 16px; line-height: 2.5rem;"><strong>Postal Code:</strong> {{ $shippingAddress['postal_code'] ?? 'N/A' }}</p>
                                    <p style="font-size: 16px; line-height: 5.5rem;"><strong>Mobile:</strong> {{ $shippingAddress['phone'] ?? 'N/A' }}</p>
                                </div>
                            @else
                                <p class="text-muted">No shipping address provided.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Right Side - Transactions Table -->
                    <div class="col-md-7">
                        <div class="card shadow-lg p-4 rounded h-100">
                            <h5 class="font-weight-bold mb-3 lh-lg">Transactions</h5>
                            <table class="table table-responsive-md table-bordered fs-5 w-100">
                                <tbody>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-success font-weight-bold">{{ format_currency($order->total) }}</td>
                                    <th class="w-25">Tax</th>
                                    <td class="w-25">{{ format_currency($order->tax) }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25">Subtotal</th>
                                    <td class="w-25">{{ format_currency($order->subtotal) }}</td>
                                    <th>Discount</th>
                                    <td>{{ format_currency($order->discount) }}</td>

                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td class="text-capitalize">{{ optional($order->transaction)->gateway ?? 'N/A' }}</td>
                                    <th>Payment Status</th>
                                    <td class="text-capitalize">
                                        @php
                                            $transactionStatus = optional($order->transaction)->status;
                                        @endphp

                                        @if($transactionStatus)
                                            @switch($transactionStatus)
                                                @case('approved')
                                                    <span class="badge bg-success">Approved</span>
                                                    @break

                                                @case('pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                    @break

                                                @case('completed')
                                                    <span class="badge bg-primary">Completed</span>
                                                    @break

                                                @case('failed')
                                                    <span class="badge bg-danger">Failed</span>
                                                    @break

                                                @case('refunded')
                                                    <span class="badge bg-info">Refunded</span>
                                                    @break

                                                @case('partially_refunded')
                                                    <span class="badge bg-secondary">Partially Refunded</span>
                                                    @break

                                                @case('disputed')
                                                    <span class="badge bg-dark">Disputed</span>
                                                    @break

                                                @case('canceled')
                                                    <span class="badge bg-danger">Canceled</span>
                                                    @break

                                                @default
                                                    <span class="badge bg-light text-dark">Unknown</span>
                                            @endswitch
                                        @else
                                            <span class="badge bg-light text-dark">No Transaction</span>
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td>{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d-M-y g:i a') : '' }}</td>
                                    <th>Delivered Date</th>
                                    <td>{{ $order->delivered_at ? \Carbon\Carbon::parse($order->delivered_at)->format('d-M-y g:i a') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Canceled Date</th>
                                    <td class="text-danger">
                                        {{ $order->canceled_at ? \Carbon\Carbon::parse($order->canceled_at)->format('d-M-y g:i a') : 'N/A' }}
                                    </td>
                                    <th>Order Status</th>
                                    <td class="text-capitalize fs-4">
                                        @php
                                            $orderStatus = $order->status;
                                        @endphp

                                        @if($orderStatus)
                                            @switch($orderStatus)
                                                @case('pending')
                                                    <span class="badge badge-pill" style="background-color: #FF9800; color: #fff; font-weight: bold; font-size: 14px;">Pending</span>
                                                    @break

                                                @case('confirmed')
                                                    <span class="badge badge-pill" style="background-color: #2196F3; color: #fff; font-weight: bold; font-size: 14px;">Confirmed</span>
                                                    @break

                                                @case('processing')
                                                    <span class="badge badge-pill" style="background-color: #00BCD4; color: #fff; font-weight: bold; font-size: 14px;">Processing</span>
                                                    @break

                                                @case('shipped')
                                                    <span class="badge badge-pill" style="background-color: #9E9E9E; color: #fff; font-weight: bold; font-size: 14px;">Shipped</span>
                                                    @break

                                                @case('delivered')
                                                    <span class="badge badge-pill" style="background-color: #4CAF50; color: #fff; font-weight: bold; font-size: 14px;">Delivered</span>
                                                    @break

                                                @case('canceled')
                                                    <span class="badge badge-pill" style="background-color: #F44336; color: #fff; font-weight: bold; font-size: 14px;">Canceled</span>
                                                    @break

                                                @case('refunded')
                                                    <span class="badge badge-pill" style="background-color: #607D8B; color: #fff; font-weight: bold; font-size: 14px;">Refunded</span>
                                                    @break

                                                @default
                                                    <span class="badge badge-pill" style="background-color: #BDBDBD; color: #fff; font-weight: bold; font-size: 14px;">Unknown</span>
                                            @endswitch
                                        @else
                                            <span class="badge badge-pill" style="background-color: #BDBDBD; color: #fff; font-weight: bold; font-size: 14px;">No Status</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg mt-5">
                <div class="card-header text-white">
                    <h5 class="mb-0">Order History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-center" style="width: 15%;">Order Date</th>
                                <th class="text-center" style="width: 30%;">Items Name</th> <!-- This will take max width -->
                                <th class="text-center" style="width: 10%;">Item Count</th>
                                <th class="text-center" style="width: 15%;">Total Value</th>
                                <th class="text-center" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 10%;">Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $index => $order)
                                <tr onclick="window.location='{{ route('admin.order.details', $order->id) }}'" style="cursor: pointer;">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-M-y g:i A') }}</td>
                                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        @foreach($order->items as $item)
                                            <span class="badge bg-secondary">{{ $item->product->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center fw-bold">{{ $order->items->sum('quantity') }}</td>
                                    <td class="text-end text-success fw-bold">{{ format_currency($order->total) }}</td>
                                    <td class="text-center">
                                        @if($order->delivered_at)
                                            <span class="badge bg-success">
                                        Delivered: {{ \Carbon\Carbon::parse($order->delivered_at)->format('d-M-y g:i A') }}
                                    </span>
                                        @elseif($order->canceled_at)
                                            <span class="badge bg-danger">
                                        Canceled: {{ \Carbon\Carbon::parse($order->canceled_at)->format('d-M-y g:i A') }}
                                    </span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $order->order_id ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No previous orders found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- SweetAlert Integration for Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmUpdateStatus() {
            const status = document.getElementById('status_select').value;
            const statusText = document.getElementById('status_select').options[document.getElementById('status_select').selectedIndex].text;

            Swal.fire({
                title: `Change status to ${statusText}?`,
                html: `Do you really want to update the status to <b style="color: red;">${statusText}</b> ?`, // Bold & Red
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#079573',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'No, Cancel',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, update the hidden input and submit the form
                    document.getElementById('status_input').value = status;
                    document.getElementById('update_status').submit();
                }
            });
        }
    </script>
@endpush
