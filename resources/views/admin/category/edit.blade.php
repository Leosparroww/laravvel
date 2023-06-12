  @extends('admin.layouts.master')
  @section('content')
      <!-- MAIN CONTENT-->
      <div class="main-content">
          <div class="section__content section__content--p30">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-3 offset-8">
                          <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                      </div>
                  </div>
                  <div class="col-lg-6 offset-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="card-title">
                                  <h3 class="text-center title-2">Category Update</h3>
                              </div>
                              <hr>
                              <form action="{{ route('category#update') }}" method="post" novalidate="novalidate">
                                  @csrf
                                  <div class="form-group">
                                      <input type="number" value="{{ $category->id }}" name="categoryId" hidden>
                                      <label class="control-label mb-1">Name</label>
                                      <input id="cc-pament" name="categoryName" type="text"
                                          class="form-control @error('categoryName') is-invalid @enderror"
                                          aria-required="true" aria-invalid="false"
                                          value="{{ old('categoryName', $category->name) }}">
                                      @error('categoryName')
                                          <small class="text-danger">{{ $message }}</small>
                                      @enderror
                                  </div>
                                  <div class="text-center mt-3">
                                      <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                          <span id="payment-button-amount">Update</span>
                                          <span id="payment-button-sending" style="display:none;">Sending…</span>
                                          <i class="fa-solid fa-circle-right"></i>
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
