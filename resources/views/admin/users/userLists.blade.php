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
                                <h2 class="title-1 mb-3 "> Users List</h2>
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
                                    class="fa-solid fa-database me-3"></i>{{ $user->total() }}</span>
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


                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                    <tr class="tr shadow-sm">
                                        <td hidden> <input type="text" class="userId" value="{{ $u->id }}"></td>
                                        <td class="col-1">
                                            @if ($u->image == null)
                                                @if ($u->gender == 'female')
                                                    <img src="{{ asset('image/feamale_profile.png') }}" alt="">
                                                @else
                                                    <img src="{{ asset('image/default_profile.jpg') }}" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $u->name }}
                                        </td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>
                                            <select name="" class="form-select role">
                                                <option value="user"@selected($u->gender == 'user')>User</option>
                                                <option value="admin"@selected($u->gender == 'admin')>Admin</option>
                                            </select>

                                        </td>
                                        <td>
                                            <div class="table-data-feature ">

                                                <a href="{{ route('user#edit', $u->id) }}"><button class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>

                                                <a href="{{ route('admin#delete', $u->id) }}" class=""><button
                                                        class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button></a>

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
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.role').change(function() {
                $userId = $(this).parents('tr').find('.userId').val()
                $role = $(this).parents('tr').find('.role').val()

                $.ajax({
                    type: 'get',
                    url: '/user/change/role',
                    data: {
                        userId: $userId,
                        role: $role,

                    },

                })
                location.reload()
            })

        })
    </script>
@endsection
