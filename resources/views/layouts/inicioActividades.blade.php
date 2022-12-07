{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Agregar Actividades')

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
            <div class="card-header">REGISTRO DE ACTIVIDADES</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">Órgano Administrativo</div>
                    <div class="col-4">
                        <select name="organo" class="form-control" id="organo">
                            <option value="{{ $organos[0]->id }}">{{ $organos[0]->descripcion }}</option>
                        </select>
                    </div>
                </div>

                <form id="formSearch" action="{{route('actividades.inicio')}}" method="get">
                    @csrf
                    <div class="row my-2">
                        <div class="col-3">Ejercicio</div>
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
                    </div>

                    <div class="row">
                        <div class="col-3">Semana</div>
                        <div class="col-4">
                            <input class="form-control" type="number" name="busqueda" id="busqueda"
                            placeholder="Semana" value="{{$semana}}">
                        </div>
                        <div class="col">
                            <button type="submit" id="btnBuscarCurso" class="btn btn-primary">FILTRAR</button>
                        </div>
                    </div>
                </form>

                <hr class="my-4">
                <form id="formAddActivity" action="{{ route('actividades.store') }}" method="post">
                    @csrf

                    <div class="row d-flex align-items-center">
                        <div class="form-group col">
                            <label for="fecha" class="control-label">Fecha</label>
                            <input type='text' id="fecha" autocomplete="off" readonly="readonly" name="fecha"
                                class="form-control datepicker" required>
                        </div>

                        <div class="form-group col">
                            <label for="asunto" class="control-label">Asunto</label>
                            <textarea name="asunto" id="asunto" class="form-control" placeholder="Asunto" cols="30" rows="2"></textarea>
                        </div>

                        {{-- <div class="form-group col">
                            <label for="area_responsable" class="control-label">Area Responsable</label>
                            <select name="area_responsable" id="area_responsable" class="custom-select">
                                <option value="">SELECCIONAR</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="form-group col">
                            <label for="actividad" class="control-label">Actividad</label>
                            <textarea name="actividad" id="actividad" class="form-control" placeholder="Actividad" cols="30" rows="2"></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="observaciones" class="control-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="2" placeholder="Observaciones"></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="semana" class="control-label">Semana</label>
                            <input type="number" class="form-control" id="semana" name="semana" placeholder="Semana"
                                value="{{$semana}}">
                        </div>

                        <div class="form-group col">
                            <label for="status" class="control-label">Estado</label>
                            <select name="status" class="form-control" id="status">
                                <option value="">Seleccione</option>
                                <option value="INICIADO">INICIADO</option>
                                <option value="EN PROCESO">EN PROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="tipo_actividad" class="control-label">Tipo de actividad</label>
                            <select name="tipo_actividad" class="form-control" id="tipo_actividad">
                                <option value="">Seleccione</option>
                                <option value="ACTIVIDAD">ACTIVIDAD</option>
                                <option value="PERMISO">PERMISO</option>
                            </select>
                        </div>

                        <div class="form-group col-1 mt-2">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="row">
                    @if (!$actividades->isEmpty())
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
                                    <th scope="col">Opción</th>
                                    @if ($showModify == 'true')
                                        <th scope="col">Indicaciones DG</th>
                                    @endif
                                    @if ($showModify == 'true')
                                        <th scope="col">Modificar</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($actividades as $actividad)
                                    <tr>
                                        <form id="formStatus_{{ $actividad->id }}"
                                            action="{{ route('actividades.editar', ['id' => $actividad->id, 'semana'=>$actividad->semana]) }}" method="post">
                                            @csrf

                                            <td width="100px">{{ $actividad->fecha }}</td>
                                            <td>{{ $actividad->asunto }}</td>
                                            <td>{{ $actividad->descripcion }}</td>
                                            <td>{{ $actividad->actividad }}</td>
                                            <td width="170px">
                                                <select name="{{ $actividad->id }}" id="{{ $actividad->id }}"
                                                    class="form-control">
                                                    <option {{ $actividad->status == 'INICIADO' ? 'selected' : '' }}
                                                        value="INICIADO">INICIADO</option>
                                                    <option {{ $actividad->status == 'EN PROCESO' ? 'selected' : '' }}
                                                        value="EN PROCESO">EN PROCESO</option>
                                                    <option {{ $actividad->status == 'TERMINADO' ? 'selected' : '' }}
                                                        value="TERMINADO">TERMINADO</option>
                                                </select>
                                            </td>
                                            <td>{{ $actividad->observaciones }}</td>
                                            <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                            <td width="40px">{{ $actividad->semana }}</td>
                                            <td width="40px">
                                                @if ($actividad->fecha_enviado == null)
                                                    NO
                                                @else
                                                    SI
                                                @endif
                                            </td>
                                            <td width="120px">
                                                @if ($actividad->fecha_enviado == null)
                                                    <div class="row d-flex justify-content-center">
                                                        @if ($showModify != 'true')
                                                            <a class="btn btn-info btn-circle m-1 btn-circle-sm" title="Modificar Status"
                                                                href="#"
                                                                onclick="document.getElementById('formStatus_' + {{ $actividad->id }}).submit()">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        @endif

                                                        <a class="btn btn-danger btn-circle m-1 btn-circle-sm" title="Eliminar"
                                                            href="{{ route('actividades.destroy', ['id'=>$actividad->id, 'semana'=>$actividad->semana]) }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    NO DISPONIBLE
                                                @endif
                                            </td>

                                            @if ($showModify == 'true')
                                                <td width="140px">
                                                    @if ($actividad->mostrar != null)
                                                        @if ( str_contains($actividad->mostrar, 'Director'))
                                                            {{ $actividad->ind_direccion }}
                                                        @else
                                                            <small>Permiso no otorgado</small>
                                                        @endif
                                                    @else
                                                        {{ $actividad->ind_direccion }}
                                                    @endif
                                                    
                                                </td>
                                            @endif
                                        
                                            @if ($showModify == 'true' && $show == 'true')
                                                <td>
                                                    <button onclick="showModal({{$actividad}})" type="button" class="btn btn-success btn-sm" 
                                                        data-toggle="modal" data-target="#modalModify">Modificar</button>
                                                </td>
                                            @else
                                                @if ($showModify != 'false')
                                                    <td>
                                                        @if ($actividad->fecha_vToBueno == null)
                                                            <button onclick="showModal({{$actividad}})" type="button" class="btn btn-success btn-sm" 
                                                                data-toggle="modal" data-target="#modalModify">Modificar</button>
                                                        @elseif($actividad->mostrar != null && str_contains($actividad->mostrar, 'Director'))
                                                            <button onclick="showModal({{$actividad}})" type="button" class="btn btn-success btn-sm" 
                                                            data-toggle="modal" data-target="#modalModify">Modificar</button>
                                                        @else
                                                            No Disponible
                                                        @endif
                                                    </td>
                                                @endif
                                            @endif
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="col text-center">
                        <h5><strong>Sin Actividades Registradas</strong></h5>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>

        @if (!$actividades->isEmpty())
            <div class="row my-2">
                <div class="col d-flex justify-content-end">
                    {{-- <button id="btnEnviar" type="button" class="btn btn-primary btn-lg">Enviar</button> --}}
                    <a class="btn btn-primary btn-lg" title="Enviar" href="{{ route('actividades.enviar') }}">
                        Enviar
                    </a>
                    {{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalSemana">Enviar</button> --}}
                </div>
            </div>
        @endif

        <!-- Modal solicitar semana -->
        <div class="modal fade" id="modalSemana" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formSemana" enctype="multipart/form-data" action="{{ route('actividades.enviar') }}"
                        method="post">
                        @csrf

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">SEMANA A ENVIAR</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            {{-- archivo --}}
                            {{-- <input class="d-none" type="text" id="idsolicitud" name="idSolicitud"
                                value="{{ $solicitud != null && !$solicitud->isEmpty() ? $solicitud[0]->id_solicitud : '' }}">
                            <input class="d-none" type="text" class="form-control" id="num_solicitud" name="num_solicitud"
                                value="{{ $solicitud != null && !$solicitud->isEmpty() ? $solicitud[0]->num_solicitud : '' }}"> --}}
                            <div class="form-group col">
                                <label for="semanaE">NÚMERO DE SEMANA A ENVIAR</label>
                                <input type="number" class="form-control" id="semanaE" name="semanaE" placeholder="Semana">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">ENVIAR ACTIVIDADES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- modal modificar --}}
        <div id="modalModify" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                    <form action="{{route('actividades.editar2')}}" method="post">
                        @csrf

                        {{-- <input class="d-none" id="tipo_activi" name="tipo_activi" type="text" value="{{$actividad2}}"> --}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modificación de actividad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input class="d-none" type="text" id="id" name="id">
                            <div class="form-group col">
                                <label for="fechaD" class="control-label">Fecha</label>
                                <input type='text' id="fechaD" autocomplete="off" readonly="readonly" name="fechaD"
                                class="form-control datepicker" required>
                            </div>
                            <div class="form-group col">
                                <label for="asuntoD" class="control-label">Asunto</label>
                                <textarea name="asuntoD" id="asuntoD" class="form-control" placeholder="Asunto" cols="30" rows="2"></textarea>
                            </div>
                            <div class="form-group col">
                                <label for="actividadD" class="control-label">Actividad</label>
                                <textarea name="actividadD" id="actividadD" class="form-control" placeholder="Actividad" cols="30" rows="2"></textarea>
                            </div>
                            <div class="form-group col">
                                <label for="observacionesD" class="control-label">Observaciones</label>
                                <textarea class="form-control" name="observacionesD" id="observacionesD" cols="30" rows="2" placeholder="Observaciones"></textarea>
                            </div>
                            <div class="form-group col">
                                <label for="semanaD" class="control-label">Semana</label>
                                <input type="number" class="form-control" id="semanaD" name="semanaD" placeholder="Semana">
                            </div>
                            <div class="form-group col">
                                <label for="statusD" class="control-label">Estado</label>
                                <select name="statusD" class="form-control" id="statusD">
                                    <option value="INICIADO">INICIADO</option>
                                    <option value="EN PROCESO">EN PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="tipo_actividadD" class="control-label">Tipo de actividad</label>
                                <select name="tipo_actividadD" class="form-control" id="tipo_actividadD">
                                    <option value="ACTIVIDAD">ACTIVIDAD</option>
                                    <option value="PERMISO">PERMISO</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $("#fecha").datepicker({
            language: "es",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd'
        });

        $("#fechaD").datepicker({
            language: "es",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd'
        });

        $('#formAddActivity').validate({
            rules: {
                fecha: {
                    required: true
                },
                asunto: {
                    required: true
                },
                area_responsable: {
                    required: true
                },
                actividad: {
                    required: true
                },
                status: {
                    required: true
                },
                observaciones: {
                    required: true
                },
                semana: {
                    required: true
                },
                tipo_actividad: {
                    required: true
                }
            },
            messages: {
                fecha: {
                    required: 'Campo requerido'
                },
                asunto: {
                    required: 'Campo requerido'
                },
                area_responsable: {
                    required: 'Campo requerido'
                },
                actividad: {
                    required: 'Campo requerido'
                },
                status: {
                    required: 'Campo requerido'
                },
                observaciones: {
                    required: 'Campo requerido'
                },
                semana: {
                    required: 'Campo requerido'
                },
                tipo_actividad: {
                    required: 'Campo requerido'
                }
            }
        });

        $('#formSemana').validate({
            rules: {
                semanaE: {
                    required: true
                }
            },
            messages: {
                semanaE: {
                    required: 'Debe ingresar el número de semana a enviar'
                }
            }
        });

        function showModal(actividad) {
            $('#id').val(actividad['id']);
            $('#fechaD').val(actividad['fecha']);
            $('#asuntoD').val(actividad['asunto']);
            $('#actividadD').val(actividad['actividad']);
            $('#observacionesD').val(actividad['observaciones']);
            $('#semanaD').val(actividad['semana']);
            $('#statusD').val(actividad['status']);
            $('#tipo_actividadD').val(actividad['tipo_actividad']);
        }

        $('#formSearch').validate({
            rules: {
                ejercicio: { required: true },
                busqueda: { required: true }
            },
            messages: {
                ejercicio: { required: 'Debe seleccionar el ejercicio' },
                busqueda: { required: 'Campo requerido' }
            }
        });

    </script>

@endsection
