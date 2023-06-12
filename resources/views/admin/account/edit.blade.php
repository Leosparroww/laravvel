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
                                  <h3 class="text-center title-2">Account edit</h3>
                              </div>
                              <hr>
                              <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                  enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                      <div class="col-3 offset-1">
                                          @if (Auth::user()->image == null)
                                              <img src="{{ asset('image/default_profile.jpg') }}" alt=""
                                                  class="img-thumbnail shadow-sm rounded-circle">
                                          @else
                                              <img src="{{ asset('storage/' . Auth::user()->image) }}" class=""
                                                  alt="">
                                          @endif
                                          <input type="file" name="image"
                                              class="rounded p-4 mt-3 form-control @error('image')
                                                          is-invalid
                                                      @enderror ">
                                          @error('image')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="col-6 offset-1 bg-success-subtle rounded p-2 ps-4">

                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid fa-user-pen me-3 p-2"></i><span>
                                                  <label for="pp" class="ms-2">Name</label><br><input type="text"
                                                      class="rounded p-2 my-1 form-control @error('name')
                                                          is-invalid
                                                      @enderror form-control @error('name')
                                                          is-invalid
                                                      @enderror"
                                                      value="{{ old('name', Auth::user()->name) }}" name="name"
                                                      placeholder="Enter your name">
                                                  @error('name')
                                                      <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                              </span>
                                          </h4>
                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid fa-envelope me-4 p-2"></i>
                                              <span><label for="pp" class="ms-2">Email</label><br><input
                                                      type="text"
                                                      class="rounded p-2 my-1 form-control @error('email')
                                                          is-invalid
                                                      @enderror"
                                                      value="{{ old('email', Auth::user()->email) }}" name="email"
                                                      placeholder="Enter your email">
                                                  @error('email')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
                                              </span>
                                          </h4>
                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid fa-phone me-4  p-2"></i>
                                              <span>
                                                  <label for="pp" class="ms-2">Phone</label><br>
                                                  <input type="number"
                                                      class="rounded p-2 my-1 form-control @error('phone')
                                                          is-invalid
                                                      @enderror "
                                                      value="{{ old('phone', Auth::user()->phone) }}" name="phone"
                                                      placeholder="Enter your ph.NO">
                                                  @error('phone')
                                                      <div class="invalid-feedback fs-5">{{ $message }}</div>
                                                  @enderror
                                              </span>

                                          </h4>


                                          <h4 class="my-3 d-flex align-items-center"><i
                                                  class="fa-solid fa-venus-mars  me-4  p-2"></i>
                                              <span>
                                                  <label for="pp" class="ms-2">Gender</label><br>
                                                  <select name="gender" id="" class="form-select">
                                                      <option value="male"
                                                          @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                      <option value="female"
                                                          @if (Auth::user()->gender == 'female') selected @endif>Female</option>

                                                  </select>
                                                  @error('gender')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
                                              </span>
                                          </h4>
                                          <h4 class="my-3  d-flex align-items-center"><i
                                                  class="fa-solid fa-address-card me-4 p-2"></i><span><label for="pp"
                                                      class="ms-2">Address</label><br>
                                                  <textarea name="address"
                                                      class="rounded p-2 my-1 form-control @error('address')
                                                          is-invalid
                                                      @enderror"
                                                      placeholder="Enter your address" id="" cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                                  @error('address')
                                                      <span class="invalid-feedback">{{ $message }}</span>
                                                  @enderror
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
