@extends('admin.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.title') }}</a></li>
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

                            @if($list->isNotEmpty())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{ __('users.field.id') }}
                                            </th>
                                            <th>
                                                {{ __('users.field.name') }}
                                            </th>
                                            <th>
                                                {{ __('users.field.email') }}
                                            </th>
                                            <th>
                                                {{ __('users.field.status') }}
                                            </th>
                                            <th>
                                                {{ __('users.field.type') }}
                                            </th>
                                            <th>
                                                {{ __('admin.options') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list as $user)
                                            <tr>
                                                <td>
                                                    {{ $user['id'] }}
                                                </td>
                                                <td>
                                                    {{ $user['name'] }}
                                                </td>
                                                <td>
                                                    {{ $user['email'] }}
                                                </td>
                                                <td>
                                                    {{ config('sopicms.user.status.'.$user['status']) }}
                                                </td>
                                                <td>
                                                    {{ config('sopicms.user.type.'.$user['type']) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', ['id' => $user['id']]) }}">
                                                        {{ __('admin.manage') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $list->appends(request()->input())->links() }}
                            @else
                                <p>{{ __('layout.alert.notFound') }}</p>
                            @endif
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-2">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                            {{ __('users.header.add') }}
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.users.add.send') }}">
                                @csrf
                                <label>
                                    {{ __('users.field.name') }}
                                    <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('users.field.email') }}
                                    <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
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
                                    <input type="submit" value="{{ __('layout.button.add') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-3">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-3-container" aria-expanded="false" aria-controls="section-3-container">
                            {{ __('users.header.search') }}
                        </button>
                    </h2>
                    <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.users.list.send') }}">
                                @csrf
                                <label>
                                    {{ __('layout.field.keyword') }}
                                    <input type="text" name="search" required="required" value="{{ old('search') }}">
                                    @error('search')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    <input type="checkbox" name="id" value="1" checked="checked">
                                    {{ __('layout.field.inId') }}
                                </label>
                                <label>
                                    <input type="checkbox" name="title" value="1" checked="checked">
                                    {{ __('layout.field.inName') }}
                                </label>
                                <label>
                                    <input type="checkbox" name="email" value="1" checked="checked">
                                    {{ __('layout.field.inEmail') }}
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('layout.button.search') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
