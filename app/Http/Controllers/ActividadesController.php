<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Actividades;
use App\organo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActividadesController extends Controller {

    public function index(Request $request) {
        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();

        if ($responsable == 3) {
            $responsable = 5;
        }

        if ($request->busqueda != null) {
            session(['semana' => $request->busqueda]);
            session(['ejercicioA' => $request->ejercicio]);
        }
        $semana = session('semana');
        $ejercicio = session('ejercicioA');
        // $actividad2 = session('actividad2');

        $showModify = 'false';
        $idOrgano = Auth::user()->id_organo;
        if ($idOrgano == 4 || $idOrgano == 5 || $idOrgano == 6 || $idOrgano == 7 
            || $idOrgano == 8 || $idOrgano == 9 || $idOrgano == 10) {
                $showModify = 'true';
        }

        $date = Carbon::now()->timezone('America/Monterrey');
        $day = Carbon::parse($date->toDateString())->format('l');
        $hora = $date->hour;

        $show = 'false';
        if ($day == 'Thursday' && $hora >= 16) {
            $show = 'true';
        } else if ($day == 'Friday' && $hora <= 16) {
            $show = 'true';
        }

        $actividades = Actividades::where('semana', '=', $semana)
            ->where('actividades.area_responsable', '=', $responsable)
            ->whereYear('fecha', $ejercicio)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();
        return view('layouts.inicioActividades', compact('organos','actividades', 'semana', 'showModify', 'show', 'ejercicio'));
    }

    public function store(Request $request) {

        if (Auth::user()->id_area == 2) {
            $id_dpto = DB::table('organos')->where('organos.id', '=', Auth::user()->id_area)->get();
        } else if (Auth::user()->id_area == 3) {
            $id_dpto = DB::table('organos')->where('organos.id', '=', 5)->get();
        } else {
            $id_dpto = DB::table('organos')->where('organos.id', '=', Auth::user()->id_organo)->get();
        }
        $organo = null;
        $departamento = null;

        if ($id_dpto[0]->id == 2 || $id_dpto[0]->id == 3) { // es un director
            $organo = $id_dpto[0]->id;
            $departamento = Auth::user()->id_area;
        } else if ($id_dpto[0]->id == 5) {
            $organo = 3;
            $departamento = 5;
        } else {
            $organo = DB::table('organos')->where('organos.id', '=', $id_dpto[0]->id_parent)->get(); //si es director no es necesario hacer esta consulta
            $organo = $organo[0]->id;
            $departamento = $id_dpto[0]->id;
        }

        $actividad = new Actividades();
        $actividad->fecha = $request->fecha;
        $actividad->asunto = $request->asunto;
        $actividad->area_responsable = Auth::user()->id_area == 3 ? 5 : Auth::user()->id_area;
        $actividad->actividad = $request->actividad;
        $actividad->status = $request->status;
        $actividad->observaciones = $request->observaciones;
        $actividad->semana = $request->semana;
        $actividad->tipo_actividad = $request->tipo_actividad;
        $actividad->id_organo = $organo;
        $actividad->id_departamento = $departamento;
        $actividad->iduser_created = Auth::user()->id;
        $actividad->save();
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD GUARDADA EXITOSAMENTE');
    }

    public function update(Request $request, $id, $semana) {
        Actividades::where('id', '=', $id)
            ->update([
                'status' => $request->$id
            ]);
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }

    public function destroy($id, $semana) {
        Actividades::destroy($id);
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD ELIMINADA EXITOSAMENTE');
    }

    public function send() {
        $semana = session('semana');
        if ($semana) {
            $date = date('Y-m-d');
            Actividades::where('semana', '=', $semana)
                ->where('iduser_created', Auth::user()->id)
                ->update([
                    'fecha_enviado' => $date
                ]);
            return redirect()->route('actividades.inicio')->with('success', sprintf('ACTIVIDADES DE LA SEMANA %s ENVIADAS CORRECTAMENTE', $semana));
        } else {
            return redirect()->route('actividades.inicio')->with('success', sprintf('Ocurrio un error! intentelo de nuevo'));
        }
    }

    public function update2(Request $request) {
        Actividades::where('id', '=', $request->id)
            ->update([
                'fecha' => $request->fechaD,
                'asunto' => $request->asuntoD,
                'actividad' => $request->actividadD,
                'observaciones' => $request->observacionesD,
                'semana' => $request->semanaD,
                'status' => $request->statusD,
                'tipo_actividad' =>$request->tipo_actividadD
            ]);
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }
}
