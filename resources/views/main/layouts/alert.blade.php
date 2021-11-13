@if(session('success'))
    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
        {!! session('success') ?? 'Operacja została wykonana pomyślnie' !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@isset($success)
    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
        {!! $success !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endisset

@if($errors->any())
    <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
        {!! $message ?? 'Operacja nie została wykonana, gdyż natrafiono na błąd' !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
        {!! session('error') ?? 'Operacja nie została wykonana, gdyż natrafiono na błąd' !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
