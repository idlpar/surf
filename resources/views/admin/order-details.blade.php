@extends('layouts.admin')
@push('styles')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
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

            <div class="wg-box mt-5">
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail card shadow-lg p-4 rounded">
                        @php
                            $shippingAddress = json_decode($order->shipping_address, true) ?? []; // Ensure it's an array
                        @endphp

                        @if(!empty($shippingAddress))
                            <h5 class="font-weight-bold mb-3 text-primary" style="font-size: 2.5rem; margin-bottom: 10px !important;">Shipping Address</h5>
                            <div class="address-detail">
                                <p style="font-size: 2rem; margin-bottom: 10px;"><strong>Name:</strong> {{ $shippingAddress['name'] ?? 'N/A' }}</p>
                                <p style="font-size: 2rem; margin-bottom: 10px;"><strong>Address:</strong> {{ $shippingAddress['address'] ?? 'N/A' }}</p>
                                <p style="font-size: 2rem; margin-bottom: 10px;"><strong>Locality:</strong> {{ $shippingAddress['locality'] ?? 'N/A' }}</p>
                                <p style="font-size: 2rem; margin-bottom: 10px;"><strong>City, State:</strong> {{ $shippingAddress['city'] ?? 'N/A' }}, {{ $shippingAddress['state'] ?? 'N/A' }}</p>
                                <p style="font-size: 2rem; margin-bottom: 10px;"><strong>Postal Code:</strong> {{ $shippingAddress['postal_code'] ?? 'N/A' }}</p>
                                <br>
                                <p style="font-size: 2rem; margin-bottom: 10px;"><strong>Mobile:</strong> {{ $shippingAddress['phone'] ?? 'N/A' }}</p>
                            </div>
                        @else
                            <p style="font-size: 2rem;">No shipping address provided.</p>
                        @endif
                    </div>
                </div>
            </div>




            <div class="wg-box mt-5">
                <h5>Transactions</h5>
                <table class="table table-striped table-bordered table-transaction">
                    <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ format_currency($order->subtotal) }}</td>
                        <th>Tax</th>
                        <td>{{ format_currency($order->tax) }}</td>
                        <th>Discount</th>
                        <td>{{ format_currency($order->discount) }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>{{ format_currency($order->total) }}</td>
                        <th>Payment Mode</th>
                        <td class="text-capitalize">{{ optional($order->transaction)->gateway ?? 'N/A'  }}</td>
                        <th>Status</th>
                        <td class="text-capitalize">{{ $order->payment_status }}</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : "" }}</td>
                        <th>Delivered Date</th>
                        <td>{{ $order->delivered_at ? $order->delivered_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        <th>Canceled Date</th>
                        <td>{{ $order->canceled_at ? $order->canceled_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
