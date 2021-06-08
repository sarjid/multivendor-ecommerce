@extends('backend.layouts.master')
@section('manage-shipping') active @endsection
@section('all-shipping') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> shipping</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">shipping</li>
                        <li class="breadcrumb-item active">shipping Edit</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form action="{{ route('shipping.update',$shipping->id) }}" method="post">
                         @csrf
                         @method('put')
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >shipping address <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="shipping_address" value="{{ $shipping->shipping_address }}" placeholder="Enter shipping address" />
                                </div>
                                @error('shipping_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Delivery Time  <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="delivery_time" value="{{ $shipping->delivery_time }}" placeholder="Enter delivery time" />
                                </div>
                                @error('delivery_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Delivery charge  <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="delivery_charge" value="{{ $shipping->delivery_charge }}" placeholder="Enter delivery charge" />
                                </div>
                                @error('delivery_charge')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="status" >Select Status <span class="text-danger">*</span> </label>
                                <select id="status" name="status" class="form-control show-tick">
                                    <option value="active" {{ $shipping->status =='active' ? "selected" :'' }}>Active</option>
                                    <option value="inactive" {{ $shipping->status =='inactive' ? "selected" :'' }} >Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        <button type="submit" class="btn btn-block btn-primary m-t-20">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

