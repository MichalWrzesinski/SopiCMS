@extends('admin.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('layout.header.admin') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.list') }}">{{ __('users.header.title') }}</a></li>
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

                            <form method="post" action="{{ route('admin.users.edit.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    {{ __('users.field.name') }}
                                    <input type="text" name="name" required="required" value="{{ old('name', $user->name) }}" class="@error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('users.field.email') }}
                                    <input type="text" name="email" required="required" value="{{ old('email', $user->email) }}" class="@error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            {{ __('users.field.status') }}
                                            <select name="status">
                                                @foreach(config('sopicms.user.status') as $key => $status)
                                                    <option value="{{ $key }}"@if($user->status == $key) selected="selected"@endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label>
                                            {{ __('users.field.type') }}
                                            <select name="type">
                                                @foreach(config('sopicms.user.type') as $key => $type)
                                                    <option value="{{ $key }}"@if($user->type == $key) selected="selected"@endif>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('layout.button.save') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-2">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                            {{ __('users.header.password') }}
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.users.password.send', ['id' => $id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            {{ __('users.field.password') }}
                                            <input type="password" name="password" required="required" class="@error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label>
                                            {{ __('users.field.passwordConfirmation') }}
                                            <input type="password" name="password_confirmation" required="required" class="@error('password_confirmation') is-invalid @enderror">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('layout.button.save') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-3">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-3-container" aria-expanded="false" aria-controls="section-3-container">
                            {{ __('users.header.avatar') }}
                        </button>
                    </h2>
                    <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            @if($user->avatar)
                                <form method="post" action="{{ route('admin.users.avatar.delete.send', ['id' => $id]) }}">
                                    @csrf
                                    @method('delete')
                                    <img src="{{ route('image.thumbnail', ['path' => $user->avatar, 'width' => 150, 'height' => 150]) }}" alt="Avatar" class="avatar me-4">
                                    <button type="submit" class="btn btn-primary">{{ __('users.button.avatar') }}</button>
                                </form>
                                <h2 class="mt-5">{{ __('users.header.avatarNew') }}</h2>
                            @endif
                            <form method="post" action="{{ route('admin.users.avatar.add.send', ['id' => $id]) }}" enctype="multipart/form-data">
                                @csrf
                                <label>
                                    {{ __('gallery.field.file') }}
                                    <input type="file" name="image" required="required" class="@error('image') is-invalid @enderror">
                                    @error('image')
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

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-4">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-4-container" aria-expanded="false" aria-controls="section-4-container">
                            {{ __('users.header.delete') }}
                        </button>
                    </h2>
                    <div id="section-4-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            @if(Auth::user()->id == $id)
                                <p>{{ __('users.alert.notDelete') }}</p>
                            @else
                                <form method="post" action="{{ route('admin.users.delete.send', ['id' => $id]) }}">
                                    @method('delete')
                                    @csrf
                                    <label>
                                        <input type="checkbox" name="delete" value="1" required="required">
                                        {{ __('users.field.delete') }}
                                    </label>
                                    <div class="mt-4">
                                        <input type="submit" value="{{ __('layout.button.delete') }}" class="btn btn-primary">
                                    </div>
                                </form>
                            @endif
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
