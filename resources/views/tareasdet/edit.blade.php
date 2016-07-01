<!-- MODAL -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

<!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Editar Tarea</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['tareasdet.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idAsistencia', null, ['id' => 'asistenciaId_E']) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('idTarea', null, ['id' => 'tareaId']) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('idTrabajo', null, ['id' => 'trabajoId_E']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('cliente', 'Cliente:', ['class' => 'control-label']) !!}
                    {!! Form::select('idCliente', $clientes, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'clientesE']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Trabajo', 'Trabajo:', ['class' => 'control-label']) !!}
                    {!! Form::select('idTrabajo', ['0' => '--Seleccionar Cliente--'], null, ['class' => 'form-control', 'id' => 'trabajosE']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Descripcion', null, ['class' => 'form-control', 'id' => 'tareaDescripcionE']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('CantHoras', 'Cant. Horas:', ['class' => 'control-label']) !!}
                    {!! Form::text('cantHoras', null, ['id' => 'debe', 'class' => 'cantHoras form-control', 'id' => 'cantHorasE']) !!}                     
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('asistencias.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>