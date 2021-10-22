@extends('backend.layouts.master')
@section('manage-banner') active @endsection
@section('create-banner') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Banner</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Banner</li>
                        <li class="breadcrumb-item active">Banner Create</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form action="{{ route('banner.store') }}" method="post">
                         @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Banner Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter Banner title" />
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="photo">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder" style="margin-top:15px;max-height:100px;"> </div>
                                </div>
                            </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                            <label for="status" >Description <span class="text-danger">*</span> </label>
                                <textarea  class="form-control summernote"  name="description"  placeholder="descriptions" /></textarea>
                            </div>
                            @error('description')
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

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="status">Select condition</label>
                                <select id="condition" name="condition" class="form-control show-tick">
                                    <option value="banner" {{ old('condition') =='banner' ? "selected" :'' }}>Banner</option>
                                    <option value="promo" {{ old('condition') =='promo' ? "selected" :'' }}>Promo</option>
                                </select>
                                @error('condition')
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

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $.jQuery(document).ready(function() {

        $('.summernote').summernote({

        });
    });

</script>
@endsection
