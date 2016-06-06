@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
					<div>
						<input type="text" id="cliente" name="cliente" placeholder="32">
						Presiona el botón para enviar petición Ajax
						<input type="button" href="javascript:;" onclick="buscarTrabajos()" value="Calcula"/>
						<br/>
						Resultado: <div id="resultado">0</div>
					</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!!Html::script('js/scriptEjemplo.js')!!}
@endsection