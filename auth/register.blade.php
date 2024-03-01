@extends('layout.normal')

@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <div class="brand-logo">
              <img src="../../assets/images/logo.svg">
            </div>
            <h4>New here?</h4>
            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
            <form class="pt-3" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group col-md-12">
                    <label for="exampleInputName1">First Name</label>
                    <input type="text"  value="{{ old('user_first_name') }}" name="user_first_name" class="form-control" id="exampleInputName1" placeholder="First Name">
                    @if ($errors->has('user_first_name'))
                    <div class="alert alert-danger">{{ $errors->first('user_first_name') }}</div>
                @endif
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputName1">Last Name</label>
                    <input type="text"  value="{{ old('user_last_name') }}" name="user_last_name" class="form-control" id="exampleInputName2" placeholder="Last Name">
                    @if ($errors->has('user_last_name'))
                    <div class="alert alert-danger">{{ $errors->first('user_last_name') }}</div>
                    @endif
                </div>


              <div class="form-group col-md-12">
                <label for="Adress">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="Email"  value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>


              <div class="form-group col-md-12">
                <label for="Adress">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>


              <div class="form-group col-md-12">
                <label for="Phone">Phone</label>
                <input type="text" name="user_phone"  value="{{ old('user_phone') }}" class="form-control" id="exampleInputphone5" placeholder="Phone">
                @if ($errors->has('user_phone'))
                <div class="alert alert-danger">{{ $errors->first('user_phone') }}</div>
            @endif
              </div>
              <div class="form-group col-md-12">
                <label for="Adress">Adress</label>
                <input type="text" name="user_adress"  value="{{ old('user_adress') }}" class="form-control" id="exampleInputadress6" placeholder="Adress">
                @if ($errors->has('user_adress'))
                <div class="alert alert-danger">{{ $errors->first('user_adress') }}</div>
            @endif
            </div>

              <div class="mt-3">
                <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN UP</button>
              </div>
              <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="{{route('login')}}" class="text-primary">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>

    <!-- content-wrapper ends -->
  </div>
@endsection


