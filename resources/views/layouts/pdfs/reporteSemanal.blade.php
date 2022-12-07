<!DOCTYPE HTML>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REPORTE SEMANAL</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('vendor/bootstrap/3.4.1/bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 110px 40px 110px;
        }

        header {
            position: fixed;
            left: 0px;
            top: -100px;
            right: 0px;
            height: 60px;
            background-color: white;
            color: black;
            text-align: center;
            line-height: 60px;
        }

        header h1 {
            margin: 10px 0;
        }

        header h2 {
            margin: 0 0 10px 0;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -90px;
            right: 0px;
            height: 60px;
            background-color: white;
            color: black;
            text-align: center;
        }

        footer .page:after {
            content: counter(page);
        }

        footer table {
            width: 100%;
        }

        footer p {
            text-align: right;
        }

        footer .izq {
            text-align: left;
        }

        img.izquierda {
            float: left;
            width: 300px;
            height: 60px;
        }

        img.izquierdabot {
            float: inline-end;
            width: 450px;
            height: 60px;
        }

        img.derechabot {
            position: absolute;
            left: 700px;
            width: 350px;
            height: 60px;

        }

        img.derecha {
            float: right;
            width: 200px;
            height: 60px;
        }

        div.content {
            margin-top: 60%;
            margin-bottom: 70%;
            margin-right: -25%;
            margin-left: 0%;
        }

    </style>
</head>

