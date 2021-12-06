@extends('auth.layout')

@section('content')
    <section class="p-5 text-center">
        <h1 class="mb-5">{{ $title }}</h1>
        @include('main.layouts.alert')
        <a href="{{ route('home') }}" class="position-absolute top-0 end-0 p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </a>
        @if($form == 1)
            <form method="post" action="{{ route('user.password.send') }}">
                @csrf
                <label>
                    <input type="email" name="email" required="required" placeholder="Adres e-mail" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('login')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </label>
                <div class="mt-4">
                    <input type="submit" value="Następny krok" class="btn btn-primary">
                </div>
                <div class="mt-4 small">
                    <a href="{{ route('user.login') }}" class="text-decoration-underline">Zaloguj się</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('user.register') }}" class="text-decoration-underline">Załóż konto</a>
                </div>
            </form>
        @endif
        @if($form == 2)
            <form method="post" action="{{ route('user.password.new.send', ['id' => $id, 'hash' => $hash]) }}">
                @csrf
                <label>
                    <input type="password" name="password" required="required" placeholder="Hasło" class="@error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </label>
                <label>
                    <input type="password" name="password_confirmation" required="required" placeholder="Powtórz hasło" class="@error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </label>
                <div class="mt-4">
                    <input type="submit" value="Zmień hasło" class="btn btn-primary">
                </div>
            </form>
        @endif
    </section>
@endsection
