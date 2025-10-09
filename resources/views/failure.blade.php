@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body text-center">
        <h2 class="text-danger mb-3">❌ Pago Fallido</h2>
        <p>Tu transacción no pudo completarse.</p>

        @if($errors->any())
            <div class="alert alert-warning mt-3">
                {{ $errors->first() }}
            </div>
        @endif

        <a href="{{ route('buy') }}" class="btn btn-outline-primary mt-3">Intentar nuevamente</a>
    </div>
</div>
@endsection
