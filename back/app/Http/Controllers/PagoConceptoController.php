<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\PagoConcepto;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PagoConceptoController extends Controller{
    function print(Request $request) {
        $pago = PagoConcepto::where('codigo', $request->codigo)->first();
        if (!$pago) {
            return view('pdf.notfound');
        }
        $pdf = Pdf::loadView('pdf.pago', compact('pago'))
            ->setPaper('half-letter');  // Formato media carta

        return $pdf->stream('recibo_pago.pdf');
    }

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


        $phone = $request->phone;
        $fraterno = User::where('id', $request->user_id)->first();
        $fraterno->phone = $phone;
        $fraterno->save();

        $user = $request->user();
        $pagoConcepto = new PagoConcepto();
        $concepto = Concepto::find($request->concepto_id);
        $pagoConcepto->codigo = substr(md5(time()), 0, 32);
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

        return PagoConcepto::where('id', $pagoConcepto->id)
            ->with('user', 'user_pago')
            ->first();
    }
    function update(Request $request, $id){
        $pagoConcepto = PagoConcepto::find($id);
        $pagoConcepto->estado = $request->estado;
        $pagoConcepto->save();
        return $pagoConcepto;
    }
}
