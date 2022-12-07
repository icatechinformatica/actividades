<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Actividades;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VtoBuenoController extends Controller {

    public function index(Request $request) {
        $organo1 = Auth::user()->id_area;
        if ($organo1 == 3) {
            $organo1 = 5;
        }
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        // $areas = DB::table('organos')->where('organos.id', '=', $organo1)->orWhere('id_parent', '=', $organo1)->get();

        if ($organo1 == 2) {
            $areas = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        } else {
            $areas = DB::table('organos')->where('organos.id', '=', $organo1)->orWhere('id_parent', '=', $organo1)->get();
        }

        if ($request->semana != null) {
            session(['semana2' => $request->semana]);
            session(['actividad2' => $request->actividad2]);
            session(['ejercicioV' => $request->ejercicio]);
        }
        $semana = session('semana2');
        $actividad2 = session('actividad2');
        $ejercicio = session('ejercicioV');

        $date = Carbon::now()->timezone('America/Monterrey');
        $day = Carbon::parse($date->toDateString())->format('l');
        $hora = $date->hour;
        
        $show = 'false';
        if ($day == 'Thursday' && $hora >= 16) {
            $show = 'true';
        } else if ($day == 'Friday' && $hora <= 16) {
            $show = 'true';
        }

        if ($actividad2 == null) {
            $actividades = Actividades::where('id_departamento', '=', $organo1)
                ->where('semana', '=', $semana)
                ->where('fecha_enviado', '!=', null)
                ->whereYear('fecha', $ejercicio)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                ->orderByRaw('status_vtoBueno desc')
                ->get();
        } else {
            $actividades = Actividades::where('id_departamento', '=', $organo1)
                ->where('semana', '=', $semana)
                ->where('tipo_actividad', '=', $actividad2)
                ->where('fecha_enviado', '!=', null)
                ->whereYear('fecha', $ejercicio)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                ->orderByRaw('status_vtoBueno desc')
                ->get();
        }
        return view('layouts.inicioVtoBueno', compact('organo', 'areas', 'semana', 'actividades', 'actividad2', 'show', 'ejercicio'));
    }

    public function store(Request $request, $semana) {
        if ($request->actividades != null) {
            $date = date('Y-m-d');
            foreach ($request->actividades as $actividad) {
                Actividades::where('id', '=', $actividad)
                    ->update([
                        'status_vtoBueno' => 'ADMINISTRATIVO',
                        'fecha_vToBueno' => $date
                    ]);
            }
        }
        return redirect()->route('vtoBueno.inicio')->with('success', 'ACTIVIDADES ENVIADAS EXITOSAMENTE!');
    }

    public function update(Request $request) {
        Actividades::where('id', '=', $request->id)
            ->update([
                'fecha' => $request->fecha,
                'asunto' => $request->asunto,
                'actividad' => $request->actividad,
                'observaciones' => $request->observaciones,
                'semana' => $request->semanaF,
                'status' => $request->status,
                'tipo_actividad' =>$request->tipo_actividad
            ]);
        return redirect()->route('vtoBueno.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }

}
