<!-- MODAL -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Editar Entrada-Salida</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::model($entrada, [
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['entradasalida.update', $entrada->idEntradaSalida]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idEntradaSalida', null, ['id' => 'movimientoId']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('radioE', 'Entrada:', ['class' => 'control-label']) !!}
                    {!! Form::radio('Movimiento', 'E', true, ['method' => 'GET', 'id' => 'radioE_E']) !!}

                    <div class="pull-right">
                        {!! Form::label('radioS', 'Salida:', ['class' => 'control-label']) !!}
                        {!! Form::radio('Movimiento', 'S', false, ['method' => 'GET', 'id' => 'radioS_E']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Fecha', 'Fecha:', ['class' => 'control-label datepicker']) !!}
                    {!! Form::text('Fecha', null, ['class' => 'form-control datepicker', 'id' => 'Fecha_E']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Hora', 'Hora:', ['class' => 'control-label']) !!}
                    {!! Form::text('Hora', null, ['id' => 'desde', 'class' => 'desdeHasta form-control', 'id' => 'Hora_E']) !!}                     
                </div>

                <div class="form-group">
                    {!! Form::label('Concepto', 'Concepto:', ['class' => 'control-label']) !!}
                    {!! Form::text('Concepto', 'null', ['class' => 'form-control', 'id' => 'Concepto_E']) !!}
                </div>
 
                <div class="form-group">
                    {!! Form::label('Monto', 'Monto:', ['class' => 'control-label']) !!}
                    {!! Form::text('Monto', 'null', ['class' => 'form-control amount', 'id' => 'Monto_E']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Responsable', 'Responsable:', ['class' => 'control-label']) !!}
                    {!! Form::text('Responsable', 'null', ['class' => 'form-control', 'id' => 'Responsable_E']) !!}
                </div>

                 {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ url('cajachica') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>

@section('scripts')
    {!!Html::script('js/funciones/datepicker.js')!!}
    {!!Html::script('js/funciones/timepicker.js')!!}
@endsection