<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\WebpayPlus\WebpayPlus;
use Transbank\Webpay\Options;

class TransbankController extends Controller
{
    public function buy()
    {
        return view('buy');
    }

    public function pay(Request $request)
    {
        $amount = intval($request->input('amount', 1000));
        $buyOrder = uniqid('ORD-');
        $sessionId = uniqid('SESS-');

        // Guardar orden en BD (pendiente)
        $order = Order::create([
            'buy_order'  => $buyOrder,
            'session_id' => $sessionId,
            'amount'     => $amount,
        ]);

        // Credenciales (usa las de integración de Transbank)
        $commerceCode = env('TRANSBANK_COMMERCE_CODE');
        $apiKey = env('TRANSBANK_API_KEY');
        $environment = Options::ENVIRONMENT_INTEGRATION;

        // Crear objeto Options
        $options = new Options($apiKey, $commerceCode, $environment);

        // Crear la transacción
        $transaction = new Transaction($options);

        // URL de retorno
        $returnUrl = route('confirm');

        // Ejecutar la creación de la transacción
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        // Obtener URL y token del response
        $url = $response->getUrl();
        $token = $response->getToken();

        if (empty($url) || empty($token)) {
            return back()->withErrors('Error iniciando transacción con Transbank. Revisa los logs.');
        }

        // Guardar respuesta (opcional)
        $order->update(['raw_response' => json_encode($response)]);

        // Redirigir al formulario de pago
        return redirect()->away($url . '?token_ws=' . $token);
    }

     public function confirm(Request $request)
    {
        $token = $request->input('token_ws');

        if (!$token) {
            return redirect()->route('failure')->withErrors('Token no recibido desde Transbank.');
        }

        $commerceCode = env('TRANSBANK_COMMERCE_CODE');
        $apiKey = env('TRANSBANK_API_KEY');
        $environment = Options::ENVIRONMENT_INTEGRATION;

        $options = new Options($apiKey, $commerceCode, $environment);
        $transaction = new Transaction($options);

        $response = $transaction->commit($token);

        $order = Order::where('buy_order', $response->buyOrder)->first();

        if ($order) {
            $order->update([
                'status' => $response->status,
                'authorization_code' => $response->authorizationCode,
                'payment_type_code' => $response->paymentTypeCode,
                'transaction_date' => $response->transactionDate,
            ]);
        }

        if ($response->status === 'AUTHORIZED') {
            return redirect()->route('success')->with('response', $response);
        } else {
            return redirect()->route('failure')->withErrors('Transacción no autorizada.');
        }
    }

    public function success(Request $request)
    {
        $response = session('response');
        return view('success', compact('response'));
    }
    
}
