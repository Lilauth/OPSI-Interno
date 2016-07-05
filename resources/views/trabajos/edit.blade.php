@extends('layouts.app')

@section('content')
<div class="container">
	 
	 <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Trabajo</h1>                       
            </div>
     <div class="panel-body"> 
        @include('partials.alerts.errors')
        <!-- success messages -->
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
           
		{!! Form::model($trabajo, [
    		'method' => 'PATCH',
    		'route' => ['trabajos.update', $trabajo->idTrabajo]
		]) !!}

        <div class="form-group">
            {!! Form::label('FechaCarga', 'Fecha de Carga:', ['class' => 'control-label']) !!}
            {!! Form::text('fechaCarga', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control datepicker enfocar']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('PedidaPor', 'Pedida Por:', ['class' => 'control-label']) !!}
            {!! Form::text('PedidaPor', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('cliente', 'Cliente:', ['class' => 'control-label']) !!}
            {!! Form::select('idCliente', $clientes, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Sistema', 'Sistema:', ['class' => 'control-label']) !!}
            {!! Form::select('idSistema', $sistemas, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('DescCorta', 'Descripci&oacute;n Corta:', ['class' => 'control-label']) !!}
            {!! Form::text('DescCorta', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
            {!! Form::textarea('Descripcion', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('responsable', 'Responsable:', ['class' => 'control-label']) !!}
            {!! Form::select('idProgramador', $desarrolladores, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Estado', 'Estado:', ['class' => 'control-label']) !!}
            {!! Form::select('idEstado', $estados, null, ['class' => 'form-control']) !!}
        </div>

		<div class="pull-right">
    		<a href="{{ route('trabajos.index') }}" class="btn btn-danger"></i>Cancel</a>
		</div>
		{!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

	</div>

	{!! Form::close() !!}
</div>

@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
    {!!Html::script('js/funciones/datepicker.js')!!}
@endsection
