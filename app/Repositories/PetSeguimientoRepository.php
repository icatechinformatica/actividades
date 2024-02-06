<?php
namespace App\Repositories;

use App\Interfaces\PetSeguimientoProcesoInterface;
use App\Models\CatSemanas;
use Carbon\Carbon;
use App\Models\PetAsuntos;
use Carbon\CarbonPeriod;
use App\Models\PetOrganismosActividades;
use Illuminate\Support\Facades\Auth;
use App\Models\PetActividades;

class PetSeguimientoRepository implements PetSeguimientoProcesoInterface
{
    public function getAllMonths()
    {
        // Establecer la configuración regional a español
        Carbon::setLocale('es');

        $ejercicios = CatSemanas::select('ejercicio')->groupBy('ejercicio')->get();
        $ejercicioArray = array();;

        foreach ($ejercicios as $value) {
            $ejercicioArray[] = $value->ejercicio;
        }

        $stringArray = array_values($ejercicioArray);

        $catSemanas = CatSemanas::select('inicio', 'fin')->whereBetween('ejercicio', $stringArray)->get();

        $mesesYAnios = [];

        foreach ($catSemanas as $key => $value) {
            # registros
            $fechaInicio = Carbon::parse($value->inicio);
            $fechaFin = Carbon::parse($value->fin);
            $periodo = CarbonPeriod::create($fechaInicio, $fechaFin);
            foreach ($periodo as $fecha) {
                $mesYAnio = $fecha->isoFormat('MMMM Y', 'es');

                // Agregar a la lista solo si no está repetido
                if (!in_array($mesYAnio, $mesesYAnios)) {
                    $mesesYAnios[] = $mesYAnio;
                }
            }
        }

        return $mesesYAnios;
    }

    public function getAsunto()
    {
        return PetAsuntos::with(['actividades.organismo'])->get();
    }

    public function getCalendarios($request): Array
    {
        $ejercicios = CatSemanas::select('ejercicio')->groupBy('ejercicio')->get();
        $grupoEjercicio = array();

        foreach ($ejercicios as $value) {
            $grupoEjercicio[] = $value->ejercicio;
        }

        $stringArray = array_values($grupoEjercicio);

        $catSemanas = CatSemanas::select('inicio', 'fin', 'activo', 'semana', 'ejercicio')->whereBetween('ejercicio', $stringArray)->get();

        $conteoPorAnio = [];

        foreach ($catSemanas as $key => $value) {
            # registros
            $fechaInicio = Carbon::parse($value->inicio);
            $fechaFin = Carbon::parse($value->fin);

            if ($fechaInicio->month == $fechaFin->month) {
                # pertenece al mismo mes
                $conteoPorAnio[] = ['mes' => $fechaInicio->month, 'semana' => $value->semana, 'activo' => $value->activo, 'ejercicio' => $value->ejercicio ];
            } else {
                # code...
                $conteoPorAnio[] =['mes' => $fechaFin->month, 'semana' => $value->semana, 'activo' => $value->activo, 'ejercicio' => $value->ejercicio ];
            }

        }

        return $conteoPorAnio;
    }

    public function storeData(array $request)
    {
        list($semana, $actividad, $ejercicio, $mes) = explode("_", $request['client']);
        $registroActividad = PetOrganismosActividades::where('actividad_id', $actividad)->first();
        $insertData = [];
        $dataAdd = [];
        if ($registroActividad) {
            if ($request['details'] === "true") {
                // get the actual JSON records
                $datosExistentes  = json_decode($registroActividad->options, true);
                // create and Add the new JSON Object
                $JsonObj =
                [
                    'semana' => $semana,
                    'actividad' => $actividad,
                    'ejercicio' => $ejercicio,
                    'mes' => $mes
                ];
                // Add a new Json Object to existing Array
                $datosExistentes[] = $JsonObj;
                // Convert the array into a Json format and update database row
                $updateData = [
                    'options' => json_encode($datosExistentes)
                ];
                PetOrganismosActividades::where('actividad_id', $actividad)->update($updateData);
            } else {
                #if checked is false proceed to do theses piece of code
                $jsonObject = $registroActividad->options;
                $deteleObject = ['semana' => $semana, 'actividad' => $actividad, 'ejercicio' => $ejercicio, 'mes' => $mes];
                $arrayDatos = json_decode($jsonObject, true);

                for ($i=0; $i < count($arrayDatos); $i++) {
                    # realizar una comparación considerando los valores
                    if (
                        $arrayDatos[$i]['semana'] == $deteleObject['semana'] &&
                        $arrayDatos[$i]['actividad'] == $deteleObject['actividad'] &&
                        $arrayDatos[$i]['ejercicio'] == $deteleObject['ejercicio'] &&
                        $arrayDatos[$i]['mes'] == $deteleObject['mes']
                    ) {
                        unset($arrayDatos[$i]);
                        $arrayDatos = array_values($arrayDatos);
                        break; // Termina el bucle después de encontrar el elemento
                    }
                }

                $insertData = [
                    'options' => json_encode($arrayDatos)
                ];
                $update = PetOrganismosActividades::where('actividad_id', $actividad)->update($insertData);
            }
        } else {
            # registro no existente
            $datosMultiples = ['semana' => $semana, 'actividad' => $actividad, 'ejercicio' => $ejercicio, 'mes' => $mes];
            $dataAdd[] = $datosMultiples;

            $insertData = [
                'actividad_id'=> $actividad,
                'id_organo' => Auth::user()->id_organo,
                'options' => json_encode($dataAdd),
                'userid_created' => Auth::user()->id,
            ];
            PetOrganismosActividades::create($insertData);
        }

        return true;
    }

    public function getActividades(): Object
    {
        $actividades = PetOrganismosActividades::select('options', 'actividad_id')->get();
        return $actividades;
    }

    public function getAsunctoActividades(): Object {
        return PetAsuntos::with(['actividades'])->get();
    }

    public function saveSubject($request)
    {
        $asunto = new PetAsuntos();
        $asunto->fill([
            'asunto' => $request['asunto']
        ]);
        $asunto->save();
        return true;
    }

    public function getSubject(): Object
    {
       return PetAsuntos::orderBy('id', 'DESC')->pluck('asunto', 'id');
    }

    public function saveActivity($request)
    {
        $activity = new PetActividades();
        $activity->fill([
            'asunto_id' => $request['asunto'],
            'actividad' => $request['actividad'],
        ]);
        $activity->save();
        return true;
    }
}
