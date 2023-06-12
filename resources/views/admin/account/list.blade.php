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
                                <h2 class="title-1 mb-3 "> Admin List</h2>
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
                    {{-- search box --}}
                    <div class="row">
                        <div class="col-3">
                            @if (request('key'))
                                <h2 class="mb-2 ">Search Key: <span class="text-danger">{{ request('key') }}</span></h2>
                            @endif
                            <span class="bg-white p-2  rounded "><i
                                    class="fa-solid fa-database me-3"></i>{{ $admin->total() }}</span>
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


                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr shadow-sm">
                                        <td class="col-1">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'female')
                                                    <img src="{{ asset('image/feamale_profile.png') }}" alt="">
                                                @else
                                                    <img src="{{ asset('image/default_profile.jpg') }}" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $a->name }}
                                        </td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature ">
                                                <a href="{{ route('admin#changeRole', $a->id) }}"><button class="item"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Change admin role">
                                                        <i class="fa-solid fa-person-circle-minus"></i>
                                                    </button></a>
                                                <button class="item p-3" data-toggle="tooltip" data-placement="top"
                                                    title="More">
                                                    <i class="fa-solid fa-circle-info "></i>
                                                </button>
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <a href="{{ route('admin#delete', $a->id) }}" class=""><button
                                                            class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
