@extends('backend.layouts.master')
@section('manage-coupon') active @endsection
@section('all-coupon') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Coupon</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Coupon</li>
                        <li class="breadcrumb-item active">Coupon Update</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form action="{{ route('coupon.update',$coupon->id) }}" method="post">
                         @csrf
                         @method('patch')
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Cupon Code <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="code" value="{{ $coupon->code }}" placeholder="Enter Coupon code" />
                                </div>
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Cupon Value <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="value" value="{{ $coupon->value }}" placeholder="Enter Coupon code % or $" />
                                </div>
                                @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="status">Select Type</label>
                                <select id="condition" name="type" class="form-control show-tick">
                                    <option value="fixed" {{ $coupon->type =='fixed' ? "selected" :'' }}>Fixed</option>
                                    <option value="percent" {{ $coupon->type =='percent' ? "selected" :'' }}>Percent</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="status" >Select Status <span class="text-danger">*</span> </label>
                                <select id="status" name="status" class="form-control show-tick">
                                    <option value="active" {{ $coupon->status =='active' ? "selected" :'' }}>Active</option>
                                    <option value="inactive" {{ $coupon->status =='inactive' ? "selected" :'' }}>Inactive</option>
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
