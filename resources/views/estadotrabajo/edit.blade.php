@extends('layouts.app')

@section('content')
<div class="container">
	 
	 <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Estado de Trabajo</h1>                       
            </div>
     <div class="panel-body"> 
        @include('partials.alerts.errors')
        <!-- success messages -->
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
           
		{!! Form::model($estadotrabajo, [
    		'method' => 'PATCH',
    		'route' => ['estadostrabajo.update', $estadotrabajo->idEstado]
		]) !!}

		<div class="form-group">
            {!! Form::label('Estado', 'Estado:', ['class' => 'control-label']) !!}
            {!! Form::text('Estado', $estadotrabajo->Estado, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Color', 'Color:', ['class' => 'control-label']) !!}
            <div id="cp2" class="input-group colorpicker-component">
                {!! Form::text('codColor', $estadotrabajo->codColor, ['class' => 'form-control']) !!}
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>

		<div class="pull-right">
    		<a href="{{ route('estadostrabajo.index') }}" class="btn btn-danger"></i>Cancel</a>
		</div>
		{!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}

	</div>

	{!! Form::close() !!}
</div>

@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){
        $("input[name='estado']").focus();
    });

    </script>

    <script>
        $(function() {
            $("#cp2").colorpicker({format: "hex",
                colorSelectors: {
                      'default': '#777777',
                      'primary': '#337ab7',
                      'success': '#5cb85c',
                      'info': '#5bc0de',
                      'warning': '#f0ad4e',
                      'danger': '#d9534f'
                  }
            });
        });
    </script>
@endsection
