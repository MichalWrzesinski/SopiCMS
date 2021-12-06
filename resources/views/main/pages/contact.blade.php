@extends('main.layouts.layout')

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
                <section class="p-4 mb-4">
                    <h1>{{ $title }}</h1>
                    <ul class="list">
                        @if(!empty($phone))<li>Telefon: {{ $phone }}</li>@endif
                        @if(!empty($email))<li>E-mail: <a href="mailto:{{ $email }}">{{ $email }}</a></li>@endif
                    </ul>
                </section>
                <section class="p-4 mb-4">
                    <h2>Formularz kontaktowy</h2>
                    @include('tools.alert')

                    <form method="post" action="{{ route('contact.send') }}">
                        @csrf
                        <label>
                            Treść wiadomości
                            <textarea name="content" required="required" class="@error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="row">
                            <div class="col-xl-6 col-sm-12">
                                <label>
                                    Twoje imię i nazwisko
                                    <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-xl-6 col-sm-12">
                                <label>
                                    Twój adres e-mail
                                    <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">>{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input type="submit" value="Wyślij" class="btn btn-primary">
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
