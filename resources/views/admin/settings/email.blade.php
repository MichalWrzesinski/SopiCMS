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

                            <form method="post" action="{{ route('admin.settings.email.send') }}">
                                @csrf
                                <label>
                                    {{ __('settings.field.email') }}
                                    <input type="email" name="to" value="{{ old('to', $form['to']) }}" required="required" class="@error('to') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('settings.field.emailReply') }}
                                    <input type="email" name="reply" value="{{ old('reply', $form['reply']) }}" required="required" class="@error('reply') is-invalid @enderror">
                                    @error('reply')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('settings.field.sender') }}
                                    <input type="text" name="sender" value="{{ old('sender', $form['sender']) }}" required="required" class="@error('sender') is-invalid @enderror">
                                    @error('sender')
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
