<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GastoComun;
use App\Services\StripeService;

class PagoController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function crearPago(GastoComun $gasto)
    {
        $paymentIntent = $this->stripe->crearPago($gasto->monto, 'clp', "Pago GastoComun #{$gasto->id}");

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
            'gastoId' => $gasto->id
        ]);
    }

    public function marcarPagado(GastoComun $gasto)
    {
        $gasto->estado = 'pagado';
        $gasto->save();

        return response()->json(['message' => 'Pago marcado como pagado']);
    }
}
