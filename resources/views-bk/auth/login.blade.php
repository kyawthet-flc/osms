@extends('layouts.unauth-app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-10" style="background-color: #fff;">
        <div class="col-md-8" style="background-color: #fff;">
            <div class="login-logo mt-5"> 
                <img class="align-content" src="images/FDAlogo.png" alt="">
            </div>
            <div class="card" style="background-color: #fff;">
                <div class="card-header text-center"><h3>{{ __('K&K Online Shop Manager') }}</h3></div>

                <div class="card-body" style="background-color: #fff;">
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
                                <button type="submit" class="btn btn-success btn-flat m-b-30 mt-3">
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
