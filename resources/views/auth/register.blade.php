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
        <form method="post" action="{{ route('user.register.send') }}">
            @csrf
            <label>
                <input type="text" name="name" required="required" placeholder="Nazwa użytkownika" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <label>
                <input type="email" name="email" required="required" placeholder="Adres e-mail" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('login')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
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
            <label class="text-start small mt-4">
                <input type="checkbox" name="regulations" required="required" class="@error('regulations') is-invalid @enderror" value="1"{{ old('regulations') == 'on' ? ' checked="checked"' : '' }}>
                Oświadczam, iż zapozałem się z <a href="{{ route('page.show', ['url' => config('sopicms.url.regulations')]) }}" target="_blank">Regulaminem</a> i <a href="{{ route('page.show', ['url' => config('sopicms.url.privacyPolicy')]) }}" target="_blank">Polityką prywatności</a> serwisu {{ config('sopicms.siteName') }} i je akceptuję, a także wyrażam zgodę na przetwarzanie moich danych osobowych do celów świadczenia usług w ramach portalu internetowego.
                @error('regulations')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <div class="mt-4">
                <input type="submit" value="Zarejestruj się" class="btn btn-primary">
            </div>
            <div class="mt-4 small">
                <a href="{{ route('user.login') }}" class="text-decoration-underline">Zaloguj się</a>
                <span class="mx-2">/</span>
                <a href="{{ route('user.password') }}" class="text-decoration-underline">Zapomniałeś hasła?</a>
            </div>
        </form>
    </section>

@endsection
