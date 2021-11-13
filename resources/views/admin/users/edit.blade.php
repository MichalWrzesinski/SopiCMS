@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.list') }}">Użytkownicy</a></li>
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

                <form method="post" action="{{ route('admin.users.edit.send', ['id' => $id]) }}">
                    @csrf
                    <label>
                        Nazwa
                        <input type="text" name="name" required="required" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Adre e-mail
                        <input type="text" name="email" required="required" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="row">
                        <div class="col">
                            <label>
                                Status
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
                                Typ
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
                        <input type="submit" value="Zapisz" class="btn btn-primary">
                    </div>
                </form>
            </section>
            <section class="p-4 mb-3">
                <h2>Zmień hasło</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-2" class="collapse mt-4">
                    <form method="post" action="{{ route('admin.users.password.send', ['id' => $id]) }}">
                        @csrf
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
                            <input type="submit" value="Zapisz" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
            <section class="p-4 mb-3">
                <h2>Avatar</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-3" role="button" aria-expanded="false" aria-controls="collapse-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-3" class="collapse mt-4">
                    @if($user->avatar)
                        <form method="post" action="{{ route('admin.users.avatar.delete.send', ['id' => $id]) }}">
                            @csrf
                            <img src="{{ route('image.thumbnail', ['path' => $user->avatar, 'width' => 150, 'height' => 150]) }}" alt="Avatar" class="avatar me-4">
                            <button type="submit" class="btn btn-primary">Usuń avatar</button>
                        </form>
                        <h2 class="mt-5">Aktualizuj avatar</h2>
                    @endif
                    <form method="post" action="{{ route('admin.users.avatar.add.send', ['id' => $id]) }}" enctype="multipart/form-data">
                        @csrf
                        <label>
                            Plik graficzny
                            <input type="file" name="avatar" required="required" class="@error('avatar') is-invalid @enderror">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Zapisz" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
            <section class="p-4 mb-3">
                <h2>Usuń użytkownika</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-1" class="collapse mt-4">
                    @if(Auth::user()->id == $id)
                        <p>Nie można usunąć własnego konta</p>
                    @else
                        <form method="post" action="{{ route('admin.users.delete.send', ['id' => $id]) }}">
                            @csrf
                            <label>
                                <input type="checkbox" name="delete" value="1" required="required">
                                Potwierdzam chęć usunięcia tego użytkownika
                            </label>
                            <div class="mt-4">
                                <input type="submit" value="Usuń" class="btn btn-primary">
                            </div>
                        </form>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
