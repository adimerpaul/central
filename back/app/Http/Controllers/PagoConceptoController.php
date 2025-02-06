<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\PagoConcepto;
use Illuminate\Http\Request;

class PagoConceptoController extends Controller{
    function index(Request $request){
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $pagos = PagoConcepto::where('fecha_pago', '>=', $fechaInicio)
            ->where('fecha_pago', '<=', $fechaFin)
            ->with('user', 'user_pago')
            ->orderBy('id', 'desc')
            ->get();
        return $pagos;
    }
    function store(Request $request){

        $user = $request->user();
        $pagoConcepto = new PagoConcepto();
        $concepto = Concepto::find($request->concepto_id);
        $pagoConcepto->user_id = $request->user_id;
        $pagoConcepto->user_pago_id = $user->id;
        $pagoConcepto->concepto_id = $request->concepto_id;
        $pagoConcepto->comprobante = '';
        $pagoConcepto->descripcion = $concepto->descripcion;
        $pagoConcepto->monto = $request->monto;
        $pagoConcepto->estado = 'Activo';
        $pagoConcepto->fecha_pago = date('Y-m-d');
        $pagoConcepto->hora_pago = date('H:i:s');
        $pagoConcepto->save();

        return $pagoConcepto;
    }
}
