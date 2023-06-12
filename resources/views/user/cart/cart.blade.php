@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5" id="dataTable">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <thead>

                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </thead>
                    </thead>
                    <tbody class="align-middle" id="t-body">
                        @foreach ($cart as $c)
                            <tr>

                                <td class="align-middle row align-items-center"><img
                                        src="{{ asset('storage/' . $c->pizza_image) }}" alt=""
                                        style="width: 50px;height: 100px;" class="col object-fit-contain">
                                    <span class="col ">{{ $c->pizza_name }} </span>
                                    <span><input type="text" name="" id="productId" value="{{ $c->product_id }}"
                                            hidden>
                                        <input type="text" name="" id="cartId" value="{{ $c->id }}"
                                            hidden>
                                    </span>
                                </td>

                                <td class="align-middle" id="price">{{ $c->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            id="qty" value="{{ $c->qty }}" min="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">
                                    {{ $c->pizza_price * $c->qty }} kyats
                                </td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove" id="btn-remove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="sub-total">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final-total">{{ $totalPrice + 3000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkBtn">Proceed To
                            Checkout</button>
                    </div>
                    <div>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCart">Clear
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents("tr")
                $price = Number($parentNode.find('#price').text().replace('kyats', ''))
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find("#total").html($total + " kyats");
                subTotal();
            })
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents("tr")
                $price = Number($parentNode.find('#price').text().replace('kyats', ''));
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find('#total').html($total + " kyats");
                subTotal();
            })
            $('.btn-remove').click(function() {
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/current/product',
                    data: {
                        'cartId': $('#cartId').val()
                    },
                    dataType: 'json',
                })
                $parentNode = $(this).parents("tr");
                $parentNode.remove();

                subTotal();
            })

            function subTotal() {
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("kyats", ''));
                })
                $('#sub-total').html(`${$totalPrice}kyats`)
                $finalPrice = $totalPrice + 3000;
                $('#final-total').html(`${$finalPrice}kyats`)
            }
            $('#checkBtn').click(function() {
                $orderList = [];
                $random = Math.floor((Math.random() * 9999) + 1);
                $random2 = Math.floor((Math.random() * 9999) + 1);
                $('#t-body tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': {{ Auth::user()->id }},
                        'product_id': $(row).find('#productId').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#total').text().replace('kyats', '') * 1,
                        'order_code': $random + '007' + $random2,
                    })

                })
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/order',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "true") {
                            window.location.href = "/user/home"
                        }
                    }
                })
            })
            $('#clearCart').click(function() {
                $('#t-body tr').remove()
                $('#sub-total').html('0 kyats')
                $('#final-total').html('3000 kyats')
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/cart',
                    dataType: 'json',
                })
            })

        })
    </script>
@endsection