<body>
    <header>
        <img class="izquierda" src="{{ public_path('img/instituto_oficial.png') }}">
        <img class="derecha" src="{{ public_path('img/chiapas.png') }}">
        {{-- <br> --}}
        <div id="wrapper">
            <div align=center>
                <b>
                    <h6>REPORTE DE ACTIVIDADES
                        <br>INSTITUTO DE CAPACITACIÓN Y
                        <br>VINCULACIÓN TECNOLÓGICA DEL ESTADO DE CHIAPAS
                    </h6>
                    <h6>"2022, Año de Ricardo Flores Magón"</h6>
                </b>
            </div>
        </div>
        <br>
    </header>
    <footer>
        <img class="izquierdabot" src="{{ public_path('img/franja.png') }}">
        <img class="derechabot" src="{{ public_path('img/icatech-imagen.png') }}">
    </footer>

    <br>
    <table class="mt-3" width="100%">
        <tbody>
            <tr>
                <td width="20%"><small>ÓRGANO ADMINISTRATIVO:</small></td>
                <td width="80%"> <small><strong>{{ $direccion2[0]->descripcion }}</strong></small></td>
            </tr>
            <tr>
                <td width="20%"><small>SEMANA DE REFERENCIA:</td>
                <td width="80%"><small><strong>{{ $semana }}</strong></small></td>
            </tr>
            {{-- <tr>
                <td width="50%"><small>CC: <strong>ARCHIVO MINUTARIO</strong></small></td>
                <td class="text-right" width="50%"><small>FECHA: <strong>date</strong></small></td>
            </tr> --}}
        </tbody>
    </table>

    {{-- <br> --}}
    {{-- <div class="form-row">
        <table  width="100%" class="table table-bordered table-striped" id="table-one">
            <thead>
                <tr>
                    <th scope="col"><small style="font-size: 9px;">NOMBRE DEL CURSO</small></th>
                    <th scope="col"><small style="font-size: 9px;">MOD</small></th>
                    <th scope="col"><small style="font-size: 9px;">DURA</small></th>
                    <th scope="col"><small style="font-size: 9px;">CLAVE</small></th>
                    <th scope="col"><small style="font-size: 9px;">No. MEMORANDUM AUT.</small></th>
                    <th scope="col"><small style="font-size: 9px;">INSTRUCTOR</small></th>
                    <th scope="col"><small style="font-size: 9px;">INICIO</small></th>
                    <th scope="col"><small style="font-size: 9px;">TERMINO</small></th>
                    <th scope="col"><small style="font-size: 9px;">ESPACIO FÍSICO</small></th>
                    <th scope="col"><small style="font-size: 9px;">SOLICITUD</small></th>
                    <th scope="col"><small style="font-size: 9px;">OBSERVACIONES</small></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitud as $item)
                    <tr>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">course</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">moood</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">duration</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">key</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">uniti</td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">name</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">start</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">end</small></td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">fisico</td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">option</td>
                        <td scope="col" class="text-center"><small style="font-size: 9px;">soli</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    </div> --}}

    <div class="form-row">
        @for ($i = 0; $i < 5; $i++)
            @if ($i == 0) 
                <h4 class="display-1">Lunes</h4>
                @if ($lunes != null)
                    <table width="100%" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col"><small>Fecha</small></th>
                                <th scope="col"><small>Asunto</small></th>
                                <th scope="col"><small>Actividad</small></th>
                                <th scope="col"><small>Estatus</small></th>
                                <th scope="col"><small>Observaciones</small></th>
                                <th scope="col"><small>Tipo</small></th>
                                <th scope="col"><small>Indicaciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subAreas as $subArea)
                                <tr>
                                    <td colspan="7"><strong><small>{{ $subArea->descripcion }}</small></strong></td>
                                </tr>
                                @foreach ($lunes as $actividad)
                                    @if ($subArea->id == $actividad->area_responsable)
                                        <tr>
                                            <td width="100px"><small>{{ $actividad->fecha }}</small></td>
                                            <td scope="col"><small>{{ $actividad->asunto }}</small></td>
                                            <td scope="col"><small>{{ $actividad->actividad }}</small></td>
                                            <td width="100px"><small>{{ $actividad->status }}</small></td>
                                            <td><small>{{ $actividad->observaciones }}</small></td>
                                            <td width="100px" ><small>{{ $actividad->tipo_actividad }}</small></td>
                                            <td><small>{{ $actividad->ind_direccion }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mt-3">
                        <div class="col d-flex justify-content-center">
                            <strong><small>Sin Actividades Registradas</small></strong>
                        </div>
                    </div>
                @endif
            @elseif ($i == 1)
                <h4 class="display-1">Martes</h4>
                @if ($martes != null)
                    <table width="100%" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><small>Fecha</small></th>
                                <th scope="col"><small>Asunto</small></th>
                                <th scope="col"><small>Actividad</small></th>
                                <th scope="col"><small>Estatus</small></th>
                                <th scope="col"><small>Observaciones</small></th>
                                <th scope="col"><small>Tipo</small></th>
                                <th scope="col"><small>Indicaciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subAreas as $subArea)
                                <tr>
                                    <td colspan="7"><strong><small>{{ $subArea->descripcion }}</small></strong></td>
                                </tr>
                                @foreach ($martes as $actividad)
                                    @if ($subArea->id == $actividad->area_responsable)
                                        <tr>
                                            <td width="100px"><small>{{ $actividad->fecha }}</small></td>
                                            <td scope="col"><small>{{ $actividad->asunto }}</small></td>
                                            <td scope="col"><small>{{ $actividad->actividad }}</small></td>
                                            <td width="100px"><small>{{ $actividad->status }}</small></td>
                                            <td><small>{{ $actividad->observaciones }}</small></td>
                                            <td width="100px" ><small>{{ $actividad->tipo_actividad }}</small></td>
                                            <td><small>{{ $actividad->ind_direccion }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mt-3">
                        <div class="col d-flex justify-content-center">
                            <strong><small>Sin Actividades Registradas</small></strong>
                        </div>
                    </div>
                @endif
            @elseif ($i == 2)
                <h4 class="display-1">Miercoles</h4>
                @if ($miercoles != null)
                    <table width="100%" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><small>Fecha</small></th>
                                <th scope="col"><small>Asunto</small></th>
                                <th scope="col"><small>Actividad</small></th>
                                <th scope="col"><small>Estatus</small></th>
                                <th scope="col"><small>Observaciones</small></th>
                                <th scope="col"><small>Tipo</small></th>
                                <th scope="col"><small>Indicaciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subAreas as $subArea)
                                <tr>
                                    <td colspan="7"><strong><small>{{ $subArea->descripcion }}</small></strong></td>
                                </tr>
                                @foreach ($miercoles as $actividad)
                                    @if ($subArea->id == $actividad->area_responsable)
                                        <tr>
                                            <td width="100px"><small>{{ $actividad->fecha }}</small></td>
                                            <td scope="col"><small>{{ $actividad->asunto }}</small></td>
                                            <td scope="col"><small>{{ $actividad->actividad }}</small></td>
                                            <td width="100px"><small>{{ $actividad->status }}</small></td>
                                            <td><small>{{ $actividad->observaciones }}</small></td>
                                            <td width="100px" ><small>{{ $actividad->tipo_actividad }}</small></td>
                                            <td><small>{{ $actividad->ind_direccion }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mt-3">
                        <div class="col d-flex justify-content-center">
                            <strong><small>Sin Actividades Registradas</small></strong>
                        </div>
                    </div>
                @endif
            @elseif ($i == 3)
                <h4 class="display-1">Jueves</h4>
                @if ($jueves != null)
                    <table width="100%" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><small>Fecha</small></th>
                                <th scope="col"><small>Asunto</small></th>
                                <th scope="col"><small>Actividad</small></th>
                                <th scope="col"><small>Estatus</small></th>
                                <th scope="col"><small>Observaciones</small></th>
                                <th scope="col"><small>Tipo</small></th>
                                <th scope="col"><small>Indicaciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subAreas as $subArea)
                                <tr>
                                    <td colspan="7"><strong><small>{{ $subArea->descripcion }}</small></strong></td>
                                </tr>
                                @foreach ($jueves as $actividad)
                                    @if ($subArea->id == $actividad->area_responsable)
                                        <tr>
                                            <td width="100px"><small>{{ $actividad->fecha }}</small></td>
                                            <td scope="col"><small>{{ $actividad->asunto }}</small></td>
                                            <td scope="col"><small>{{ $actividad->actividad }}</small></td>
                                            <td width="100px"><small>{{ $actividad->status }}</small></td>
                                            <td><small>{{ $actividad->observaciones }}</small></td>
                                            <td width="100px" ><small>{{ $actividad->tipo_actividad }}</small></td>
                                            <td><small>{{ $actividad->ind_direccion }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mt-3">
                        <div class="col d-flex justify-content-center">
                            <strong><small>Sin Actividades Registradas</small></strong>
                        </div>
                    </div>
                @endif
            @elseif ($i == 4)
                <h4 class="display-1">Viernes</h4>
                @if ($viernes != [])
                    <table width="100%" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><small>Fecha</small></th>
                                <th scope="col"><small>Asunto</small></th>
                                <th scope="col"><small>Actividad</small></th>
                                <th scope="col"><small>Estatus</small></th>
                                <th scope="col"><small>Observaciones</small></th>
                                <th scope="col"><small>Tipo</small></th>
                                <th scope="col"><small>Indicaciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subAreas as $subArea)
                                <tr>
                                    <td colspan="7"><strong><small>{{ $subArea->descripcion }}</small></strong></td>
                                </tr>
                                @foreach ($viernes as $actividad)
                                    @if ($subArea->id == $actividad->area_responsable)
                                        <tr>
                                            <td width="100px"><small>{{ $actividad->fecha }}</small></td>
                                            <td scope="col"><small>{{ $actividad->asunto }}</small></td>
                                            <td scope="col"><small>{{ $actividad->actividad }}</small></td>
                                            <td width="100px"><small>{{ $actividad->status }}</small></td>
                                            <td><small>{{ $actividad->observaciones }}</small></td>
                                            <td width="100px" ><small>{{ $actividad->tipo_actividad }}</small></td>
                                            <td><small>{{ $actividad->ind_direccion }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mt-3">
                        <div class="col d-flex justify-content-center">
                            <strong><small>Sin Actividades Registradas</small></strong>
                        </div>
                    </div>
                @endif
            @endif
        @endfor
    </div>

</body>

</html>
