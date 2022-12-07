{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Plan Semanal')

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
            <div class="card-header">PLAN SEMANAL</div>
            <div class="card-body">

                <form action="{{ route('plan.inicio') }}" method="get">
                    @csrf

                    {{-- Ejercicio --}}
                    <div class="row">
                        <div class="col-3">Ejercicio</div>
                        <div class="col-4">
                            <select id="ejercicio" name="ejercicio" class="form-control">
                                <option {{$ejercicio == '2021' ? 'selected' : ''}} value="2021">2021</option>
                                <option {{($ejercicio == '2022' || $ejercicio == null) ? 'selected' : ''}} value="2022">2022</option>
                                <option {{$ejercicio == '2023' ? 'selected' : ''}} value="2023">2023</option>
                                <option {{$ejercicio == '2024' ? 'selected' : ''}} value="2024">2024</option>
                                <option {{$ejercicio == '2025' ? 'selected' : ''}} value="2025">2025</option>
                                <option {{$ejercicio == '2026' ? 'selected' : ''}} value="2026">2026</option>
                                <option {{$ejercicio == '2027' ? 'selected' : ''}} value="2027">2027</option>
                                <option {{$ejercicio == '2028' ? 'selected' : ''}} value="2028">2028</option>
                                <option {{$ejercicio == '2029' ? 'selected' : ''}} value="2029">2029</option>
                                <option {{$ejercicio == '2030' ? 'selected' : ''}} value="2030">2030</option>
                            </select>
                        </div>
                    </div>

                    {{-- mes --}}
                    {{-- <div class="row mt-2">
                        <div class="col-3">Mes</div>
                        <div class="col-4">
                            <select name="mes" class="form-control" id="mes">
                                <option value="">SELECCIONAR</option>
                                <option {{$mes == '01' ? 'selected' : ''}} value="01">Enero</option>
                                <option {{$mes == '02' ? 'selected' : ''}} value="02">Febrero</option>
                                <option {{$mes == '03' ? 'selected' : ''}} value="03">Marzo</option>
                                <option {{$mes == '04' ? 'selected' : ''}} value="04">Abril</option>
                                <option {{$mes == '05' ? 'selected' : ''}} value="05">Mayo</option>
                                <option {{$mes == '06' ? 'selected' : ''}} value="06">Junio</option>
                                <option {{$mes == '07' ? 'selected' : ''}} value="07">Julio</option>
                                <option {{$mes == '08' ? 'selected' : ''}} value="08">Agosto</option>
                                <option {{$mes == '09' ? 'selected' : ''}} value="09">Septiembre</option>
                                <option {{$mes == '10' ? 'selected' : ''}} value="10">Octubre</option>
                                <option {{$mes == '11' ? 'selected' : ''}} value="11">Noviembre</option>
                                <option {{$mes == '12' ? 'selected' : ''}} value="12">Diciembre</option>
                            </select>
                        </div>
                    </div> --}}

                    {{-- direccion --}}
                    <div class="row mt-2">
                        <div class="col-3">Dirección</div>
                        <div class="col-4">
                            <select name="area" id="area" class="custom-select">
                                <option value="">SELECCIONAR</option>
                                @foreach ($areas as $area)
                                    <option {{$area->id == $direccion ? 'selected' : ''}} value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input class="form-control" type="number" name="semana" id="semana" placeholder="Semana"
                            value="{{$semana}}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary">FILTRAR</button>
                        </div>
                    </div>
                </form>

                <div class="row mt-4">
                    <div class="col d-flex justify-content-center">
                        <h4><strong>PLAN SEMANAL</strong></h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        {{-- encabezado --}}
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Lunes</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Martes</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Miercoles</a>
                                <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Jueves</a>
                                <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-viernes" role="tab" aria-controls="nav-about" aria-selected="false">Viernes</a>
                            </div>
                        </nav>

                        {{-- contenido --}}
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            {{-- lunes --}}
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                @if ($lunes != [])
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Asunto</th>
                                                <th scope="col">Actividad</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Observaciones</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Indicaciones</th>
                                                @if ($organo == null)
                                                    <th scope="col">Mostrar</th>
                                                @endif
                                                <th scope="col">Enviar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subAreas as $subArea)
                                                <tr >
                                                    <td colspan="{{$organo== null ? '9' : '8'}}"><strong>{{$subArea->descripcion}}</strong></td>
                                                </tr>
                                                @foreach ($lunes as $actividad)

                                                    @if ($subArea->id == $actividad->area_responsable)
                                                        <form action="{{route('plan.editar',  ['id' => $actividad->id])}}" method="post">
                                                            @csrf

                                                            <tr>
                                                                <td width="120px">{{ $actividad->fecha }}</td>
                                                                <td>{{ $actividad->asunto }}</td>
                                                                <td>{{ $actividad->actividad }}</td>
                                                                <td width="120px">{{ $actividad->status }}</td>
                                                                <td>{{ $actividad->observaciones }}</td>
                                                                <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                                                <td>
                                                                    @if ($organo == null)
                                                                        <input class="form-control" type="text" name="indicaciones"
                                                                        id="indicaciones" placeholder="Indicaciones"
                                                                        value="{{$actividad->ind_direccion}}">
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <input class="form-control" type="text" name="indicaciones"
                                                                            id="indicaciones" placeholder="Indicaciones"
                                                                            value="{{$actividad->ind_direccion}}">
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if ($organo == null)
                                                                    <td class="pb-0" width="100px">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Director') ? 'checked' : '' : '' }} type="checkbox" 
                                                                            value="Director" class="custom-control-input settings"
                                                                                name="views[]" id="check + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check + {{$actividad->id}}"><small>Director</small></label>
                                                                        </div>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Validador') ? 'checked' : '' : ''}} type="checkbox" 
                                                                            value="Validador" class="custom-control-input settings"
                                                                                name="views[]" id="check2 + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check2 + {{$actividad->id}}"><small>Validador</small></label>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td width="80px">
                                                                    @if ($organo == null)
                                                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-center">
                                            <strong>Sin Actividades registradas</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- martes --}}
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                @if ($martes != [])
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Asunto</th>
                                                <th scope="col">Actividad</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Observaciones</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Indicaciones</th>
                                                @if ($organo == null)
                                                    <th scope="col">Mostrar</th>
                                                @endif
                                                <th scope="col">Enviar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subAreas as $subArea)
                                                <tr>
                                                    <td colspan="{{$organo== null ? '9' : '8'}}"><strong>{{$subArea->descripcion}}</strong></td>
                                                </tr>
                                                @foreach ($martes as $actividad)

                                                    @if ($subArea->id == $actividad->area_responsable)
                                                        <form action="{{route('plan.editar',  ['id' => $actividad->id])}}" method="post">
                                                            @csrf

                                                            <tr>
                                                                <td width="120px">{{ $actividad->fecha }}</td>
                                                                <td>{{ $actividad->asunto }}</td>
                                                                <td>{{ $actividad->actividad }}</td>
                                                                <td width="120px">{{ $actividad->status }}</td>
                                                                <td>{{ $actividad->observaciones }}</td>
                                                                <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                                                <td>
                                                                    @if ($organo == null)
                                                                        <input class="form-control" type="text" name="indicaciones"
                                                                        id="indicaciones" placeholder="Indicaciones"
                                                                        value="{{$actividad->ind_direccion}}">
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <input class="form-control" type="text" name="indicaciones"
                                                                            id="indicaciones" placeholder="Indicaciones"
                                                                            value="{{$actividad->ind_direccion}}">
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if ($organo == null)
                                                                    <td class="pb-0" width="100px">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Director') ? 'checked' : '' : '' }} type="checkbox" 
                                                                            value="Director" class="custom-control-input settings"
                                                                                name="views[]" id="check + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check + {{$actividad->id}}"><small>Director</small></label>
                                                                        </div>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Validador') ? 'checked' : '' : ''}} type="checkbox" 
                                                                            value="Validador" class="custom-control-input settings"
                                                                                name="views[]" id="check2 + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check2 + {{$actividad->id}}"><small>Validador</small></label>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td width="80px">
                                                                    @if ($organo == null)
                                                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-center">
                                            <strong>Sin Actividades registradas</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- miercoles --}}
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                @if ($miercoles != [])
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Asunto</th>
                                                <th scope="col">Actividad</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Observaciones</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Indicaciones</th>
                                                @if ($organo == null)
                                                    <th scope="col">Mostrar</th>
                                                @endif
                                                <th scope="col">Enviar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subAreas as $subArea)
                                                <tr >
                                                    <td colspan="{{$organo== null ? '9' : '8'}}"><strong>{{$subArea->descripcion}}</strong></td>
                                                </tr>
                                                @foreach ($miercoles as $actividad)

                                                    @if ($subArea->id == $actividad->area_responsable)
                                                        <form action="{{route('plan.editar',  ['id' => $actividad->id])}}" method="post">
                                                            @csrf

                                                            <tr>
                                                                <td width="120px">{{ $actividad->fecha }}</td>
                                                                <td>{{ $actividad->asunto }}</td>
                                                                <td>{{ $actividad->actividad }}</td>
                                                                <td width="120px">{{ $actividad->status }}</td>
                                                                <td>{{ $actividad->observaciones }}</td>
                                                                <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                                                <td>
                                                                    @if ($organo == null)
                                                                        <input class="form-control" type="text" name="indicaciones"
                                                                        id="indicaciones" placeholder="Indicaciones"
                                                                        value="{{$actividad->ind_direccion}}">
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <input class="form-control" type="text" name="indicaciones"
                                                                            id="indicaciones" placeholder="Indicaciones"
                                                                            value="{{$actividad->ind_direccion}}">
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if ($organo == null)
                                                                    <td class="pb-0" width="100px">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Director') ? 'checked' : '' : '' }} type="checkbox" 
                                                                            value="Director" class="custom-control-input settings"
                                                                                name="views[]" id="check + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check + {{$actividad->id}}"><small>Director</small></label>
                                                                        </div>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Validador') ? 'checked' : '' : ''}} type="checkbox" 
                                                                            value="Validador" class="custom-control-input settings"
                                                                                name="views[]" id="check2 + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check2 + {{$actividad->id}}"><small>Validador</small></label>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td width="80px">
                                                                    @if ($organo == null)
                                                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-center">
                                            <strong>Sin Actividades registradas</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- jueves --}}
                            <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                @if ($jueves != [])
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Asunto</th>
                                                <th scope="col">Actividad</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Observaciones</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Indicaciones</th>
                                                @if ($organo == null)
                                                    <th scope="col">Mostrar</th>
                                                @endif
                                                <th scope="col">Enviar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subAreas as $subArea)
                                                <tr >
                                                    <td colspan="{{$organo== null ? '9' : '8'}}"><strong>{{$subArea->descripcion}}</strong></td>
                                                </tr>
                                                @foreach ($jueves as $actividad)

                                                    @if ($subArea->id == $actividad->area_responsable)
                                                        <form action="{{route('plan.editar',  ['id' => $actividad->id])}}" method="post">
                                                            @csrf

                                                            <tr>
                                                                <td width="120px">{{ $actividad->fecha }}</td>
                                                                <td>{{ $actividad->asunto }}</td>
                                                                <td>{{ $actividad->actividad }}</td>
                                                                <td width="120px">{{ $actividad->status }}</td>
                                                                <td>{{ $actividad->observaciones }}</td>
                                                                <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                                                <td>
                                                                    @if ($organo == null)
                                                                        <input class="form-control" type="text" name="indicaciones"
                                                                        id="indicaciones" placeholder="Indicaciones"
                                                                        value="{{$actividad->ind_direccion}}">
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <input class="form-control" type="text" name="indicaciones"
                                                                            id="indicaciones" placeholder="Indicaciones"
                                                                            value="{{$actividad->ind_direccion}}">
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if ($organo == null)
                                                                    <td class="pb-0" width="100px">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Director') ? 'checked' : '' : '' }} type="checkbox" 
                                                                            value="Director" class="custom-control-input settings"
                                                                                name="views[]" id="check + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check + {{$actividad->id}}"><small>Director</small></label>
                                                                        </div>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Validador') ? 'checked' : '' : ''}} type="checkbox" 
                                                                            value="Validador" class="custom-control-input settings"
                                                                                name="views[]" id="check2 + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check2 + {{$actividad->id}}"><small>Validador</small></label>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td width="80px">
                                                                    @if ($organo == null)
                                                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-center">
                                            <strong>Sin Actividades registradas</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- viernes --}}
                            <div class="tab-pane fade" id="nav-viernes" role="tabpanel" aria-labelledby="nav-about-tab">
                                @if ($viernes != [])
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Asunto</th>
                                                <th scope="col">Actividad</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Observaciones</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Indicaciones</th>
                                                @if ($organo == null)
                                                    <th scope="col">Mostrar</th>
                                                @endif
                                                <th scope="col">Enviar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subAreas as $subArea)
                                                <tr >
                                                    <td colspan="{{$organo== null ? '9' : '8'}}"><strong>{{$subArea->descripcion}}</strong></td>
                                                </tr>
                                                @foreach ($viernes as $actividad)

                                                    @if ($subArea->id == $actividad->area_responsable)
                                                        <form action="{{route('plan.editar',  ['id' => $actividad->id])}}" method="post">
                                                            @csrf

                                                            <tr>
                                                                <td width="120px">{{ $actividad->fecha }}</td>
                                                                <td>{{ $actividad->asunto }}</td>
                                                                <td>{{ $actividad->actividad }}</td>
                                                                <td width="120px">{{ $actividad->status }}</td>
                                                                <td>{{ $actividad->observaciones }}</td>
                                                                <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                                                <td>
                                                                    @if ($organo == null)
                                                                        <input class="form-control" type="text" name="indicaciones"
                                                                        id="indicaciones" placeholder="Indicaciones"
                                                                        value="{{$actividad->ind_direccion}}">
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <input class="form-control" type="text" name="indicaciones"
                                                                            id="indicaciones" placeholder="Indicaciones"
                                                                            value="{{$actividad->ind_direccion}}">
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if ($organo == null)
                                                                    <td class="pb-0" width="100px">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Director') ? 'checked' : '' : '' }} type="checkbox" 
                                                                            value="Director" class="custom-control-input settings"
                                                                                name="views[]" id="check + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check + {{$actividad->id}}"><small>Director</small></label>
                                                                        </div>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input {{$actividad->mostrar != null ? str_contains($actividad->mostrar, 'Validador') ? 'checked' : '' : ''}} type="checkbox" 
                                                                            value="Validador" class="custom-control-input settings"
                                                                                name="views[]" id="check2 + {{$actividad->id}}">
                                                                            <label class="custom-control-label"
                                                                                for="check2 + {{$actividad->id}}"><small>Validador</small></label>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td width="80px">
                                                                    @if ($organo == null)
                                                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                    @else
                                                                        @if ($actividad->mostrar == null || str_contains($actividad->mostrar, 'Validador'))
                                                                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                                                        @else
                                                                            <small>Permiso no otorgado</small>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-center">
                                            <strong>Sin Actividades registradas</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if ($lunes !=[] || $martes != [] || $miercoles != [] || $jueves != [] || $viernes != [])
                    <div class="row pr-2 d-flex justify-content-end">
                        <a href="{{route('planSemanal.reporte', ['ejercicio' => $ejercicio, 'mes' => $mes, 'direccion' => $direccion, 'semana' => $semana])}}">
                            <button type="button" class="btn btn-primary">GENERAR REPORTE</button>
                        </a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>

@endsection
