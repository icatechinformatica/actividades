@extends('adminlte::page')

@section('title', 'Programa Específico de Trabajo - Entrega Recepción')
@section('css')
    <style>
        :root {
            --form-control-disabled: #959495;
        }

        * {
            outline: none;
        }

        /* Basic styles  */
        #gantt {
            font-family: "Roboto";
        }

        /* Variables de colores */
        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
            background: gray;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        ::-webkit-scrollbar-thumb:horizontal {
            background: #000;
            border-radius: 10px;
        }

        /* Estilos de la tabla y contenedor */
        table {
            overflow-x: auto;
            display: block;
        }


        table tr td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        td.cont {
            height: 50px;
            /* Altura fija */
            max-height: 100px;
            /* Altura máxima */
            min-height: 20px;
            /* Altura mínima */
        }

        .container table.main {
            border-collapse: collapse;
            border-spacing: 0px 10px;
            width: 100%;
        }

        table.main tr {
            border-bottom: 1.5px solid rgba(0, 0, 0, 0.1);
        }

        .container table.main tr th {
            border: 0.6px solid white;
            border-collapse: collapse;
            padding: 9px;
            font-size: 12px;
            background-color: #770723 !important;
            color: #fff;
        }

        .container table.main tr th.fijar-headcol {
            width: 300px;
            text-align: center;
        }

        .container table.main tr td {
            line-height: 17px;
            border-left: 1px solid rgba(0, 0, 0, 0.1);
        }

        .container table.main tr td:last-child {
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }

        table thead tr th.headcol {
            width: 50px;
            /* Ancho fijo de la primera columna */
        }

        table tr td.fijar {
            text-align: justify;
            font-size: 12px;
            padding: 6px 6px;
            /* Ancho fijo de la primera columna */
            min-width: 275px;
        }

        .gantt__row-head {
            background-color: #B2A9A8;
            border-width: 1px 0 0 0;
            border-color: rgba(0, 0, 0, 0.1);
            border-style: solid;
            padding: 8px 0;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        .contenedor_padre {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 5px;
            height: 100%;
            min-width: 80px;
        }

        .contenedor_hijo {
            background-color: #ECF0F1;
            height: 100%;
            flex-grow: 1;
            flex-shrink: 2;
            flex-basis: fit-content;
            flex: 1;
            text-align: center;
            min-width: 70px;
        }

        .contenedor_cabecera {
            display: flex;
            flex-direction: row;
            height: 25px;
            min-width: 80px;
            align-items: center;
            gap: 2px;
            color: #FFF;
        }

        .cabecera_hijo {
            background-color: #AEB6BF;
            height: 100%;
            flex-grow: 1;
            flex-shrink: 2;
            flex-basis: fit-content;
            flex: 1;
            text-align: center;
            padding: 2px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        /* checkbox */

        /* new checkbox item ccs */

        .datos {
            display: none;
        }

        label {
            min-width: 70px;
            height: 100%;
            flex-basis: fit-content;
            background-color: #ECF0F1;
            border-radius: 5%;
            border: solid 1px #F0F3F4;
            transition: 0.3s ease background-color, 0.5s ease transform,
                0.3s ease box-shadow;
            overflow: hidden;
            z-index: 1;
            cursor: pointer;
        }

        label:before {
            content: "";
            min-width: 70px;
            height: 100%;
            margin: 0 auto;
            background-color: white;
            transform: translateY(-50%);
            border-radius: 20%;
            transition: 0.3s ease width, 0.3s ease height;
        }

        label:hover:before {
            width: 20px;
            height: 20px;
            background-color: white;
        }

        .datos:checked~label {
            background: #B09A5B;
            color: #fff;
        }

        .datos:disabled~label {
            opacity: 0.7;
            cursor: not-allowed ! important;
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
        @php
            $contadorMeses = count($getMonths);
            $anios = [];
            $conteoPorAnio = [];
            $mesesAnio = 12;
            $arrayMes = [
                'enero' => 1,
                'febrero' => 2,
                'marzo' => 3,
                'abril' => 4,
                'mayo' => 5,
                'junio' => 6,
                'julio' => 7,
                'agosto' => 8,
                'septiembre' => 9,
                'octubre' => 10,
                'noviembre' => 11,
                'diciembre' => 12,
            ];
        @endphp
        <div class="card">
            <div class="card-header">ENTREGA RECEPCIÓN</div>
            <div class="card-body">
                <div class="col-12">
                    <div class="container">
                        <table cellspacing="0" width="100%" class="main">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="fijar-headcol headcol">Actividad</th>
                                    @foreach ($getMonths as $key => $value)
                                        @php
                                            $dividir = explode(' ', $value);
                                            $anio = $dividir[1];

                                            if (!in_array($dividir[1], $anios)) {
                                                $anios[] = $dividir[1];
                                            }

                                            if (isset($conteoPorAnio[$anio])) {
                                                $conteoPorAnio[$anio]++;
                                            } else {
                                                $conteoPorAnio[$anio] = 1;
                                            }

                                        @endphp
                                    @endforeach

                                    @foreach ($conteoPorAnio as $anio => $conteo)
                                        <th colspan="{{ $conteo }}">{{ $anio }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($getMonths as $k => $v)
                                        @php
                                            $partes = explode(' ', $v);
                                        @endphp
                                        <th style="text-align: center;">{{ ucfirst($partes[0]) }}</th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody id="chargetabledata">
                                <tr>
                                    <td style="text-align:center;">
                                        <b>Semanas</b>
                                    </td>

                                    @for ($i = 0; $i < $contadorMeses; $i++)
                                        <td>
                                            @if (preg_match("/(\w+) (\d+)$/", $getMonths[$i], $matches))
                                                @php
                                                    $nombreMes = $matches[1];
                                                    // $fecha = Carbon\Carbon::createFromFormat('F', ucfirst($nombreMes));
                                                    $anio = $matches[2];
                                                    $numeroMesAjustado = (($i - 0) % $mesesAnio) + 1;
                                                @endphp
                                                <div class="contenedor_cabecera">
                                                    @foreach ($periodos as $k => $j)
                                                        @if ($arrayMes[$nombreMes] == $j['mes'] && $j['ejercicio'] == $anio)
                                                            <span class="cabecera_hijo">
                                                                {{ $j['semana'] }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                                @foreach ($asunto as $k => $v)
                                    <tr class="gantt__row-head">
                                        <td colspan="14">{{ $v->asunto }}</td>
                                    </tr>


                                    @foreach ($v->actividades as $key)
                                        @php
                                            $actividad = $key->id;
                                            $organismo = $key->organismo;
                                        @endphp
                                        <tr>
                                            <td class="fijar">
                                                {{ $key->actividad }}
                                            </td>

                                            @for ($i = 0; $i < $contadorMeses; $i++)
                                                <td class="cont">
                                                    @if (preg_match("/(\w+) (\d+)$/", $getMonths[$i], $matches))
                                                        @php
                                                            $nombreMes = $matches[1];
                                                            $anio = $matches[2];
                                                            $numeroMesAjustado = (($i - 0) % $mesesAnio) + 1;
                                                        @endphp
                                                        <div class="contenedor_padre">
                                                            @foreach ($periodos as $key => $val)
                                                                @if ($arrayMes[$nombreMes] == $val['mes'] && $val['ejercicio'] == $anio)
                                                                    @php
                                                                        $seleccionado = false;
                                                                    @endphp
                                                                    @foreach ($organismo as $k => $v)
                                                                        @php
                                                                            $datoJson = json_decode($v->options, true);
                                                                        @endphp
                                                                        @foreach ($datoJson as $dato)
                                                                            @if (
                                                                                $dato['mes'] == $arrayMes[$nombreMes] &&
                                                                                    $dato['actividad'] == $actividad &&
                                                                                    $dato['semana'] == $val['semana'] &&
                                                                                    $dato['ejercicio'] == $val['ejercicio']
                                                                            )
                                                                                @php
                                                                                    $seleccionado = true;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach

                                                                    <div class="contenedor_hijo">

                                                                        <input type="checkbox"
                                                                            id="{{ $val['semana'] . '_' . $actividad . '_' . $val['ejercicio'] }}"
                                                                            name="checkbox" class="datos"
                                                                            value="{{ $val['semana'] . '_' . $actividad . '_' . $val['ejercicio'] . '_' . $val['mes'] }}"
                                                                            {{ $seleccionado ? 'checked' : '' }}
                                                                            {{ $val['activo'] ? '' : 'disabled' }}>
                                                                        <label
                                                                            for="{{ $val['semana'] . '_' . $actividad . '_' . $val['ejercicio'] }}">&nbsp;</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $(document).ready(function() {
            async function enviarSeamana(parametro1, parametro2) {
                try {
                    const resultado = await new Promise((resolve, reject) => {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('pet.store') }}",
                            dataType: "json",
                            data: {
                                client: parametro1,
                                details: parametro2
                            },
                            success: function(response) {
                                resolve(response);
                            },
                            error: function(error) {
                                reject(response);
                            }
                        });
                    });

                    return resultado;
                } catch (error) {
                    console.error(`Error en la llamada Ajax: ${error}`);
                    throw error;
                }
            }
            // Manejar el evento onclick del checkbox
            $('.datos').on('click', async function() {
                try {
                    const idConAttr = $(this).attr('id');
                    // Verificar si el checkbox está marcado o desmarcado
                    let valor = $('#' + idConAttr).val();
                    let checked = $(this).is(':checked');
                    await enviarSeamana(valor, checked);
                } catch (error) {
                    console.error(`Error después de la llamada Ajax: ${error}`);
                }
            });
        });
    </script>
@endsection
