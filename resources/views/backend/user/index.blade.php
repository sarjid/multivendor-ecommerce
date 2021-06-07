@extends('backend.layouts.master')
@section('manage-user') active @endsection
@section('all-user') active @endsection
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All user</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">user</li>
                        <li class="breadcrumb-item active">All user</li>
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
                        <a href="{{ route('user.create') }}"  class="btn btn-success" style="float: right;">Add New</a>
                        <h2>All users</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Username</th>
                                        <th>FullName</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>phone</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>${{ $item->full_name }}</td>
                                        <td>
                                            <img src="{{ $item->photo }}" style="max-height: 90px; max-width:120px; border-radius:50%;" alt="photo">
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <input type="checkbox" value="{{ $item->id }}" name="toggle" data-toggle="switchbutton" {{ $item->status == 'active' ? 'checked':'' }}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="javascript::void(0)" data-toggle="modal" data-target="#userModal{{ $item->id }}" data-placement="bottom"  title="view" class="btn btn-outline-secondary"> <i class="icon-eye"></i>
                                            </a>

                                            <a href="{{ route('user.edit',$item->id) }}" data-toggle="tooltip" data-placement="bottom"  title="edit" class="btn btn-outline-warning"> <i class="icon-pencil"></i>
                                            </a>
                                        <form action="{{ route('user.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="delete" class="btn btn-outline-danger delBtn mt-2"> <i class="icon-trash"></i>
                                            </a>
                                        </form>
                                        </td>
                                {{-- modal  start  --}}
                                <div class="modal fade" id="userModal{{ $item->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        @php
                                            $user = App\Models\User::where('id',$item->id)->first();
                                        @endphp
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="title" id="defaultModalLabel">{{ $user->username }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <strong>Full Name:</strong> {{ $item->full_name }}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <strong>Email</strong>
                                                            {{ $item->email }}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Phone:</strong>
                                                            {{ $item->phone }}
                                                        </div>
                                                    </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <strong>Address:</strong> {{ $item->address }}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <strong>Role:</strong> {{ $item->role }}%
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Status:</strong> <span class="badge badge-pill badge-success">{{ $item->status }}</span>
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
                url: "{{ route('user.status') }}",
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
