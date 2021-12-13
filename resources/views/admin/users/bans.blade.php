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

                            @if($list->isNotEmpty())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('bans.field.id') }}</th>
                                            <th>{{ __('bans.field.ip') }}</th>
                                            <th>{{ __('bans.field.date') }}</th>
                                            <th>{{ __('layout.field.options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list as $ban)
                                            <tr>
                                                <td>{{ $ban['id'] }}</td>
                                                <td>{{ $ban['ip'] }}</td>
                                                <td>{{ $ban['created_at'] }}</td>
                                                <td>
                                                    <form method="post" action="{{ route('admin.users.bans.delete.send', ['id' => $ban['id']]) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="submit" value="{{ __('bans.button.delete') }}" class="btn btn-link">
                                                    </form>
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
                            {{ __('bans.header.add') }}
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.users.bans.add.send') }}">
                                @csrf
                                <label>
                                    {{ __('bans.field.ip') }}
                                    <input type="text" name="ip" required="required" class="@error('ip') is-invalid @enderror">
                                    @error('ip')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
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
                            {{ __('bans.header.search') }}
                        </button>
                    </h2>
                    <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.users.bans.send') }}">
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
                                    <input type="checkbox" name="ip" value="1" checked="checked">
                                    {{ __('layout.field.inIP') }}
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
