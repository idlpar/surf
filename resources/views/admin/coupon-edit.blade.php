@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Coupon infomation</h3>
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
                        <a href="{{ route('admin.coupons') }}">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST"
                      action="{{ route('admin.coupon.update', ['id' => $coupon->id]) }}">
                    @method('PUT')
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Code"
                               name="code" value="{{ $coupon->code }}" required>
                        @error('code')
                        <div class="text-tiny text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="category">
                        <div class="body-title">Coupon Type</div>
                        <div class="select flex-grow">
                            <select class="" name="type" required>
                                <option value="">Select</option>
                                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent</option>
                            </select>
                        </div>
                        @error('type')
                        <div class="text-tiny text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow"
                               type="number"
                               placeholder="Coupon Value"
                               name="value"
                               value="{{ (int)$coupon->value }}"
                               step="1"
                               min="0"
                               oninput="this.value = Math.ceil(this.value)"
                               required>
                        @error('value')
                        <div class="text-tiny text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow"
                               type="number"
                               placeholder="Cart Value"
                               name="cart_value"
                               value="{{ (int)$coupon->cart_value }}"
                               step="1"
                               min="0"
                               oninput="this.value = Math.ceil(this.value)"
                               required>
                        @error('cart_value')
                        <div class="text-tiny text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                        <input class="flex-grow"
                               type="date"
                               placeholder="Expiry Date"
                               name="expiry_date"
                               value="{{ \Carbon\Carbon::parse($coupon->expiry_date)->format('Y-m-d') }}"
                               required>
                        @error('expiry_date')
                        <div class="text-tiny text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
