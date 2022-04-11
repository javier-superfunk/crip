@extends('layouts.auth')

@section('content')
    <div class="col-lg-5">
        <!-- Basic login form-->
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header justify-content-center"><h3 class="fw-light my-4">{{__('Two factor Challenge')}}</h3></div>
            <div class="card-body">
                <!-- Login form-->
                <form method="POST" action="{{ route('two-factor.login') }}">
                    
                    @csrf

                    <!-- Form Group (password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="code">{{ __('Authentication code') }}</label>
                        <input  id="code" 
                                type="password"
                                class="form-control @error('code') is-invalid @enderror" 
                                name="code"
                                placeholder="{{__('Enter Authentication Code')}}" />

                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">Ó</div>

                    <!-- Form Group (password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="recovery_code">{{ __('Recovery Code') }}</label>
                        <input  id="recovery_code" 
                                type="password"
                                class="form-control @error('recovery_code') is-invalid @enderror" 
                                name="recovery_code"
                                placeholder="{{__('Enter Recovery Code')}}" />

                        @error('recovery_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <!-- Form Group (login box)-->
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-primary"> {{ __('Submit') }} </button>                        
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <div class="small">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
@endsection