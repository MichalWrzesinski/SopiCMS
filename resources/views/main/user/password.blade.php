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

                    @if($form == 1)
                        <form method="post" action="{{ route('user.password.send') }}">
                            @csrf
                            <label>
                                Adres e-mail
                                <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('login')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </label>
                            <div class="mt-4">
                                <input type="submit" value="Przypomnij hasło" class="btn btn-primary">
                            </div>
                        </form>
                    @endif

                    @if($form == 2)
                        <form method="post" action="{{ route('user.password.new.send', ['id' => $id, 'hash' => $hash]) }}">
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
                                <input type="submit" value="Zmień hasło" class="btn btn-primary">
                            </div>
                        </form>
                    @endif

                </section>
            </div>
        </div>
    </div>

@endsection
