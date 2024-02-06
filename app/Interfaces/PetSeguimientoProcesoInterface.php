<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface PetSeguimientoProcesoInterface
{
    public function getAllMonths();
    public function getAsunto();
    public function getCalendarios(Request $request);
    public function storeData(array $request);
    public function getActividades();
    public function getAsunctoActividades();
    public function saveSubject(Request $request);
    public function getSubject();
    public function saveActivity(Request $request);
}
