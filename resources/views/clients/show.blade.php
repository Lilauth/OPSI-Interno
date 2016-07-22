<!-- MODAL -->
<div class="modal fade" id="showModal" role="dialog">
    <div class="modal-dialog">
<!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Datos de Cliente</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::hidden('id', null, ['class' => 'control-label', 'id' => 'clienteId']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('codigo', 'C&oacute;digo:', ['class' => 'control-label']) !!}
                    {!! Form::label(null, null, ['id' => 'codigo']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::label(null, null, ['class' => 'control-label', 'id' => 'nombre']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::label(null, null, ['class' => 'control-label', 'id' => 'telefono']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('observaciones', 'Observaciones:', ['class' => 'control-label']) !!}
                    {!! Form::textarea(null, null, ['class' => 'control-label', 'id' => 'observaciones']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('otrosnombres', 'Otros Nombres:', ['class' => 'control-label']) !!}
                    {!! Form::label(null, null, ['class' => 'control-label', 'id' => 'otrosnombres']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nivel', 'Nivel:', ['class' => 'control-label']) !!}
                    {!! Form::label(null, null, ['class' => 'control-label', 'id' => 'nivel']) !!}
                </div>
            </div>
        </div>
    </div>
</div>