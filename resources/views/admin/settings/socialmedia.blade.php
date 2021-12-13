@extends('admin.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('layout.header.admin') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('settings.header.title') }}</a></li>
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
                            @include('tools.alert')

                            <form method="post" action="{{ route('admin.settings.socialmedia.send') }}">
                                @csrf
                                <label>
                                    {{ __('settings.field.facebook') }}
                                    <input type="text" name="facebook" value="{{ old('facebook', $form['facebook']) }}" required="required" class="@error('facebook') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('settings.field.instagram') }}
                                    <input type="text" name="instagram" value="{{ old('instagram', $form['instagram']) }}" required="required" class="@error('instagram') is-invalid @enderror">
                                    @error('instagram')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('settings.field.youtube') }}
                                    <input type="text" name="youtube" value="{{ old('youtube', $form['youtube']) }}" required="required" class="@error('youtube') is-invalid @enderror">
                                    @error('youtube')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('settings.field.twitter') }}
                                    <input type="text" name="twitter" value="{{ old('twitter', $form['twitter']) }}" required="required" class="@error('twitter') is-invalid @enderror">
                                    @error('twitter')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('settings.field.linkedin') }}
                                    <input type="text" name="linkedin" value="{{ old('linkedin', $form['linkedin']) }}" required="required" class="@error('linkedin') is-invalid @enderror">
                                    @error('linkedin')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('layout.button.save') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
