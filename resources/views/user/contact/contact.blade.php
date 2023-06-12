  @extends('user.layouts.master')
  @section('content')
      <!-- MAIN CONTENT-->
      <div class="main-content">
          <div class="section__content section__content--p30">
              <div class="container-fluid">
                  <div class="text-center offset-3 col-6 mb-1" style="height: 50px">
                      @if (session('messageSent'))
                          <div class="alert alert-success alert-dismissible fade show m-1 " role="alert">
                              <i class="fa-solid fa-check"></i>
                              <span>{{ session('messageSent') }}</span>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif
                  </div>
                  <div class="col-lg-6 offset-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="card-title">
                                  <div class="float-left" onclick="history.back()" style="cursor: pointer"><i
                                          class="fa-solid fa-arrow-left-long" style="color: #175cd3;"></i>
                                  </div>
                                  <h3 class="text-center title-2">Send Message</h3>
                              </div>
                              <hr>
                              <form action="{{ route('user#meassageSent') }}" method="post" novalidate="novalidate">
                                  @csrf
                                  <div class="form-group row mb-3">
                                      <div class="offset-1 col-4"><label class="control-label mb-1">Name</label>
                                          <input id="cc-pament" name="userName" type="text" class="form-control"
                                              aria-required="true" aria-invalid="false" placeholder="Your name..."
                                              value="{{ old('userName', Auth::user()->name) }}">

                                      </div>
                                      <div class=" offset-2 col-4"><label class="control-label mb-1">Email</label>
                                          <input id="cc-pament" name="userEmail" type="text"
                                              class="form-control @error('userEmail') is-invalid @enderror"
                                              aria-required="true" aria-invalid="false"
                                              value="{{ old('userEmail', Auth::user()->email) }}"
                                              placeholder="123@email.com...">
                                          @error('userEmail')
                                              <span class="invalid-feedback">{{ $message }}</span>
                                          @enderror
                                      </div>
                                      <div class="col-10 offset-1 mt-4"><label class="control-label mb-1">Subject</label>
                                          <input id="cc-pament" name="userSubject" type="text"
                                              class="form-control @error('userSubject') is-invalid @enderror"
                                              aria-required="true" aria-invalid="false" placeholder="Subjects..."
                                              value="{{ old('userSubject') }}">
                                          @error('userSubject')
                                              <span class="invalid-feedback">{{ $message }}</span>
                                          @enderror
                                      </div>

                                      <div class="col-10 offset-1 mt-4">
                                          <textarea name="userMessage" id="" cols="30" rows="10"
                                              class="form-control-plaintext border @error('userMessage') is-invalid @enderror"
                                              placeholder="Enter your message here"></textarea>
                                          @error('userMessage')
                                              <span class="invalid-feedback">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div>
                                      <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                          <span id="payment-button-amount">Send</span>
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
