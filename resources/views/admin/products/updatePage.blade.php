  @extends('admin.layouts.master')
  @section('content')
      <!-- MAIN CONTENT-->
      <div class="main-content">
          <div class="section__content section__content--p30">
              <div class="container-fluid">

                  <div class="col-lg-10 offset-1">
                      <div class="card">
                          <div class="card-body">
                              <div class="card-title">
                                  <h3 class="text-center title-2">Pizza edit</h3>
                              </div>
                              <hr>
                              <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  <input type="text" name="pizzaId" value="{{ $pizza->id }}" hidden>
                                  <div class="row">
                                      <div class="col-3 offset-1">
                                          <img src="{{ asset('storage/' . $pizza->image) }}" alt=""
                                              class="img-thumbnail shadow-sm ">
                                          <input type="file" name="pizzaImage"
                                              class="rounded p-4 mt-3 form-control @error('pizzaImage')
                                                          is-invalid
                                                      @enderror ">
                                          @error('pizzaImage')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="col-6 offset-1 bg-success-subtle rounded p-2 ps-4">

                                          <h4 class="my-3 d-flex align-items-center ">
                                              <i class="fa-solid fa-pizza-slice me-4 p-2"></i>
                                              <div class=" w-50 ">
                                                  <label for="">Pizza Name</label>
                                                  <input type="text "
                                                      class="rounded p-2 my-1 form-control @error('pizzaName')
                                                          is-invalid @enderror "
                                                      value="{{ old('name', $pizza->name) }}"
                                                      name="pizzaName"placeholder="Enter your pizza name">
                                                  @error('pizzaName')
                                                      <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                              </div>
                                          </h4>
                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid  fa-money-bill-1-wave me-4 p-2"></i>
                                              <span><label for="pp" class="ms-2">price</label><br><input
                                                      type="text"
                                                      class="rounded p-2 my-1 form-control @error('pizzaPrice')
                                                          is-invalid
                                                      @enderror"
                                                      value="{{ old('price', $pizza->price) }}" name="pizzaPrice"
                                                      placeholder="Enter your price">
                                                  @error('pizzaPrice')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
                                              </span>
                                          </h4>
                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid fa-hourglass-half me-4  p-2"></i>
                                              <span>
                                                  <label for="pp" class="ms-2">waiting_time</label><br>
                                                  <input type="number"
                                                      class="rounded p-2 my-1 form-control   @error('pizzaWaitingTime')
                                                          is-invalid
                                                      @enderror"
                                                      value="{{ old('waiting_time', $pizza->waiting_time) }}"
                                                      name="pizzaWaitingTime" placeholder="Enter your ph.NO">
                                                  @error('pizzaWaitingTime')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
                                              </span>

                                          </h4>
                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid fa-bars  me-4  p-2"></i>
                                              <span>
                                                  <label for="pp" class="ms-2">Category</label><br>
                                                  <select name="pizzaCategory" id=""
                                                      class="form-select @error('pizzaCategory')
                                                          is-invalid
                                                      @enderror">
                                                      <option value="">Choose option</option>
                                                      @foreach ($categories as $c)
                                                          <option value="{{ $c->id }}"
                                                              @if ($c->id == $pizza->category_id) selected @endif>
                                                              {{ $c->name }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('pizzaCategory')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
                                              </span>
                                          </h4>
                                          <h4 class="my-3  d-flex align-items-center"><i
                                                  class="fa-solid fa-file-lines me-4 p-2"></i><span><label for="pp"
                                                      class="ms-2">Description</label><br>
                                                  <textarea name="pizzaDescription"
                                                      class="rounded p-2 my-1 form-control @error('pizzaDescription')
                                                          is-invalid
                                                      @enderror"
                                                      placeholder="Enter your description" id="" cols="30" rows="10">{{ old('description', $pizza->description) }}</textarea>
                                                  @error('pizzaDescription')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
                                              </span>
                                          </h4>
                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid  fa-eye me-4  p-2"></i>
                                              <span>
                                                  <label for="pp" class="ms-2">Views</label><br>
                                                  <input type="number" class="rounded p-2 my-1 form-control "
                                                      value="{{ old('view_count', $pizza->view_count) }}" name="view_count"
                                                      placeholder="Enter your ph.NO" disabled>
                                              </span>

                                          </h4>
                                          <h4 class="mb-3 d-flex"><i class="fa-solid fa-calendar me-4 p-2"></i>
                                              <span class=""><label for="p" class="">Created
                                                      Date</label><br><input type="text" class="rounded my-1"
                                                      value="{{ Auth::user()->created_at->format('d-F-Y') }}" disabled>
                                              </span>
                                          </h4>


                                      </div>
                                  </div>
                                  <div class="row mt-5">
                                      <div class="text-end ">
                                          <button class="btn btn bg-success-subtle fw-bold ">Edit profile</button>
                                      </div>
                                  </div>
                              </form>
                              <div class="invalid-feedback">fdfdfdf</div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END MAIN CONTENT-->
      <!-- END PAGE CONTAINER-->
  @endsection
