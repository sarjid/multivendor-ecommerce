@extends('frontend.layouts.master')
@section('content')
   <!-- Breadcumb Area -->
   <div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Review Order</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Review Order</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Checkout Steps Area -->
<div class="checkout_steps_area">
    <a class="complated" href="{{ route('checkout1') }}"><i class="icofont-check-circled"></i> Billing</a>
    <a class="active" href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
    <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
    <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
</div>
<!-- Checkout Steps Area -->
<!-- Checkout Area -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <form action="{{ route('checkoutlast.store') }}" method="POST">
            @csrf
            <div class="row">
                @csrf
                <div class="col-12">
                    <div class="checkout_details_area clearfix">
                        <h5 class="mb-30">Review Your Order</h5>

                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-30">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                        <tr>
                                            <td>
                                            @php
                                                $photo = explode(',',$item->model->photo);
                                            @endphp
                                                @if (count($photo) ==1)
                                                    <img src="{{ $item->model->photo }}" alt="Product">
                                                @else
                                                <img src="{{ $photo[0] }}" alt="Product">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('product.detail',$item->model->slug) }}">{{ $item->name }}</a>
                                            </td>
                                            <td>${{ $item->price }}</td>
                                            <td>
                                                <div class="quantity">
                                                    {{ $item->qty }}
                                                </div>
                                            </td>
                                            <td>${{ $item->qty * $item->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7 ml-auto">
                    <div class="cart-total-area">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>
                                            ${{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal() }}
                                        </td>
                                    </tr>

                                @if (\Illuminate\Support\Facades\Session::has('coupon'))
                                    <tr>
                                        <td>Discount</td>
                                        <td>
                                            ${{ \Illuminate\Support\Facades\Session::get('coupon')['value'] }}
                                        </td>
                                    </tr>
                                @endif

                                @if (\Illuminate\Support\Facades\Session::has('checkout'))
                                    <tr>
                                        <td>Shipping</td>
                                        <td>
                                            ${{ number_format(\Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'],2) }}
                                        </td>
                                    </tr>
                                @endif
                                    <tr>
                                        <td>Total</td>
                                    @if (\Illuminate\Support\Facades\Session::has('coupon') && \Illuminate\Support\Facades\Session::has('checkout'))

                                        <td>
                                            ${{ number_format(round(str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) + \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'] - str_replace(',','',\Illuminate\Support\Facades\Session::get('coupon')['value'])),2) }}
                                        </td>

                                    @elseif(\Illuminate\Support\Facades\Session::has('coupon'))
                                        <td>
                                            ${{ number_format(round(str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) + \Illuminate\Support\Facades\Session::get('coupon')['value']),2) }}
                                        </td>
                                    @elseif (\Illuminate\Support\Facades\Session::has('checkout'))
                                            <td>
                                                ${{ number_format(round(str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) + \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge']),2) }}
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout_pagination d-flex justify-content-end mt-3">
                            <a href="checkout-4.html" class="btn btn-primary mt-2 ml-2 d-none d-sm-inline-block">Go Back</a>
                            <button type="submit"" class="btn btn-primary mt-2 ml-2">Confirm</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Area End -->


@endsection
