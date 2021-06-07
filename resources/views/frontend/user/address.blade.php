@extends('frontend.layouts.master')
@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Address</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Address</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

   <!-- My Account Area -->
   <section class="my-account-area section_padding_100_50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="my-account-navigation mb-50">
                    <ul>
                        @include('frontend.user.inc.sidebar')
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="my-account-content mb-50">
                    <p>The following addresses will be used on the checkout page by default.</p>

                    <div class="row">
                        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                            <h6 class="mb-3">Billing Address</h6>
                            <address>
                               {{ $user->address }} <br>
                               {{ $user->state }}, {{ $user->city }} <br>
                               {{ $user->country }} <br>
                               {{ $user->postcode }} <br>
                            </address>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#billingModal">Edit Address</a>

                             <!--billing address Modal -->
                            <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background: rgba(0,0,0,.5);">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Billing Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('billing.address',$user->id) }}" method="POST">
                                            @csrf
                                        <div class="modal-body">
                                                <div class="form-group">
                                                  <label for="Address">Billing Address</label>
                                                  <textarea name="address" id="Address" class="form-control" placeholder="address" aria-describedby="helpId">{{ $user->address }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="country">Billing Country</label>
                                                    <input type="text" name="country" id="country" class="form-control" placeholder="country" aria-describedby="helpId" value="{{ $user->country }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode">Billing PostCode</label>
                                                    <input type="text" name="postcode" id="postcode" class="form-control" placeholder="postcode" aria-describedby="helpId" value="{{ $user->postcode }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode">Billing State</label>
                                                    <input type="text" name="state" id="state" class="form-control" placeholder="state" aria-describedby="helpId" value="{{ $user->state }}">
                                                </div>

                                                 <div class="form-group">
                                                    <label for="postcode">Billing City</label>
                                                    <input type="text" name="city" id="city" class="form-control" placeholder="city" aria-describedby="helpId" value="{{ $user->city }}">
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h6 class="mb-3">Shipping Address</h6>
                            <address>
                               {{ $user->saddress }} <br>
                               {{ $user->sstate }}, {{ $user->scity }} <br>
                               {{ $user->scountry }} <br>
                               {{ $user->spostcode }} <br>
                            </address>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#shippingModal">Edit Address</a>

                             <!--shipping address Modal -->
                             <div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background: rgba(0,0,0,.5); z-index:999999999;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Shipping Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('shipping.address',$user->id) }}" method="POST">
                                            @csrf
                                        <div class="modal-body">
                                                <div class="form-group">
                                                  <label for="Address">Shipping Address</label>
                                                  <textarea name="saddress" id="Address" class="form-control" placeholder="address" aria-describedby="helpId">{{ $user->saddress }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="country">Shipping Country</label>
                                                    <input type="text" name="scountry" id="country" class="form-control" placeholder="country" aria-describedby="helpId" value="{{ $user->scountry }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode">Shipping PostCode</label>
                                                    <input type="text" name="spostcode" id="postcode" class="form-control" placeholder="postcode" aria-describedby="helpId" value="{{ $user->spostcode }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode">Shipping State</label>
                                                    <input type="text" name="sstate" id="state" class="form-control" placeholder="state" aria-describedby="helpId" value="{{ $user->sstate }}">
                                                </div>

                                                 <div class="form-group">
                                                    <label for="postcode">Shipping City</label>
                                                    <input type="text" name="scity" id="city" class="form-control" placeholder="city" aria-describedby="helpId" value="{{ $user->scity }}">
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account Area -->
@endsection
@section('styles')
    <style>
    .footer_area {
        z-index: -1;
    }
    </style>
@endsection
