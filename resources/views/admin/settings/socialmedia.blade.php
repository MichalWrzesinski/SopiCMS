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

                <form method="post" action="{{ route('admin.settings.socialmedia.send') }}">
                    @csrf
                    <label>
                        Facebook
                        <input type="text" name="facebook" value="{{ old('facebook', $form['facebook']) }}" required="required" class="@error('facebook') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Instagram
                        <input type="text" name="instagram" value="{{ old('instagram', $form['instagram']) }}" required="required" class="@error('instagram') is-invalid @enderror">
                        @error('instagram')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        YouTube
                        <input type="text" name="youtube" value="{{ old('youtube', $form['youtube']) }}" required="required" class="@error('youtube') is-invalid @enderror">
                        @error('youtube')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Twitter
                        <input type="text" name="twitter" value="{{ old('twitter', $form['twitter']) }}" required="required" class="@error('twitter') is-invalid @enderror">
                        @error('twitter')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        LinkedIn
                        <input type="text" name="linkedin" value="{{ old('linkedin', $form['linkedin']) }}" required="required" class="@error('linkedin') is-invalid @enderror">
                        @error('linkedin')
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
