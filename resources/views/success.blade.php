@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body text-center">
        <h2 class="text-success mb-4">✅ Pago Exitoso</h2>
        <p><strong>Orden de compra:</strong> {{ $response->buyOrder }}</p>
        <p><strong>Monto:</strong> ${{ number_format($response->amount, 0, ',', '.') }}</p>
        <p><strong>Fecha:</strong> {{ $response->transactionDate }}</p>
        <p><strong>Código de autorización:</strong> {{ $response->authorizationCode }}</p>
        <p><strong>Tipo de pago:</strong> {{ $response->paymentTypeCode }}</p>

        <a href="{{ route('buy') }}" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
</div>
@endsection
