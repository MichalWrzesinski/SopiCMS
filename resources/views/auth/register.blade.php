@extends('auth.layout')

@section('content')
    <section class="p-5 text-center">
        <h1 class="mb-5">{{ $title }}</h1>
        @include('tools.alert')
        <a href="{{ route('home') }}" class="position-absolute top-0 end-0 p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </a>
        <form method="post" action="{{ route('auth.register.send') }}">
            @csrf
            <label>
                <input type="text" name="name" required="required" placeholder="{{ __('auth.field.name') }}" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <label>
                <input type="email" name="email" required="required" placeholder="{{ __('auth.field.email') }}" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('login')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <label>
                <input type="password" name="password" required="required" placeholder="{{ __('auth.field.password') }}" class="@error('password') is-invalid @enderror">
                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <label>
                <input type="password" name="password_confirmation" required="required" placeholder="{{ __('auth.field.passwordConfirmation') }}" class="@error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <label class="text-start small mt-4">
                <input type="checkbox" name="regulations" required="required" class="@error('regulations') is-invalid @enderror" value="1"{{ old('regulations') == 'on' ? ' checked="checked"' : '' }}>
                {!! __('auth.field.regulations', [
                    'Regulations' => '<a href="'.route('page.show', ['url' => config('sopicms.url.regulations')]).'" target="_blank">'.__('auth.field.regulationsRegulations').'</a>',
                    'Policy' => '<a href="'.route('page.show', ['url' => config('sopicms.url.privacyPolicy')]).'" target="_blank">'.__('auth.field.regulationsPolicy').'</a>',
                    'Name' => config('sopicms.siteName'),
                ]) !!}
                @error('regulations')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </label>
            <div class="mt-4">
                <input type="submit" value="{{ __('auth.button.register') }}" class="btn btn-primary">
            </div>
            <div class="mt-4 small">
                <a href="{{ route('auth.login') }}" class="text-decoration-underline">{{ __('auth.header.login2') }}</a>
                <span class="mx-2">/</span>
                <a href="{{ route('auth.password') }}" class="text-decoration-underline">{{ __('auth.header.password2') }}</a>
            </div>
        </form>
    </section>

@endsection
