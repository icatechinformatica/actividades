{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Validación de Actividades')

@section('css')
    <style>
        .colorTop { 
            background-color: #541533;
        }
    </style>
@endsection

@section('content')
    
    <div class="container-fluid">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                VALIDACIÓN DE ACTIVIDADES POR ÓRGANO ADMINISTRATIVO
            </div>
            <div class="card-body">

                <form id="formGetData" action="{{route('validacion.inicio')}}" method="get">
                    @csrf

                    <div class="row">
                        <div class="col-2">Órgano Validador</div>
                        <div class="col-4">
                            <select name="organo" class="form-control" id="organo">
                                <option value="{{ $organo[0]->id }}">{{ $organo[0]->descripcion }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-2">Órgano Administrativo</div>
                        <div class="col-4">
                            <select name="area" id="area" class="custom-select">
                                <option value="">SELECCIONAR</option>
                                @foreach ($areas as $area)
                                    <option {{$administrativo == $area->id ? 'selected' : ''}} value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-2">Ejercicio</div>
                        <div class="col-4">
                            <select class="custom-select" id="ejercicio" name="ejercicio">
                                {{-- <option value=''>Seleccione...</option> --}}
                                <option {{ $ejercicio == '2021' ? 'selected' : '' }}>2021</option>
                                <option {{ ($ejercicio == '2022' || $ejercicio == null) ? 'selected' : '' }}>2022</option>
                                <option {{ $ejercicio == '2023' ? 'selected' : '' }}>2023</option>
                                <option {{ $ejercicio == '2024' ? 'selected' : '' }}>2024</option>
                                <option {{ $ejercicio == '2025' ? 'selected' : '' }}>2025</option>
                                <option {{ $ejercicio == '2026' ? 'selected' : '' }}>2026</option>
                                <option {{ $ejercicio == '2027' ? 'selected' : '' }}>2027</option>
                                <option {{ $ejercicio == '2028' ? 'selected' : '' }}>2028</option>
                                <option {{ $ejercicio == '2029' ? 'selected' : '' }}>2029</option>
                                <option {{ $ejercicio == '2030' ? 'selected' : '' }}>2030</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input class="form-control" type="number" name="semana" id="semana" placeholder="Semana" value="{{$semana}}">
                        </div>
                        <div class="col-2">
                            <select name="actividad2" class="form-control" id="actividad2">
                                <option value="">--SELECCIONAR--</option>
                                <option {{$actividad2 == 'ACTIVIDAD' ? 'selected' : ''}}  value="ACTIVIDAD">ACTIVIDAD</option>
                                <option {{$actividad2 == 'PERMISO' ? 'selected' : ''}} value="PERMISO">PERMISO</option>
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary">FILTRAR</button>
                        </div>
                    </div>
                </form>

                <div class="row mt-4">

                    @if (!$actividades->isEmpty())
                        <div class="col">
                            <form action="{{route('validacion.enviar')}}" method="post">
                                @csrf
        
                                <input class="d-none" type="text" id="tipo_act" name="tipo_act" value="{{$actividad2}}">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Asunto</th>
                                            <th scope="col">Área responsable</th>
                                            <th scope="col">Actividad</th>
                                            <th scope="col">Estatus</th>
                                            <th scope="col">Observaciones</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Semana</th>
                                            <th scope="col">Enviado</th>
                                            <th scope="col">Selección</th>
                                        </tr>
                                    </thead>
            
                                    <tbody>
                                        <input id="administrativo" name="administrativo" class="d-none" type="number" value="{{$administrativo}}">
                                        <input id="semana" name="semana" class="d-none" type="number" value="{{$semana}}">

                                        @foreach ($actividades as $actividad)
                                            <tr>
                                                <td width="100px">{{ $actividad->fecha }}</td>
                                                <td>{{ $actividad->asunto }}</td>
                                                <td width="200px" ><strong>{{ $actividad->descripcion }}</strong></td>
                                                <td>{{ $actividad->actividad }}</td>
                                                <td width="120px">{{ $actividad->status }}</td>
                                                <td>{{ $actividad->observaciones }}</td>
                                                <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                                <td width="40px">{{ $actividad->semana }}</td>
                                                <td width="50px">
                                                    @if ($actividad->fecha_validacion == null)
                                                        NO
                                                    @else
                                                        SI
                                                    @endif
                                                </td>
                                                <td width="40px">
                                                    @if ($actividad->fecha_validacion == null)
                                                        <div class="custom-control custom-checkbox d-flex justify-content-center">
                                                            <input type="checkbox" value="{{ $actividad->id }}" class="custom-control-input settings"
                                                                name="actividades[]" id="check + {{$actividad->id}}">
                                                            <label class="custom-control-label"
                                                                for="check + {{$actividad->id}}"></label>
                                                        </div>
                                                    @else
                                                        No Disponible
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- @if (!$actividades->isEmpty()) --}}
                                    <div class="row">
                                        <div class="col d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-lg">Enviar a DG</button>
                                        </div>
                                    </div>
                                {{-- @endif --}}
                            </form>
                        </div>
                    @else
                        <div class="col text-center mt-5">
                            <h5><strong>Sin Actividades Registradas</strong></h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#formGetData').validate({
            rules: {
                area: { required: true },
                ejercicio: { required: true },
                semana: { required: true },

            },
            messages: {
                area: { required: 'Seleccione el organo administrativo' },
                ejercicio: { required: 'Seleccione el ejercicio' },
                semana: { required: 'Ingrese la semana' }
            }
        });
    </script>
@endsection