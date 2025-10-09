@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="mb-4">🛒 Iniciar pago</h3>
                <form method="POST" action="{{ route('pay') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="amount" class="form-label">Monto a pagar (en CLP):</label>
                        <input type="number" name="amount" id="amount" class="form-control" value="1000" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Pagar con Webpay</button>
                </form>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
