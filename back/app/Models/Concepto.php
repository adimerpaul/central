<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concepto extends Model{
    use SoftDeletes;
    protected $fillable = ['nombre', 'descripcion', 'tipo', 'monto', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['nombreBs'];

    public function getNombreBsAttribute(){
        return $this->nombre . '|' . $this->monto . ' Bs.';
    }
}
