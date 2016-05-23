@extends('layouts.app')

@section('content')
<div class="container">
	 
	 <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Sistema de Cliente</h1>                       
            </div>
     <div class="panel-body"> 
        @include('partials.alerts.errors')
        <!-- success messages -->
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
           
		{!! Form::model($sistema, [
    		'method' => 'PATCH',
    		'route' => ['sistemas.update', $sistema->idSistema]
		]) !!}

		<div class="form-group">
            {!! Form::label('Descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
            {!! Form::text('Descripcion', $sistema->Descripcion, ['class' => 'form-control']) !!}
        </div>

		<div class="pull-right">
    		<a href="{{ route('sistemas.index') }}" class="btn btn-danger"></i>Cancel</a>
		</div>
		{!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

	</div>

	{!! Form::close() !!}
</div>

@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){
        $("input[name='Descripcion']").focus();
    });

    </script>
@endsection
