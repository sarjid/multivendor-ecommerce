@extends('backend.layouts.master')
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All currency</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">currency</li>
                        <li class="breadcrumb-item active">All currency</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <a href="{{ route('currency.create') }}"  class="btn btn-success" style="float: right;">Add New</a>
                        <h2>All currency</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Symbol</th>
                                        <th>Code</th>
                                        <th>Exchange Rate (1$ == ?)</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($currencies as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->symbol }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ number_format($item->exchange_rate,2) }} {{ $item->symbol }}</td>
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="toggle" data-toggle="switchbutton" {{ $item->status == 'active' ? 'checked':'' }}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="{{ route('currency.edit',$item->id) }}" data-toggle="tooltip" data-placement="bottom"  title="edit" class="btn btn-outline-primary"> <i class="icon-pencil"></i>
                                            </a>
                                        <form action="{{ route('currency.destroy',$item->id) }}" method="POST">
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
                url: "{{ route('currency.status') }}",
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
