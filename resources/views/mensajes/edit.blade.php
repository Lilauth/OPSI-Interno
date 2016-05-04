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
           
		{!! Form::model($mensaje, [
    		'method' => 'PATCH',
    		'route' => ['mensajes.update', $mensaje->idMensaje]
		]) !!}

		<div class="form-group">
                    {!! Form::label('Fecha', 'Fecha:', ['class' => 'control-label']) !!}
                    {!! Form::text('Fecha', null, ['id' => 'datepicker', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Cliente', 'Cliente:', ['class' => 'control-label']) !!}
                    {!! Form::text('Cliente', null, ['class' => 'form-control']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('idCliente', 'Empresa:', ['class' => 'control-label']) !!}
                    {!! Form::select('idCliente', $clientes_sel, null, ['class' => 'form-control']) !!}
                </div>                

                <div class="form-group">
                     {!! Form::label('Para', 'Para:', ['class' => 'control-label']) !!}                    
                     {!! Form::select('Para', $desarrolladores_sel, null, ['class' => 'form-control']  
                     ) !!}
                 </div> 

                 <div class="form-group">
                    {!! Form::label('visto', 'Visto', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('visto') !!}
                 </div>

                 <div class="form-group">
                    {!! Form::label('Mensaje', 'Mensaje:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Mensaje', null, ['class' => 'form-control']) !!}
                 </div>

        {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}
		<div class="pull-right">
    		<a href="{{ route('mensajes.index') }}" class="btn btn-danger"></i>Cancel</a>
		</div>
		
         {!! Form::close() !!}
	</div>

	{!! Form::close() !!}
</div>

@endsection