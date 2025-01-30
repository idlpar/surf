@extends('layouts.app')
@push('styles')
    <style>
        .shopping-cart__totals {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
        }

        .cart-totals {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-totals td, .cart-totals th {
            padding: 1rem 0;
            border-bottom: 1px solid #dee2e6;
            text-align: right;
        }

        .cart-totals th {
            text-align: left;
            font-weight: 500;
        }

        .discount-row td {
            color: #FF2D20;
        }

        .total-row th, .total-row td {
            font-weight: 700;
            font-size: 1.1em;
            border-bottom: none;
        }

        .shipping-options .form-check {
            margin-bottom: 0.5rem;
        }

        .btn-checkout {
            font-size: 1.1rem;
            letter-spacing: 0.05em;
        }
    </style>
@endpush
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Cart</h2>
            <div class="checkout-steps">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
                </a>
            </div>
            <div class="shopping-cart">
                @if( $items->count()>0 )
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{ asset('uploads/products/' . $item->model->image) }}" width="120" height="120" alt="{{ $item->name }}" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>{{ $item->name }}</h4>
                                    <ul class="shopping-cart__product-item__options">
                                        <li>Color: Yellow</li>
                                        <li>Size: L</li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price"> {{ $item->price }}</span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="qty-control__number text-center">
                                    <form method="POST" action="{{ route('cart.decrease', [ 'rowId' => $item->rowId] ) }}">
                                        @csrf
                                        <div class="qty-control__reduce">-</div>
                                    </form>
                                    <form method="POST" action="{{ route('cart.increase', [ 'rowId' => $item->rowId] ) }}">
                                        @csrf
                                        <div class="qty-control__increase">+</div>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal"> {{ $item->subTotal() }}</span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', [ 'rowId' => $item->rowId ]) }}">
                                    @csrf
                                    @method('DELETE')
                                <a href="javascript:void(0)" class="remove-cart">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                        <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                    </svg>
                                </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="cart-table-footer">
                        @if(!Session::has('coupon'))
                            <form method="POST" action="{{ route('coupon.apply') }}" class="position-relative bg-body">
                                @csrf
                                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code" value="@if(Session::has('coupon')) {{Session::get('coupon')['code']}} Applied! @endif" style="border: 1px solid green;">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                       value="APPLY COUPON">
                            </form>
                        @else
                            <form method="POST" action="{{ route('coupon.remove') }}" class="position-relative bg-body">
                                @csrf
                                @method('DELETE')
                                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code" value="@if(Session::has('coupon')) {{Session::get('coupon')['code']}} Applied! @endif" style="border: 1px solid red;">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="REMOVE COUPON" style="color: red; font-weight: bold;">
                            </form>
                        @endif

                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="border: 1px solid red; background-color: #ffc107; color: black; font-size: 1.2rem; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='red'; this.style.color='white'; this.style.borderColor='darkred';" onmouseout="this.style.backgroundColor='#ffc107'; this.style.color='black'; this.style.borderColor='red';">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                    <div>
                        @if( Session::has('success'))
                            <p style="color: #0f5132;">{{ Session::get('success') }}</p>
                        @elseif(Session::has('error'))
                        <p class="text-danger">{{ Session::has('error')}}</p>
                        @endif
                    </div>
                </div>
                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Cart Totals</h3>
                                <table class="cart-totals">
                                    <tbody>
                                    <!-- Subtotal -->
                                    <tr>
                                        <th>Subtotal</th>
                                        <td> {{ format_currency(Cart::instance('cart')->subtotal()) }}</td>
                                    </tr>

                                    <!-- Discount -->
                                    @if(Session::has('coupon'))
                                        <tr class="discount-row">
                                            <th>Discount ({{ session('coupon.code') }})</th>
                                            <td>{{ format_currency(session('discounts.discount') * -1) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal After Discount</th>
                                            <td> {{ format_currency(session('discounts.subtotal'))}}</td>
                                        </tr>
                                    @endif

                                    <!-- Shipping -->
                                    <tr>
                                        <th>Shipping</th>
                                        <td>
                                            <div class="shipping-options">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipping"
                                                           id="free_shipping" value="0" required>
                                                    <label class="form-check-label" for="free_shipping">
                                                        Free shipping
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipping"
                                                           id="flat_rate" value="49">
                                                    <label class="form-check-label" for="flat_rate">
                                                        Flat rate:  {{ format_currency(49) }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipping"
                                                           id="local_pickup" value="8">
                                                    <label class="form-check-label" for="local_pickup">
                                                        Local pickup:  {{ format_currency(8) }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="shipping-address mt-2">
                                                <div>Shipping to {{ $userShippingAddress->city ?? 'N/A' }}</div>
                                                <a href="#"
                                                   class="btn btn-link btn-sm p-0 text-decoration-none">
                                                    Change Address
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Tax -->
                                    <tr>
                                        <th>VAT</th>
                                        <td> {{ format_currency(Session::has('discounts') ? session('discounts.tax') : Cart::instance('cart')->tax()) }}</td>
                                    </tr>

                                    <!-- Total -->
                                    <tr class="total-row">
                                        <th>Total</th>
                                        <td> {{ format_currency(Session::has('discounts') ? session('discounts.total') : Cart::instance('cart')->total()) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Checkout Button -->
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="button-wrapper container">
                                    <a href="#"
                                       class="btn btn-primary btn-checkout w-100 py-3">
                                        PROCEED TO CHECKOUT
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center w-100 px-4">
                            <div class="alert alert-warning shadow-sm mx-auto p-5" style="max-width: 600px;">
                                <h4 class="text-danger mb-3">Your Cart is Empty!</h4>
                                <p class="text-muted mb-4">It seems like your shopping cart is currently empty. Start adding items now!</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-bag"></i> Browse Products
                                </a>
                            </div>
                        </div>
                    </div>


                @endif
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function(){
            $(".qty-control__increase").on("click", function(){
                $(this).closest('form').submit();
            });
            $(".qty-control__reduce").on("click", function(){
                $(this).closest('form').submit();
            });
            $(".remove-cart").on("click", function (){
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
