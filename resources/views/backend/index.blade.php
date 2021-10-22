@extends('backend.layouts.master')

@section('backend-content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">University</li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
                            data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                        <span>Visitors</span>
                    </div>
                    <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
                            data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                        <span>Visits</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon text-info"><i class="fa fa-user"></i> </div>
                        <div class="content">
                            <div class="text">Total Student</div>
                            <h5 class="number">530</h5>
                        </div>
                        <hr>
                        <div class="icon text-warning"><i class="fa fa-user-circle"></i> </div>
                        <div class="content">
                            <div class="text">Total Teacher</div>
                            <h5 class="number">14</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon text-warning"><i class="fa fa-tags"></i> </div>
                        <div class="content">
                            <div class="text">Department</div>
                            <h5 class="number">7</h5>
                        </div>
                        <hr>
                        <div class="icon"><i class="fa fa-graduation-cap"></i> </div>
                        <div class="content">
                            <div class="text">Courses</div>
                            <h5 class="number">35</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon text-danger"><i class="fa fa-credit-card"></i> </div>
                        <div class="content">
                            <div class="text">Expense</div>
                            <h5 class="number">$3205</h5>
                        </div>
                        <hr>
                        <div class="icon text-success"><i class="fa fa-university"></i> </div>
                        <div class="content">
                            <div class="text">Income</div>
                            <h5 class="number">$35,325</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon"><i class="fa fa-map-pin"></i> </div>
                        <div class="content">
                            <div class="text">Our Center</div>
                            <h5 class="number">28</h5>
                        </div>
                        <hr>
                        <div class="icon text-success"><i class="fa fa-smile-o"></i> </div>
                        <div class="content">
                            <div class="text">Happy Clients</div>
                            <h5 class="number">528</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>New Order List</h2>

                        <a href="{{ route('order.index') }}" class="btn btn-sm btn-danger" style="float: right;">View All</a>
                    </div>
                    <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0">
                            <thead class="thead-dark">
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
                                    <form action="{{ route('coupon.destroy',$item->id) }}" method="POST">
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
