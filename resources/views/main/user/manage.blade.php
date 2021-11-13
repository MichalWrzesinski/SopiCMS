@extends('main.layouts.default')

@section('content')

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Twoje konto</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @include('main.layouts.left')
            </div>
            <div class="col-xl-9 col-sm-12">
                <section class="p-4 mb-4">
                    <h1>{{ $title }}</h1>
                    @include('main.layouts.alert')
                </section>
                <section class="p-4 mb-4">
                    <h2>Twoje dane</h2>
                    <form method="post" action="{{ route('user.manage.data.send') }}">
                        @csrf
                        <label>
                            Nazwa użytkownika
                            <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Adres e-mail
                            <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Zapisz zmiany" class="btn btn-primary">
                        </div>
                    </form>
                </section>
                <section class="p-4 mb-4">
                    <h2>Twoje hasło</h2>
                    <form method="post" action="{{ route('user.manage.password.send') }}">
                        @csrf
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
                        <div class="mt-4">
                            <input type="submit" value="Zapisz zmiany" class="btn btn-primary">
                        </div>
                    </form>
                </section>
                <section class="p-4 mb-4">
                    <h2>Avatar</h2>
                    @if($user->avatar)
                        <form method="post" action="{{ route('user.manage.avatar.delete') }}">
                            @csrf
                            <img src="{{ route('image.thumbnail', ['path' => $user->avatar, 'width' => 150, 'height' => 150]) }}" alt="Avatar" class="avatar me-4">
                            <button type="submit" class="btn btn-primary">Usuń avatar</button>
                        </form>
                        <h2 class="mt-5">Aktualizuj avatar</h2>
                    @endif
                    <form method="post" action="{{ route('user.manage.avatar.send') }}" enctype="multipart/form-data">
                        @csrf
                        <label>
                            Plik graficzny
                            <input type="file" name="avatar" required="required" class="@error('avatar') is-invalid @enderror">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Zapisz zmiany" class="btn btn-primary">
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

@endsection
