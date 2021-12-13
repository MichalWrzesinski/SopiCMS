@extends('auth.layout')

@section('content')
    <section class="p-5 text-center">
        <h1 class="mb-5">{{ $title }}</h1>
        @include('tools.alert')
        <a href="{{ route('home') }}" class="position-absolute top-0 end-0 p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </a>
        <p>{{ __('auth.alert.logout') }}</p>
        <div class="mt-4 small">
            <a href="{{ route('home') }}" class="text-decoration-underline">{{ __('layout.header.home') }}</a>
            <span class="mx-2">/</span>
            <a href="{{ route('auth.login') }}" class="text-decoration-underline">{{ __('auth.header.login2') }}</a>
        </div>
    </section>
@endsection
