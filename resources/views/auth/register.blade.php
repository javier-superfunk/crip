@extends('layouts.auth')

@section('content')
<div class="col-lg-7">
    <!-- Basic registration form-->
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header justify-content-center"><h3 class="fw-light my-4">{{__('Create Account')}}</h3></div>
        <div class="card-body">
            <!-- Registration form-->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Form Row-->
                <div class="row gx-3">                    
                    <!-- Form Group (first name)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputFirstName">{{ __('Name') }}</label>
                        <input  type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="exampleInputname1" 
                                aria-describedby="nameHelp"
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autocomplete="name"
                                placeholder="Enter name"
                                autofocus />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>              
                </div>
                <!-- Form Group (email address)            -->
                <div class="mb-3">
                    <label class="small mb-1" for="inputEmailAddress">{{ __('Email Address') }}</label>
                    <input  type="email" 
                            class="form-control @error('email') is-invalid @enderror"  
                            id="exampleInputEmail1" 
                            aria-describedby="emailHelp" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autocomplete="email"
                            placeholder="Enter email address" />

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <!-- Form Row    -->
                <div class="row gx-3">
                    <div class="col-md-6">
                        <!-- Form Group (password)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPassword">{{ __('Password') }}</label>
                            <input  type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" 
                                    id="InputPassword" 
                                    required
                                    placeholder="{{__('Enter password')}}"
                                    autocomplete="new-password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Form Group (confirm password)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputConfirmPassword">{{ __('Confirm Password') }}</label>
                            <input  id="password-confirm" 
                                    type="password" 
                                    class="form-control" 
                                    name="password_confirmation" 
                                    required 
                                    placeholder="{{__('Confirm Password')}}"
                                    autocomplete="new-password" />                                
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Form Group (create account submit)-->
                <button type="submit" class="btn btn-primary btn-block">{{ __('Create Account') }}</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="small"><a href="{{ route('login') }}">{{__('If you already have an account, go to login')}}</a></div>
        </div>
    </div>
</div>
@endsection