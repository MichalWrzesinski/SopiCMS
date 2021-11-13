@extends('main.layouts.default')

@section('content')

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @include('main.layouts.left')
            </div>
            <div class="col-xl-9 col-sm-12">
                <section class="p-4">
                    <h1>{{ $title }}</h1>

                    @include('main.layouts.alert')

                    <form method="post" action="{{ route('user.register.send') }}">
                        @csrf

                        <label>
                            Nazwa użytkownika
                            <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Adres e-mail
                            <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('login')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="row">
                            <div class="col">
                                <label>
                                    Hasło
                                    <input type="password" name="password" required="required" class="@error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    Powtórz hasło
                                    <input type="password" name="password_confirmation" required="required" class="@error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <label>
                            <input type="checkbox" name="regulations" required="required" class="@error('regulations') is-invalid @enderror" value="1"{{ old('regulations') == 'on' ? ' checked="checked"' : '' }}>
                            Oświadczam, iż zapozałem się z <a href="{{ route('page.show', ['url' => config('sopicms.url.regulations')]) }}" target="_blank">Regulaminem</a> i <a href="{{ route('page.show', ['url' => config('sopicms.url.privacyPolicy')]) }}" target="_blank">Polityką prywatności</a> serwisu {{ config('sopicms.siteName') }} i je akceptuję, a także wyrażam zgodę na przetwarzanie moich danych osobowych do celów świadczenia usług w ramach portalu internetowego.
                            @error('regulations')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Zarejestruj się" class="btn btn-primary">
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

@endsection
