  @extends('user.layouts.master')
  @section('content')
      <!-- MAIN CONTENT-->
      <div class="main-content">
          <div class="section__content section__content--p30">
              <div class="container-fluid">

                  <div class="col-lg-6 offset-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="card-title">
                                  <h3 class="text-center title-2">Category Creation</h3>
                              </div>
                              <hr>
                              @if (session('changeSuccess'))
                                  <div class="alert alert-success alert-dismissible fade show m-1 " role="alert">
                                      <i class="fa-solid fa-check"></i>
                                      <span>{{ session('changeSuccess') }}</span>
                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                          aria-label="Close"></button>
                                  </div>
                              @endif
                              @if (session('notMatch'))
                                  <div class="alert alert-danger alert-dismissible fade show m-1 " role="alert">
                                      <i class="fa-solid fa-check"></i>
                                      <span>{{ session('notMatch') }}</span>
                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                          aria-label="Close"></button>
                                  </div>
                              @endif
                              <form action="{{ route('user#passwordChange') }}" method="post" novalidate="novalidate">
                                  @csrf
                                  <div class="form-group">
                                      <label class="control-label mb-1">Old Password</label>
                                      <input id="cc-pament" name="oldPassword" type="password"
                                          class="form-control @error('oldPassword') is-invalid @enderror  @if (session('notMatch')) is-invalid @endif "
                                          aria-required="true" aria-invalid="false" placeholder="Old password">
                                      @error('oldPassword')
                                          <small class="text-danger">{{ $message }}</small>
                                      @enderror

                                  </div>
                                  <div class="form-group">
                                      <label class="control-label mb-1">New password</label>
                                      <input id="cc-pament" name="newPassword" type="password"
                                          class="form-control @error('newPassword') is-invalid @enderror"
                                          aria-required="true" aria-invalid="false" placeholder="Enter new password">
                                      @error('newPassword')
                                          <small class="text-danger">{{ $message }}</small>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label mb-1">Confirm Password</label>
                                      <input id="cc-pament" name="confirmPassword" type="password"
                                          class="form-control @error('confirmPassword') is-invalid @enderror"
                                          aria-required="true" aria-invalid="false" placeholder="Enter confirm password">
                                      @error('confirmPassword')
                                          <small class="text-danger">{{ $message }}</small>
                                      @enderror
                                  </div>
                                  <div class="text-center mt-3">
                                      <button id="payment-button" type="submit"
                                          class="btn btn-lg btn-info btn-block text-center">
                                          <i class="fa-solid fa-key"></i><span id="payment-button-amount">Update
                                              Password</span>
                                          <span id="payment-button-sending" style="display:none;">Sending…</span>
                                      </button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END MAIN CONTENT-->
      <!-- END PAGE CONTAINER-->
  @endsection
