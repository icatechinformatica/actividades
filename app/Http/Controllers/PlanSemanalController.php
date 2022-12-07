<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\organo;
use Carbon\Carbon;
use DateTime;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlanSemanalController extends Controller {
    
    public function index(Request $request) {
        $organo = Auth::user()->id_organo;
        if ($organo == null) {
            $areas = DB::table('organos')->where('id', '=', 2)->orWhere('id_parent', '=', 2)->orWhere('id_parent', '=', 3)->get();
        } else {
            $id_area = Auth::user()->id_area;
            if ($id_area == 2) {
                $areas = DB::table('organos')->where('id', '=', 2)->orWhere('id_parent', '=', $id_area)->get();
            } else {
                $areas = DB::table('organos')->where('id_parent', '=', $id_area)->get();
            }
        }

        if ($request->area == 2) {
            $subAreas = DB::table('organos')->where('organos.id', '=', $request->area)->get();
        } else {
            $subAreas = DB::table('organos')->where('organos.id', '=', $request->area)->orWhere('id_parent', '=', $request->area)->get();
        }
        
        $lunes = []; $martes = []; $miercoles = []; $jueves = []; $viernes = [];
        $mes = $request->mes;
        $direccion = $request->area;
        $semana = $request->semana;
        $ejercicio = $request->ejercicio;

        if ($request->ejercicio != null){
            $actividades = DB::table('actividades')
            ->whereYear('fecha', $request->ejercicio)
            // ->whereMonth('fecha', $request->mes)
            ->where('id_departamento', '=', $request->area)
            ->where('semana', '=', $request->semana)
            ->where('fecha_validacion', '!=', null)
            ->orderByDesc('actividades.id')
            ->get();

            // recorrer el array y separar por dias
            foreach ($actividades as $actividad) {
                $day = Carbon::parse($actividad->fecha)->format('l');
                switch ($day) {
                    case 'Monday':
                        array_push($lunes, $actividad);
                        break;
                    case 'Tuesday':
                        array_push($martes, $actividad);
                        break;
                    case 'Wednesday':
                        array_push($miercoles, $actividad);
                        break;
                    case 'Thursday':
                        array_push($jueves, $actividad);
                        break;
                    case 'Friday':
                        array_push($viernes, $actividad);
                        break;
                }
            }
        }

        return view('layouts.inicioPlanSemanal', compact('areas', 'subAreas', 'lunes', 'martes', 'miercoles', 'jueves', 
            'viernes', 'mes', 'direccion', 'semana', 'ejercicio', 'organo'));
    }

    public function update(Request $request, $id) {
        $mostrar = [];
        $organo = Auth::user()->id_organo;

        if ($organo == null) { //inicio sesion direccion general
            if ($request->views != null) {
                foreach ($request->views as $view) {
                    $mostrar[] = $view;
                }
            }
        } else {
            $mostrar[] = 'Director';
            $mostrar[] = 'Validador';
        }
        

        $date = date('Y-m-d');
        Actividades::where('id', '=', $id)
            ->update([
                'ind_direccion' => $request->indicaciones,
                'fecha_direccion' => $date,
                'iduser_updated' => Auth::user()->id,
                'mostrar' => $mostrar
            ]);
        return back()->withInput()->with('success', 'SE GUARDARON LOS CAMBIOS CORRECTAMENTE');
    }

    public function reporteSemanal($ejercicio, $direccion, $semana) {
        // $mes,
        $direccion2 = organo::where('id', '=', $direccion)->get();

        if ($direccion == 2) {
            $subAreas = DB::table('organos')->where('organos.id', '=', $direccion)->get();
        } else {
            $subAreas = DB::table('organos')->where('organos.id', '=', $direccion)->orWhere('id_parent', '=', $direccion)->get();
        }

        $lunes = []; $martes = []; $miercoles = []; $jueves = []; $viernes = [];
        if ($ejercicio != null){
            $actividades = DB::table('actividades')
                ->whereYear('fecha', $ejercicio)
                // ->whereMonth('fecha', $mes)
                ->where('id_departamento', '=', $direccion)
                ->where('semana', '=', $semana)
                ->where('fecha_validacion', '!=', null)
                ->orderByDesc('actividades.id')
                ->get();

            // recorrer el array y separar por dias
            foreach ($actividades as $actividad) {
                $day = Carbon::parse($actividad->fecha)->format('l');
                switch ($day) {
                    case 'Monday':
                        array_push($lunes, $actividad);
                        break;
                    case 'Tuesday':
                        array_push($martes, $actividad);
                        break;
                    case 'Wednesday':
                        array_push($miercoles, $actividad);
                        break;
                    case 'Thursday':
                        array_push($jueves, $actividad);
                        break;
                    case 'Friday':
                        array_push($viernes, $actividad);
                        break;
                }
            }
        }

        $pdf = PDF::loadView('layouts.pdfs.reporteSemanal', compact('direccion2', 'semana', 'subAreas', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream('download.pdf');
    }
}
