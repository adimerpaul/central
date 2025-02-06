<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagoConcepto extends Model{
    use SoftDeletes;
    protected $fillable = ['user_id', 'user_pago_id', 'concepto_id', 'comprobante', 'descripcion', 'monto', 'estado', 'fecha_pago', 'hora_pago'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
