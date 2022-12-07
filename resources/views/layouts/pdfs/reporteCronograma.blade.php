<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REPORTE CRONOGRAMA DE PAGOS</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('vendor/bootstrap/3.4.1/bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 110px 10px 110px;
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
            <div >
                <b>
                    <h6>
                        <br>INSTITUTO DE CAPACITACIÓN Y VINCULACIÓN TECNOLÓGICA DEL ESTADO DE CHIAPAS
                        <br>CURSOS PARA PAGO DE HONORARIOS-MODALIDAD: CAPACITACIÓN A DISTANCIA
                        <br>CRONOGRAMA DE PAGOS POR UNIDAD DE CAPACITACIÓN (VALIDADOS EN EL SISTEMA SIVYC)
                    </h6>
                    <h6>"2022, Año de Ricardo Flores Magón"</h6>
                </b>
            </div>
        </div>
        <br>
    </header>
    <footer>
        {{-- <img class="izquierdabot" src="{{ public_path('img/franja.png') }}"> --}}
        <img class="derechabot" src="{{ public_path('img/icatech-imagen.png') }}">
    </footer>

    {{-- <br> --}}
    <div style="display: none">{{$comitan = 0, $jiquipilas = 0, $catazaja = 0, $reforma = 0, $tapachula = 0, $sanCristobal = 0, $tuxtla = 0, 
        $tonala = 0, $ocosingo = 0, $villaflores = 0, $yajalon = 0}}</div>
    
    <table>
        <tbody>
            <tr>
                <td>Rango de Fechas:</td>
                <td> </td>
                <td>{{$fechaInicio}} - {{$fechaTermino}}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td><small><strong>PP</strong> - Pagos Programados</small></td>
                <td> </td><td> </td><td> </td>
                <td><small><strong>CB</strong> - Pagos Cargados al Banco</small></td>
                <td> </td><td> </td><td> </td>
                <td><small><strong>EP</strong> - Pagos Efectivamente Pagados</small></td>
                <td> </td><td> </td><td> </td>
                <td><small><strong>0 </strong> - No Agregado</small></td>
            </tr>
        </tbody>
    </table>
    
    <div style="display: none"> {{$cp = 0, $cb = 0, $ce = 0, $jp = 0, $jb = 0, $je = 0,
            $cap = 0, $cab = 0, $cae = 0, $rp = 0, $rb = 0, $re = 0,
            $tp = 0, $tb = 0, $te = 0, $sp = 0, $sb = 0, $se = 0,
            $tup = 0, $tub = 0, $tue = 0, $top = 0, $tob = 0, $toe = 0,
            $op = 0, $ob = 0, $oe = 0, $vp = 0, $vb = 0, $ve = 0,
            $yp = 0, $yb = 0, $ye = 0}}</div>
    <div style="display: none">{{$comitan = 0, $comitanBanco = 0, $comitanEfectivos = 0,  $jiquipilas = 0, $jiquipilasBanco = 0, $jiquipilasEfectivos = 0, 
            $catazaja = 0, $catazajaBanco = 0, $catazajaEfectivos = 0, $reforma = 0, $reformaBanco = 0, $reformaEfectivos = 0, 
            $tapachula = 0, $tapachulaBanco = 0, $tapachulaEfectivos = 0, $sanCristobal = 0, $sanCristobalBanco = 0, $sanCristobalEfectivos = 0, 
            $tuxtla = 0, $tuxtlaBanco = 0, $tuxtlaEfectivos = 0,$tonala = 0, $tonalaBanco = 0, $tonalaEfectivos = 0, 
            $ocosingo = 0, $ocosingoBanco = 0, $ocosingoEfectivos = 0, $villaflores = 0, $villafloresBanco = 0, $villafloresEfectivos = 0, 
            $yajalon = 0, $yajalonBanco = 0, $yajalonEfectivos = 0}}</div>
    <div style="display: none">{{$totalPP = 0, $totalCB = 0, $totalEP = 0, $totTotalPP = 0, $totTotalCB = 0, $totTotalEP = 0}}</div>

    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <td><small>Unidades de Capacitación</small></td>
                @foreach ($unidades as $unidad)
                {{-- th --}}
                    <td style="text-align: center" colspan="3"><small>{{$unidad->nombre}} <br> <small>PP - CB - EP</small></small></td>
                @endforeach
                <td class="text-center" colspan="3"><small><strong>Totales</strong> <br> <small>PP - CB - EP</small></small></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped as $group)
                <tr>
                    <td><small>{{$group[0]->start}}</small></td>
                    {{-- comitan --}}
                    <div style="display: none">{{$cp = 0}}</div>
                    <div style="display: none">{{$cb = 0}}</div>
                    <div style="display: none">{{$ce = 0}}</div>
                    <div style="display: none">{{$totalPP = 0}}</div>
                    <div style="display: none">{{$totalCB = 0}}</div>
                    <div style="display: none">{{$totalEP = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 1)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$comitan += $item->title}} {{$cp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$comitanBanco += $item->title}} {{$cb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$comitanEfectivos += $item->title}} {{$ce = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$cp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$cb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$ce}}</small></small>
                    </td>
                    {{-- jiquipilas --}}
                    <div style="display: none">{{$jp = 0}}</div>
                    <div style="display: none">{{$jb = 0}}</div>
                    <div style="display: none">{{$je = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 2)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$jiquipilas += $item->title}} {{$jp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$jiquipilasBanco += $item->title}} {{$jb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$jiquipilasEfectivos += $item->title}} {{$je = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$jp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$jb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$je}}</small></small>
                    </td>
                    {{-- catazaja --}}
                    <div style="display: none">{{$cap = 0}}</div>
                    <div style="display: none">{{$cab = 0}}</div>
                    <div style="display: none">{{$cae = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 3)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$catazaja += $item->title}} {{$cap = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$catazajaBanco += $item->title}} {{$cab = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$catazajaEfectivos += $item->title}} {{$cae = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$cap}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$cab}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$cae}}</small></small>
                    </td>
                    {{-- reforma --}}
                    <div style="display: none">{{$rp = 0}}</div>
                    <div style="display: none">{{$rb = 0}}</div>
                    <div style="display: none">{{$re = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 4)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$reforma += $item->title}} {{$rp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$reformaBanco += $item->title}} {{$rb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$reformaEfectivos += $item->title}} {{$re = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$rp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$rb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$re}}</small></small>
                    </td>
                    {{-- tapachula --}}
                    <div style="display: none">{{$tp = 0}}</div>
                    <div style="display: none">{{$tb = 0}}</div>
                    <div style="display: none">{{$te = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 5)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$tapachula += $item->title}} {{$tp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$tapachulaBanco += $item->title}} {{$tb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$tapachulaEfectivos += $item->title}} {{$te = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$tp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$tb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$te}}</small></small>
                    </td>
                    {{-- san cristobal --}}
                    <div style="display: none">{{$sp = 0}}</div>
                    <div style="display: none">{{$sb = 0}}</div>
                    <div style="display: none">{{$se = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 6)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$sanCristobal += $item->title}} {{$sp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$sanCristobalBanco += $item->title}} {{$sb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$sanCristobalEfectivos += $item->title}} {{$se = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$sp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$sb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$se}}</small></small>
                    </td>
                    {{-- tuxtla --}}
                    <div style="display: none">{{$tup = 0}}</div>
                    <div style="display: none">{{$tub = 0}}</div>
                    <div style="display: none">{{$tue = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 7)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$tuxtla += $item->title}} {{$tup = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$tuxtlaBanco += $item->title}} {{$tub = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$tuxtlaEfectivos += $item->title}} {{$tue = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$tup}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$tub}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$tue}}</small></small>
                    </td>
                    {{-- tonala --}}
                    <div style="display: none">{{$top = 0}}</div>
                    <div style="display: none">{{$tob = 0}}</div>
                    <div style="display: none">{{$toe = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 8)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$tonala += $item->title}} {{$top = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$tonalaBanco += $item->title}} {{$tob = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$tonalaEfectivos += $item->title}} {{$toe = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$top}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$tob}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$toe}}</small></small>
                    </td>
                    {{-- ocosingo --}}
                    <div style="display: none">{{$op = 0}}</div>
                    <div style="display: none">{{$ob = 0}}</div>
                    <div style="display: none">{{$oe = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 9)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$ocosingo += $item->title}} {{$op = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$ocosingoBanco += $item->title}} {{$ob = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$ocosingoEfectivos += $item->title}} {{$oe = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$op}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$ob}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$oe}}</small></small>
                    </td>
                    {{-- villaflores --}}
                    <div style="display: none">{{$vp = 0}}</div>
                    <div style="display: none">{{$vb = 0}}</div>
                    <div style="display: none">{{$ve = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 10)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$villaflores += $item->title}} {{$vp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$villafloresBanco += $item->title}} {{$vb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$villafloresEfectivos += $item->title}} {{$ve = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$vp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$vb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$ve}}</small></small>
                    </td>
                    {{-- yajalon --}}
                    <div style="display: none">{{$yp = 0}}</div>
                    <div style="display: none">{{$yb = 0}}</div>
                    <div style="display: none">{{$ye = 0}}</div>
                    @foreach ($group as $item)
                        @if ($item->id_unidad == 11)
                            @if ($item->backgroundColor == null) 
                                <div style="display: none">{{$yajalon += $item->title}} {{$yp = $item->title}} {{$totalPP += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#fceb30')
                                <div style="display: none">{{$yajalonBanco += $item->title}} {{$yb = $item->title}} {{$totalCB += $item->title}}</div>
                            @elseif ($item->backgroundColor == '#00ff04')
                                <div style="display: none">{{$yajalonEfectivos += $item->title}} {{$ye = $item->title}} {{$totalEP += $item->title}}</div>
                            @endif
                        @endif
                    @endforeach
                    <td>
                        <small><small>{{$yp}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$yb}}</small></small>
                    </td>
                    <td>
                        <small><small>{{$ye}}</small></small>
                    </td>
                    <td><small><strong><small>{{$totalPP}}</small></strong></small></td>
                    <td><small><strong><small>{{$totalCB}}</small></strong></small></td>
                    <td><small><strong><small>{{$totalEP}}</small></strong></small></td>
                    <div style="display: none">{{$totTotalPP += $totalPP}}</div>
                    <div style="display: none">{{$totTotalCB += $totalCB}}</div>
                    <div style="display: none">{{$totTotalEP += $totalEP}}</div>
                </tr>
            @endforeach
            <tr>
                <td><strong>Totales</strong></td>
                <td><small><strong><small>{{$comitan}}</small></strong></small></td>
                <td><small><strong><small>{{$comitanBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$comitanEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$jiquipilas}}</small></strong></small></td>
                <td><small><strong><small>{{$jiquipilasBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$jiquipilasEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$catazaja}}</small></strong></small></td>
                <td><small><strong><small>{{$catazajaBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$catazajaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$reforma}}</small></strong></small></td>
                <td><small><strong><small>{{$reformaBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$reformaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$tapachula}}</small></strong></small></td>
                <td><small><strong><small>{{$tapachulaBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$tapachulaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$sanCristobal}}</small></strong></small></td>
                <td><small><strong><small>{{$sanCristobalBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$sanCristobalEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$tuxtla}}</small></strong></small></td>
                <td><small><strong><small>{{$tuxtlaBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$tuxtlaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$tonala}}</small></strong></small></td>
                <td><small><strong><small>{{$tonalaBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$tonalaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$ocosingo}}</small></strong></small></td>
                <td><small><strong><small>{{$ocosingoBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$ocosingoEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$villaflores}}</small></strong></small></td>
                <td><small><strong><small>{{$villafloresBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$villafloresEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$yajalon}}</small></strong></small></td>
                <td><small><strong><small>{{$yajalonBanco}}</small></strong></small></td>
                <td><small><strong><small>{{$yajalonEfectivos}}</small></strong></small></td>
                <td><small><strong><small class="text-success">{{$totTotalPP}}</small></strong></small></td>
                <td><small><strong><small class="text-success">{{$totTotalCB}}</small></strong></small></td>
                <td><small><strong><small class="text-success">{{$totTotalEP}}</small></strong></small></td>
            </tr>
        </tbody>
    </table>


</body>