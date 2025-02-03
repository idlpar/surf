@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Wishlist</h2>

            <div class="shopping-cart">
                @if( $items->count() > 0)
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $items as $item )
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{ asset('uploads/products/' . $item->model->image ) }}" width="120" height="120" alt="{{ $item->name }}" />
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
                                <span class="shopping-cart__product-price">Tk. {{ $item->price }}</span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="qty-control__number text-center">
                                </div><!-- .qty-control -->
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Move to Cart Button -->
                                    <form method="POST" action="{{ route('wishlist.move.to.cart', ['rowId' => $item->rowId]) }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success d-flex align-items-center gap-1">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 20C9 21.1046 8.10457 22 7 22C5.89543 22 5 21.1046 5 20C5 18.8954 5.89543 18 7 18C8.10457 18 9 18.8954 9 20Z" fill="currentColor"/>
                                                <path d="M20 20C20 21.1046 19.1046 22 18 22C16.8954 22 16 21.1046 16 20C16 18.8954 16.8954 18 18 18C19.1046 18 20 18.8954 20 20Z" fill="currentColor"/>
                                                <path d="M2 3H4.5L6.5 15H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6.5 11H18.5C19.0523 11 19.5 10.5523 19.5 10V6C19.5 5.44772 19.0523 5 18.5 5H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Move to Cart</span>
                                        </button>
                                    </form>

                                    <!-- Remove Button -->
                                    <form method="POST" action="{{ route('wishlist.remove', ['rowId' => $item->rowId]) }}" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 7H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 11V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 11V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M18 7V19C18 20.1046 17.1046 21 16 21H8C6.89543 21 6 20.1046 6 19V7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 7V4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('wishlist.clear') }}">
                        @csrf
                        @method('DELETE')
                    <div class="cart-table-footer">
                        <button type="submit" class="btn" style="border: 1px solid red; background-color: #ffc107; color: black; font-size: 1.2rem; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='red'; this.style.color='white'; this.style.borderColor='darkred';" onmouseout="this.style.backgroundColor='#ffc107'; this.style.color='black'; this.style.borderColor='red';">
                            Clear Wishlist
                        </button>
                    </div>
                    </form>
                </div>
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Cart Totals</h3>
                            <table class="cart-totals">
                                <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>$1300</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                                   id="free_shipping">
                                            <label class="form-check-label" for="free_shipping">Free shipping</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="flat_rate">
                                            <label class="form-check-label" for="flat_rate">Flat rate: $49</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                                   id="local_pickup">
                                            <label class="form-check-label" for="local_pickup">Local pickup: $8</label>
                                        </div>
                                        <div>Shipping to AL.</div>
                                        <div>
                                            <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>$19</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>$1319</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <button class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</button>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center w-100 px-4">
                            <div class="alert alert-warning shadow-sm mx-auto p-5" style="max-width: 600px;">
                                <h4 class="text-danger mb-3">Your Wishlist is Empty!</h4>
                                <p class="text-muted mb-4">It seems like your wishlist is currently empty. Start adding items now!</p>
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
