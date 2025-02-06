<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use Illuminate\Http\Request;

class ConceptoController extends Controller{
    function index(){
        return Concepto::where('estado', 'Activo')->get();
    }
}
