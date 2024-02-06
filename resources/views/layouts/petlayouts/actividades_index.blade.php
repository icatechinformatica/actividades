@extends('adminlte::page')

@section('title', 'Catálogo de Actividades - Entrega Recepción')

@section('css')
    <style>
        table.main {
            border-collapse: collapse;
            border-spacing: 0px 10px;
            width: 100%;
        }

        table.main tr {
            border-bottom: 1.5px solid rgba(0, 0, 0, 0.1);
        }

        table.main tr th {
            border: 0.6px solid white;
            border-collapse: collapse;
            padding: 9px;
            font-size: 12px;
            background-color: #770723 !important;
            color: #fff;
        }

        table.main tr td {
            line-height: 17px;
            border-left: 1px solid rgba(0, 0, 0, 0.1);
        }

        table.main tr td:last-child {
            border-right: 1px solid rgba(0, 0, 0, 0.1);
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

        table tr td.activity {
            text-align: justify-left;
            font-weight: bold;
            font-size: 12px;
            padding: 5px 4px;
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
            <div class="card-header">Catálogo de Actividades</div>
            <div class="card-body">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" onclick="NuevaFunction()">Agregar
                        Asuntos</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addActivityModal">Agregar Actividades</button>
                </div>
                <br>
                <div class="col-12">
                    <table class="main">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Fecha</th>
                                <th>Usuario Crea</th>
                                <th>Usuario Modifica</th>
                                <th>Más</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asuntoActividades as $k => $v)
                                <tr class="gantt__row-head">
                                    <td colspan="14">{{ $v->asunto }}</td>
                                </tr>
                                @foreach ($v->actividades as $key)
                                    @php
                                        $actividad = $key->id;
                                        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                        $fecha = Carbon\Carbon::parse($key->created_at);
                                        $mes = $meses[$fecha->format('n') - 1];
                                        $fechaCreado = $fecha->format('d') . ' de ' . $mes . ' ' . $fecha->format('Y');
                                    @endphp
                                    <tr>
                                        <td class="activity">
                                            {{ $key->actividad }}
                                        </td>
                                        <td>{{ $fechaCreado }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- incluir modal de inserción de datos --}}
        @include('layouts.modal.asunto_add')
        {{-- modal de actividades  --}}
        @include('layouts.modal.add_activity_modal')
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('jqueryValidate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('jqueryValidate/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        function NuevaFunction() {
            $('#asuntoAddModal').modal('show');
        }

        function nuevaActividad() {
            $('#addActivityModal').modal('show');
        }

        $(document).ready(function() {
            $('#agregarAsunto').on('click', function(e) {
                e.preventDefault();
                const formData = new FormData($('#frmModalSubject')[0]);
                const urlData = "{{ route('pet.subject.store') }}";
                $.ajax({
                    url: urlData,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function() {
                        // procesar antes de enviar
                        $('#frmModalSubject').attr('disabled',
                            'disabled'); // deshabilitar el formulario
                    },
                    success: function(res) {
                        console.log(res);
                        let formModal = $('#frmModalSubject');
                        formModal?.attr('disabled',
                            false); // el formulario se habilita nuevamente
                        formModal?.trigger("reset"); // resetear formulario
                        $('#asuntoAddModal').modal('hide'); // ocultar modal
                        window.location.href =
                            "{{ route('pet.actividades.index') }}"; // redirect
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.statusText);
                        console.log(xhr.responseText);
                        console.log(xhr.status);
                        console.log(textStatus);
                        console.log(error);
                    }
                });
            });


            const form = $('#frmActivyty');

            form.validate({
                errorClass: "error",
                rules: {
                    asunto: {
                        required: true
                    },
                    actividad: {
                        required: true
                    }
                },
                messages: {
                    asunto: {
                        required: "El Asunto es requerido"
                    },
                    actividad: {
                        required: "La Actividad es requerida",
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass(errorClass);
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    const frmdata = new FormData($('#frmActivyty')[0]);
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        data: frmdata,
                        url: "{{ route('pet.activity.store') }}",
                        beforeSend: function() {
                            // procesar antes de enviar
                            $('#frmActivyty').attr('disabled',
                                'disabled'); // deshabilitar el formulario
                        },
                        success: function(data) {
                            console.log(data);
                            $('#addActivityModal').modal('hide'); // cerrar el modal
                            // resetear formulario del modal
                            $('#frmActivyty')[0].reset();
                            //redireccionar
                            window.location.href = "{{ route('pet.actividades.index') }}";
                        },
                        error: function(xhr, textStatus, error) {
                            // manejar errores
                            console.log(xhr.statusText);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                            console.log(textStatus);
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
