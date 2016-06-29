<!--*****************************************************************************************-->
<!--************ÉSTE TEMPLATE ESPERA UNA $asistencia Y UNA COLECCIÓN DE $clientes************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="createModal-Entrada" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Nueva Entrada</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open(['url' => 'entradasalida']) !!}

                <div class="form-group">
                    {!! Form::label('radioE', 'Entrada:', ['class' => 'control-label']) !!}
                    {!! Form::radio('Movimiento', 'E', true, ['method' => 'GET', 'id' => 'radioE']) !!}

                    <div class="pull-right">
                        {!! Form::label('radioS', 'Salida:', ['class' => 'control-label']) !!}
                        {!! Form::radio('Movimiento', 'S', false, ['method' => 'GET', 'id' => 'radioS']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Fecha', 'Fecha:', ['class' => 'control-label']) !!}
                    {!! Form::text('Fecha', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control datepicker']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Hora', 'Hora:', ['class' => 'control-label']) !!}
                    {!! Form::text('Hora', \Carbon\Carbon::now()->format('H:i'), ['id' => 'desde', 'class' => 'Hora form-control']) !!}                     
                </div>

                <div class="form-group">
                    {!! Form::label('Concepto', 'Concepto:', ['class' => 'control-label']) !!}
                    {!! Form::text('Concepto', null, ['class' => 'form-control']) !!}
                </div>
 
                <div class="form-group">
                    {!! Form::label('Monto', 'Monto:', ['class' => 'control-label']) !!}
                    {!! Form::text('Monto', null, ['class' => 'form-control amount']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Responsable', 'Responsable:', ['class' => 'control-label']) !!}
                    {!! Form::text('Responsable', null, ['class' => 'form-control']) !!}
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