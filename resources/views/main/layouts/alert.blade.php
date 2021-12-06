@if(session('success'))
    <div class="alert alert-success align-items-center" role="alert">
        {!! session('success') ?? 'Operacja została wykonana pomyślnie' !!}
    </div>
@endif

@isset($success)
    <div class="alert alert-success align-items-center" role="alert">
        {!! $success !!}
    </div>
@endisset

@if($errors->any())
    <div class="alert alert-danger align-items-center" role="alert">
        {!! $message ?? 'Operacja nie została wykonana, gdyż natrafiono na błąd' !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger align-items-center" role="alert">
        {!! session('error') ?? 'Operacja nie została wykonana, gdyż natrafiono na błąd' !!}
    </div>
@endif
