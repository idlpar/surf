@extends('layouts.admin')
@section('content')
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Orders</h3>
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
                            <div class="text-tiny">Orders</div>
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
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width:70px">OrderNo</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Shipping Cost</th>
                                    <th class="text-center">Total</th>

                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                @foreach( $orders as $order )
                                <tbody>
                                <tr>
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td class="text-center">{{ $order->user->name }}</td>
                                    <td class="text-center">{{ $order->user->mobile }}</td>
                                    <td class="text-center">{{ format_currency($order->subtotal) }}</td>
                                    <td class="text-center">{{ format_currency($order->tax) }}</td>
                                    <td class="text-center">{{ format_currency($order->shipping_cost) }}</td>
                                    <td class="text-center">{{ format_currency($order->total) }}</td>

                                    <td class="text-center">{{ $order->payment_status }}</td>
                                    <td class="text-center">{{ $order->created_at->format('d-m-y \a\t H:i') }}</td>
                                    <td class="text-center">{{ $order->items->count() }}</td>
                                    <td class="text-center">{{ $order->delivered_at ? $order->delivered_at->format('d F, Y \a\t h:i A') : "Yet to" }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.order.details', [ 'order_id' => $order->id ]) }}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $orders->links('pagination::bootstrap-5' ) }}
                    </div>
                </div>
            </div>
    </div>
@endsection
