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

        tbody tr td {
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

        input.error {
            background-color: ivory;
            border: 1px solid red;;
            outline: 1px solid red;
            border-radius: 4px;
        }
        label.error {
            color:#770723
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
            <div class="card-header">Catálogo de Semanas</div>
            <div class="card-body">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Agregar Semana
                    </button>
                </div>
                <br>
                <div class="col-12">
                    <table class="main">
                        <thead>
                            <tr>
                                <th>Semana</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Ejercicio</th>
                                <th>Más</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catSemanas as $k => $v)
                                @php
                                    $fechaInicio = Carbon\Carbon::parse($v->inicio);
                                    $fechaFin = Carbon\Carbon::parse($v->fin);
                                @endphp
                                <tr>
                                    <td>{{ $v->semana }}</td>
                                    <td>{{ $fechaInicio->format('d-m-Y') }}</td>
                                    <td>{{ $fechaFin->format('d-m-Y') }}</td>
                                    <td>{{ $v->ejercicio }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    {{ $catSemanas->links() }}
                </div>
            </div>
        </div>
        {{-- incluir modal de inserción de datos --}}
        @include('layouts.modal.add_semana_modal')
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

        function nuevaActividad() {
            $('#addActivityModal').modal('show');
        }

        $(document).ready(function() {

            const form = $('#frmAddSemana');

            form.validate({
                errorClass: "error",
                rules: {
                    semana: {
                        required: true
                    },
                    fechaInicio: {
                        required: true,
                        date: true
                    },
                    ejercicio: {
                        required: true,
                    }
                },
                messages: {
                    semana: {
                        required: "La Semana es requerido"
                    },
                    fechaInicio: {
                        required: "La Fecha de Inicio es requerida",
                    },
                    ejercicio: {
                        required: "El ejercio es requerido"
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass(errorClass);
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    const frmdata = new FormData($('#frmAddSemana')[0]);
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        data: frmdata,
                        url: "{{ route('pet.semana.store') }}",
                        beforeSend: function() {
                            // procesar antes de enviar
                            $('#frmAddSemana').attr('disabled',
                                'disabled'); // deshabilitar el formulario
                        },
                        success: function(data) {
                            console.log(data);
                            $('#addActivityModal').modal('hide'); // cerrar el modal
                            // resetear formulario del modal
                            $('#frmAddSemana')[0].reset();
                            //redireccionar
                            window.location.href = "{{ route('pet.semana.index') }}";
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
