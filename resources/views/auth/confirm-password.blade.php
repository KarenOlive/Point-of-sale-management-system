@extends('layouts.guest')
@section('yield')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap py-5">
                <div class="img d-flex align-items-center justify-content-center">
                    {{-- style="background-image: url(images/bg.jpg);"> --}}
                    <img src="{{ asset('/favicon.ico') }}" width="35" height="35" alt="">
                </div>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="form-group">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" autofocus />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Confirm') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



