@extends('layouts.guest')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="mb-4 text-sm text-white">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
        </div>


    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap py-5">
                <div class="img d-flex align-items-center justify-content-center">
                    {{-- style="background-image: url({{ asset('img/bg-1.jpeg') }});"> --}}

                    <img src="{{ asset('/favicon.ico') }}" width="35" height="35" alt="">
                </div>


                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4 form-group">
                        <x-jet-button>
                            {{ __('Email Password Reset Link') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
