<div class="modal fade" id="asuntoAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #621132;">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Asunto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['method' => 'POST', 'id' => 'frmModalSubject']) !!}
            <div class="modal-body">

                <div class="mb-3">
                    {!! Form::label('subject', 'Asunto:', ['class' => 'col-form-label']) !!}
                    {!! Form::text('asunto', null, ['class' => 'form-control', 'id' => 'subject']) !!}
                </div>

            </div>
            <div class="modal-footer">
                {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) !!}

                {!! Form::button('Agregar Asunto', ['class' => 'btn btn-primary', 'id' => 'agregarAsunto']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
