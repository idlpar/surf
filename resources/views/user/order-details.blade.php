@extends('layouts.app')
@push('styles')
    <style>
        .pt-90 {
            padding-top: 90px !important;
        }

        h5 {
            padding-right: 6px;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .my-account .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            padding-bottom: 2px;
        }

        .my-account .wg-box {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: column;
            gap: 24px;
            border-radius: 12px;
            background: var(--White);
            box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }

        .pname {
            display: flex;
            gap: 13px;
        }

         .btn-gradient-canceled {
             max-width: 250px;
             width: 100%;
             padding: 14px 28px;
             font-size: 16px;
             font-weight: 600;
             color: #ffffff;
             background: linear-gradient(135deg, #b92b27, #1565c0);
             border: none;
             border-radius: 50px;
             cursor: not-allowed;
             box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
             transition: all 0.3s ease-in-out;
             text-transform: uppercase;
             letter-spacing: 1px;
             display: flex;
             align-items: center;
             justify-content: center;
             opacity: 0.8;
         }

        .btn-gradient-canceled:disabled {
            opacity: 0.6;
            background: linear-gradient(135deg, #888888, #555555);
            cursor: not-allowed;
        }

        .btn-gradient-canceled:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
         .btn-gradient-cancel {
             max-width: 250px;
             width: auto;
             padding: 14px 28px;
             font-size: 16px;
             font-weight: 600;
             color: #ffffff;
             background: linear-gradient(135deg, #ff512f, #dd2476);
             border: none;
             border-radius: 50px;
             cursor: pointer;
             box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
             transition: all 0.3s ease-in-out;
             text-transform: uppercase;
             letter-spacing: 1px;
             display: flex;
             align-items: center;
             justify-content: center;
         }

        .btn-gradient-cancel:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-gradient-cancel:active {
            transform: scale(0.98);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        /* Icon styling */
        .btn-gradient-main i {
            margin-right: 10px;
        }

        /* Adjust the title size */
        .swal2-popup .swal2-title {
            font-size: 24px;  /* Title font size */
        }

        /* Adjust the body text size */
        .swal2-popup .swal2-html-container {
            font-size: 18px;  /* Body font size */
            line-height: 1.5rem;
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
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Order's Details</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="wg-box wg-table table-all-user">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Items</h5>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-lg btn-dark px-4 py-2 fs-5 fw-bold" href="{{ route('user.orders') }}">Back</a>
                            </div>
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
                            <table class="table table-hover table-striped table-bordered w-100">
                                <thead class="table-dark fs-6">
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">SKU</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                </thead>
                                <tbody class="fs-5">
                                @foreach($order->items as $item)
                                    <tr class="align-middle"> <!-- align-middle for vertical centering -->
                                        <td class="pname">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="image d-flex justify-content-center align-items-center" style="height: 50px;">
                                                    <img src="{{ asset('uploads/products/' . $item->product->image ) }}"
                                                         alt="{{ $item->product->name }}"
                                                         class="img-fluid"
                                                         style="max-width: 50px; max-height: 50px;">
                                                </div>
                                                <div class="name d-flex align-items-center">
                                                    <a href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}"
                                                       target="_blank"
                                                       class="body-title-2 text-decoration-none">
                                                        {{ $item->product->name ?? 'N/A' }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-end">{{ format_currency($item->price) }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{{ $item->sku }}</td>
                                        <td class="text-center">{{ $item->product->category->name ?? 'N/A' }}</td>
                                        <td class="text-end">{{ format_currency($item->price * $item->quantity) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="wg-box mt-0 d-flex justify-content-center align-items-center">
                                @if($order->status == 'canceled')
                                    <button class="btn-gradient-canceled" disabled>
                                        Order Canceled
                                    </button>
                                @elseif($order->status == 'delivered' || $order->status == 'refunded' || $order->status == 'shipped')
                                    <!-- No button for delivered, refunded, or shipped orders -->
                                @else
                                    <button type="button" class="btn-gradient-cancel" onclick="confirmCancelOrder()">
                                        Cancel Order
                                    </button>

                                    <form id="cancel_order_form" action="{{ route('user.cancel.order', ['order_id' => $order->id]) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

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
                                        <h5 class="font-weight-bold mb-3" style="font-size: 1.5rem; line-height: 2rem;">Shipping Address</h5>
                                        <div class="address-detail">
                                            <p style="font-size: 16px; line-height: 1rem;"><strong>Name:</strong> {{ $shippingAddress['name'] ?? 'N/A' }}</p>
                                            <p style="font-size: 16px; line-height: 1rem;"><strong>Address:</strong> {{ $shippingAddress['address'] ?? 'N/A' }}</p>
                                            <p style="font-size: 16px; line-height: 1rem;"><strong>Locality:</strong> {{ $shippingAddress['locality'] ?? 'N/A' }}</p>
                                            <p style="font-size: 16px; line-height: 1rem;"><strong>City, State:</strong> {{ $shippingAddress['city'] ?? 'N/A' }}, {{ $shippingAddress['state'] ?? 'N/A' }}</p>
                                            <p style="font-size: 16px; line-height: 1rem;"><strong>Postal Code:</strong> {{ $shippingAddress['postal_code'] ?? 'N/A' }}</p>
                                            <p style="font-size: 16px; line-height: 1.5rem;"><strong>Mobile:</strong> {{ $shippingAddress['phone'] ?? 'N/A' }}</p>
                                        </div>
                                    @else
                                        <p class="text-muted">No shipping address provided.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Side - Transactions Table -->
                            <div class="col-md-7">
                                <div class="card shadow-lg p-2 rounded h-100">
                                    <h5 class="font-weight-bold mb-2 lh-lg">Transactions</h5>
                                    <table class="table table-striped table-hover table-responsive-md table-bordered fs-6 w-100">
                                        <tbody>
                                        <tr>
                                            <th>Total</th>
                                            <td class="text-success font-weight-bold"> <span class="bg-success p-2 text-dark"> {{ format_currency($order->total) }} </span></td>
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
                                            <th>Status</th>
                                            <td class="text-capitalize">{{ $order->payment_status }}</td>
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
                                <table class="table table-hover table-bordered align-middle fs-6">
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
                                        <tr onclick="window.location='{{ route('user.order.details', [ 'order_id' => $order->id ]) }}'" style="cursor: pointer;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-M-y') }}</td>
                                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                @foreach($order->items as $item)
                                                    <span class="badge bg-secondary">{{ $item->product->name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-center fw-bold">{{ $order->items->sum('quantity') }}</td>
                                            <td class="text-end fw-bold" style="color: green;">{{ format_currency($order->total) }}</td>
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
        </section>
    </main>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function confirmCancelOrder() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Canceling this order cannot be undone. Do you want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#0c8158',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel_order_form').submit();
                }
            });
        }
    </script>
@endpush
