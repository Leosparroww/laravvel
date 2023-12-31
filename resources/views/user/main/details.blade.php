@extends('user.layouts.master')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <a class="ms-5 my-5 text-black text-decoration-none" href="{{ route('user#home') }}">
            <i class="fa-solid fa-arrow-left mx-2"></i> back
        </a>
        <div class="row px-xl-5 mt-4">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active text-center">
                            <img class="img-thumbnail" style="height:500px " src="{{ asset('storage/' . $pizza->image) }}"
                                alt="Image">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <input type="number" value="{{ Auth::user()->id }}" hidden id="userId">
                <input type="number" value="{{ $pizza->id }}" hidden id="productId">
                <div class="h-100 bg-light p-30">
                    <h3 class="text-capitalize">{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        <span>View Count ( {{ $pizza->view_count + 1 }}<i class="fa-solid fa-eye mx-1"></i>)</span>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }}</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1"
                                id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" type="button" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->



    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light ">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid object-fit-contain" style="height:400px"
                                    src="{{ asset('storage/' . $p->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-circle-info" style="color: #005eff;"></i></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }}</h5>

                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>( <i class="fa-solid fa-eye mx-1"></i>{{ $p->view_count + 1 }})</small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Products End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            // increase view count
            $.ajax({
                type: 'get',
                url: "/user/ajax/viewcount",
                data: {
                    'userId': $('#userId').val(),
                    'productId': $('#productId').val(),
                    'count': $('#orderCount').val(),
                },
            })

            //add to cart
            $('#addCartBtn').click(function() {
                $source = {
                    'userId': $('#userId').val(),
                    'productId': $('#productId').val(),
                    'count': $('#orderCount').val(),
                }

                $.ajax({
                    type: 'get',
                    url: "/user/ajax/addToCart",
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "/user/home"
                        }
                    }
                })
            })



        })
    </script>
@endsection
