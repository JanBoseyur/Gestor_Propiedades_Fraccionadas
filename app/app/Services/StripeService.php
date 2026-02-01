<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function crearPago(float $monto, string $moneda = 'clp', string $descripcion = '')
    {
        $montoCentavos = $monto * 100;

        $paymentIntent = PaymentIntent::create([
            'amount' => $montoCentavos,
            'currency' => $moneda,
            'description' => $descripcion,
            'payment_method_types' => ['card'],
        ]);

        return $paymentIntent;
    }
}
