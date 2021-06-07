@extends('backend.layouts.master')
@section('manage-product') active @endsection
@section('all-product') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All product</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">product</li>
                        <li class="breadcrumb-item active">All product</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            {{-- -------- message ======= --}}
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <a href="{{ route('product.create') }}"  class="btn btn-success" style="float: right;">Add New</a>
                        <h2>All products</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $item)
                                @php
                                    $photo = explode(',',$item->photo)
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if ($photo == '')
                                            <img src="{{ $item->photo }}" style="max-height: 90px; max-width:120px;" alt="photo">
                                            @else
                                            <img src="{{ $photo[0] }}" style="max-height: 90px; max-width:120px;" alt="photo">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->offer_price == 0)
                                                ${{ number_format($item->price,2) }}
                                            @else
                                                ${{ number_format($item->offer_price,2) }}
                                            <del class="text-danger"> ${{ number_format($item->price,2) }}</del>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->discount == 0)
                                                <span class="badge badge-pill badge-danger">No</span>
                                            @else
                                                <span class="badge badge-pill badge-success">{{ $item->discount }}%</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->size }}</td>
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="toggle" data-toggle="switchbutton" {{ $item->status == 'active' ? 'checked':'' }}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="javascript::void(0)" data-toggle="modal" data-target="#productModal{{ $item->id }}" data-placement="bottom"  title="view" class="btn btn-outline-secondary"> <i class="icon-eye"></i>
                                            </a>

                                            <a href="{{ route('product.edit',$item->id) }}" data-toggle="tooltip" data-placement="bottom"  title="edit" class="btn btn-outline-warning"> <i class="icon-pencil"></i>
                                            </a>
                                        <form action="{{ route('product.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="delete" class="btn btn-outline-danger delBtn mt-2"> <i class="icon-trash"></i>
                                            </a>
                                        </form>
                                        </td>
                                {{-- modal  start  --}}
                                    <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            @php
                                                $product = App\Models\Product::where('id',$item->id)->first();
                                            @endphp
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="title" id="defaultModalLabel">{{ $product->title }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Category:</strong>
                                                                {{ App\Models\Category::where('id',$product->cat_id)->value('title') }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Child Category:</strong>
                                                                {{ App\Models\Category::where('id',$product->child_cat_id)->value('title') }}
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Brand:</strong>
                                                                {{ App\Models\Brand::where('id',$product->brand_id)->value('title') }}
                                                            </div>
                                                        </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <strong>Price:</strong> ${{ number_format($product->price,2) }}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <strong>Discount:</strong> {{ $product->discount }}%
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Offer Price:</strong> ${{ number_format($product->offer_price,2) }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <strong>Stock:</strong>
                                                            <span class="badge badge-pill badge-warning">{{ $product->stock }}</span>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <strong>Conditions:</strong>
                                                            <span class="badge badge-pill badge-danger">{{ $product->conditions }}</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Status:</strong>
                                                            <span class="badge badge-pill badge-success">{{ $product->status }}</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-12">
                                                            <strong>Vendor:</strong>
                                                           {{ App\Models\User::where('id',$product->vendor_id)->value('full_name') }}
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <strong>Summary:</strong>
                                                            <textarea name="" id="" class="form-control" disabled cols="30" rows="4">{!! $product->summary !!}</textarea>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <strong>Description:</strong>
                                                            <textarea name="" id="" class="form-control" disabled cols="30" rows="4">{!! $product->description !!}</textarea>
                                                        </div>

                                                    </div>

                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- modal  end  --}}
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

@endsection

@section('scripts')
<script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
{{-- ---------- Delete Button code ----------------  --}}
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
{{-- //status change with ajax  --}}
    <script>
        $('input[name=toggle]').change(function(){
            let status = $(this).prop('checked');
            let id = $(this).val();

            $.ajax({
                url: "{{ route('product.status') }}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    status:status,
                    id:id
                },
                success: function (response) {
                   if (response.status) {
                        alert(response.msg);
                   }else{
                       alert('try again!');
                   }
                }
            });
        })
    </script>
@endsection
