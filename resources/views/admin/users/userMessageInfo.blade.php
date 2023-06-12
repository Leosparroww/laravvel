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
                                <a onclick="history.back()"><i class="fa-solid fa-arrow-left-long  fs-4"
                                        style="color: #0c5de9; cursor: pointer;"></i></a>
                                <h2 class="title-1 mb-3 "></h2>
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
                            Message Info
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-id-card me-2" style="color: #102f65;"></i>User ID
                                </div>
                                <div class="col">{{ $message->user_id }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"> <i class="fa-solid fa-user me-2" style="color: #005eff;"></i>User Name
                                </div>
                                <div class="col">{{ $message->name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-envelope me-2" style="color: #ff0000;"></i>Email
                                </div>
                                <div class="col">{{ $message->email }}</div>
                            </div>

                            <div class="row ">
                                <div class="col"><i class="fa-solid fa-calendar-days me-2"
                                        style="color: #577cbc;"></i>Message receive date </div>
                                <div class="col"> {{ $message->created_at->format(' g:i  a  |  d-F-Y') }}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card offset-2 col-8">
                        <h2 class="card-header text-center">
                            {{ $message->subject }}
                        </h2>
                        <div class="card-body">
                            <p>{{ $message->message }}</p>
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
