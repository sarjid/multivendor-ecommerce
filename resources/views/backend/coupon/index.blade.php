@extends('backend.layouts.master')
@section('manage-coupon') active @endsection
@section('all-coupon') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Coupon</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Coupon</li>
                        <li class="breadcrumb-item active">All Coupon</li>
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
                        <a href="{{ route('coupon.create') }}"  class="btn btn-success" style="float: right;">Add New</a>
                        <h2>All Coupon</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($coupons as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            @if ($item->type == 'fixed')
                                                <span class="badge badge-pill badge-success">{{ $item->type }}</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">{{ $item->type }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->type == 'fixed')
                                                <span class="badge badge-pill badge-success">${{ $item->value }}</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">{{ $item->value }}%</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="toggle" data-toggle="switchbutton" {{ $item->status == 'active' ? 'checked':'' }}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="{{ route('coupon.edit',$item->id) }}" data-toggle="tooltip" data-placement="bottom"  title="edit" class="btn btn-outline-primary"> <i class="icon-pencil"></i>
                                            </a>
                                        <form action="{{ route('coupon.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="delete" class="btn btn-outline-danger delBtn"> <i class="icon-trash"></i>
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
                url: "{{ route('coupon.status') }}",
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
