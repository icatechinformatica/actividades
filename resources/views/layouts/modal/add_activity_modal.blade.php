<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #621132;">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['method' => 'POST', 'id' => 'frmActivyty']) !!}
            <div class="modal-body">

                <div class="mb-2">
                    {!! Form::label('asunto', 'Asunto:', ['class' => 'col-form-label']) !!}
                    {!! Form::select('asunto', $getSubject , null, ['placeholder' => 'Seleccionar Asunto...', 'class' => 'form-control', 'id' => 'asunto']); !!}
                </div>

                <div class="mb-2">
                    {!! Form::label('actividad', 'Actividad:', ['class' => 'col-form-label']) !!}
                    {!! Form::text('actividad', null, ['class' => 'form-control', 'id' => 'actividad', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) !!}

                {!! Form::submit('Agregar Actividad', ['class' => 'btn btn-primary', 'id' => 'agregarActivity']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
