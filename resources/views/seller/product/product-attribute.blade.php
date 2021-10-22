@extends('seller.layouts.master')
@section('seller-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create Product Attribute</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Product</li>
                        <li class="breadcrumb-item active">Create Product Attribute</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Create Product Attribute For <span class="text-danger">{{ $product->title }}</span></strong></h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-7 col-md-7">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                <form action="{{ route('product.attribute.store',$product->id) }}" method="POST">
                                    @csrf
                                    <div id="product_attribute" class="content" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                        <div class="row">
                                            <div class="col-md-12"><button type="button" id="btnAdd-1" class="btn btn-info mb-3"><i class="fa fa-plus-circle"></i></button></div>
                                        </div>
                                        <div class="row group">
                                            <div class="col-md-2">
                                                <label for="size">Size</label>
                                                <input class="form-control" placeholder="eg.s" id="size" name="size[]" type="text">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="original_price">Original Price</label>
                                                <input class="form-control" placeholder="eg.100" id="original_price" name="original_price[]" type="text">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="offer_price">Offer Price</label>
                                                <input class="form-control" placeholder="eg.80" id="offer_price" name="offer_price[]" type="text">
                                            </div>

                                            <div class="col-md-2">
                                                <label for="stock">Stock</label>
                                                <input class="form-control" placeholder="eg.200" id="stock" name="stock[]" type="number">
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" class="mt-4 btn btn-danger btnRemove"><i class="fa fa-minus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info m-t-20">Submit</button>
                                </form>
                            </div>


                            <div class="col-lg-5 col-md-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable table-custom table-danger">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($productAttributes as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>
                                                    @if ($item->offer_price == 0)
                                                        ${{ number_format($item->original_price,2) }}
                                                    @else
                                                        ${{ number_format($item->offer_price,2) }}
                                                    <del class="text-danger"> ${{ number_format($item->original_price,2) }}</del>
                                                    @endif
                                                </td>
                                                <td>{{ $item->stock }}</td>
                                                <td>
                                                <form action="{{ route('product.attribute.destroy',$item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="delete" class="btn btn-sm btn-outline-danger delBtn mt-2"> <i class="icon-trash"></i>
                                                    </a>
                                                </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('backend/assets/js/jquery.multifield.min.js') }}"></script>
<script>
    $('#product_attribute').multifield();
</script>

{{-- ---------- Delete Button code ----------------  --}}
<script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delBtn').click(function (e) {
        let form = $(this).closest('form');
        let dataID = $(this).data('id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection
