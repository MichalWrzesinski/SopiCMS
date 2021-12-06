@extends('admin.layouts.layout')

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

                            <form method="post" action="{{ route('admin.settings.seo.send') }}">
                                @csrf
                                <label>
                                    Nazwa
                                    <input type="text" name="name" value="{{ old('name', $form['name']) }}" required="required" class="@error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    Tytuł
                                    <input type="text" name="title" value="{{ old('title', $form['title']) }}" required="required" placeholder="Meta / title" class="@error('title') is-invalid @enderror">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    Opis
                                    <input type="text" name="description" value="{{ old('description', $form['description']) }}" placeholder="Meta / description" class="@error('description') is-invalid @enderror">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    Słowa kluczowe
                                    <input type="text" name="keywords" value="{{ old('keywords', $form['keywords']) }}" placeholder="Meta / keywords" class="@error('keywords') is-invalid @enderror">
                                    @error('keywords')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="hidden" name="index" value="">
                                <label>
                                    <input type="checkbox" name="index" value="all"@if(old('index', $form['index']) == 'all') checked="checked"@endif class="@error('index') is-invalid @enderror">
                                    Indeksuj w przeglądarkach
                                    @error('index')
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

            </div>
        </div>
    </div>
@endsection
