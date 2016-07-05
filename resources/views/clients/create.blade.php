@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Nuevo Cliente</h1>                       
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
                {!! Form::open(['url' => 'client']) !!}

                <div class="form-group">
                    {!! Form::label('NombreCliente', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('NombreCliente', null, ['class' => 'form-control enfocar']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Telefono', 'Teléfono:', ['class' => 'control-label']) !!}
                    {!! Form::text('Telefono', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('OtrosNombres', 'Contactos:', ['class' => 'control-label']) !!}
                    {!! Form::text('OtrosNombres', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                     {!! Form::label('idNivel', 'Nivel:', ['class' => 'control-label']) !!}                    
                     {!! Form::select('idNivel', [
                             '1' => 'Prioritario',
                             '2' => 'Prioritario Nivel 2',
                             '3' => 'Sistema Periodo Adaptacion',
                             '4' => 'Sin Nada'], '3', ['class' => 'form-control']
                     ) !!}
                 </div>

                 <div class="form-group">
                    {!! Form::label('Mantenimiento', 'Mantenimiento', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('Mantenimiento', '1', true) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Observaciones', 'Observaciones:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Observaciones', null, ['class' => 'form-control']) !!}
                </div>                

                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

                <div class="pull-right">
                    <a href="{{ route('client.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
@endsection