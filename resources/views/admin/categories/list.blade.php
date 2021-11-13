@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.items.list') }}">{{ config('sopicms.item.name') }}</a></li>
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

                @if(count($list) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nazwa</th>
                                <th>Pozycja</th>
                                <th>Opcje</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list[0] as $cat)
                            <tr>
                                <td class="table-primary">{{ $cat['id'] }}</td>
                                <td class="table-primary"><strong>{{ $cat['name'] }}</strong></td>
                                <td class="table-primary">
                                    <a href="{{ route('admin.categories.up.send', ['id' => $cat['id']]) }}"@if($cat['y'] == 0) class="text-secondary disabled"@endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                                            <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.categories.down.send', ['id' => $cat['id']]) }}"@if($cat['y'] == $cat['lastY']) class="text-secondary disabled"@endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td class="table-primary"><a href="{{ route('admin.categories.edit', ['id' => $cat['id']]) }}">Zarządzaj</a></td>
                            </tr>
                            @if(isset($list[$cat['id']]) && is_array($list[$cat['id']]))
                                @foreach($list[$cat['id']] as $sub)
                                    <tr>
                                        <td>{{ $sub['id'] }}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"/>
                                            </svg>
                                            {{ $sub['name'] }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.categories.up.send', ['id' => $sub['id']]) }}"@if($sub['y'] == 0) class="text-secondary disabled"@endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                                                    <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.categories.down.send', ['id' => $sub['id']]) }}"@if($sub['y'] == $sub['lastY']) class="text-secondary disabled"@endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td><a href="{{ route('admin.categories.edit', ['id' => $sub['id']]) }}">Zarządzaj</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Niczego nie znaleziono</p>
                @endif
            </section>
            <section class="p-4 mb-3">
                <h2>Dodaj kategorię</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-1" class="collapse mt-4">
                    <form method="post" action="{{ route('admin.categories.add.send') }}">
                        @csrf
                        <label>
                            Nazwa
                            <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror">
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
                                        <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Dodaj" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
