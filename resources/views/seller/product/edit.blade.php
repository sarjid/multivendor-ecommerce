@extends('seller.layouts.master')
@section('seller-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Update Product</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Product</li>
                        <li class="breadcrumb-item active">Update Product</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Update Products</strong></h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('seller-product.update',$product->id) }}" method="POST">
                            @csrf
                            @method('patch')
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Product Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="title" value="{{ $product->title }}" placeholder="Enter product title" />
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="status">Photo <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" value="{{ $product->photo }}" name="photo">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder" style="margin-top:15px;max-height:100px;"> </div>
                                  @if ($multiPhoto =='')
                                  <img src="{{ $product->photo }}" style="margin-top:15px;max-height:100px;">
                                  @else
                                    @foreach ($multiPhoto as $photo)
                                    <img src="{{ $photo }}" style="margin-top:15px;max-height:100px;">
                                    @endforeach
                                  @endif
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="status">Size Guide <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                        </span>
                                        <input id="thumbnail1" class="form-control" type="text" name="size_guide" value="{{ $product->size_guide }}" >
                                        @error('size_guide')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder1" style="margin-top:15px;max-height:100px;"> </div>
                                  @if ($sizeGuide =='')
                                  <img src="{{ $product->size_guide }}" style="margin-top:15px;max-height:100px;">
                                  @else
                                    @foreach ($sizeGuide as $guide)
                                    <img src="{{ $guide }}" style="margin-top:15px;max-height:100px;">
                                    @endforeach
                                  @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Descriptions <span class="text-danger">*</span> </label>
                                        <textarea  class="form-control summernote"  name="description"  placeholder="descriptions" />{{ $product->description }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-lg-36 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Summary <span class="text-danger">*</span> </label>
                                        <textarea  class="form-control summernote"  name="summary"  placeholder="summary" />{{ $product->summary }}</textarea>
                                    </div>
                                    @error('summary')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Additiional Info <span class="text-danger">*</span> </label>
                                        <textarea  class="form-control summernote"  name="additional_info"  placeholder="additional info" />{{ $product->additional_info }}
                                    </textarea>
                                </div>
                                @error('additional_info')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-36 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Return Cancellation<span class="text-danger">*</span> </label>
                                        <textarea  class="form-control summernote"  name="return_cancellation"  placeholder="return cancellation" />{{ $product->return_cancellation }}</textarea>
                                    </div>
                                    @error('return_cancellation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Product Stock <span class="text-danger">*</span> </label>
                                    <input type="number" class="form-control" name="stock" value="{{ $product->stock }}" placeholder="stock" />
                                </div>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Product Price <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="price" value="{{ $product->price }}" placeholder="price" />
                                </div>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Product Discount (%)</label>
                                    <input type="number" min="1" max="99" class="form-control" name="discount" value="{{ $product->discount }}" placeholder="discount" />
                                </div>
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="brand_id" >Select Brand <span class="text-danger">*</span> </label>
                                    <select id="brand_id" name="brand_id" class="form-control show-tick">
                                        <option>=======Select Brand=======</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ ($brand->id == $product->brand_id) ? 'selected':'' }}>{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                                    @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="cat_id" >Select Category <span class="text-danger">*</span> </label>
                                    <select id="cat_id" name="cat_id" class="form-control show-tick">
                                        <option>=======Select Category=======</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ ($cat->id == $product->cat_id) ? 'selected':'' }}>{{ $cat->title }}</option>
                                    @endforeach
                                    </select>
                                    @error('cat_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 d-none" id="child_cat_div">
                                <div class="form-group">
                                    <label for="child_cat_id" >Select Child Category <span class="text-danger">*</span> </label>
                                    <select id="child_cat_id" name="child_cat_id" class="form-control show-tick">
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="size" >Select Size <span class="text-danger">*</span> </label>
                                    <select id="size" name="size" class="form-control show-tick">
                                        <option>=======Select Size=======</option>
                                        <option value="M" {{ $product->size =='M' ? "selected" :'' }}>M</option>
                                        <option value="S" {{ $product->size =='S' ? "selected" :'' }}>S</option>
                                        <option value="L" {{ $product->size =='L' ? "selected" :'' }}>L</option>
                                        <option value="XL"{{ $product->size =='XL' ? "selected" :'' }}>XL</option>
                                    </select>
                                    @error('size')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Select Status <span class="text-danger">*</span> </label>
                                    <select id="status" name="status" class="form-control show-tick">
                                        <option>=======Select Status=======</option>
                                        <option value="active" {{ $product->status =='active' ? "selected" :'' }}>Active</option>
                                        <option value="inactive" {{ $product->status =='inactive' ? "selected" :'' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Conditions <span class="text-danger">*</span> </label>
                                    <select id="status" name="conditions" class="form-control show-tick">
                                        <option>====Select Conditions=====</option>
                                        <option value="new" {{ $product->conditions =='new' ? "selected" :'' }}>New</option>
                                        <option value="popular"{{ $product->conditions =='popular' ? "selected" :'' }}>Popular</option>
                                        <option value="winter" {{ $product->conditions =='winter' ? "selected" :'' }}>Winter</option>
                                    </select>
                                    @error('conditions')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary m-t-20">Submit</button>
                                <button type="reset" class="btn btn-secondary m-t-20">Cancel</button>
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
        $('#lfm,#lfm1').filemanager('image');
    </script>

    <script>
        $.jQuery(document).ready(function() {
            $('.summernote').summernote({

            });
        });

    </script>

{{-- //parent category show/hide click with yes button --}}
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


{{-- ///get parent to child category --}}
<script>
    let child_cat_id = {{ $product->child_cat_id }}
    $('#cat_id').change(function (){
        let cat_id = $(this).val();
        if (cat_id != null) {
            $.ajax({
                type: "POST",
                url: "/admin/category/"+cat_id+"/child",
                data: {
                    _token:"{{ csrf_token() }}",
                    cat_id:cat_id
                },
                success: function (response) {
                     var html_option = "<option value=''>=======Select Child Category=======</option>";
                     if (response.status) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function (id, title) {
                                html_option +="<option value='"+id+"' "+(child_cat_id == id ? 'selected':'')+">"+title+"</option>";
                            });
                     }else{
                        $('#child_cat_div').addClass('d-none');
                     }

                     $('#child_cat_id').html(html_option);
                }
            });
        }
    })

    //select child cat id field
    if (child_cat_id != null) {
        $('#cat_id').change();
    }
</script>
@endsection
