<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\organo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ValidacionController extends Controller {

    public function index(Request $request) {
        $organo1 = Auth::user()->id_area;
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();

        if ($organo1 == 2) {
            $areas = DB::table('organos')->where('organos.id', '=', $organo1)->orWhere('id_parent', '=', $organo1)->get();
        } else {
            $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();
        }

        if ($request->semana != null) {
            session(['administrativo' => $request->area]);
            session(['semana2' => $request->semana]);
            session(['actividad22' => $request->actividad2]);
            session(['ejercicioVV' => $request->ejercicio]);
        }
        $administrativo = session('administrativo');
        $semana = session('semana2');
        $actividad2 = session('actividad22');
        $ejercicio = session('ejercicioVV');

        if ($actividad2 == null) {
            $actividades = Actividades::where('id_departamento', '=', $administrativo)
                ->where('semana', '=', $semana)
                ->where('fecha_vToBueno', '!=', null)
                ->whereYear('fecha', $ejercicio)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                ->orderByRaw('status_validacion desc')
                ->get();
        } else {
            $actividades = Actividades::where('id_departamento', '=', $administrativo)
            ->where('semana', '=', $semana)
            ->where('tipo_actividad', '=', $actividad2)
            ->where('fecha_vToBueno', '!=', null)
            ->whereYear('fecha', $ejercicio)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByRaw('status_validacion desc')
            ->get();
        }
        return view('layouts.inicioValidacion', compact('organo', 'areas', 'actividades', 'administrativo', 'semana', 'actividad2', 'ejercicio'));
    }

    public function store(Request $request) {
        if ($request->actividades != null) {
            $date = date('Y-m-d');
            foreach ($request->actividades as $actividad) {
                Actividades::where('id', '=', $actividad)
                    ->update([
                        'status_validacion' => 'ADMINISTRATIVO',
                        'fecha_validacion' => $date
                    ]);
            }
        }
        return redirect()->route('validacion.inicio')->with('success', 'ACTIVIDADES ENVIADAS CORRECTAMENTE');
    }

}
