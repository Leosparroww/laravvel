@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="m-auto col-8 table-responsive mb-5" id="dataTable">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark ">
                        <thead class="">
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </thead>
                    </thead>
                    <tbody class="align-middle" id="t-body">
                        @foreach ($order as $o)
                            <tr>
                                <th>{{ $o->created_at->format('d-F-Y') }}</th>
                                <th>{{ $o->order_code }}</th>
                                <th>{{ $o->total_price }}</th>
                                <th>
                                    @if ($o->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-spinner mx-2"></i> pending</span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check mx-2"></i> success</span>
                                    @elseif ($o->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-xmark mx-2"></i> cancelled</span>
                                    @endif
                                </th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div> {{ $order->links() }}</div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
@endsection
