@extends('frontend.layouts.master')
@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Account Detail</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account Detail</li>
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
                        <h5 class="mb-3">Account Details</h5>

                        <form action="{{ route('update.account',$user->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Full Name *</label>
                                        <input type="text" class="form-control" name="full_name" value="{{ $user->full_name }}" id="firstName" placeholder="full name">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="lastName">User Name *</label>
                                        <input type="text" class="form-control" name="username" id="lastName" placeholder="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="displayName">Phone Number *</label>
                                        <input type="text" class="form-control" id="displayName" placeholder="phone number" value="{{ $user->phone }}" name="phone">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="emailAddress">Email Address *</label>
                                        <input type="email" class="form-control" id="emailAddress" placeholder="exmaple@gmail.com" disabled value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection
