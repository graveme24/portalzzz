@extends('layouts.login_master')

@section('content')
<div class="content-wrapper">
<div class="container content d-flex justify-content-center align-items-center">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class=""><img src="{{URL::asset('/image/HWA.jpg')}}" width="100px" height="100px"></i>
                    <h5 class="mb-0">Login to your account</h5>
                    <span class="d-block text-muted">Your credentials</span>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                    </div>
                @endif
              <p class="text-muted">Sign In to your account</p>
              <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="icon-user"></i>
                      </span>
                  </div>
                  <input type="text" class="form-control" name="identity" value="{{ old('identity') }}" placeholder="Login ID or Email">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>
                  <div class="input-group mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="icon-lock"></i>
                      </span>
                  </div>
                  <input required name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                        <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                    </div>
                  </form>
                  <div class="col-6 text-right">
                    <a href="{{ route('password.request') }}" class="ml-auto">Forgot password?</a>
                  </div>
                  </div>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                {{-- <h2>Sign up</h2> --}}
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="form-group">
                    <a href="{{ route('guest') }}" class="btn btn-light btn-block"><i class="icon-home"></i> Back to Home</a>
                </div>
                {{-- @if (Route::has('password.request'))
                  <a href="{{ route('register') }}" class="btn btn-primary active mt-3" type="button">{{ __('Register') }}</a>
                @endif --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
    {{-- <div class="page-content login-cover">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login card -->
                <form class="login-form " method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class=""><img src="{{URL::asset('/image/HWA.jpg')}}" width="100px" height="100px"></i>
                                <h5 class="mb-0">Login to your account</h5>
                                <span class="d-block text-muted">Your credentials</span>
                            </div>

                                @if ($errors->any())
                                <div class="alert alert-danger alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                                </div>
                                @endif


                            <div class="form-group ">
                                <input type="text" class="form-control" name="identity" value="{{ old('identity') }}" placeholder="Login ID or Email">
                            </div>

                            <div class="form-group ">
                                <input required name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">

                            </div>

                            <div class="form-group d-flex align-items-center">
                                <div class="form-check mb-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }} data-fouc>
                                        Remember
                                    </label>
                                </div>

                                <a href="{{ route('password.request') }}" class="ml-auto">Forgot password?</a>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                            </div>




                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div> --}}
    @endsection

