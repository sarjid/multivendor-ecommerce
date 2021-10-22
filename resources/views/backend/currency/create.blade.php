@extends('backend.layouts.master')
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> currency</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">currency</li>
                        <li class="breadcrumb-item active">currency Create</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form action="{{ route('currency.store') }}" method="post">
                         @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >currency name <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter currency name" />
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >currency Symbol <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="symbol" value="{{ old('symbol') }}" placeholder="Enter currency symbol" />
                                </div>
                                @error('symbol')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Exchange Rate <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="exchange_rate" value="{{ old('exchange_rate') }}" placeholder="Enter currency exchange_rate" />
                                </div>
                                @error('exchange_rate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Code: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Enter currency code" />
                                </div>
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="status" >Select Status <span class="text-danger">*</span> </label>
                                <select id="status" name="status" class="form-control show-tick">
                                    <option value="active" {{ old('status') =='active' ? "selected" :'' }}>Active</option>
                                    <option value="inactive" {{ old('status') =='inactive' ? "selected" :'' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        <button type="submit" class="btn btn-block btn-primary m-t-20">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
