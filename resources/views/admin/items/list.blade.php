@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
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

                            @if($list->isNotEmpty())
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tytuł</th>
                                        <th>Status</th>
                                        <th>Promowane</th>
                                        <th>Opcje</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td><a href="{{ route('item.show', ['id' => $item['id'], 'url' => Str::Slug($item['title'])]) }}" target="_blank">{{ $item['title'] }}</a></td>
                                            <td>{{ config('sopicms.item.status.'.$item['status']) }}</td>
                                            <td>@if($item['premium'] > Carbon\Carbon::now()) {{ config('sopicms.item.premium.1') }} @else {{ config('sopicms.item.premium.0') }} @endif</td>
                                            <td><a href="{{ route('admin.items.edit', ['id' => $item['id']]) }}">Zarządzaj</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $list->links() }}
                            @else
                                <p>Niczego nie znaleziono</p>
                            @endif
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-2">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                            Dodaj ogłoszenie
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.items.list.send') }}">
                                @csrf
                                <label>
                                    Słowo kluczowe
                                    <input type="text" name="search" required="required" value="{{ old('search') }}">
                                    @error('search')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    <input type="checkbox" name="id" value="1" checked="checked">
                                    Szukaj w ID
                                </label>
                                <label>
                                    <input type="checkbox" name="title" value="1" checked="checked">
                                    Szukaj w tytułach
                                </label>
                                <label>
                                    <input type="checkbox" name="content" value="1" checked="checked">
                                    Szukaj w treści
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="Szukaj" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
