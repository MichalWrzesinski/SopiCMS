@extends('main.layouts.layout')

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
                <div class="accordion accordion-flush" id="section-list">

                    <div class="accordion-item mb-4">
                        <h1 class="accordion-header" id="section-1">
                            <button class="accordion-button text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-1-container" aria-expanded="false" aria-controls="section-1-container">
                                {{ $title }}
                            </button>
                        </h1>
                        <div id="section-1-container" class="accordion-collapse collapse show" aria-labelledby="section-1">
                            <section class="accordion-body p-4">
                                @include('main.layouts.alert')

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
                        </div>
                    </div>

                    <div class="accordion-item mb-4">
                        <h2 class="accordion-header" id="section-2">
                            <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                                Hasło
                            </button>
                        </h2>
                        <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                            <section class="accordion-body p-4">
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
                        </div>
                    </div>

                    <div class="accordion-item mb-4">
                        <h2 class="accordion-header" id="section-3">
                            <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-3-container" aria-expanded="false" aria-controls="section-3-container">
                                Avatar
                            </button>
                        </h2>
                        <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                            <section class="accordion-body p-4">
                                @if($user->avatar)
                                    <form method="post" action="{{ route('user.manage.avatar.delete') }}">
                                        @csrf
                                        @method('delete')
                                        <img src="{{ route('image.thumbnail', ['path' => $user->avatar, 'width' => 150, 'height' => 150]) }}" alt="Avatar" class="avatar me-4">
                                        <button type="submit" class="btn btn-primary">Usuń avatar</button>
                                    </form>
                                    <h2 class="mt-5">Aktualizuj avatar</h2>
                                @endif
                                <form method="post" action="{{ route('user.manage.avatar.send') }}" enctype="multipart/form-data">
                                    @csrf
                                    <label>
                                        Plik graficzny
                                        <input type="file" name="image" required="required" class="@error('image') is-invalid @enderror">
                                        @error('image')
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
            </div>
        </div>
    </div>

@endsection
