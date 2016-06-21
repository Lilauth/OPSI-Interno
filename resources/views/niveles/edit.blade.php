@extends('layouts.app')

@section('content')
<div class="container">
	 
	 <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Nivel de Cliente</h1>                       
            </div>
     <div class="panel-body"> 
        @include('partials.alerts.errors')
        <!-- success messages -->
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
           
		{!! Form::model($nivel, [
    		'method' => 'PATCH',
    		'route' => ['niveles.update', $nivel->idNivel]
		]) !!}

		<div class="form-group">
            {!! Form::label('Descripcion', 'Descripcion:', ['class' => 'control-label']) !!}
            {!! Form::text('Descripcion', $nivel->Descripcion, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Color', 'Color:', ['class' => 'control-label']) !!}
            <div id="cp2" class="input-group colorpicker-component">
                {!! Form::text('codColor', $nivel->codColor, ['class' => 'form-control']) !!}
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>

		<div class="pull-right">
    		<a href="{{ route('niveles.index') }}" class="btn btn-danger"></i>Cancel</a>
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
