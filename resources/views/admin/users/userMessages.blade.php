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
                                <h2 class="title-1 mb-3 "> Messages List</h2>
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
                                    class="fa-solid fa-database me-3"></i>{{ $messages->total() }}</span>
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
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Feedback or Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $m)
                                    <tr class="tr shadow-sm remover">
                                        <td hidden></td>
                                        <td>{{ $m->user_id }}</td>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->email }}</td>
                                        <td>{{ $m->subject }}</td>

                                        <td>
                                            <input type="text" class="input" value="{{ $m->id }}" hidden>
                                            <a data-bs-toggle="collapse" href="#{{ $m->id }}" role="button"
                                                aria-expanded="false"
                                                class="border rounded-4 p-2 text-decoration-none me-4">
                                                <i class="fa-solid fa-circle-chevron-up" style="color: #1b69ee;"></i>
                                                <i class="fa-solid fa-circle-chevron-down" style="color: #1b69ee;"></i>
                                            </a>
                                            <a href="{{ route('user#messageInfo', $m->id) }}"
                                                class="border rounded-4 p-2 text-decoration-none me-4">
                                                <i class="fa-solid fa-circle-info" style="color: #2461cc;"></i>
                                            </a>
                                            <a href="" id="" class="border rounded-4 p-2 deleteBtn"
                                                data-bs-toggle="collapse" href="#collapseExample" title="Delete">
                                                <i class="fa-solid fa-trash-can" style="color: #c32418;" title="delete">
                                                </i>
                                            </a>

                                        </td>
                                    </tr>
                                    <tr class="collapse remover" id="{{ $m->id }}">
                                        <td colspan="5">
                                            <div class="collapse text-left mx-5" id="{{ $m->id }}">
                                                {{ $m->message }}
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
        {{ $messages->links() }}
    </div>

    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('.deleteBtn').click(function() {

                $parentNode = $(this).parents('tr')
                $data = $parentNode.find('.input').val()
                console.log($data)

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/message/clear',
                    dataType: 'json',
                    data: {
                        'id': $data,
                    },
                })
                $parentNode.remove()
            })
        })
    </script>
@endsection
