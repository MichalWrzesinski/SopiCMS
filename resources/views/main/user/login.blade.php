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

                    <form method="post" action="{{ route('user.login.send') }}">
                        @csrf

                        <label>
                            Adres e-mail
                            <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('login')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Hasło
                            <input type="password" name="password" required="required" class="@error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Zaloguj się" class="btn btn-primary">
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
