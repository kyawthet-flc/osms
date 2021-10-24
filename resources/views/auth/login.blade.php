@extends('layouts.unauth-app')
@section('title') Login @endsection
@section('content')
<div class="container">

    @if(session()->has('success'))
        <div class="row justify-content-center mt-5 mb-0">
            <div class="col-md-5">
                <h5 class="mt-1 mb-1 text-left text-success">
                Successful Registration.<br/> You can login now.
            </h5>
            </div>
        </div>
    @endif 
    <div class="row justify-content-center mt-5">
        <div class="col-md-5 pt-1 pb-5" style="height: auto;">
            {{--<div class="login-logo mt-5"> 
                <img class="align-content" src="images/osms-small-icon-ts.png.png" alt="">
            </div>--}}
            <div>
                <div class="card-header text-left mb-1" style="border:1px solid #fff;background-color: transparent;">
                  <h1 style="color: #4a4a4a;font-weight: bolder;">
                    {{ __('OSMS') }}
                  </h1>
                  <p style="color: #4a4a4a;font-size: 9px;">ONLINE SHOP MANAGEMENT SYSTEM</p>
                </div>

                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="login_id" class="col-md-12 col-form-label text-md-left"><b>{{ __('LOGIN ID') }}</b></label>

                            <div class="col-md-12">
                                <input id="login_id" autocomplete="new-password" type="text" class="form-control @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}" autofocus>
                                @error('login_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left"><b>{{ __('PASSWORD') }}</b></label>
                            <div class="col-md-12">
                                <input id="password" autocomplete="new-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>               
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
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