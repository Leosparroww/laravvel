  @extends('admin.layouts.master')
  @section('content')
      <!-- MAIN CONTENT-->
      <div class="main-content">
          <div class="section__content section__content--p30">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-3 offset-8">
                          <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                      </div>
                  </div>
                  <div class="col-lg-6 offset-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="card-title">
                                  <h3 class="text-center title-2">Product Creation</h3>
                              </div>
                              <hr>
                              <form action="{{ route('products#create') }}" method="post" novalidate="novalidate"
                                  enctype="multipart/form-data">
                                  @csrf
                                  <div class="form-group">

                                      <div> <label class="control-label mb-1">Name</label>
                                          <input id="cc-pament" name="pizzaName" type="text"
                                              class="form-control @error('pizzaName') is-invalid @enderror"
                                              value="{{ old('pizzaName') }}" aria-required="true" aria-invalid="false"
                                              placeholder="Enter pizza name">
                                          @error('pizzaName')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div><label class="control-label mb-1">Category</label>
                                          <select name="pizzaCategory" id=""
                                              class="form-select @error('pizzaCategory') is-invalid @enderror" required>
                                              <option value="">Select category</option>
                                              @foreach ($categories as $c)
                                                  <option value="{{ $c->id }}">{{ $c->name }}</option>
                                              @endforeach

                                          </select>
                                          @error('pizzaCategory')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class=""><label class="control-label mb-1">Decription</label>
                                          <textarea name="pizzaDescription" class=" form-control @error('pizzaDescription') is-invalid @enderror" id=""
                                              cols="30" rows="10" placeholder="Enter Decription">{{ old('pizzaDescription') }}</textarea>
                                          @error('pizzaDescription')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="">
                                          <label class="control-label mb-1">Image</label>
                                          <input id="cc-pament" name="pizzaImage" type="file"
                                              class="form-control @error('pizzaImage') is-invalid @enderror"
                                              aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                          @error('pizzaImage')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="">
                                          <label class="control-label mb-1">waiting time</label>
                                          <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                              class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                              aria-required="true" aria-invalid="false"
                                              value="{{ old('pizzaWaitingTime') }}" placeholder="Enter WaitingTime..">
                                          @error('pizzaWaitingTime')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="">
                                          <label class="control-label mb-1">Price</label>
                                          <input id="cc-pament" name="pizzaPrice" type="number"
                                              class="form-control @error('pizzaPrice') is-invalid @enderror"
                                              aria-required="true" aria-invalid="false" value="{{ old('pizzaPrice') }}"
                                              placeholder="Enter Price..">
                                          @error('pizzaPrice')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                      </div>
                                  </div>
                                  <div>
                                      <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                          <span id="payment-button-amount">Create</span>
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
