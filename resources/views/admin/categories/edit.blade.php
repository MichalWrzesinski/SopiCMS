@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.items.list') }}">{{ config('sopicms.item.name') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.list') }}">Kategorie</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div id="left" class="col-xl-3 col-sm-12">
            @include('admin.layouts.left')
        </div>
        <div id="right" class="col-xl-9 col-sm-12">
            <section class="p-4 mb-3">
                <h1 class="mb-4">{{ $title }}</h1>
                @include('main.layouts.alert')

                <form method="post" action="{{ route('admin.categories.edit.send', ['id' => $id]) }}">
                    @csrf
                    <label>
                        Nazwa
                        <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Drzewo kategorii
                        <select name="parent">
                            <option value="0">Kategoria główna</option>
                            @if(isset($list[0]) && is_array($list[0]))
                                @foreach($list[0] as $cat)
                                    <option value="{{ $cat['id'] }}"@if($category->parent_id == $cat['id']) selected="selected"@endif>{{ $cat['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </label>
                    <div class="mt-4">
                        <input type="submit" value="Zapisz" class="btn btn-primary">
                    </div>
                </form>
            </section>
            <section class="p-4 mb-3">
                <h2>Usuń kategorię</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-1" class="collapse mt-4">
                    <form method="post" action="{{ route('admin.categories.delete.send', ['id' => $id]) }}">
                        @csrf
                        <label>
                            <input type="checkbox" name="delete" value="1" required="required" class="@error('delete') is-invalid @enderror">
                            Potwierdzam chęć usunięcia tej kategorii
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Usuń" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
