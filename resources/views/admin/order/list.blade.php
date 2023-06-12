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
                                <h2 class="title-1 mb-3  text-center"> Order List</h2>
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

                    <div class="row ">
                        <form action="{{ route('order#changeStatus') }}" class="input-group w-25" method="GET">
                            <span class="bg-white p-2 input-group-text"><i
                                    class="fa-solid fa-database me-3"></i>{{ $order->total() }}</span>
                            <select name="orderStatus" class=" form-select " id="status inputGroupSelect04"
                                aria-label="Example select with button addon">
                                <option value="">All</option>
                                <option value="0" @selected(request('orderStatus') == '0')>Pending</option>
                                <option value="1"@selected(request('orderStatus') == '1')>Accept</option>
                                <option value="2"@selected(request('orderStatus') == '2')>Reject</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="submit">Search</button>


                        </form>
                    </div>
                    {{-- search box --}}

                    @if ($order->total() != 0)
                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>User id</th>
                                        <th>User Name </th>
                                        <th>Order date</th>
                                        <th>Order Code</th>
                                        <th> Amount</th>
                                        <th>Status </th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($order as $o)
                                        <tr class="tr-shadow">
                                            <td hidden> <input type="text" class="orderId" value="{{ $o->id }}">
                                            </td>
                                            <td>{{ $o->user_id }}</td>
                                            <td>
                                                {{ $o->user_name }}
                                            </td>
                                            <td>
                                                {{ $o->created_at->format(' g:i  a | F-j-Y') }}
                                            </td>
                                            <td> <a class="text-danger text-decoration-none"
                                                    href="{{ route('order#listInfo', $o->order_code) }}">{{ $o->order_code }}</a>
                                            </td>
                                            <td class="amount" id="amount">{{ $o->total_price }} Kyats </td>
                                            <td>
                                                <select name="" class="p-3 border rounded orderStatus">
                                                    <i class="fa-solid fa-sort-down"></i>
                                                    <option value="0"
                                                        @if ($o->status == 0) selected @endif>
                                                        pending</option>

                                                    <option value="1"
                                                        @if ($o->status == 1) selected @endif>
                                                        Accept</option>

                                                    <option value="2" @selected($o->status == 2)>Reject</option>

                                                </select>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $order->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <h1>There is no data</h1>
                        </div>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('.orderStatus').change(function() {
                console.log('fdfj')
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: {
                        status: $currentStatus,
                        'order_id': $orderId,
                    },
                    dataType: 'json',
                })
                location.reload()
            })
        })
    </script>
@endsection
