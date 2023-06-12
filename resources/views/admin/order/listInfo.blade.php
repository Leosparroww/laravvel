@extends('admin.layouts.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="table-data__tool ">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap ">
                                <h2 class="title-1 mb-3 "> Order info</h2>
                                @if (session('createSuccess'))
                                    <div class="alert alert-success alert-dismissible fade show ms-5 " role="alert">
                                        <span>{{ session('createSuccess') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif (session('deleteSuccess'))
                                    <div class="alert alert-danger alert-dismissible fade show ms-5 " role="alert">
                                        <span>{{ session('deleteSuccess') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif (session('updateSuccess'))
                                    <div class="alert alert-danger alert-dismissible fade show ms-5 " role="alert">
                                        <span>{{ session('updateSuccess') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="card col-4">
                        <div class="card-header font-weight-bold fs-3">
                            Order Info
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"> <i class="fa-solid fa-user me-2" style="color: #005eff;"></i>User Name
                                </div>
                                <div class="col">{{ ucfirst($orderInfo[0]->user_name) }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode me-2"
                                        style="color: #ff4d00;"></i></i>Order Code</div>
                                <div class="col text-danger">{{ $orderInfo[0]->order_code }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                <div class="col">{{ $orderInfo[0]->created_at->format(' g:i  a  |  d-F-Y') }}
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col"><i class="fa-solid fa-sack-dollar  me-2"
                                        style="color: #2ecc5d;"></i>Total
                                    Price</div>
                                <div class="col">{{ $orderPrice->total_price }} Kyats
                                </div>
                            </div>
                            <span class="text-center" style="color: #ff0156"> ( Delivery fees included <i
                                    class="fa-solid fa-circle-exclamation"></i>)</span>
                        </div>
                    </div>
                    <a onclick="history.back()"><i class="fa-solid fa-arrow-left-long mb-3 fs-4"
                            style="color: #0c5de9;"></i></a>
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 ">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>User id</th>
                                    <th>User name</th>
                                    <th>product image</th>
                                    <th>product name</th>
                                    <th>Order date</th>
                                    <th>quantity</th>
                                    <th>ammount</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orderInfo as $o)
                                    <tr class="tr-shadow">
                                        <td hidden></td>
                                        <td class="align-item-center">{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td class="col-1"><img src="{{ asset('storage/' . $o->product_image) }}"
                                                alt=""></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format(' g:i  a  |  d-F-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>

                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
