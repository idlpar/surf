@extends('layouts.app')

@push('styles')
    <style>
        .order-table {
            --table-accent-bg: transparent;
            --table-border-color: rgba(255,255,255,0.1);
            border-collapse: separate;
            border-spacing: 0 8px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 12px;
            overflow: hidden;
        }

        .order-table th {
            background: linear-gradient(45deg, #6a6e51 0%, #4d503a 100%);
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
            padding: 1rem 1.5rem !important;
        }

        .order-table th:first-child {
            border-radius: 12px 0 0 12px;
        }

        .order-table th:last-child {
            border-radius: 0 12px 12px 0;
        }

        .order-table td {
            padding: 1.25rem 1.5rem !important;
            background: rgba(255,255,255,0.9);
            transition: all 0.3s ease;
        }

        .order-table tr:nth-child(even) td {
            background: rgba(245, 247, 250, 0.9);
        }

        .order-table tr:hover td {
            background: rgba(255,255,255,1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(106, 110, 81, 0.1);
        }

        .status-badge {
            padding: 0.35rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .bg-success {
            background: linear-gradient(45deg, #40c710 0%, #32a80d 100%);
            color: white !important;
        }
        .bg-danger {
            background: linear-gradient(45deg, #f44032 0%, #d1372b 100%);
            color: white !important;
        }
        .bg-warning {
            background: linear-gradient(45deg, #f5d700 0%, #e0c300 100%);
            color: #000 !important;
        }

        .view-icon {
            transition: all 0.3s ease;
            color: #6a6e51;
            background: rgba(106, 110, 81, 0.1);
            padding: 8px;
            border-radius: 8px;
        }

        .view-icon:hover {
            color: #ffffff;
            background: #6a6e51;
            transform: rotate(-5deg) scale(1.1);
        }

        .product-image {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

    </style>
@endpush

@section('content')
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title mb-4">Order History</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-striped-columns table-hover order-table mb-0">
                                    <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th class="text-center">Products</th>
                                        <th class="text-center">Items</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <!-- Order Number -->
                                            <td>#{{ $order->order_number }}</td>

                                            <!-- Order Date (formatted date and time) -->
                                            <td>
                                                {{ $order->created_at->format('M d, Y') }}<br>
                                                <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                            </td>

                                            <!-- Items Names -->
                                            <td class="text-start">
                                                @foreach($order->items as $item)
                                                    <div class="d-flex align-items-center gap-2 mb-1">
                                                        <img src="{{ asset('uploads/products/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             style="width: 40px; height: 40px; object-fit: cover">
                                                        <div>
                                                            {{ $item->product->name }}
                                                            <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <!-- Items Count -->
                                            <td class="text-center">{{ $order->items->count() }}</td>

                                            <!-- Subtotal -->
                                            <td class="text-center">{{ format_currency($order->subtotal) }}</td>

                                            <!-- Tax -->
                                            <td class="text-center">{{ format_currency($order->tax) }}</td>

                                            <!-- Total -->
                                            <td class="text-end">{{ format_currency($order->total) }}</td>

                                            <!-- Status -->
                                            <td class="text-center">
                                                @if($order->canceled_at)
                                                    <span class="status-badge bg-danger">Canceled</span>
                                                @elseif($order->delivered_at)
                                                    <span class="status-badge bg-success">Delivered</span>
                                                @else
                                                    <span class="status-badge bg-warning">{{ ucfirst($order->payment_status) }}</span>
                                                @endif
                                            </td>

                                            <!-- Action (View Details Link) -->
                                            <td class="text-center">
                                                <a href="{{ route('user.order.details', ['order_id' => $order->id]) }}"
                                                   class="text-decoration-none text-dark"
                                                   title="View Details">
                                                    <i class="fas fa-eye view-icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">No orders found</div>
                                                <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">
                                                    Start Shopping
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->hasPages())
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
