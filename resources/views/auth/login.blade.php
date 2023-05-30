@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="color: black; font-family:'Poppins', sans-serif;">
                <div class="card-header" style="font-size: 30px; font-weight: 600">{{ __('LOG IN') }}</div>

                <div class="card-body" style="font-weight: 550; font-size: 14px;">
                    <form method="POST" action="{{ route('authenticate') }}" class="mt-5 mb-5">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('EMAIL ADDRESS') }}</label> -->

                            <center><div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="CLSU email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div></center>
                        </div>

                        <div class="form-group row mt-2">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('PASSWORD') }}</label> -->

                            <center><div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div></center>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-4 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('SIGN IN') }}
                                </button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-8 offset-md-2">
                        @if (Route::has('password.request'))
                                  <a class="btn btn-link" style="text-decoration: none; color: gray; font-size:13px;" href="{{ route('password.request') }}">
                                      {{ __('Forgot password?') }}
                                   </a>
                                @endif
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
