@extends('layouts.auth')

@section('content')
    <div class="col-lg-5">
        <!-- Basic login form-->
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header justify-content-center"><h3 class="fw-light my-4">{{ __('Reset Password') }}</h3></div>
            <div class="card-body">
                <!-- Login form-->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ request()->route('token')}}">

                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">{{ __('Email Address') }}</label>
                        <input  id="email" 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ $email ?? old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus />

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
                                autocomplete="new-password" />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="small mb-1" for="inputPassword">{{ __('Confirm Password') }}</label>
                        <input  id="password_confirmation" 
                                type="password" 
                                class="form-control" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password" />
                    </div>
                    
                    <!-- Form Group (login box)-->
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>                
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection