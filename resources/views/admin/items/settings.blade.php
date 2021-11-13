@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.items.list') }}">{{ config('sopicms.item.name') }}</a></li>
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

                <form method="post" action="{{ route('admin.items.settings.send') }}">
                    @csrf
                    <label>
                        Liczba dni publikacji
                        <input type="text" name="validity" value="{{ old('validity', $form['validity']) }}" required="required" class="@error('validity') is-invalid @enderror">
                        @error('validity')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Liczba dni promowania
                        <input type="text" name="premium-validity" value="{{ old('premium-validity', $form['premium-validity']) }}" required="required" class="@error('premium-validity') is-invalid @enderror">
                        @error('premium-validity')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Cena promowania
                        <input type="text" name="premium-price" value="{{ old('premium-price', $form['premium-price']) }}" required="required" class="@error('premium-price') is-invalid @enderror">
                        @error('premium-price')
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
