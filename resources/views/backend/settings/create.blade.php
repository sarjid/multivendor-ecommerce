@extends('backend.layouts.master')
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Setting</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Setting</li>
                        <li class="breadcrumb-item active">Setting Create</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form action="{{ route('setting.update') }}" method="post">
                         @csrf
                         @method('put')
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="title" value="{{ $setting->title }}" placeholder="Enter title" />
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status">Meta Keywords <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="meta_keywords" value="{{ $setting->meta_keywords }}" placeholder="Enter keywords" />
                                </div>
                                @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status">Meta Description <span class="text-danger">*</span> </label>
                                    <textarea name="meta_description" class="form-control" id="" cols="30" rows="5">{{ $setting->meta_description }}</textarea>
                                </div>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >logo <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="logo" value="{{ $setting->logo }}">
                                        @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder" style="margin-top:15px;max-height:100px;"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Favicon <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                        </span>
                                        <input id="thumbnail1" class="form-control" type="text" name="favicon" value="{{ $setting->favicon }}">
                                        @error('favicon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder1" style="margin-top:15px;max-height:100px;"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Email <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="email" value="{{ $setting->email }}" placeholder="Enter email" />
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Address <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="address" value="{{ $setting->address }}" placeholder="Enter address" />
                                </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Phone <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="phone" value="{{ $setting->phone }}" placeholder="Enter phone" />
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Fax <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="fax" value="{{ $setting->fax }}" placeholder="Enter fax" />
                                </div>
                                @error('fax')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Facebook Url <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="facebook_url" value="{{ $setting->facebook_url }}" placeholder="Enter facebook_url" />
                                </div>
                                @error('facebook_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Twitter Url <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="twitter_url" value="{{ $setting->twitter_url }}" placeholder="Enter twitter_url" />
                                </div>
                                @error('twitter_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Linkedin Url <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="linkedin_url" value="{{ $setting->linkedin_url }}" placeholder="Enter linkedin_url" />
                                </div>
                                @error('linkedin_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Pinterest Url <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="pinterest_url" value="{{ $setting->pinterest_url }}" placeholder="Enter Pinterest Url" />
                                </div>
                                @error('pinterest_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary m-t-20">Update</button>
                            </div>
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
        $('#lfm1').filemanager('image');
    </script>
@endsection
