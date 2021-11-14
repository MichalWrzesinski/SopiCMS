@extends('main.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                <section class="p-4 mb-4">
                    <h4>Filtruj</h4>
                    <form method="post" action="{{ route('item.search.send') }}">
                        @csrf
                        <label>
                            Słowo kluczowe
                            <input type="text" name="query" value="{{ $search['query'] ?? '' }}">
                            @error('search')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Kategoria
                            <select name="category" class="@error('category') is-invalid @enderror">
                                <option value="">Wybierz</option>
                                @foreach($category[0] ?? [] as $cat)
                                    @if(isset($category[$cat['id']]) && is_array($category[$cat['id']]))
                                        <option value="{{ $cat['id'] }}"@if(isset($search['category']) && $search['category'] == $cat['id']) selected="selected"@endif>{{ $cat['name'] }}</option>
                                        @foreach($category[$cat['id']] as $sub)
                                            <option value="{{ $sub['id'] }}"@if(isset($search['category']) && $search['category'] == $sub['id']) selected="selected"@endif>-> {{ $sub['name'] }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ $cat['id'] }}"@if(isset($search['category']) && $search['category'] == $cat['id']) selected="selected"@endif>{{ $cat['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Region
                            <select name="region" class="@error('category') is-invalid @enderror">
                                <option value="">Wybierz</option>
                                @if(is_array(config('sopicms.region')))
                                    @foreach(config('sopicms.region') as $key => $name)
                                        <option value="{{ $key }}"@if(isset($search['region']) && $search['region'] == $key) selected="selected"@endif>{{ $name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('region')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Miejscowość
                            <input type="text" name="city" class="@error('city') is-invalid @enderror" value="{{ $search['city'] ?? '' }}">
                            @error('city')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="row">
                            <div class="col">
                                <label>
                                    Cena od
                                    <input type="text" name="price-from" class="@error('price-from') is-invalid @enderror" value="{{ $search['price-from'] ?? '' }}">
                                    @error('price-from')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    do
                                    <input type="text" name="price-to" class="@error('price-to') is-invalid @enderror" value="{{ $search['price-to'] ?? '' }}">
                                    @error('price-to')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="user" value="{{ $search['user'] ?? '' }}">
                        <div class="mt-4">
                            <input type="submit" value="Szukaj" class="btn btn-primary me-2">
                            <a href="{{ route('item.list') }}" class="btn btn-secondary">Wyczyść filtry</a>
                        </div>
                    </form>
                </section>
                @if(config('settings.ads.block3'))
                    <div id="block-3" class="mb-4">
                        {!! config('settings.ads.block3') !!}
                    </div>
                @endif
            </div>
            <div class="col-xl-9 col-sm-12">
                <section class="p-4 mb-4">
                    <h1>{{ $title }}</h1>
                    @if(count($list) == 0)
                        <p>Niczego nie znaleziono</p>
                    @endif
                </section>
                @if(count($list) > 0)
                    <div class="row">
                        @foreach($list as $item)
                            <div class="col-xl-4 mb-4">
                                @include('main.items.block', ['item' => $item, 'cover' => $gallery[$item->id]])
                            </div>
                        @endforeach
                    </div>
                @endif
                {{ $list->links() }}
            </div>
        </div>
    </div>
@endsection
