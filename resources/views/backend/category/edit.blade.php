@extends('backend.layouts.master')
@section('manage-category') active @endsection
@section('all-category') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Category</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Category</li>
                        <li class="breadcrumb-item active">Category Update</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <form action="{{ route('category.update',$category->id) }}" method="post">
                         @csrf
                         @method('patch')
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="status" >Category Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="title" value="{{ $category->title }}" placeholder="Enter Banner title" />
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
                                        <input id="thumbnail" class="form-control" value="{{ $category->photo }}" type="text" name="photo">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder" style="margin-top:15px;max-height:100px;"> </div>
                                  <img src="{{ $category->photo }}" style="margin-top:15px;max-height:100px;">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                <label for="status" >summary <span class="text-danger">*</span> </label>
                                    <textarea  class="form-control summernote" name="summary" placeholder="summary" />{{ $category->summary }}</textarea>
                                </div>
                                @error('summary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="status" >Is Parent ? <span class="text-danger">*</span> </label>
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox" id="is_parent" value="1" name="is_parent" {{ $category->is_parent == 1 ? 'checked' : '' }}><span>Yes</span></label>
                                </div>
                                @error('is_parent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 {{ $category->is_parent == 1 ? ' d-none':'' }}" id="parent_cat_div">
                                <label for="status" >Parent Category <span class="text-danger">*</span> </label>
                                <select class="form-control show-tick ms search-select" name="parent_id" data-placeholder="Select">
                                    <option></option>
                                    @foreach ($parentCat as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected':'' }}>{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
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
<script>
    $('#is_parent').change(function (e) {
        e.preventDefault();
        let is_checked = $('#is_parent').prop('checked');
        if (is_checked) {
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
        }else{
            $('#parent_cat_div').removeClass('d-none');
        }

    });
</script>
@endsection
