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

                @if($list->isNotEmpty())
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Użytkownik</th>
                            <th>Status</th>
                            <th>Typ</th>
                            <th>Data</th>
                            <th>Opcje</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $payment)
                            <tr>
                                <td>{{ $payment['id'] }}</td>
                                <td><a href="{{ route('admin.users.edit', ['id' => $payment['user_id']]) }}">{{ $payment['name'] }}</a></td>
                                <td>{{ config('sopicms.payment.status.'.$payment['status']) }}</td>
                                <td>{{ config('sopicms.payment.type.'.$payment['type']) }}</td>
                                <td>{{ $payment['updated_at'] }}</td>
                                <td>-</td>
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
@endsection
