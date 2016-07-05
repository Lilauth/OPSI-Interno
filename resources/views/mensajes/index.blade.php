@extends('layouts.app')

@section('content')    
	<div class="container">
	@include('partials.alerts.js_confirm')  
	<!-- success messages -->
	@if(Session::has('flash_message'))
		<div class="alert alert-success">
			{{ Session::get('flash_message') }}
		</div>
	@endif 
	 <!-- Current Clients -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>
					Mensajes Telef&oacute;nicos
					<div class="pull-right">
						{!! Form::open([
                            'method' => 'GET',
                            'route' => ['mensajes.create'],
                            'class' => 'navbar-form navbar-left pull-left'                                                         
						]) !!}
						{!! Form::submit('Nuevo Mensaje', ['class' => 'btn btn-primary']) !!}
						{!! Form::close() !!}           
					</div> 
				</h1>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
					{!! Form::open([
	                    'method' => 'GET',
	                    'route' => ['mensajes.index'],
	                    'class' => 'navbar-form',                                                                        
	                ]) !!}
					{!! Form::label('Estado', 'Visto:', ['class' => 'control-label']) !!}                                    
					{!! Form::select('visto', [
	                    '1' => 'Visto',
	                    '2' => 'No Vistos',
	                    '3' => 'Todos'], $visto, ['class' => 'form-control']
					) !!}
	                {!! Form::label('Para', 'Para:', ['class' => 'control-label']) !!}                                    
	                {!! Form::select('para', $desarrolladores_sel, $id_desarrollador, ['class' => 'form-control enfocar']) !!}
	                {!! Form::submit('Filtrar', ['class' => 'btn btn-default', 'id' => 'filtrar']) !!}
	                {!! Form::close() !!} 
				</div>
			</div>
			<div class="panel-body">                       
				<table class="table table-striped task-table">
					<thead>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Mensaje</th> 
						<th>Para</th>
						<th>Visto</th>
					 <!-- <th>&nbsp;</th>-->
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</thead>
					<tbody>
						@foreach ($mensajes as $mensaje)
							<tr>
								<td class="table-text"><div>{{ (new \Carbon\Carbon($mensaje->Fecha))->diffForHumans() }}</div></td>
								<td class="table-text"><div>{{ $mensaje->Cliente }}</div></td>
								<td class="table-text"><div>{{ $mensaje->Mensaje }}</div></td>                                       
								<td class="table-text"><div>{{ $mensaje->desarrollador->NombreDesarrollador }}</div></td>
								<td class="table/text"> {{ Form::checkbox('visto', $mensaje->idMensaje, $mensaje->visto, ['class' => 'form-control checkVisto', 'id' => $mensaje->idMensaje]) }} </td>
								<!--Editar Mensaje-->
								<td>
									{!! Form::open([
                                        'method' => 'GET',
                                        'route' => ['mensajes.edit', $mensaje->idMensaje]                                
									]) !!}
                                    {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}                                              
								</td>
								<!-- Task Delete Button -->
								<td>
									{!! Form::open([
											'method' => 'DELETE',
											'route' => ['mensajes.destroy', $mensaje->idMensaje],
											'onsubmit' => 'return ConfirmDelete()'                  
									]) !!}
                                    {!! Form::button('Delete <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
									{!! Form::close() !!}                                           
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div>
                    {!! $mensajes->render() !!}
				</div>
			</div>                
		</div>         
	</div>    
	@include('layouts.spinner')
@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
	{!!Html::script('js/mensajes/setVisto.js')!!}
@endsection