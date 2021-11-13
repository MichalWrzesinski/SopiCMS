@extends('main.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Twoje konto</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @include('main.layouts.left')
            </div>
            <div class="col-xl-9 col-sm-12">
                <section class="p-4 mb-4">
                    <h1>{{ $title }}</h1>
                    @include('main.layouts.alert')

                    <form method="post" action="{{ route('user.item.add.send') }}">
                        @csrf

                        <div class="row">
                            <div class="col-8">
                                <label>
                                    Tytuł
                                    <input type="text" name="title" required="required" class="@error('title') is-invalid @enderror" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-4">
                                <label>
                                    Cena
                                    <input type="text" name="price" required="required" class="@error('category') is-invalid @enderror" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>
                                    Kategoria
                                    <select name="category" required="required" class="@error('category') is-invalid @enderror">
                                        <option value="">Wybierz</option>
                                        @if(isset($list[0]) && is_array($list[0]))
                                            @foreach($list[0] as $cat)
                                                @if(isset($list[$cat['id']]) && is_array($list[$cat['id']]))
                                                    <optgroup label="{{ $cat['name'] }}">
                                                        @foreach($list[$cat['id']] as $sub)
                                                            <option value="{{ $sub['id'] }}"@if(old('category') == $sub['id']) selected="selected"@endif>{{ $sub['name'] }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option value="{{ $cat['id'] }}"@if(old('category') == $cat['id']) selected="selected"@endif>{{ $cat['name'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-4">
                                <label>
                                    Region
                                    <select name="region" required="required" class="@error('category') is-invalid @enderror">
                                        <option value="">Wybierz</option>
                                        @if(is_array(config('sopicms.region')))
                                            @foreach(config('sopicms.region') as $key => $name)
                                                <option value="{{ $key }}"@if(old('region') == $key) selected="selected"@endif>{{ $name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('region')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-4">
                                <label>
                                    Miejscowość
                                    <input type="text" name="city" required="required" class="@error('city') is-invalid @enderror" value="{{ old('city') }}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <label>
                            Treść
                            <textarea name="content" required="required" class="@error('content') is-invalid @enderror" >{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Dalej" class="btn btn-primary">
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
