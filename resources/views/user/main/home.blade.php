@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-danger-subtle px-3 py-2">
                            <a href="{{ route('user#home') }}"> <span class="mt-2 text-black font-weight-bold"
                                    for="price-all">Categories
                                </span></a>
                            <span class="badge text-bg-secondary">
                                {{ count($category) }}</span>
                        </div>
                        @foreach ($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3 ms-3">
                                <a href="{{ route('user#filter', $c->id) }}"> <span class=" text-black"
                                        for="price-1">{{ $c->name }} </span></a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}"><button type="button"
                                        class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button></a>
                                <a href="{{ route('user#history') }}"><button type="button"
                                        class="btn btn-primary position-relative ms-5">
                                        History <i class="fa-solid fa-clock-rotate-left"></i>
                                    </button></a>
                            </div>
                            <div class="ml-2">
                                <div class="">
                                    <select name="sorting" id="sortingOption" class="form-control rounded">
                                        <option value="">Sort</option>
                                        <option value="asc">Accending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <span class="row" id="dataList">
                        <input type="text" id="categoryId" value="{{ $categoryId }} " hidden>
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4 " class="myForm">
                                        <div class="product-img position-relative overflow-hidden text-center ">
                                            <img src="{{ asset('storage/' . $p->image) }}" alt=""
                                                class="img-thumbnail" style="height:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                        class="fa-solid fa-circle-info" style="color: #005eff;"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>
                                                <h6 class="text-muted ml-2"><del>25000</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="fs-2 font-weight-bold text-center"> No products right now </div>
                        @endif
                    </span>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    @if (count($pizza) != 0)
        <script>
            $(document).ready(function() {
                // $.ajax({
                //     type: 'get',
                //     url: '/user/ajax/pizzaList',
                //     datatype: 'json',
                //     success: function(response) {
                //         console.log(response)
                //     }

                // })
                $categoryId = $('#categoryId').val()

                $('#sortingOption').change(function() {
                    $eventOption = $('#sortingOption').val();

                    if ($eventOption == 'asc') {

                        $.ajax({
                            type: 'get',
                            url: '/user/ajax/pizzaList',
                            data: {
                                'status': 'asc',
                                'id': $categoryId,
                            },
                            dataType: 'json',

                            success: function(response) {
                                $list = '';
                                for ($i = 0; $i < response.length; $i++) {
                                    // console.log(`${response[$i].name}`)
                                    $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                            <div class="product-item bg-light mb-4 " class="myForm">
                                <div class="product-img position-relative overflow-hidden text-center ">
                                    <img src="{{ asset('storage/${response[$i].image}') }}" alt=""
                                        class=" object-fit-cover" style='height:300px;'>
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>
                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                                }
                                $('#dataList').html($list);

                            }

                        })
                    } else if ($eventOption == 'desc') {
                        $.ajax({
                            type: 'get',
                            url: '/user/ajax/pizzaList',
                            data: {
                                'status': 'desc',
                                'id': $categoryId,
                            },
                            datatype: 'json',
                            success: function(response) {
                                $list = '';
                                for ($i = 0; $i < response.length; $i++) {
                                    // console.log(`${response[$i].name}`)
                                    $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                            <div class="product-item bg-light mb-4 " class="myForm">
                                <div class="product-img position-relative overflow-hidden text-center ">
                                    <img src="{{ asset('storage/${response[$i].image}') }}" alt=""
                                        class=" object-fit-cover" style='height:300px;'>
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>
                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                                }
                                $('#dataList').html($list);

                            }
                        })
                    }
                })
            })
        </script>
    @else
    @endif
@endsection
