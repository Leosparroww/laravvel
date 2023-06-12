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
                                <h2 class="title-1 mb-3 "> Product List</h2>
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
                        <div class="table-data__tool-right d-flex">
                            <form action="{{ route('products#createPage') }}">
                                @csrf
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small mx-2" type="submit">
                                    <i class="zmdi zmdi-plus"></i>Product Create
                                </button>
                            </form>

                            <span><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button></span>
                        </div>
                    </div>
                    {{-- search box --}}
                    <div class="row">

                        <div class="col-3 mt-2">
                            <h2 class="mb-2">
                                @if (request('key'))
                                    Search Key:
                                @endif{{ request('key') }}
                            </h2>
                            <span class="bg-white p-2  rounded "><i
                                    class="fa-solid fa-database me-3"></i>{{ $pizzas->total() }}</span>
                        </div>

                        <div class="col-3 offset-6">
                            <form action="" method="get">
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search...."
                                        value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-danger"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>


                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Pizza id</th>
                                        <th>name</th>
                                        <th>Category</th>
                                        <th>Waiting Time</th>
                                        <th>View Count</th>
                                        <th>Created at</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td style='height:200px;'><img src="{{ asset('storage/' . $pizza->image) }}"
                                                    class="img-thumbnail h-100" alt=""></td>
                                            <td>
                                                {{ $pizza->id }}
                                            </td>
                                            <td>
                                                {{ $pizza->name }}
                                            </td>
                                            <td> {{ $pizza->category_name }}</td>
                                            <td>{{ $pizza->waiting_time }}</td>
                                            <td><i class="fa-regular fa-eye mx-1"></i>{{ $pizza->view_count }}</td>
                                            <td>{{ $pizza->created_at->format('j-F-Y') }}</td>

                                            <td>
                                                <div class="table-data-feature ">
                                                    <a href="{{ route('products#edit', $pizza->id) }}"><button
                                                            class="item p-3" data-toggle="tooltip" data-placement="top"
                                                            title="More">
                                                            <i class="fa-solid fa-circle-info "></i>
                                                        </button></a>
                                                    <a href="{{ route('product#updatePage', $pizza->id) }}"><button
                                                            class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button></a>


                                                    <a href="{{ route('products#delete', $pizza->id) }}"
                                                        class=""><button class="item" data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button></a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $pizzas->links() }}
                            </div>
                        </div>
                    @else
                        <h1 class="text-center mt-5">There is no Data</h1>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
