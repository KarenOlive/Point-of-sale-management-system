@extends('layouts.guest')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section text-white">Sign up</h2>
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
                <p class="text-center">Create Your Account</p>
                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="login-form">
                    @csrf
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span>
                        </div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa fa-envelope"></span></div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-phone"></span>
                        </div>
                        <x-jet-label for="phonenumber" value="{{ __('Phonenumber') }}" />
                        <x-jet-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber"
                            :value="old('phonenumber')" autofocus autocomplete="phonenumber" />
                    </div>
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa fa-address-card"></span>
                        </div>
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"
                            :value="old('address')" autofocus autocomplete="address" />
                    </div>
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span>
                        </div>
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span>
                        </div>
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-white-50 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
