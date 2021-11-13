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
            <section class="p-4 mb-3">
                <h1 class="mb-4">{{ $title }}</h1>
                @include('main.layouts.alert')

                @if($list->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nazwa</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Typ</th>
                                <th>Opcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ config('sopicms.user.status.'.$user['status']) }}</td>
                                    <td>{{ config('sopicms.user.type.'.$user['type']) }}</td>
                                    <td><a href="{{ route('admin.users.edit', ['id' => $user['id']]) }}">Zarządzaj</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $list->links() }}
                @else
                    <p>Niczego nie znaleziono</p>
                @endif
            </section>
            <section class="p-4 mb-3">
                <h2>Dodaj użytkownika</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-1" class="collapse mt-4">
                    <form method="post" action="{{ route('admin.users.add.send') }}">
                        @csrf
                        <label>
                            Nazwa
                            <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <label>
                            Adres e-mail
                            <input type="email" name="email" required="required" class="@error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="row">
                            <div class="col">
                                <label>
                                    Hasło
                                    <input type="password" name="password" required="required" class="@error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    Powtórz hasło
                                    <input type="password" name="password_confirmation" required="required" class="@error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input type="submit" value="Dodaj" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
            <section class="p-4 mb-3">
                <h2>Szukaj użytkownika</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-2" class="collapse mt-4">
                    <form method="post" action="{{ route('admin.users.list.send') }}">
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
                            Szukaj w nazwach
                        </label>
                        <label>
                            <input type="checkbox" name="email" value="1" checked="checked">
                            Szukaj w adresach e-mail
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Szukaj" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
