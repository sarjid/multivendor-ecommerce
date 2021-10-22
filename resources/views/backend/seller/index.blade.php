@extends('backend.layouts.master')
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All seller</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">seller</li>
                        <li class="breadcrumb-item active">All seller</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <a href="{{ route('seller.create') }}"  class="btn btn-success" style="float: right;">Add New</a>
                        <h2>All seller</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Photo</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Is Verified</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($sellers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ ($item->photo == null) ? Helper::userDefaultImage() : asset($item->photo) }}" style="max-height: 60px; max-width:60px;" alt="photo">
                                        </td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="verified" data-size="sm"  data-toggle="switchbutton" {{ $item->is_verified  ? 'checked':'' }}  data-onlabel="Yes" data-offlabel="No" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="toggle" data-size="sm" data-toggle="switchbutton" {{ $item->status == 'active' ? 'checked':'' }}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="{{ route('seller.edit',$item->id) }}" data-toggle="tooltip" data-placement="bottom"  title="edit" class="btn btn-outline-primary"> <i class="icon-pencil"></i>
                                            </a>
                                        <form action="{{ route('seller.destroy',$item->id) }}" method="POST">
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
                url: "{{ route('seller.status') }}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    status:status,
                    id:id
                },
                success: function (response) {
                   if (response.status) {
                    swal(response.msg, {
                        icon: "success",
                        button:false,
                        timer: 1500,
                        });
                   }else{
                       alert('try again!');
                   }
                }
            });
        })
    </script>

    {{-- //Seller Verify with ajax  --}}
    <script>
        $('input[name=verified]').change(function(){
            let mode = $(this).prop('checked');
            let id = $(this).val();

            $.ajax({
                url: "{{ route('seller.verified') }}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    mode:mode,
                    id:id
                },
                success: function (response) {
                   if (response.status) {
                        swal(response.msg, {
                        icon: "success",
                        button:false,
                        timer: 1500,
                        });
                   }else{
                       alert('Something Went Wrong..try again!');
                   }
                }
            });
        })
    </script>
@endsection
