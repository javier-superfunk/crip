@extends('layouts.auth')

@section('content')
<div class="col-lg-5">
    <!-- Basic login form-->
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header justify-content-center"><h3 class="fw-light my-4">{{ __('Verify Email Address') }}</h3></div>
        <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
            @endif
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                        class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
            </form>
            
        </div>
    </div>
</div>
@endsection