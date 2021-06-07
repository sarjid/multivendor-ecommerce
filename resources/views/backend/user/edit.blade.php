@extends('backend.layouts.master')
@section('manage-user') active @endsection
@section('all-user') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Update user</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">User</li>
                        <li class="breadcrumb-item active">Update user</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Update users</strong></h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('user.update',$user->id) }}" method="POST">
                            @csrf
                            @method('put')
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Username <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" placeholder="Enter user username" />
                                </div>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Fullname <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="full_name" value="{{ $user->full_name }}" placeholder="Enter user full name" />
                                </div>
                                @error('full_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Email <span class="text-danger">*</span> </label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter user email" />
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Phone <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Enter user phone" />
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Address <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="Enter user address" />
                                </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="role" >Select Role <span class="text-danger">*</span> </label>
                                    <select id="role" name="role" class="form-control show-tick">
                                        <option>=======Select Role=======</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected':'' }}>Admin</option>
                                        <option value="customer" {{ $user->role == 'customer' ? 'selected':'' }}>customer</option>
                                        <option value="vendor" {{ $user->role == 'vendor' ? 'selected':'' }}>Vendor</option>
                                </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status">Photo <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" value="{{ $user->photo }}" type="text" name="photo">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div id="holder" style="margin-top:15px;max-height:100px;"> </div>
                                  <img src="{{ $user->photo }}" style="margin-top:15px;max-height:100px;">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="status" >Select Status <span class="text-danger">*</span> </label>
                                    <select id="status" name="status" class="form-control show-tick">
                                        <option>=======Select Status=======</option>
                                        <option value="active" {{ $user->status =='active' ? "selected" :'' }}>Active</option>
                                        <option value="inactive" {{ $user->status =='inactive' ? "selected" :'' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                           <div class="col-sm-12">
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
    </script>

    <script>
        $.jQuery(document).ready(function() {

        $('.summernote').summernote({

        });
    });

</script>

@endsection
