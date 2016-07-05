@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Asistencia</h1>
            </div>

            <div class="panel-body">                
                @include('partials.alerts.errors')
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::model($asistencia, [
                    'method' => 'PATCH',
                    'route' => ['asistencias.update', $asistencia->idAsistencia]
                ]) !!}

                
                <div class="form-group">
                    {!! Form::label('Fecha', 'Fecha:', ['class' => 'control-label']) !!}
                    {!! Form::text('fecha', $asistencia->fecha->format('d-m-Y'), ['class' => 'form-control enfocar datepicker']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Desarrollador', 'Desarrollador:', ['class' => 'control-label']) !!}
                    {!! Form::select('idDesarrollador', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control']) !!}
                </div>

<!--CONTROLES DE TIPO "TIMEPICKER"-->
                <div class="form-group">
                    {!! Form::label('Desde', 'Desde:', ['class' => 'control-label']) !!}
                    {!! Form::text('desde', $asistencia->desde->format('H:i'), ['id' => 'desde', 'class' => 'desdeHasta form-control']) !!}                     
                </div>

                <div class="form-group">
                    {!! Form::label('Hasta', 'Hasta:', ['class' => 'control-label']) !!}
                    {!! Form::text('hasta', (($asistencia->hasta == null) ? Null : ($asistencia->hasta->format('H:i'))), ['id' => 'hasta', 'class' => 'desdeHasta form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Debe', 'Debe:', ['class' => 'control-label']) !!}
                    {!! Form::text('debe', (($asistencia->debe == null) ? Null : ($asistencia->debe->format('H:i'))), ['id' => 'debe', 'class' => 'cantHoras form-control']) !!}                     
                </div>

                <div class="form-group">
                    {!! Form::label('Recupera', 'Recupera:', ['class' => 'control-label']) !!}
                    {!! Form::text('recupera', (($asistencia->recupera == null) ? Null : ($asistencia->recupera->format('H:i'))), ['id' => 'recupera', 'class' => 'cantHoras form-control']) !!}    
                </div>
<!--FIN CONTROLES DE TIPO "TIMEPICKER"-->

                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

                <div class="pull-right">
                    <a href="{{ route('asistencias.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/funciones/timepicker.js') !!} 
@endsection
