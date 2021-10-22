@extends('backend.layouts.master')
@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> order</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-order"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-order">order</li>
                        <li class="breadcrumb-order active">order view</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <a href="{{ route('order.index') }}"  class="btn btn-success" style="float: right;">All Order</a>
                        <h2>Show Order</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
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
                                    <tr>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ number_format($order->total_amount,2) }}</td>
                                        <td><span class="badge
                                        @if($order->condition =='pending')
                                            badge-primary
                                        @elseif ($order->condition =='processing')
                                            badge-info
                                        @elseif ($order->condition =='delivered')
                                            badge-success
                                        @else
                                            badge-danger
                                        @endif
                                            ">{{ $order->condition }}</span></td>
                                        <td>
                                        <a href="javascript::void(0)"  title="download" class="btn btn-outline-info"> <i class="fa fa-download"></i>
                                            </a>
                                        <form action="{{ route('order.destroy',$order->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="" data-id="{{ $order->id }}" data-toggle="tooltip" data-placement="bottom" title="delete" class="btn btn-outline-danger delBtn"> <i class="icon-trash"></i>
                                            </a>
                                        </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->products as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            @php
                                                $photo = explode(',',$item->photo);
                                            @endphp
                                            @if (count($photo) == 1)
                                                <img src="{{ $item->photo }}" height="70" width="70" alt="">
                                            @else
                                                <img src="{{ $photo[0] }}" height="70" width="70" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-5">
                            <form action="{{ route('order.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="form-group">
                                    <label for="ST">Status</label>
                                    <select class="form-control" name="condition" id="ST">
                                      <option value="pending" {{ $order->condition == 'delivered' ||  $order->condition == 'cancelled' ? 'disabled':'' }} {{ $order->condition == 'pending' ? 'selected':'' }}>Pending</option>

                                      <option value="processing" {{ $order->condition == 'delivered' ||  $order->condition == 'cancelled' ? 'disabled':'' }} {{ $order->condition == 'processing' ? 'selected':'' }}>Processing</option>

                                      <option value="delivered" {{ $order->condition == 'delivered' ||  $order->condition == 'cancelled' ? 'disabled':'' }} {{ $order->condition == 'delivered' ? 'selected':'' }}>Delivered</option>

                                      <option value="cancelled" {{ $order->condition == 'delivered' ||  $order->condition == 'cancelled' ? 'disabled':'' }} {{ $order->condition == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                        <div class="col-5">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Subtotal:</strong> {{ number_format($order->sub_total,2) }}</li>
                                    <li class="list-group-item"><strong>Shipping Cost:</strong> {{ number_format($order->delivery_charge,2) }}</li>
                                    <li class="list-group-item"><strong>Coupon:</strong> {{ number_format($order->coupon,2) }}</li>
                                    <li class="list-group-item"><strong>Total:</strong> {{ number_format($order->total_amount,2) }}</li>
                                    <li class="list-group-item">Item 3</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-1"></div>
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
