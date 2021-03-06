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
                                            <th>{{ __('payments.field.id') }}</th>
                                            <th>{{ __('payments.field.user') }}</th>
                                            <th>{{ __('payments.field.status') }}</th>
                                            <th>{{ __('payments.field.type') }}</th>
                                            <th>{{ __('payments.field.date) }}</th>
                                            <th>{{ __('layout.field.options') }}</th>
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
                                {{ $list->appends(request()->input())->links() }}
                            @else
                                <p>{{ __('layout.alert.notFound') }}</p>
                            @endif
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
