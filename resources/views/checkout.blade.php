@extends('layouts.app')
@push('styles')
    <style>
        .address-card {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .card-header.bg-light-primary {
            background-color: #e3f2fd;
            border-bottom: 1px solid #bbdefb;
        }

        .address-label, .meta-label {
            color: #6c757d;
            min-width: 80px;
            display: inline-block;
            font-weight: 500;
        }

        .address-value, .meta-value {
            color: #212529;
            font-weight: 400;
        }

        .address-header h5 {
            font-size: 1.25rem;
            color: #1a237e;
        }

        .meta-item {
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .card {
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
@endpush
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
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

            <form method="POST" name="checkout-form" action="{{ route('cart.place.order') }}">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                                <!-- Optionally, add content or instructions here -->
                            </div>
                        </div>
                        @if($address)
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card shadow-sm border-primary">
                                        <div class="card-header bg-light-primary">
                                            <h5 class="mb-0">Saved Shipping Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="address-card">
                                                <div class="d-flex justify-content-between align-items-start mb-4">
                                                    <div class="address-header">
                                                        <h5 class="fw-semibold mb-1">{{ $address->name }}</h5>
                                                        <p class="text-muted mb-0">Default Shipping Address</p>
                                                    </div>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">Edit Address</a>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="address-detail">
                                                            <div class="address-line mb-3">
                                                                <span class="address-label">Address Line 1:</span>
                                                                <span class="address-value">{{ $address->address }}</span>
                                                            </div>
                                                            <div class="address-line mb-3">
                                                                <span class="address-label">Upazila/Police Station:</span>
                                                                <span class="address-value">{{ $address->locality }}</span>
                                                            </div>
                                                            <div class="address-line">
                                                                <span class="address-label">City/District:</span>
                                                                <span class="address-value">
                                            {{ $address->city }}, {{ $address->state }}, {{ $address->country ?? 'Bangladesh' }}
                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="address-meta">
                                                            <div class="meta-item mb-3">
                                                                <span class="meta-label">Post Code:</span>
                                                                <span class="meta-value">{{ $address->postal_code }}</span>
                                                            </div>
                                                            <div class="meta-item">
                                                                <span class="meta-label">Phone:</span>
                                                                <span class="meta-value">{{ $address->phone }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-5">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                                        <label for="name">Full Name *</label>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="phone" required value="{{ old('phone') }}">
                                        <label for="phone">Phone Number *</label>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Pincode -->
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="postal_code" required value="{{ old('postal_code') }}">
                                        <label for="postal_code">Postal Code *</label>
                                        @error('zip')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- State -->
                                <div class="col-md-4">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" name="state" required value="{{ old('state') }}">
                                        <label for="state">State *</label>
                                        @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- City -->
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="city" required value="{{ old('city') }}">
                                        <label for="city">Town / City *</label>
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="address" required value="{{ old('address') }}">
                                        <label for="address">House no, Building Name *</label>
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Locality -->
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="locality" required value="{{ old('locality') }}">
                                        <label for="locality">Road Name, Area, Colony *</label>
                                        @error('locality')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Landmark -->
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="landmark" required value="{{ old('landmark') }}">
                                        <label for="landmark">Landmark *</label>
                                        @error('landmark')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th class="text-right">SUBTOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::instance('cart') as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }} x {{ $item->qty }}
                                            </td>
                                            <td class="text-right">
                                                {{ format_currency($item->subtotal) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                @if(Session::has('discounts'))
                                    <table class="checkout-totals">
                                        <tbody>
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td class="text-right">{{ format_currency(Cart::instance('cart')->subtotal()) }}</td>
                                        </tr>
                                        <tr>
                                            <th>DISCOUNT ({{ session('coupon.code') }})</th>
                                            <td class="text-right" style="color: #FF2D20;">{{ format_currency(session('discounts.discount') * -1) }}</td>
                                        </tr>
                                        <tr>
                                            <th>SUBTOTAL AFTER DISCOUNT</th>
                                            <td class="text-right">{{ format_currency(session('discounts.subtotal')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>SHIPPING</th>
                                            <td class="text-right">Free shipping</td>
                                        </tr>
                                        <tr>
                                            <th>VAT</th>
                                            <td class="text-right">{{ format_currency(session('discounts.tax')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td class="text-right">{{ format_currency(session('discounts.total')) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="checkout-totals">
                                        <tbody>
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td class="text-right">{{ format_currency(Cart::instance('cart')->subtotal()) }}</td>
                                        </tr>
                                        <tr>
                                            <th>SHIPPING</th>
                                            <td class="text-right">Free shipping</td>
                                        </tr>
                                        <tr>
                                            <th>VAT</th>
                                            <td class="text-right">{{ format_currency(Cart::instance('cart')->tax()) }}</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td class="text-right">{{ format_currency(Cart::instance('cart')->total()) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>

                            <div class="checkout__payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="gateway" id="gateway_1" value="bank" checked>
                                    <label class="form-check-label" for="gateway_1">
                                        Direct bank transfer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="gateway" id="gateway_2" value="card">
                                    <label class="form-check-label" for="gateway_2">
                                        Debit or Credit Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="gateway" id="gateway_3" value="cash">
                                    <label class="form-check-label" for="gateway_3">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="gateway" id="checkout_payment_method_4">
                                    <label class="form-check-label" for="checkout_payment_method_4">
                                        Paypal
                                        <p class="option-detail">
                                            Phasellus sed volutpat orci. Fusce eget lorem mauris vehicula elementum gravida nec dui.
                                            Aenean aliquam varius ipsum, non ultricies tellus sodales eu.
                                        </p>
                                    </label>
                                </div>
                                <div class="policy-text">
                                    Your personal data will be used to process your order, support your experience throughout this website,
                                    and for other purposes described in our <a href="terms.html" target="_blank">privacy policy</a>.
                                </div>
                            </div>
                            <button class="btn btn-primary btn-checkout">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
