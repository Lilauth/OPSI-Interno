@extends('layouts.app')

@section('content')
<div class="container">
	 
	 <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Cliente</h1>                       
            </div>
     <div class="panel-body"> 
        @include('partials.alerts.errors')
        <!-- success messages -->
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
           
		{!! Form::model($cliente, [
    		'method' => 'PATCH',
    		'route' => ['client.update', $cliente->IdCliente]
		]) !!}

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
                             '4' => 'Sin Nada'], null, ['class' => 'form-control']
                     ) !!}
                 </div>

                <div class="form-group">
                    {!! Form::label('Mantenimiento', 'Mantenimiento', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('Mantenimiento') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Observaciones', 'Observaciones:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Observaciones', null, ['class' => 'form-control']) !!}
                </div>

                <div id="map">
                    {!! Form::label('position', 'Direcci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::hidden('position', null, ['class' => 'form-control', 'id' => 'position']) !!}
                    {!! $map['html'] !!}
                </div>

		<div class="pull-right">
    		<a href="{{ route('client.index') }}" class="btn btn-danger"></i>Cancel</a>
		</div>
		{!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

	</div>

	{!! Form::close() !!}
</div>

@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    @include('gmaps.headscripts')
@endsection