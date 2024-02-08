<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #621132;">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Semana</h5>
            </div>
            {!! Form::open(['method' => 'POST', 'id' => 'frmAddSemana']) !!}
            <div class="modal-body">
                <div class="mb-2">
                    {!! Form::label('semana', 'Semana:', ['class' => 'col-form-label']) !!}
                    {!! Form::number('semana', null, ['class' => 'form-control', 'id' => 'semana', 'min' => '1']) !!}
                </div>
                <div class="mb-2">
                    {!! Form::label('fechaInicio', 'Fecha Inicio:', ['class' => 'col-form-label']) !!}
                    {!! Form::date('fechaInicio', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechaInicio']) !!}
                </div>
                <div class="mb-2">
                    {!! Form::label('fechaFin', 'Fecha Fin:', ['class' => 'col-form-label']) !!}
                    {!! Form::date('fechaFin', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fechaFin']) !!}
                </div>
                <div class="mb-2">
                    {!! Form::label('ejercicio', 'Ejercicio:', ['class' => 'col-form-label']) !!}
                    {!! Form::text('ejercicio', null, ['class' => 'form-control', 'id' => 'ejercicio', 'autocomplete' => 'off']) !!}
                </div>
                <div class="mb-2">
                    {!! Form::label('activo', 'Activo:', ['class' => 'col-form-label']) !!}
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="activo" name="activo">
                        <label class="custom-control-label" for="activo">&nbsp;</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) !!}

                {!! Form::submit('Guardad', ['class' => 'btn btn-primary', 'id' => 'agregarSemana']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
