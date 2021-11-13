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

                <form method="post" action="{{ route('admin.settings.ads.send') }}">
                    @csrf
                    <label>
                        Blok nr 1
                        <textarea name="block1" class="@error('block1') is-invalid @enderror">{{ old('block1', $form['block1']) }}</textarea>
                        @error('block1')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Blok nr 2
                        <textarea name="block2" class="@error('block2') is-invalid @enderror">{{ old('block2', $form['block2']) }}</textarea>
                        @error('block2')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Blok nr 3
                        <textarea name="block3" class="@error('block3') is-invalid @enderror">{{ old('block3', $form['block3']) }}</textarea>
                        @error('block3')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Blok nr 4
                        <textarea name="block4" class="@error('block4') is-invalid @enderror">{{ old('block4', $form['block4']) }}</textarea>
                        @error('block4')
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
