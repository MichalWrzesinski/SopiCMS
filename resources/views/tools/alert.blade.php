@if(session('success'))
    <div class="alert alert-success align-items-center" role="alert">
        {!! session('success') ?? __('alerts.success') !!}
    </div>
@endif

@isset($success)
    <div class="alert alert-success align-items-center" role="alert">
        {!! $success !!}
    </div>
@endisset

@if($errors->any())
    <div class="alert alert-danger align-items-center" role="alert">
        {!! $message ?? __('alerts.error') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger align-items-center" role="alert">
        {!! session('error') ?? __('alerts.error') !!}
    </div>
@endif
