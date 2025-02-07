@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/adm/custom.css') }}">
@endpush

@section('content')
    <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Total Orders</div>
                                        <h4>{{ $dashboardData->TotalCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Total Amount</div>
                                        <h4>{{  format_currency($dashboardData->Total) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders</div>
                                        <h4>{{  $dashboardData->TotalPending }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders Amount</div>
                                        <h4>{{ format_currency($dashboardData->TotalPendingAmount) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders</div>
                                        <h4>{{  $dashboardData->TotalDelivered }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders Amount</div>
                                        <h4>{{ format_currency($dashboardData->TotalDeliveredAmount) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders</div>
                                        <h4>{{  $dashboardData->TotalCanceled }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders Amount</div>
                                        <h4>{{ format_currency($dashboardData->TotalCanceledAmount)  }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Monthly Revenue</h5>
                        <div class="dropdown default">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);">This Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Last Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap40">
                        @if(isset($monthlyData) && count($monthlyData) > 0)
                            @php
                                $currentMonth = now()->month;
                                $currentMonthData = collect($monthlyData)->firstWhere('MonthNo', $currentMonth);
                                $previousMonthData = collect($monthlyData)->firstWhere('MonthNo', $currentMonth - 1);

                                // Initialize trend variables
                                $percentageChange = 0;
                                $trendIcon = 'up';  // Default to 'up' trend
                                $trendClass = 'up'; // Default to 'up' trend

                                if ($previousMonthData && $previousMonthData->TotalAmount > 0) {
                                    // Calculate percentage change only if the previous month's total is not zero
                                    $percentageChange = (($currentMonthData->TotalAmount ?? 0) - ($previousMonthData->TotalAmount ?? 0)) / $previousMonthData->TotalAmount * 100;

                                    // Determine the trend icon based on percentage change
                                    if ($percentageChange < 0) {
                                        $trendIcon = 'down';
                                        $trendClass = 'down';
                                    }
                                } elseif (!$previousMonthData) {
                                    // If there is no previous month data, treat as no comparison available
                                    $percentageChange = 0;
                                    $trendIcon = '';  // No trend icon
                                    $trendClass = ''; // No trend class
                                } else {
                                    // If the previous month's total is zero, set the trend to zero change
                                    $percentageChange = 0;
                                    $trendIcon = '';  // No trend icon
                                    $trendClass = ''; // No trend class
                                }
                            @endphp

                                <!-- Total -->
                            <div>
                                <div class="mb-2">
                                    <div class="block-legend">
                                        <div class="dot t1"></div>
                                        <div class="text-tiny">Total</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap10">
                                    <h4>{{ format_currency($currentMonthData->TotalAmount ?? 0) }}</h4>
                                    @if ($trendIcon)
                                        <div class="box-icon-trending {{ $trendClass }}">
                                            <i class="icon-trending-{{ $trendIcon }}"></i>
                                            <div class="body-title number">{{ number_format(abs($percentageChange), 2) }}%</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Pending -->
                            <div>
                                <div class="mb-2">
                                    <div class="block-legend">
                                        <div class="dot t2"></div>
                                        <div class="text-tiny">Pending</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap10">
                                    <h4>{{ format_currency($currentMonthData->TotalPendingAmount ?? 0) }}</h4>
                                    @if ($trendIcon)
                                        <div class="box-icon-trending {{ $trendClass }}">
                                            <i class="icon-trending-{{ $trendIcon }}"></i>
                                            <div class="body-title number">{{ number_format(abs($percentageChange), 2) }}%</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Delivered -->
                            <div>
                                <div class="mb-2">
                                    <div class="block-legend">
                                        <div class="dot t2"></div>
                                        <div class="text-tiny">Delivered</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap10">
                                    <h4>{{ format_currency($currentMonthData->TotalDeliveredAmount ?? 0) }}</h4>
                                    @if ($trendIcon)
                                        <div class="box-icon-trending {{ $trendClass }}">
                                            <i class="icon-trending-{{ $trendIcon }}"></i>
                                            <div class="body-title number">{{ number_format(abs($percentageChange), 2) }}%</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Canceled -->
                            <div>
                                <div class="mb-2">
                                    <div class="block-legend">
                                        <div class="dot t2"></div>
                                        <div class="text-tiny">Canceled</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap10">
                                    <h4>{{ format_currency($currentMonthData->TotalCanceledAmount ?? 0) }}</h4>
                                    @if ($trendIcon)
                                        <div class="box-icon-trending {{ $trendClass }}">
                                            <i class="icon-trending-{{ $trendIcon }}"></i>
                                            <div class="body-title number">{{ number_format(abs($percentageChange), 2) }}%</div>
                                        </div>
                                    @endif
                                </div>
                            </div>


                        @else
                            <p class="text-center">No data available for this month.</p>
                        @endif
                    </div>

                    <div id="line-chart-8"></div>
                </div>



            </div>
            <div class="tf-section mb-30">

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Recent orders</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="{{ route('admin.orders') }}">
                                <span class="view-all">View all</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
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
                                <th class="text-center">Delivered</th>
                                <th class="text-center">Canceled!</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $orders as $order )
                                <tr>
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td class="text-center">{{ $order->user->name }}</td>
                                    <td class="text-center">{{ $order->user->mobile }}</td>
                                    <td class="text-center">{{ format_currency($order->subtotal) }}</td>
                                    <td class="text-center">{{ format_currency($order->tax) }}</td>
                                    <td class="text-center">{{ format_currency($order->shipping_cost) }}</td>
                                    <td class="text-center">{{ format_currency($order->total) }}</td>

                                    <td class="text-center">{{ $order->payment_status }}</td>
                                    <td class="text-center">{{ $order->created_at->format('d-M-y g:i a') }}</td>
                                    <td class="text-center">{{ $order->items->count() }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $order->delivered_at ? 'bg-success' : 'bg-danger' }} p-2">
                                            {{ $order->delivered_at ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $order->canceled_at ? 'bg-danger' : 'bg-success' }} p-2">
                                            {{ $order->canceled_at ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
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
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        (function ($) {

            var tfLineChart = (function () {

                var chartBar = function () {

                    var options = {
                        series: [{
                            name: 'Total',
                            data: @json(collect($monthlyData)->pluck('TotalAmount')->map(fn($val) => round($val, 2)))
                        }, {
                            name: 'Pending',
                            data: @json(collect($monthlyData)->pluck('TotalPendingAmount')->map(fn($val) => round($val, 2)))
                        },
                            {
                                name: 'Delivered',
                                data: @json(collect($monthlyData)->pluck('TotalDeliveredAmount')->map(fn($val) => round($val, 2)))
                            }, {
                                name: 'Canceled',
                                data: @json(collect($monthlyData)->pluck('TotalCanceledAmount')->map(fn($val) => round($val, 2)))
                            }],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "Tk. " + Number(val).toLocaleString();
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                /* Function ============ */
                return {
                    init: function () { },

                    load: function () {
                        chartBar();
                    },
                    resize: function () { },
                };
            })();

            jQuery(document).ready(function () { });

            jQuery(window).on("load", function () {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function () { });
        })(jQuery);
    </script>

@endpush
