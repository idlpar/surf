@extends('layouts.app')

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
                                <table class="table table-striped table-hover table-bordered mb-0">
                                    <thead class="table-dark">
                                    <tr>
                                        <th style="width: 5%;">Order #</th>
                                        <th style="width: 10%;">Date</th>
                                        <th class="text-center" style="width: 25%;">Products</th>
                                        <th class="text-center" style="width: 5%;">Items</th>
                                        <th class="text-center" style="width: 10%;">Subtotal</th>
                                        <th class="text-center" style="width: 10%;">Tax</th>
                                        <th class="text-end" style="width: 10%;">Total</th>
                                        <th class="text-center" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 5%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <!-- Order Number -->
                                            <td>#{{ $order->order_number }}</td>

                                            <!-- Order Date -->
                                            <td>
                                                {{ $order->created_at->format('M d, Y') }}<br>
                                                <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                            </td>

                                            <!-- Products -->
                                            <td class="text-start">
                                                @foreach($order->items as $item)
                                                    <div class="d-flex align-items-center gap-2 mb-1">
                                                        <img src="{{ asset('uploads/products/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
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


                                            <!-- Action -->
                                            <td class="text-center">
                                                <a href="{{ route('user.order.details', ['order_id' => $order->id]) }}"
                                                   class="btn btn-outline-dark btn-sm" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
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
                        <div class="mt-4 d-flex justify-content-center">
                            <nav aria-label="Order Pagination">
                                <ul class="pagination pagination-sm">
                                    {{-- Previous Page Link --}}
                                    @if ($orders->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">&laquo; Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($orders->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Next &raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </main>
@endsection
