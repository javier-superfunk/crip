@extends('layouts.auth')

@section('content')
    <div class="col-lg-5">
        <!-- Basic login form-->
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header justify-content-center"><h3 class="fw-light my-4">{{__('Login')}}</h3></div>
            <div class="card-body">
                <!-- Login form-->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">{{ __('Email Address') }}</label>
                        <input id="email" 
                                type="email"
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email"
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus 
                                placeholder="user@mail.net">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <!-- Form Group (password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputPassword">{{ __('Password') }}</label>
                        <input  id="password" 
                                type="password"
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="{{__('Enter password')}}" />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <!-- Form Group (remember password checkbox)-->
                    <div class="mb-3">
                        <div class="form-check">
                            <input  class="form-check-input" 
                                    type="checkbox" 
                                    name="remember"
                                    id="remember" {{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label" for="rememberPasswordCheck">{{ __('Remember Me') }}</label>
                        </div>
                    </div>
                    <!-- Form Group (login box)-->
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary"> {{ __('Login') }} </button>                        
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <div class="small">
                    @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">{{__('Need an account? Sign up!')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection