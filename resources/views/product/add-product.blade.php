@extends('layouts.layout');
@section('styles')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@powerGridStyles
@endsection

@section('content')

<livewire:products-table/>

@endsection

@section('scripts')
@livewireScripts
@powerGridScripts
@endsection
