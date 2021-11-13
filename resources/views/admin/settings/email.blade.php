@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ustawienia</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div id="left" class="col-xl-3 col-sm-12">
            @include('admin.layouts.left')
        </div>
        <div id="right" class="col-xl-9 col-sm-12">
            <section class="p-4">
                <h1 class="mb-4">{{ $title }}</h1>
                @include('main.layouts.alert')

                <form method="post" action="{{ route('admin.settings.email.send') }}">
                    @csrf
                    <label>
                        Adres e-mail
                        <input type="email" name="to" value="{{ old('to', $form['to']) }}" required="required" class="@error('to') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Adres zwrotny e-mail
                        <input type="email" name="reply" value="{{ old('reply', $form['reply']) }}" required="required" class="@error('reply') is-invalid @enderror">
                        @error('reply')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Nadawca
                        <input type="text" name="sender" value="{{ old('sender', $form['sender']) }}" required="required" class="@error('sender') is-invalid @enderror">
                        @error('sender')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="mt-4">
                        <input type="submit" value="Zapisz" class="btn btn-primary">
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
