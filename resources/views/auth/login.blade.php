@extends('layouts.unauth-app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-10" style="background-color: #fff;">
        <div class="col-md-6 pb-5" style="height: auto;">
            <div class="login-logo mt-5"> 
                <img class="align-content" src="images/FDAlogo.png" alt="">
            </div>
            <div>
                <div class="card-header text-left mb-0" style="border:1px solid #fff;background-color: transparent;">
                  <h1 style="color: #185770;font-weight: bolder;">
                    <b>{{ __('OSMS') }}</b>
                  </h1>
                  <p style="color: #666;font-size: 9px;">Online Shop Management System</p>
                </div>

                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="login_id" class="col-md-12 col-form-label text-md-left">{{ __('Login ID') }}</label>

                            <div class="col-md-12">
                                <input id="login_id" type="text" class="form-control @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}" required autocomplete="login_id" autofocus>
                                @error('login_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>               
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-secondary btn-flat m-b-30 mt-3">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
