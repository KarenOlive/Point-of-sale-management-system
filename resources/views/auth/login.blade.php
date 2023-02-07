@extends('layouts.guest')
@section('styles')
   
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section text-white">Login</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap py-5">
                <div class="img d-flex align-items-center justify-content-center"
                    style="background-image: url({{ asset('img/bg-1.jpeg') }});">

                    {{-- <img src="{{ asset('/favicon.ico') }}" width="35" height="35" alt=""> --}}
                </div>
                <h2 class="text-center mb-0 font-weight-bold">Welcome</h2>
                <p class="text-center">Sign in by entering the information below</p>
                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa fa-envelope"></span></div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span>
                        </div>
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-100 text-md-right">

                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-white-50 hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif



                        </div>
                    </div>
                    <div class="form-group block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-white-50">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <x-jet-button class="ml-4">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </form>
                <div class="w-100 text-center mt-4 text">


                    <a class="underline text-sm text-white-50 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('Don\'t have an account?') }}
                    </a>



                </div>
            </div>
        </div>
    </div>
@endsection
