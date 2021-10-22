@extends('backend.layouts.master')
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All order</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">order</li>
                        <li class="breadcrumb-item active">All order</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>All order</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Condition</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td><span class="list-name">{{ $loop->iteration }}</span></td>
                                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ number_format($item->total_amount,2) }}</td>
                                        <td><span class="badge
                                        @if($item->condition =='pending')
                                            badge-primary
                                        @elseif ($item->condition =='processing')
                                            badge-info
                                        @elseif ($item->condition =='delivered')
                                            badge-success
                                        @else
                                            badge-danger
                                        @endif
                                            ">{{ $item->condition }}</span></td>
                                        <td>
                                            <a href="{{ route('order.show',$item->id) }}"  title="add attribute" class="btn btn-outline-info"> <i class="icon-eye"></i>
                                            </a>
                                        <form action="{{ route('order.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="delete" class="btn btn-outline-danger delBtn"> <i class="icon-trash"></i>
                                            </a>
                                        </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2">No Order Found..!</td>
                                    </tr>
                                @endforelse
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
@endsection
