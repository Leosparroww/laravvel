  @extends('admin.layouts.master')
  @section('content')
      <!-- MAIN CONTENT-->
      <div class="main-content">
          <div class="section__content section__content--p30">
              <div class="container-fluid">
                  <div class="offset-3 col-6">
                      @if (session('updateSuccess'))
                          <div class="alert alert-success alert-dismissible fade show ms-5 " role="alert">
                              <span>{{ session('updateSuccess') }}</span>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif
                  </div>
                  <div class="col-lg-10 offset-1">
                      <div class="card">
                          <div class="card-body">
                              <div class="card-title">
                                  <h3 class="text-center title-2">Account details</h3>
                              </div>
                              <hr>
                              <div class="row">
                                  <div class="col-2 offset-2 ">
                                      @if (Auth::user()->image == null)
                                          <img src="{{ asset('image/default_profile.jpg') }}" alt=""
                                              class="img-thumbnail shadow-sm rounded-circle">
                                      @else
                                          <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                              style='height:200px;width:200px;' class="float-center" alt="">
                                      @endif
                                  </div>
                                  <div class=" offset-1 col-6 bg-success-subtle  rounded p-2 ps-4">
                                      <form action="">

                                          <h4>
                                              <table class="table table-sm">
                                                  <tbody>
                                                      <tr>
                                                          <td>
                                                              <i class="fa-solid fa-user-pen me-2"></i>

                                                          </td>
                                                          <td>{{ Auth::user()->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                              <i class="fa-solid fa-envelope me-2"></i>
                                                          </td>
                                                          <td>{{ Auth::user()->email }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                              <i class="fa-solid fa-phone me-2"></i></i>

                                                          </td>
                                                          <td>{{ Auth::user()->phone }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                              <i class="fa-solid fa-venus-mars  me-2"></i>
                                                          </td>
                                                          <td>{{ Auth::user()->gender }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                              <i class="fa-solid fa-address-card me-2"></i>

                                                          </td>
                                                          <td>{{ Auth::user()->address }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                              <i class="fa-solid fa-calendar me-2"></i>

                                                          </td>
                                                          <td>{{ Auth::user()->created_at }}</td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </h4>

                                      </form>
                                  </div>
                              </div>
                              <div class="row mt-5">
                                  <div class="text-end ">
                                      <a href="{{ route('admin#edit') }}"> <button
                                              class="btn btn bg-success-subtle fw-bold ">Edit profile</button></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END MAIN CONTENT-->
      <!-- END PAGE CONTAINER-->
  @endsection
